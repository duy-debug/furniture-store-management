<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Danh sách sản phẩm public.
     * Hỗ trợ: phân trang, sắp xếp, lọc danh mục, khoảng giá, tồn kho, tìm kiếm.
     */
    public function index(Request $request): View
    {
        $query = Product::query()
            ->where('status', 'active')
            ->with(['category', 'images']);

        // Tìm kiếm theo từ khóa
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('product_code', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('material', 'like', "%{$search}%");
            });
        }

        // Lọc theo danh mục
        if ($categoryId = $request->input('category')) {
            $query->where('category_id', $categoryId);
        }

        // Lọc theo khoảng giá
        if ($minPrice = $request->input('min_price')) {
            $query->where('price', '>=', $minPrice);
        }

        if ($maxPrice = $request->input('max_price')) {
            $query->where('price', '<=', $maxPrice);
        }

        // Lọc theo trạng thái còn hàng
        if ($request->input('in_stock') === '1') {
            $query->where('stock_quantity', '>', 0);
        }

        // Sắp xếp
        $sort = $request->input('sort', 'newest');
        $query = match ($sort) {
            'price_asc' => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            'name_asc' => $query->orderBy('name', 'asc'),
            'name_desc' => $query->orderBy('name', 'desc'),
            default => $query->orderBy('created_at', 'desc'),
        };

        $products = $query->paginate(12)->withQueryString();

        $categories = Category::where('status', 'active')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('products.index', compact('products', 'categories') + [
            'layout' => $this->resolvePublicLayout($request),
        ]);
    }

    /**
     * Chi tiết sản phẩm.
     */
    public function show(Request $request, string $slug): View
    {
        $product = Product::where('slug', $slug)
            ->where('status', 'active')
            ->with(['category', 'images'])
            ->firstOrFail();

        // Sản phẩm liên quan (cùng danh mục)
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 'active')
            ->with('images')
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts') + [
            'layout' => $this->resolvePublicLayout($request),
        ]);
    }

    private function resolvePublicLayout(Request $request): string
    {
        $user = $request->user();

        if (! $user) {
            return 'public-layout';
        }

        return $user->hasRole(['admin', 'staff']) ? 'public-layout' : 'app-layout';
    }
}
