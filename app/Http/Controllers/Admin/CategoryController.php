<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(Request $request): View
    {
        $categories = Category::query()
            ->with(['parent'])
            ->withCount('products')
            ->withTrashed()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = trim($request->string('search')->toString());

                $query->where(function ($inner) use ($search) {
                    $inner->where('name', 'like', "%{$search}%")
                        ->orWhere('slug', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')->toString()))
            ->latest('sort_order')
            ->latest('created_at')
            ->paginate(15)
            ->withQueryString();

        return view('admin.categories.index', [
            'categories' => $categories,
        ]);
    }

    public function create(): View
    {
        return view('admin.categories.create', [
            'category' => new Category(),
            'parents' => Category::query()->withTrashed()->orderBy('name')->get(),
            'isEdit' => false,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateCategory($request);

        $category = DB::transaction(function () use ($request, $validated) {
            $category = Category::create([
                'parent_id' => $validated['parent_id'] ?? null,
                'name' => $validated['name'],
                'slug' => $this->generateUniqueSlug($validated['slug'] ?: $validated['name']),
                'description' => $validated['description'] ?? null,
                'status' => $validated['status'],
                'sort_order' => $validated['sort_order'] ?? 0,
            ]);

            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('categories/' . $category->id, 'public');
                $category->image_path = $path;
                $category->save();
            }

            return $category;
        });

        return redirect()
            ->route('admin.categories.index')
            ->with('success', "Đã thêm danh mục thành công: {$category->name}");
    }

    public function edit(Category $category): View
    {
        return view('admin.categories.edit', [
            'category' => $category->load('parent'),
            'parents' => Category::query()
                ->withTrashed()
                ->where('id', '!=', $category->id)
                ->orderBy('name')
                ->get(),
            'isEdit' => true,
        ]);
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $this->validateCategory($request, $category);

        DB::transaction(function () use ($request, $validated, $category) {
            $category->fill([
                'parent_id' => $validated['parent_id'] ?? null,
                'name' => $validated['name'],
                'description' => $validated['description'] ?? null,
                'status' => $validated['status'],
                'sort_order' => $validated['sort_order'] ?? 0,
            ]);

            $category->slug = $this->generateUniqueSlug($validated['slug'] ?: $validated['name'], $category->id);
            $category->save();

            if ($request->hasFile('image')) {
                if ($category->image_path) {
                    Storage::disk('public')->delete($category->image_path);
                }

                $category->image_path = $request->file('image')->store('categories/' . $category->id, 'public');
                $category->save();
            }
        });

        return redirect()
            ->route('admin.categories.index')
            ->with('success', "Đã cập nhật danh mục thành công: {$category->name}");
    }

    public function destroy(Category $category): RedirectResponse
    {
        if ($category->hasProducts()) {
            return back()->with('error', 'Không thể xóa danh mục vì vẫn còn sản phẩm thuộc danh mục này.');
        }

        DB::transaction(function () use ($category) {
            $category = Category::query()->withTrashed()->lockForUpdate()->findOrFail($category->id);
            $category->delete();
        });

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Đã xóa mềm danh mục thành công.');
    }

    public function restore(Category $category): RedirectResponse
    {
        DB::transaction(function () use ($category) {
            $category = Category::query()->withTrashed()->lockForUpdate()->findOrFail($category->id);

            if (! $category->trashed()) {
                return;
            }

            $category->restore();
        });

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Đã khôi phục danh mục thành công.');
    }

    private function validateCategory(Request $request, ?Category $category = null): array
    {
        $rules = [
            'parent_id' => [
                'nullable',
                'integer',
                Rule::exists('categories', 'id'),
            ],
            'name' => ['required', 'string', 'max:255'],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('categories', 'slug')->ignore($category?->id),
            ],
            'description' => ['nullable', 'string', 'max:5000'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'status' => ['required', Rule::in(['active', 'hidden'])],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:65535'],
        ];

        if ($category) {
            $rules['parent_id'][] = Rule::notIn([$category->id]);
        }

        return $request->validate($rules);
    }

    private function generateUniqueSlug(string $value, ?int $ignoreId = null): string
    {
        $base = Str::slug($value);
        $slug = $base;
        $index = 1;

        while (Category::withTrashed()
            ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->where('slug', $slug)
            ->exists()) {
            $slug = $base . '-' . $index++;
        }

        return $slug;
    }
}
