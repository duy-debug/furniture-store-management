<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Tạo danh mục
        $categories = [
            ['name' => 'Phòng khách', 'slug' => 'phong-khach', 'description' => 'Nội thất phòng khách', 'sort_order' => 1],
            ['name' => 'Phòng ngủ', 'slug' => 'phong-ngu', 'description' => 'Nội thất phòng ngủ', 'sort_order' => 2],
            ['name' => 'Phòng bếp', 'slug' => 'phong-bep', 'description' => 'Nội thất nhà bếp', 'sort_order' => 3],
            ['name' => 'Văn phòng', 'slug' => 'van-phong', 'description' => 'Nội thất văn phòng', 'sort_order' => 4],
        ];

        $catModels = [];
        foreach ($categories as $cat) {
            $catModels[] = Category::updateOrCreate(['slug' => $cat['slug']], $cat);
        }

        // Tạo sản phẩm
        $products = [
            // Phòng khách
            ['category' => 0, 'name' => 'Sofa góc L vải bố cao cấp', 'price' => 12500000, 'material' => 'Vải bố', 'color' => 'Xám đậm', 'size' => '280x180x85 cm', 'stock' => 5],
            ['category' => 0, 'name' => 'Bàn trà mặt đá marble', 'price' => 4200000, 'material' => 'Đá marble + Inox', 'color' => 'Trắng', 'size' => '120x60x45 cm', 'stock' => 12],
            ['category' => 0, 'name' => 'Kệ tivi gỗ sồi tự nhiên', 'price' => 6800000, 'material' => 'Gỗ sồi', 'color' => 'Nâu tự nhiên', 'size' => '200x40x50 cm', 'stock' => 8],
            ['category' => 0, 'name' => 'Ghế thư giãn bọc da', 'price' => 8900000, 'material' => 'Da thật', 'color' => 'Nâu bò', 'size' => '90x85x100 cm', 'stock' => 3],

            // Phòng ngủ
            ['category' => 1, 'name' => 'Giường ngủ gỗ óc chó 1m8', 'price' => 15800000, 'material' => 'Gỗ óc chó', 'color' => 'Nâu óc chó', 'size' => '200x180x35 cm', 'stock' => 4],
            ['category' => 1, 'name' => 'Tủ quần áo 4 cánh', 'price' => 9500000, 'material' => 'Gỗ MDF phủ melamine', 'color' => 'Trắng kem', 'size' => '200x60x220 cm', 'stock' => 6],
            ['category' => 1, 'name' => 'Bàn trang điểm có gương', 'price' => 3200000, 'material' => 'Gỗ công nghiệp', 'color' => 'Trắng', 'size' => '100x45x75 cm', 'stock' => 10],
            ['category' => 1, 'name' => 'Tab đầu giường 2 ngăn kéo', 'price' => 1800000, 'material' => 'Gỗ MDF', 'color' => 'Xám', 'size' => '50x40x55 cm', 'stock' => 15],

            // Phòng bếp
            ['category' => 2, 'name' => 'Bàn ăn gỗ tự nhiên 6 ghế', 'price' => 11200000, 'material' => 'Gỗ ash', 'color' => 'Nâu sáng', 'size' => '160x80x75 cm', 'stock' => 3],
            ['category' => 2, 'name' => 'Tủ bếp trên dưới chữ L', 'price' => 25000000, 'material' => 'Gỗ Acrylic', 'color' => 'Trắng bóng', 'size' => '300x60x220 cm', 'stock' => 2],
            ['category' => 2, 'name' => 'Ghế bar chân sắt mặt gỗ', 'price' => 1500000, 'material' => 'Sắt + Gỗ', 'color' => 'Đen + Nâu', 'size' => '40x40x75 cm', 'stock' => 20],
            ['category' => 2, 'name' => 'Kệ gia vị treo tường', 'price' => 850000, 'material' => 'Inox 304', 'color' => 'Bạc', 'size' => '60x15x40 cm', 'stock' => 0],

            // Văn phòng
            ['category' => 3, 'name' => 'Bàn làm việc chữ L', 'price' => 4500000, 'material' => 'Gỗ MDF + Sắt', 'color' => 'Nâu + Đen', 'size' => '140x120x75 cm', 'stock' => 7],
            ['category' => 3, 'name' => 'Ghế công thái học Ergonomic', 'price' => 6200000, 'material' => 'Lưới mesh + Nhôm', 'color' => 'Đen', 'size' => '65x65x120 cm', 'stock' => 9],
            ['category' => 3, 'name' => 'Tủ hồ sơ 3 ngăn có khóa', 'price' => 2800000, 'material' => 'Thép sơn tĩnh điện', 'color' => 'Xám', 'size' => '45x62x100 cm', 'stock' => 14],
            ['category' => 3, 'name' => 'Kệ sách 5 tầng', 'price' => 2100000, 'material' => 'Gỗ thông', 'color' => 'Tự nhiên', 'size' => '80x30x180 cm', 'stock' => 0],
        ];

        foreach ($products as $index => $item) {
            $slug = Str::slug($item['name']);
            $code = 'SP' . str_pad($index + 1, 4, '0', STR_PAD_LEFT);

            Product::updateOrCreate(
                ['product_code' => $code],
                [
                    'category_id' => $catModels[$item['category']]->id,
                    'product_code' => $code,
                    'slug' => $slug,
                    'name' => $item['name'],
                    'description' => 'Sản phẩm ' . $item['name'] . ' chất lượng cao, thiết kế hiện đại phù hợp với mọi không gian sống.',
                    'price' => $item['price'],
                    'cost_price' => $item['price'] * 0.6,
                    'size' => $item['size'],
                    'material' => $item['material'],
                    'color' => $item['color'],
                    'stock_quantity' => $item['stock'],
                    'low_stock_threshold' => 5,
                    'status' => 'active',
                ]
            );
        }
    }
}
