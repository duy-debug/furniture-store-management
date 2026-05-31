<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $catalog = [
                [
                    'category' => ['name' => 'Sofa vải', 'slug' => 'sofa-vai', 'description' => 'Các mẫu sofa vải thoáng mát, dễ phối màu cho phòng khách hiện đại.', 'sort_order' => 1],
                    'products' => [
                        ['name' => 'Sofa vải 3 chỗ Milan', 'price' => 12900000, 'material' => 'Khung gỗ thông, vải bố cao cấp', 'color' => 'Xám ghi', 'size' => '220x90x85 cm', 'stock' => 6],
                        ['name' => 'Sofa góc L Nordic', 'price' => 16800000, 'material' => 'Khung gỗ sồi, vải nhung', 'color' => 'Be nhạt', 'size' => '280x180x88 cm', 'stock' => 4],
                        ['name' => 'Sofa băng 2 chỗ Compact', 'price' => 8900000, 'material' => 'Gỗ thông, mút D40', 'color' => 'Xanh olive', 'size' => '180x85x82 cm', 'stock' => 8],
                        ['name' => 'Sofa giường đa năng Urban', 'price' => 14900000, 'material' => 'Khung thép sơn tĩnh điện, vải polyester', 'color' => 'Xanh than', 'size' => '200x100x90 cm', 'stock' => 5],
                        ['name' => 'Ghế đôn sofa đồng bộ', 'price' => 2200000, 'material' => 'Vải nỉ, chân gỗ tự nhiên', 'color' => 'Kem', 'size' => '70x55x42 cm', 'stock' => 12],
                    ],
                ],
                [
                    'category' => ['name' => 'Sofa da', 'slug' => 'sofa-da', 'description' => 'Sofa da thật và da công nghiệp sang trọng cho không gian tiếp khách.', 'sort_order' => 2],
                    'products' => [
                        ['name' => 'Sofa da 3 chỗ Verona', 'price' => 21900000, 'material' => 'Da bò Ý, khung gỗ sồi', 'color' => 'Nâu cognac', 'size' => '230x95x88 cm', 'stock' => 3],
                        ['name' => 'Sofa góc L da công nghiệp', 'price' => 17900000, 'material' => 'Da PU, khung gỗ dầu', 'color' => 'Đen', 'size' => '275x175x86 cm', 'stock' => 4],
                        ['name' => 'Sofa băng da 2 chỗ', 'price' => 13200000, 'material' => 'Da microfiber, mút đàn hồi', 'color' => 'Nâu đậm', 'size' => '190x92x84 cm', 'stock' => 5],
                        ['name' => 'Ghế đơn da thư giãn', 'price' => 7600000, 'material' => 'Da thật, chân thép sơn', 'color' => 'Nâu caramel', 'size' => '92x86x98 cm', 'stock' => 7],
                        ['name' => 'Đôn da phòng khách', 'price' => 1950000, 'material' => 'Da PU, khung gỗ MDF', 'color' => 'Đen', 'size' => '60x45x40 cm', 'stock' => 15],
                    ],
                ],
                [
                    'category' => ['name' => 'Bàn trà', 'slug' => 'ban-tra', 'description' => 'Bàn trà phòng khách với nhiều lựa chọn mặt đá, gỗ và kính cường lực.', 'sort_order' => 3],
                    'products' => [
                        ['name' => 'Bàn trà mặt đá marble', 'price' => 5400000, 'material' => 'Đá marble, chân inox', 'color' => 'Trắng vân xám', 'size' => '120x60x45 cm', 'stock' => 10],
                        ['name' => 'Bàn trà đôi tổ ong', 'price' => 6200000, 'material' => 'MDF phủ melamine, chân sắt', 'color' => 'Nâu óc chó', 'size' => '80x80x42 cm', 'stock' => 7],
                        ['name' => 'Bàn trà tròn kính cường lực', 'price' => 3900000, 'material' => 'Kính cường lực, thép sơn', 'color' => 'Đen', 'size' => '90x90x40 cm', 'stock' => 12],
                        ['name' => 'Bàn trà ngăn kéo gỗ sồi', 'price' => 7100000, 'material' => 'Gỗ sồi tự nhiên', 'color' => 'Nâu sáng', 'size' => '130x70x45 cm', 'stock' => 6],
                        ['name' => 'Bàn trà nâng mặt đa năng', 'price' => 5800000, 'material' => 'MDF chống ẩm, piston thép', 'color' => 'Kem', 'size' => '110x55x48 cm', 'stock' => 8],
                    ],
                ],
                [
                    'category' => ['name' => 'Kệ tivi', 'slug' => 'ke-tivi', 'description' => 'Kệ tivi tối ưu lưu trữ, phù hợp không gian phòng khách căn hộ và nhà phố.', 'sort_order' => 4],
                    'products' => [
                        ['name' => 'Kệ tivi gỗ sồi 2m', 'price' => 6900000, 'material' => 'Gỗ sồi', 'color' => 'Nâu tự nhiên', 'size' => '200x40x50 cm', 'stock' => 8],
                        ['name' => 'Kệ tivi treo tường hiện đại', 'price' => 5400000, 'material' => 'MDF phủ veneer', 'color' => 'Trắng kem', 'size' => '180x35x30 cm', 'stock' => 9],
                        ['name' => 'Kệ tivi thấp phong cách Nhật', 'price' => 4800000, 'material' => 'Gỗ ash', 'color' => 'Sồi sáng', 'size' => '160x38x42 cm', 'stock' => 11],
                        ['name' => 'Kệ tivi tích hợp ngăn kéo', 'price' => 8200000, 'material' => 'MDF lõi xanh, phụ kiện giảm chấn', 'color' => 'Xám khói', 'size' => '220x45x55 cm', 'stock' => 5],
                        ['name' => 'Kệ tivi mặt đá sang trọng', 'price' => 11800000, 'material' => 'Đá nhân tạo, khung gỗ', 'color' => 'Đen vân trắng', 'size' => '210x42x48 cm', 'stock' => 3],
                    ],
                ],
                [
                    'category' => ['name' => 'Tủ giày', 'slug' => 'tu-giay', 'description' => 'Tủ giày gọn gàng, hỗ trợ lưu trữ và giữ cho lối vào luôn ngăn nắp.', 'sort_order' => 5],
                    'products' => [
                        ['name' => 'Tủ giày 3 cánh cánh lật', 'price' => 3900000, 'material' => 'MDF chống ẩm', 'color' => 'Trắng', 'size' => '120x35x100 cm', 'stock' => 14],
                        ['name' => 'Tủ giày gỗ sồi có ghế ngồi', 'price' => 6200000, 'material' => 'Gỗ sồi tự nhiên', 'color' => 'Nâu sáng', 'size' => '140x40x110 cm', 'stock' => 7],
                        ['name' => 'Tủ giày thông thoáng 5 tầng', 'price' => 2800000, 'material' => 'Gỗ thông', 'color' => 'Tự nhiên', 'size' => '100x30x120 cm', 'stock' => 18],
                        ['name' => 'Tủ giày cửa lùa hiện đại', 'price' => 5100000, 'material' => 'MDF phủ melamine', 'color' => 'Xám nhạt', 'size' => '150x35x105 cm', 'stock' => 9],
                        ['name' => 'Tủ giày đa năng kèm móc treo', 'price' => 7300000, 'material' => 'MDF, thép sơn tĩnh điện', 'color' => 'Nâu óc chó', 'size' => '160x40x180 cm', 'stock' => 5],
                    ],
                ],
                [
                    'category' => ['name' => 'Ghế thư giãn', 'slug' => 'ghe-thu-gian', 'description' => 'Ghế thư giãn cho góc đọc sách, lounge tiếp khách hoặc phòng ngủ.', 'sort_order' => 6],
                    'products' => [
                        ['name' => 'Ghế thư giãn bọc vải bouclé', 'price' => 5600000, 'material' => 'Vải bouclé, chân gỗ sồi', 'color' => 'Kem sữa', 'size' => '88x82x92 cm', 'stock' => 10],
                        ['name' => 'Ghế bập bênh thư giãn', 'price' => 4100000, 'material' => 'Vải nỉ, khung gỗ uốn cong', 'color' => 'Xám tro', 'size' => '84x78x94 cm', 'stock' => 6],
                        ['name' => 'Ghế đơn lounge bọc da', 'price' => 8100000, 'material' => 'Da microfiber, chân thép', 'color' => 'Nâu caramel', 'size' => '90x86x100 cm', 'stock' => 4],
                        ['name' => 'Ghế papasan kèm đệm', 'price' => 3650000, 'material' => 'Mây tre, đệm cotton', 'color' => 'Tự nhiên', 'size' => '95x90x95 cm', 'stock' => 9],
                        ['name' => 'Ghế nằm đọc sách có gác chân', 'price' => 9200000, 'material' => 'Vải polyester, khung gỗ', 'color' => 'Xanh rêu', 'size' => '150x82x95 cm', 'stock' => 3],
                    ],
                ],
                [
                    'category' => ['name' => 'Giường gỗ', 'slug' => 'giuong-go', 'description' => 'Giường gỗ tự nhiên và công nghiệp, ưu tiên độ bền và tính thẩm mỹ.', 'sort_order' => 7],
                    'products' => [
                        ['name' => 'Giường gỗ óc chó 1m8', 'price' => 16200000, 'material' => 'Gỗ óc chó', 'color' => 'Nâu óc chó', 'size' => '200x180x35 cm', 'stock' => 4],
                        ['name' => 'Giường gỗ sồi có hộc kéo', 'price' => 14800000, 'material' => 'Gỗ sồi tự nhiên', 'color' => 'Nâu sáng', 'size' => '210x160x38 cm', 'stock' => 5],
                        ['name' => 'Giường gỗ ash kiểu Nhật', 'price' => 11900000, 'material' => 'Gỗ ash', 'color' => 'Vàng sồi', 'size' => '205x160x32 cm', 'stock' => 6],
                        ['name' => 'Giường gỗ công nghiệp hiện đại', 'price' => 9300000, 'material' => 'MDF chống ẩm', 'color' => 'Trắng kem', 'size' => '200x160x34 cm', 'stock' => 8],
                        ['name' => 'Giường platform tối giản', 'price' => 10700000, 'material' => 'Gỗ thông', 'color' => 'Tự nhiên', 'size' => '200x180x28 cm', 'stock' => 7],
                    ],
                ],
                [
                    'category' => ['name' => 'Giường bọc nệm', 'slug' => 'giuong-boc-nem', 'description' => 'Giường bọc nệm êm ái, phù hợp phòng ngủ phong cách khách sạn.', 'sort_order' => 8],
                    'products' => [
                        ['name' => 'Giường bọc nệm đầu cong', 'price' => 13900000, 'material' => 'Khung gỗ, nỉ cao cấp', 'color' => 'Xám ghi', 'size' => '210x180x100 cm', 'stock' => 5],
                        ['name' => 'Giường bọc nệm nhung mềm', 'price' => 15700000, 'material' => 'Vải nhung, khung gỗ thông', 'color' => 'Xanh navy', 'size' => '220x180x105 cm', 'stock' => 4],
                        ['name' => 'Giường bọc nệm có ngăn kéo', 'price' => 16800000, 'material' => 'Vải polyester, ván plywood', 'color' => 'Be', 'size' => '210x160x102 cm', 'stock' => 6],
                        ['name' => 'Giường bọc nệm chân thấp', 'price' => 12400000, 'material' => 'Nỉ, gỗ công nghiệp', 'color' => 'Xám đậm', 'size' => '200x160x96 cm', 'stock' => 8],
                        ['name' => 'Giường bọc nệm luxury king size', 'price' => 22900000, 'material' => 'Da microfiber, khung gỗ sồi', 'color' => 'Nâu champagne', 'size' => '220x200x110 cm', 'stock' => 2],
                    ],
                ],
                [
                    'category' => ['name' => 'Tủ quần áo', 'slug' => 'tu-quan-ao', 'description' => 'Tủ quần áo nhiều kích thước, tối ưu lưu trữ cho phòng ngủ gia đình.', 'sort_order' => 9],
                    'products' => [
                        ['name' => 'Tủ quần áo 4 cánh', 'price' => 9700000, 'material' => 'MDF phủ melamine', 'color' => 'Trắng kem', 'size' => '200x60x220 cm', 'stock' => 6],
                        ['name' => 'Tủ quần áo cửa lùa 3 cánh', 'price' => 11500000, 'material' => 'MDF lõi xanh', 'color' => 'Xám khói', 'size' => '180x60x220 cm', 'stock' => 5],
                        ['name' => 'Tủ quần áo kèm ngăn kéo', 'price' => 12800000, 'material' => 'Gỗ công nghiệp chống ẩm', 'color' => 'Nâu óc chó', 'size' => '220x60x220 cm', 'stock' => 4],
                        ['name' => 'Tủ quần áo cánh kính mờ', 'price' => 14900000, 'material' => 'MDF, kính mờ, nhôm', 'color' => 'Đen + khói', 'size' => '200x65x230 cm', 'stock' => 3],
                        ['name' => 'Tủ quần áo mini 2 cánh', 'price' => 6200000, 'material' => 'Gỗ thông', 'color' => 'Tự nhiên', 'size' => '120x55x190 cm', 'stock' => 10],
                    ],
                ],
                [
                    'category' => ['name' => 'Bàn trang điểm', 'slug' => 'ban-trang-diem', 'description' => 'Bàn trang điểm có gương, ngăn kéo và thiết kế tinh gọn cho phòng ngủ.', 'sort_order' => 10],
                    'products' => [
                        ['name' => 'Bàn trang điểm có gương LED', 'price' => 5200000, 'material' => 'MDF chống ẩm', 'color' => 'Trắng', 'size' => '100x45x75 cm', 'stock' => 8],
                        ['name' => 'Bàn trang điểm gỗ sồi mini', 'price' => 6100000, 'material' => 'Gỗ sồi tự nhiên', 'color' => 'Nâu sáng', 'size' => '110x50x78 cm', 'stock' => 5],
                        ['name' => 'Bàn phấn ngăn kéo đôi', 'price' => 4700000, 'material' => 'MDF phủ veneer', 'color' => 'Kem', 'size' => '95x45x72 cm', 'stock' => 12],
                        ['name' => 'Bàn trang điểm phong cách Hàn', 'price' => 6800000, 'material' => 'Gỗ công nghiệp', 'color' => 'Be sáng', 'size' => '105x48x76 cm', 'stock' => 7],
                        ['name' => 'Bàn trang điểm kèm ghế đôn', 'price' => 7900000, 'material' => 'MDF, chân thép sơn', 'color' => 'Trắng mờ', 'size' => '120x50x78 cm', 'stock' => 4],
                    ],
                ],
                [
                    'category' => ['name' => 'Tab đầu giường', 'slug' => 'tab-dau-giuong', 'description' => 'Tab đầu giường nhỏ gọn, tăng khả năng lưu trữ bên cạnh giường ngủ.', 'sort_order' => 11],
                    'products' => [
                        ['name' => 'Tab đầu giường 2 ngăn kéo', 'price' => 1800000, 'material' => 'Gỗ MDF', 'color' => 'Xám', 'size' => '50x40x55 cm', 'stock' => 15],
                        ['name' => 'Tab đầu giường gỗ sồi', 'price' => 2600000, 'material' => 'Gỗ sồi tự nhiên', 'color' => 'Nâu sáng', 'size' => '48x38x52 cm', 'stock' => 11],
                        ['name' => 'Tab đầu giường treo tường', 'price' => 1450000, 'material' => 'MDF chống ẩm', 'color' => 'Trắng', 'size' => '45x30x25 cm', 'stock' => 20],
                        ['name' => 'Tab đầu giường mặt đá', 'price' => 3100000, 'material' => 'Đá nhân tạo, khung thép', 'color' => 'Đen', 'size' => '50x40x50 cm', 'stock' => 6],
                        ['name' => 'Tab đầu giường tối giản', 'price' => 2100000, 'material' => 'Gỗ thông', 'color' => 'Tự nhiên', 'size' => '42x35x48 cm', 'stock' => 14],
                    ],
                ],
                [
                    'category' => ['name' => 'Bàn ăn', 'slug' => 'ban-an', 'description' => 'Bàn ăn cho gia đình nhỏ đến đông người, đa dạng chất liệu và kiểu dáng.', 'sort_order' => 12],
                    'products' => [
                        ['name' => 'Bàn ăn gỗ tự nhiên 6 ghế', 'price' => 11900000, 'material' => 'Gỗ ash', 'color' => 'Nâu sáng', 'size' => '160x80x75 cm', 'stock' => 3],
                        ['name' => 'Bàn ăn mặt đá 4 ghế', 'price' => 9800000, 'material' => 'Đá ceramic, chân thép', 'color' => 'Trắng vân xám', 'size' => '140x80x75 cm', 'stock' => 5],
                        ['name' => 'Bàn ăn tròn mở rộng', 'price' => 13600000, 'material' => 'Gỗ sồi, cơ cấu mở rộng', 'color' => 'Nâu mật ong', 'size' => '120-160x120x75 cm', 'stock' => 4],
                        ['name' => 'Bàn ăn 8 ghế phong cách Bắc Âu', 'price' => 18500000, 'material' => 'Gỗ tần bì, vải nệm', 'color' => 'Kem + gỗ tự nhiên', 'size' => '180x90x75 cm', 'stock' => 2],
                        ['name' => 'Bàn ăn gấp gọn căn hộ', 'price' => 6900000, 'material' => 'MDF chống ẩm', 'color' => 'Trắng', 'size' => '120x75x75 cm', 'stock' => 9],
                    ],
                ],
                [
                    'category' => ['name' => 'Ghế ăn', 'slug' => 'ghe-an', 'description' => 'Ghế ăn đồng bộ bàn ăn, chú trọng độ bền, độ thoải mái và tính thẩm mỹ.', 'sort_order' => 13],
                    'products' => [
                        ['name' => 'Ghế ăn gỗ bọc nệm', 'price' => 1250000, 'material' => 'Gỗ sồi, nệm vải', 'color' => 'Nâu sáng', 'size' => '45x52x82 cm', 'stock' => 20],
                        ['name' => 'Ghế ăn bọc da công nghiệp', 'price' => 1450000, 'material' => 'Da PU, chân thép', 'color' => 'Đen', 'size' => '46x54x84 cm', 'stock' => 18],
                        ['name' => 'Ghế ăn Nordic lưng cong', 'price' => 980000, 'material' => 'Gỗ ash', 'color' => 'Tự nhiên', 'size' => '44x50x80 cm', 'stock' => 24],
                        ['name' => 'Ghế ăn đệm nhung', 'price' => 1690000, 'material' => 'Vải nhung, chân gỗ', 'color' => 'Xanh rêu', 'size' => '46x53x83 cm', 'stock' => 12],
                        ['name' => 'Ghế ăn quầy bar cao', 'price' => 1790000, 'material' => 'Sắt sơn tĩnh điện, gỗ', 'color' => 'Đen + nâu', 'size' => '48x50x105 cm', 'stock' => 10],
                    ],
                ],
                [
                    'category' => ['name' => 'Tủ bếp', 'slug' => 'tu-bep', 'description' => 'Tủ bếp module cho căn hộ và nhà phố, tối ưu công năng và độ bền.', 'sort_order' => 14],
                    'products' => [
                        ['name' => 'Tủ bếp chữ L Acrylic', 'price' => 28500000, 'material' => 'MDF lõi xanh phủ Acrylic', 'color' => 'Trắng bóng', 'size' => '300x60x220 cm', 'stock' => 2],
                        ['name' => 'Tủ bếp trên dưới laminate', 'price' => 23900000, 'material' => 'MDF chống ẩm phủ Laminate', 'color' => 'Xám khói', 'size' => '280x60x220 cm', 'stock' => 3],
                        ['name' => 'Tủ bếp chữ I căn hộ', 'price' => 19800000, 'material' => 'MDF chống ẩm', 'color' => 'Kem', 'size' => '240x60x220 cm', 'stock' => 4],
                        ['name' => 'Tủ bếp gỗ sồi tự nhiên', 'price' => 36900000, 'material' => 'Gỗ sồi', 'color' => 'Nâu sáng', 'size' => '320x65x220 cm', 'stock' => 1],
                        ['name' => 'Tủ bếp module treo tường', 'price' => 14900000, 'material' => 'MDF chống ẩm', 'color' => 'Trắng kem', 'size' => '200x35x80 cm', 'stock' => 5],
                    ],
                ],
                [
                    'category' => ['name' => 'Phụ kiện bếp', 'slug' => 'phu-kien-bep', 'description' => 'Phụ kiện bếp hỗ trợ sắp xếp và tối ưu không gian lưu trữ trong khu bếp.', 'sort_order' => 15],
                    'products' => [
                        ['name' => 'Kệ gia vị treo tường', 'price' => 850000, 'material' => 'Inox 304', 'color' => 'Bạc', 'size' => '60x15x40 cm', 'stock' => 20],
                        ['name' => 'Giá bát nâng hạ', 'price' => 2900000, 'material' => 'Inox sơn tĩnh điện', 'color' => 'Bạc', 'size' => '80x30x70 cm', 'stock' => 8],
                        ['name' => 'Khay chia ngăn kéo bếp', 'price' => 620000, 'material' => 'Nhựa ABS', 'color' => 'Xám', 'size' => '50x40x5 cm', 'stock' => 25],
                        ['name' => 'Kệ úp chén 2 tầng', 'price' => 1100000, 'material' => 'Inox 304', 'color' => 'Bạc', 'size' => '60x25x45 cm', 'stock' => 18],
                        ['name' => 'Mâm xoay góc tủ bếp', 'price' => 1750000, 'material' => 'Thép mạ crom', 'color' => 'Bạc', 'size' => '80x80x20 cm', 'stock' => 10],
                    ],
                ],
                [
                    'category' => ['name' => 'Bàn làm việc', 'slug' => 'ban-lam-viec', 'description' => 'Bàn làm việc cho học tập và văn phòng tại nhà, nhiều kích thước tiện dụng.', 'sort_order' => 16],
                    'products' => [
                        ['name' => 'Bàn làm việc chữ L', 'price' => 4500000, 'material' => 'Gỗ MDF, sắt sơn tĩnh điện', 'color' => 'Nâu + đen', 'size' => '140x120x75 cm', 'stock' => 7],
                        ['name' => 'Bàn làm việc tối giản 120cm', 'price' => 2900000, 'material' => 'MDF phủ melamine', 'color' => 'Trắng', 'size' => '120x60x75 cm', 'stock' => 15],
                        ['name' => 'Bàn làm việc có hộc tủ', 'price' => 4100000, 'material' => 'Gỗ công nghiệp', 'color' => 'Nâu sồi', 'size' => '140x70x75 cm', 'stock' => 9],
                        ['name' => 'Bàn standing desk điện', 'price' => 12500000, 'material' => 'Khung thép, mặt gỗ MDF', 'color' => 'Đen', 'size' => '160x80x72-118 cm', 'stock' => 4],
                        ['name' => 'Bàn làm việc kèm kệ sách', 'price' => 5600000, 'material' => 'MDF, thép', 'color' => 'Xám gỗ', 'size' => '150x60x150 cm', 'stock' => 6],
                    ],
                ],
                [
                    'category' => ['name' => 'Ghế văn phòng', 'slug' => 'ghe-van-phong', 'description' => 'Ghế văn phòng và ghế công thái học cho làm việc lâu dài, giảm mỏi lưng cổ.', 'sort_order' => 17],
                    'products' => [
                        ['name' => 'Ghế công thái học Ergonomic', 'price' => 6200000, 'material' => 'Lưới mesh, nhôm', 'color' => 'Đen', 'size' => '65x65x120 cm', 'stock' => 9],
                        ['name' => 'Ghế xoay lưng cao', 'price' => 3200000, 'material' => 'Da PU, chân thép', 'color' => 'Nâu đậm', 'size' => '68x68x118 cm', 'stock' => 11],
                        ['name' => 'Ghế lưới văn phòng', 'price' => 2100000, 'material' => 'Lưới mesh, khung nhựa', 'color' => 'Đen', 'size' => '60x60x112 cm', 'stock' => 20],
                        ['name' => 'Ghế gaming làm việc', 'price' => 5400000, 'material' => 'Da PU, đệm mút lạnh', 'color' => 'Đen đỏ', 'size' => '70x70x125 cm', 'stock' => 6],
                        ['name' => 'Ghế quỳ văn phòng', 'price' => 1800000, 'material' => 'Vải lưới, chân thép', 'color' => 'Xám', 'size' => '55x55x95 cm', 'stock' => 14],
                    ],
                ],
                [
                    'category' => ['name' => 'Tủ hồ sơ', 'slug' => 'tu-ho-so', 'description' => 'Tủ hồ sơ văn phòng với khóa an toàn và khả năng lưu trữ tài liệu tốt.', 'sort_order' => 18],
                    'products' => [
                        ['name' => 'Tủ hồ sơ 3 ngăn có khóa', 'price' => 2800000, 'material' => 'Thép sơn tĩnh điện', 'color' => 'Xám', 'size' => '45x62x100 cm', 'stock' => 14],
                        ['name' => 'Tủ hồ sơ cánh kính', 'price' => 4900000, 'material' => 'Thép, kính cường lực', 'color' => 'Trắng', 'size' => '90x40x185 cm', 'stock' => 8],
                        ['name' => 'Tủ tài liệu thấp 2 cánh', 'price' => 2300000, 'material' => 'MDF phủ melamine', 'color' => 'Nâu gỗ', 'size' => '80x40x90 cm', 'stock' => 16],
                        ['name' => 'Tủ locker văn phòng 6 ngăn', 'price' => 5800000, 'material' => 'Thép sơn tĩnh điện', 'color' => 'Xanh nhạt', 'size' => '90x45x180 cm', 'stock' => 5],
                        ['name' => 'Tủ hồ sơ di động', 'price' => 1950000, 'material' => 'MDF chống ẩm', 'color' => 'Trắng kem', 'size' => '40x45x65 cm', 'stock' => 12],
                    ],
                ],
                [
                    'category' => ['name' => 'Kệ sách', 'slug' => 'ke-sach', 'description' => 'Kệ sách cho phòng khách, phòng làm việc và không gian học tập.', 'sort_order' => 19],
                    'products' => [
                        ['name' => 'Kệ sách 5 tầng', 'price' => 2100000, 'material' => 'Gỗ thông', 'color' => 'Tự nhiên', 'size' => '80x30x180 cm', 'stock' => 12],
                        ['name' => 'Kệ sách chữ A', 'price' => 2600000, 'material' => 'MDF, chân sắt', 'color' => 'Trắng + đen', 'size' => '85x35x175 cm', 'stock' => 9],
                        ['name' => 'Kệ sách treo tường', 'price' => 1450000, 'material' => 'MDF chống ẩm', 'color' => 'Nâu sáng', 'size' => '100x20x60 cm', 'stock' => 20],
                        ['name' => 'Kệ sách module 6 ô', 'price' => 3400000, 'material' => 'Gỗ công nghiệp', 'color' => 'Xám gỗ', 'size' => '120x30x120 cm', 'stock' => 10],
                        ['name' => 'Kệ sách có cửa kính', 'price' => 5200000, 'material' => 'MDF, kính mờ', 'color' => 'Nâu óc chó', 'size' => '90x35x190 cm', 'stock' => 4],
                    ],
                ],
                [
                    'category' => ['name' => 'Bàn học', 'slug' => 'ban-hoc', 'description' => 'Bàn học cho trẻ em và người lớn với kích thước gọn và tiện dụng.', 'sort_order' => 20],
                    'products' => [
                        ['name' => 'Bàn học sinh có kệ sách', 'price' => 2900000, 'material' => 'MDF chống ẩm', 'color' => 'Trắng', 'size' => '120x60x120 cm', 'stock' => 15],
                        ['name' => 'Bàn học đôi cho bé', 'price' => 4100000, 'material' => 'Gỗ công nghiệp', 'color' => 'Xanh pastel', 'size' => '140x60x125 cm', 'stock' => 7],
                        ['name' => 'Bàn học thông minh nâng hạ', 'price' => 6800000, 'material' => 'Khung thép, mặt MDF', 'color' => 'Trắng xám', 'size' => '110x60x75-105 cm', 'stock' => 5],
                        ['name' => 'Bàn học góc nhỏ', 'price' => 2400000, 'material' => 'MDF phủ melamine', 'color' => 'Nâu sồi', 'size' => '100x50x75 cm', 'stock' => 18],
                        ['name' => 'Bàn học có hộc kéo', 'price' => 3600000, 'material' => 'Gỗ thông', 'color' => 'Tự nhiên', 'size' => '120x55x76 cm', 'stock' => 9],
                    ],
                ],
                [
                    'category' => ['name' => 'Giường tầng', 'slug' => 'giuong-tang', 'description' => 'Giường tầng tối ưu diện tích cho phòng trẻ em và căn hộ nhỏ.', 'sort_order' => 21],
                    'products' => [
                        ['name' => 'Giường tầng trẻ em có cầu trượt', 'price' => 17900000, 'material' => 'Gỗ thông', 'color' => 'Trắng + hồng', 'size' => '250x120x180 cm', 'stock' => 3],
                        ['name' => 'Giường tầng gỗ tự nhiên', 'price' => 16500000, 'material' => 'Gỗ sồi', 'color' => 'Nâu sáng', 'size' => '240x110x175 cm', 'stock' => 4],
                        ['name' => 'Giường tầng có bàn học', 'price' => 19800000, 'material' => 'MDF chống ẩm, khung thép', 'color' => 'Trắng xám', 'size' => '260x125x190 cm', 'stock' => 2],
                        ['name' => 'Giường tầng tối giản cho bé', 'price' => 13900000, 'material' => 'Gỗ thông', 'color' => 'Tự nhiên', 'size' => '230x105x170 cm', 'stock' => 5],
                        ['name' => 'Giường tầng 3 ngăn kéo', 'price' => 21400000, 'material' => 'MDF lõi xanh', 'color' => 'Xanh navy', 'size' => '250x120x185 cm', 'stock' => 2],
                    ],
                ],
                [
                    'category' => ['name' => 'Nội thất trẻ em', 'slug' => 'noi-that-tre-em', 'description' => 'Nội thất an toàn cho phòng trẻ em, chú trọng màu sắc nhẹ nhàng và bền chắc.', 'sort_order' => 22],
                    'products' => [
                        ['name' => 'Tủ quần áo trẻ em 2 cánh', 'price' => 5700000, 'material' => 'MDF chống ẩm', 'color' => 'Trắng hồng', 'size' => '100x50x180 cm', 'stock' => 10],
                        ['name' => 'Bàn học trẻ em kèm ghế', 'price' => 3300000, 'material' => 'Gỗ công nghiệp', 'color' => 'Xanh pastel', 'size' => '100x55x75 cm', 'stock' => 12],
                        ['name' => 'Kệ đồ chơi 6 ô', 'price' => 2500000, 'material' => 'MDF bo cạnh', 'color' => 'Trắng + vàng', 'size' => '120x30x90 cm', 'stock' => 16],
                        ['name' => 'Giường đơn trẻ em', 'price' => 6900000, 'material' => 'Gỗ thông', 'color' => 'Kem', 'size' => '190x90x35 cm', 'stock' => 6],
                        ['name' => 'Ghế ngồi đọc sách trẻ em', 'price' => 1650000, 'material' => 'Vải nỉ, mút mềm', 'color' => 'Đỏ cam', 'size' => '55x55x60 cm', 'stock' => 14],
                    ],
                ],
                [
                    'category' => ['name' => 'Tủ trưng bày', 'slug' => 'tu-trung-bay', 'description' => 'Tủ trưng bày cho decor, rượu vang, sách hoặc bộ sưu tập cá nhân.', 'sort_order' => 23],
                    'products' => [
                        ['name' => 'Tủ trưng bày cánh kính', 'price' => 8400000, 'material' => 'MDF, kính cường lực', 'color' => 'Nâu óc chó', 'size' => '90x40x190 cm', 'stock' => 5],
                        ['name' => 'Tủ rượu trưng bày có đèn', 'price' => 11300000, 'material' => 'Gỗ công nghiệp, kính', 'color' => 'Đen', 'size' => '100x45x200 cm', 'stock' => 3],
                        ['name' => 'Tủ showcase 4 tầng', 'price' => 6900000, 'material' => 'MDF phủ veneer', 'color' => 'Trắng kem', 'size' => '80x35x180 cm', 'stock' => 7],
                        ['name' => 'Tủ trưng bày góc phòng', 'price' => 5200000, 'material' => 'Gỗ thông, kính mờ', 'color' => 'Tự nhiên', 'size' => '70x70x175 cm', 'stock' => 6],
                        ['name' => 'Tủ trưng bày mini', 'price' => 2900000, 'material' => 'MDF chống ẩm', 'color' => 'Xám nhạt', 'size' => '60x30x120 cm', 'stock' => 12],
                    ],
                ],
                [
                    'category' => ['name' => 'Bàn console', 'slug' => 'ban-console', 'description' => 'Bàn console trang trí lối vào, hành lang hoặc sau sofa.', 'sort_order' => 24],
                    'products' => [
                        ['name' => 'Bàn console chân sắt', 'price' => 3200000, 'material' => 'MDF, sắt sơn tĩnh điện', 'color' => 'Đen + nâu', 'size' => '120x35x80 cm', 'stock' => 14],
                        ['name' => 'Bàn console mặt đá', 'price' => 5900000, 'material' => 'Đá nhân tạo, chân thép', 'color' => 'Trắng vân mây', 'size' => '130x40x82 cm', 'stock' => 6],
                        ['name' => 'Bàn console gỗ sồi', 'price' => 4300000, 'material' => 'Gỗ sồi tự nhiên', 'color' => 'Nâu sáng', 'size' => '110x30x78 cm', 'stock' => 9],
                        ['name' => 'Bàn console gương decor', 'price' => 7600000, 'material' => 'Kính, thép không gỉ', 'color' => 'Bạc', 'size' => '100x35x85 cm', 'stock' => 4],
                        ['name' => 'Bàn console tối giản', 'price' => 2600000, 'material' => 'Gỗ thông', 'color' => 'Tự nhiên', 'size' => '100x30x75 cm', 'stock' => 18],
                    ],
                ],
                [
                    'category' => ['name' => 'Tủ ngăn kéo', 'slug' => 'tu-ngan-keo', 'description' => 'Tủ ngăn kéo hỗ trợ lưu trữ đồ dùng cá nhân và tài liệu nhỏ gọn.', 'sort_order' => 25],
                    'products' => [
                        ['name' => 'Tủ ngăn kéo 3 hộc', 'price' => 2500000, 'material' => 'MDF phủ melamine', 'color' => 'Trắng', 'size' => '80x45x90 cm', 'stock' => 12],
                        ['name' => 'Tủ ngăn kéo gỗ sồi', 'price' => 4500000, 'material' => 'Gỗ sồi tự nhiên', 'color' => 'Nâu sáng', 'size' => '90x50x100 cm', 'stock' => 8],
                        ['name' => 'Tủ ngăn kéo phòng ngủ', 'price' => 3600000, 'material' => 'Gỗ công nghiệp', 'color' => 'Xám nhạt', 'size' => '85x45x95 cm', 'stock' => 10],
                        ['name' => 'Tủ ngăn kéo có bánh xe', 'price' => 1900000, 'material' => 'MDF chống ẩm', 'color' => 'Kem', 'size' => '50x45x65 cm', 'stock' => 20],
                        ['name' => 'Tủ ngăn kéo mặt đá', 'price' => 6200000, 'material' => 'Đá nhân tạo, khung thép', 'color' => 'Đen', 'size' => '100x45x92 cm', 'stock' => 4],
                    ],
                ],
                [
                    'category' => ['name' => 'Kệ treo tường', 'slug' => 'ke-treo-tuong', 'description' => 'Kệ treo tường trang trí và lưu trữ nhẹ nhàng cho nhiều không gian.', 'sort_order' => 26],
                    'products' => [
                        ['name' => 'Kệ treo tường 3 tầng', 'price' => 950000, 'material' => 'Gỗ thông', 'color' => 'Tự nhiên', 'size' => '60x15x60 cm', 'stock' => 30],
                        ['name' => 'Kệ treo tường hình hộp', 'price' => 1250000, 'material' => 'MDF phủ melamine', 'color' => 'Trắng', 'size' => '80x20x40 cm', 'stock' => 22],
                        ['name' => 'Kệ treo tường decor phòng khách', 'price' => 1800000, 'material' => 'Gỗ sồi', 'color' => 'Nâu sáng', 'size' => '100x20x45 cm', 'stock' => 14],
                        ['name' => 'Kệ treo tường âm tường', 'price' => 2400000, 'material' => 'MDF chống ẩm', 'color' => 'Xám', 'size' => '90x25x50 cm', 'stock' => 10],
                        ['name' => 'Kệ treo tường zigzag', 'price' => 1600000, 'material' => 'MDF, thép sơn', 'color' => 'Đen + gỗ', 'size' => '75x18x55 cm', 'stock' => 18],
                    ],
                ],
                [
                    'category' => ['name' => 'Đồ decor', 'slug' => 'do-decor', 'description' => 'Đồ decor hoàn thiện không gian sống, tạo điểm nhấn cho nhà ở và văn phòng.', 'sort_order' => 27],
                    'products' => [
                        ['name' => 'Bộ bình gốm decor', 'price' => 1100000, 'material' => 'Gốm sứ', 'color' => 'Trắng ngà', 'size' => '30x12x25 cm', 'stock' => 25],
                        ['name' => 'Tượng decor trừu tượng', 'price' => 1800000, 'material' => 'Composite', 'color' => 'Đen mờ', 'size' => '20x15x40 cm', 'stock' => 16],
                        ['name' => 'Khung tranh canvas set 3', 'price' => 1450000, 'material' => 'Canvas, gỗ thông', 'color' => 'Đa sắc', 'size' => '40x60 cm', 'stock' => 20],
                        ['name' => 'Đồng hồ treo tường decor', 'price' => 2350000, 'material' => 'Kim loại, kính', 'color' => 'Vàng champagne', 'size' => '60x60x5 cm', 'stock' => 11],
                        ['name' => 'Bộ nến thơm trang trí', 'price' => 790000, 'material' => 'Sáp thực vật, thủy tinh', 'color' => 'Kem', 'size' => '12x12x15 cm', 'stock' => 35],
                    ],
                ],
                [
                    'category' => ['name' => 'Đèn trang trí', 'slug' => 'den-trang-tri', 'description' => 'Đèn trang trí tạo ánh sáng ấm và tăng điểm nhấn cho nội thất.', 'sort_order' => 28],
                    'products' => [
                        ['name' => 'Đèn sàn đọc sách', 'price' => 2200000, 'material' => 'Kim loại sơn, chụp vải', 'color' => 'Đen', 'size' => '35x35x160 cm', 'stock' => 12],
                        ['name' => 'Đèn bàn decor ánh vàng', 'price' => 1300000, 'material' => 'Gốm, vải', 'color' => 'Kem', 'size' => '25x25x45 cm', 'stock' => 18],
                        ['name' => 'Đèn thả trần 3 chao', 'price' => 3600000, 'material' => 'Thép sơn tĩnh điện', 'color' => 'Đen mờ', 'size' => '90x20x120 cm', 'stock' => 7],
                        ['name' => 'Đèn ngủ cảm ứng', 'price' => 890000, 'material' => 'Nhựa ABS', 'color' => 'Trắng', 'size' => '18x18x28 cm', 'stock' => 30],
                        ['name' => 'Đèn tường trang trí', 'price' => 1650000, 'material' => 'Kim loại, kính mờ', 'color' => 'Vàng đồng', 'size' => '20x15x35 cm', 'stock' => 14],
                    ],
                ],
                [
                    'category' => ['name' => 'Bàn ban công', 'slug' => 'ban-ban-cong', 'description' => 'Bàn nhỏ cho ban công, sân vườn và góc cà phê ngoài trời.', 'sort_order' => 29],
                    'products' => [
                        ['name' => 'Bàn ban công gấp gọn', 'price' => 2400000, 'material' => 'Gỗ acacia, khung thép', 'color' => 'Nâu + đen', 'size' => '70x70x75 cm', 'stock' => 14],
                        ['name' => 'Bàn cà phê ngoài trời tròn', 'price' => 1900000, 'material' => 'Nhôm đúc', 'color' => 'Xám đá', 'size' => '60x60x70 cm', 'stock' => 16],
                        ['name' => 'Bàn ban công mặt kính', 'price' => 3100000, 'material' => 'Kính cường lực, thép', 'color' => 'Đen', 'size' => '80x80x74 cm', 'stock' => 9],
                        ['name' => 'Bàn sân vườn gỗ tự nhiên', 'price' => 4200000, 'material' => 'Gỗ teak', 'color' => 'Nâu teak', 'size' => '90x90x75 cm', 'stock' => 5],
                        ['name' => 'Bàn ban công mini 2 ghế', 'price' => 3600000, 'material' => 'Mây nhựa, khung thép', 'color' => 'Màu mây', 'size' => '65x65x72 cm', 'stock' => 8],
                    ],
                ],
                [
                    'category' => ['name' => 'Thảm trang trí', 'slug' => 'tham-trang-tri', 'description' => 'Thảm trang trí giúp hoàn thiện bố cục không gian và tăng cảm giác ấm cúng.', 'sort_order' => 30],
                    'products' => [
                        ['name' => 'Thảm lông ngắn phòng khách', 'price' => 1350000, 'material' => 'Polyester', 'color' => 'Xám nhạt', 'size' => '160x230 cm', 'stock' => 20],
                        ['name' => 'Thảm dệt tay Bắc Âu', 'price' => 2400000, 'material' => 'Cotton, sợi tổng hợp', 'color' => 'Be + nâu', 'size' => '200x290 cm', 'stock' => 10],
                        ['name' => 'Thảm tròn decor', 'price' => 980000, 'material' => 'Len nhân tạo', 'color' => 'Kem', 'size' => '120 cm', 'stock' => 18],
                        ['name' => 'Thảm phòng ngủ chống trượt', 'price' => 1100000, 'material' => 'Microfiber', 'color' => 'Xanh xám', 'size' => '140x200 cm', 'stock' => 16],
                        ['name' => 'Thảm hành lang cao cấp', 'price' => 1650000, 'material' => 'Polypropylene', 'color' => 'Nâu đất', 'size' => '80x300 cm', 'stock' => 12],
                    ],
                ],
            ];

            $productSequence = 1;

            foreach ($catalog as $group) {
                $categoryData = $group['category'];

                $category = Category::query()
                    ->withTrashed()
                    ->updateOrCreate(
                        ['slug' => $categoryData['slug']],
                        array_merge($categoryData, ['status' => 'active'])
                    );

                if ($category->trashed()) {
                    $category->restore();
                }

                foreach ($group['products'] as $item) {
                    $productCode = 'SP' . str_pad((string) $productSequence, 4, '0', STR_PAD_LEFT);
                    $productSequence++;

                    $product = Product::query()
                        ->withTrashed()
                        ->updateOrCreate(
                            ['product_code' => $productCode],
                            [
                                'category_id' => $category->id,
                                'product_code' => $productCode,
                                'slug' => Str::slug($item['name']),
                                'name' => $item['name'],
                                'description' => 'Mẫu ' . $item['name'] . ' phù hợp cho không gian thực tế, chú trọng độ bền, thẩm mỹ và công năng sử dụng hằng ngày.',
                                'price' => $item['price'],
                                'cost_price' => round($item['price'] * 0.65, 2),
                                'size' => $item['size'],
                                'material' => $item['material'],
                                'color' => $item['color'],
                                'stock_quantity' => $item['stock'],
                                'low_stock_threshold' => 5,
                                'status' => 'active',
                            ]
                        );

                    if ($product->trashed()) {
                        $product->restore();
                    }
                }
            }
        });
    }
}
