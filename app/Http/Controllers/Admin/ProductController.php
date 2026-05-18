<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $products = Product::query()
            ->with(['category', 'images'])
            ->withCount('orderItems')
            ->withTrashed()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = trim($request->string('search')->toString());

                $query->where(function ($inner) use ($search) {
                    $inner->where('name', 'like', "%{$search}%")
                        ->orWhere('product_code', 'like', "%{$search}%")
                        ->orWhere('material', 'like', "%{$search}%")
                        ->orWhere('color', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('category_id'), fn ($query) => $query->where('category_id', $request->integer('category_id')))
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')->toString()))
            ->latest('created_at')
            ->paginate(15)
            ->withQueryString();

        return view('admin.products.index', [
            'products' => $products,
            'categories' => Category::query()->orderBy('sort_order')->orderBy('name')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.products.create', [
            'product' => new Product(),
            'categories' => Category::query()->orderBy('sort_order')->orderBy('name')->get(),
            'isEdit' => false,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateProduct($request);

        $product = DB::transaction(function () use ($request, $validated) {
            $product = Product::create([
                'category_id' => $validated['category_id'],
                'product_code' => $validated['product_code'],
                'slug' => $this->generateUniqueSlug($validated['name']),
                'name' => $validated['name'],
                'description' => $validated['description'] ?? null,
                'price' => $validated['price'],
                'size' => $validated['size'] ?? null,
                'material' => $validated['material'] ?? null,
                'color' => $validated['color'] ?? null,
                'stock_quantity' => $validated['stock_quantity'],
                'low_stock_threshold' => 5,
                'status' => $validated['status'],
            ]);

            if ($request->hasFile('image')) {
                $this->storePrimaryImage($request, $product);
            }

            return $product;
        });

        return redirect()
            ->route('admin.products.show', $product)
            ->with('success', 'Đã thêm sản phẩm thành công.');
    }

    public function show(Product $product): View
    {
        $product->load(['category', 'images.uploader', 'orderItems.order']);

        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product): View
    {
        $product->load('images');

        return view('admin.products.edit', [
            'product' => $product,
            'categories' => Category::query()->orderBy('sort_order')->orderBy('name')->get(),
            'isEdit' => true,
        ]);
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $this->validateProduct($request, $product);

        DB::transaction(function () use ($request, $validated, $product) {
            $product = Product::withTrashed()->with('images')->lockForUpdate()->findOrFail($product->id);

            $product->fill([
                'category_id' => $validated['category_id'],
                'name' => $validated['name'],
                'description' => $validated['description'] ?? null,
                'price' => $validated['price'],
                'size' => $validated['size'] ?? null,
                'material' => $validated['material'] ?? null,
                'color' => $validated['color'] ?? null,
                'stock_quantity' => $validated['stock_quantity'],
                'status' => $validated['status'],
            ]);

            if ($product->isDirty('name')) {
                $product->slug = $this->generateUniqueSlug($validated['name'], $product->id);
            }

            $product->save();

            if ($request->hasFile('image')) {
                $this->replacePrimaryImage($request, $product);
            }
        });

        return redirect()
            ->route('admin.products.show', $product)
            ->with('success', 'Đã cập nhật sản phẩm thành công.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        DB::transaction(function () use ($product) {
            $product = Product::withTrashed()->lockForUpdate()->findOrFail($product->id);

            if ($product->hasTransactions()) {
                $product->status = 'hidden';
                $product->save();
                return;
            }

            $product->delete();
        });

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Đã xử lý sản phẩm theo quy tắc giao dịch.');
    }

    public function restore(Product $product): RedirectResponse
    {
        DB::transaction(function () use ($product) {
            $product = Product::withTrashed()->lockForUpdate()->findOrFail($product->id);

            if (! $product->trashed()) {
                return;
            }

            $product->restore();
        });

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Đã khôi phục sản phẩm thành công.');
    }

    public function images(Product $product): View
    {
        $product->load(['images.uploader']);

        return view('admin.products.images', compact('product'));
    }

    public function storeImages(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'images' => ['required', 'array', 'min:1'],
            'images.*' => ['required', 'file', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'primary_index' => ['nullable', 'integer', 'min:0'],
        ]);

        DB::transaction(function () use ($request, $product, $validated) {
            $product = Product::withTrashed()->with('images')->lockForUpdate()->findOrFail($product->id);

            $primaryIndex = isset($validated['primary_index']) ? (int) $validated['primary_index'] : null;
            $sortOrder = (int) ($product->images->max('sort_order') ?? -1) + 1;
            $createdImages = [];

            foreach ($request->file('images') as $file) {
                $path = $file->store('products/' . $product->id, 'public');

                $createdImages[] = ProductImage::create([
                    'product_id' => $product->id,
                    'uploaded_by' => $request->user()->id,
                    'image_path' => $path,
                    'alt_text' => $product->name,
                    'is_primary' => false,
                    'sort_order' => $sortOrder++,
                ]);
            }

            if (!empty($createdImages)) {
                $hasPrimary = $product->images->contains(fn ($image) => (bool) $image->is_primary);
                if ($primaryIndex !== null && isset($createdImages[$primaryIndex])) {
                    $this->setPrimaryImageInternal($product, $createdImages[$primaryIndex]);
                } elseif (!$hasPrimary) {
                    $this->setPrimaryImageInternal($product, $createdImages[0]);
                }
            }
        });

        return redirect()
            ->route('admin.products.images', $product)
            ->with('success', 'Đã tải ảnh sản phẩm thành công.');
    }

    public function setPrimaryImage(Product $product, ProductImage $image): RedirectResponse
    {
        if ($image->product_id !== $product->id) {
            abort(404);
        }

        DB::transaction(function () use ($product, $image) {
            $product = Product::withTrashed()->with('images')->lockForUpdate()->findOrFail($product->id);
            $image = ProductImage::query()->lockForUpdate()->findOrFail($image->id);

            $this->setPrimaryImageInternal($product, $image);
        });

        return redirect()
            ->route('admin.products.images', $product)
            ->with('success', 'Đã đặt ảnh đại diện.');
    }

    public function destroyImage(Product $product, ProductImage $image): RedirectResponse
    {
        if ($image->product_id !== $product->id) {
            abort(404);
        }

        DB::transaction(function () use ($product, $image) {
            $product = Product::withTrashed()->with('images')->lockForUpdate()->findOrFail($product->id);
            $image = ProductImage::query()->lockForUpdate()->findOrFail($image->id);

            if ($image->image_path) {
                Storage::disk('public')->delete($image->image_path);
            }

            $wasPrimary = (bool) $image->is_primary;
            $image->delete();

            if ($wasPrimary) {
                $nextImage = $product->images()
                    ->where('id', '!=', $image->id)
                    ->orderBy('sort_order')
                    ->orderBy('id')
                    ->first();

                if ($nextImage) {
                    $this->setPrimaryImageInternal($product, $nextImage);
                }
            }
        });

        return redirect()
            ->route('admin.products.images', $product)
            ->with('success', 'Đã xóa ảnh sản phẩm.');
    }

    private function validateProduct(Request $request, ?Product $product = null): array
    {
        return $request->validate([
            'product_code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('products', 'product_code')->ignore($product?->id),
            ],
            'category_id' => ['required', 'integer', Rule::exists('categories', 'id')],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'price' => ['required', 'numeric', 'min:0'],
            'size' => ['nullable', 'string', 'max:150'],
            'material' => ['nullable', 'string', 'max:150'],
            'color' => ['nullable', 'string', 'max:100'],
            'stock_quantity' => ['required', 'integer', 'min:0'],
            'status' => ['required', Rule::in(['active', 'hidden'])],
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);
    }

    private function generateUniqueSlug(string $value, ?int $ignoreId = null): string
    {
        $base = Str::slug($value);
        $slug = $base;
        $index = 1;

        while (Product::withTrashed()
            ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->where('slug', $slug)
            ->exists()) {
            $slug = $base . '-' . $index++;
        }

        return $slug;
    }

    private function storePrimaryImage(Request $request, Product $product): void
    {
        $path = $request->file('image')->store('products/' . $product->id, 'public');

        ProductImage::create([
            'product_id' => $product->id,
            'uploaded_by' => $request->user()->id,
            'image_path' => $path,
            'alt_text' => $product->name,
            'is_primary' => true,
            'sort_order' => 0,
        ]);
    }

    private function replacePrimaryImage(Request $request, Product $product): void
    {
        $existingPrimary = $product->images()->where('is_primary', true)->first();
        $path = $request->file('image')->store('products/' . $product->id, 'public');

        if ($existingPrimary) {
            if ($existingPrimary->image_path) {
                Storage::disk('public')->delete($existingPrimary->image_path);
            }

            $existingPrimary->update([
                'uploaded_by' => $request->user()->id,
                'image_path' => $path,
                'alt_text' => $product->name,
            ]);
        } else {
            ProductImage::create([
                'product_id' => $product->id,
                'uploaded_by' => $request->user()->id,
                'image_path' => $path,
                'alt_text' => $product->name,
                'is_primary' => true,
                'sort_order' => 0,
            ]);
        }
    }

    private function setPrimaryImageInternal(Product $product, ProductImage $image): void
    {
        $product->images()->update(['is_primary' => false]);
        $image->is_primary = true;
        $image->save();
    }
}
