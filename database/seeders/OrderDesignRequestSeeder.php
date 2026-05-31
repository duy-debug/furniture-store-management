<?php

namespace Database\Seeders;

use App\Models\DesignRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class OrderDesignRequestSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $customers = User::query()
                ->whereIn('email', [
                    'minh.anh@thongmai.local',
                    'hoang.nam@thongmai.local',
                    'thuy.linh@thongmai.local',
                    'quang.huy@thongmai.local',
                    'mai.phuong@thongmai.local',
                    'tuan.kiet@thongmai.local',
                    'ngoc.han@thongmai.local',
                    'duc.minh@thongmai.local',
                    'khanh.van@thongmai.local',
                    'anh.khoa@thongmai.local',
                ])
                ->get()
                ->keyBy('email');

            $staff = User::query()->where('email', 'staff@thongmai.local')->firstOrFail();

            $products = Product::query()
                ->whereIn('product_code', ['SP0001', 'SP0006', 'SP0012', 'SP0017', 'SP0025', 'SP0034', 'SP0041', 'SP0048', 'SP0057', 'SP0063'])
                ->get()
                ->keyBy('product_code');

            $orders = [
                [
                    'order_code' => 'DH202605310001',
                    'customer_email' => 'minh.anh@thongmai.local',
                    'customer_name' => 'Nguyen Minh Anh',
                    'customer_phone' => '0901000001',
                    'shipping_address' => '12 Nguyen Hue, Ben Nghe, Quan 1, Ho Chi Minh City',
                    'shipping_note' => 'Giao sau 14h, goi truoc 30 phut.',
                    'payment_method' => 'cod',
                    'payment_status' => 'unpaid',
                    'status' => 'pending',
                    'placed_at' => Carbon::now()->subDays(4),
                    'items' => [
                        ['product_code' => 'SP0001', 'quantity' => 1],
                        ['product_code' => 'SP0012', 'quantity' => 1],
                    ],
                ],
                [
                    'order_code' => 'DH202605310002',
                    'customer_email' => 'hoang.nam@thongmai.local',
                    'customer_name' => 'Tran Hoang Nam',
                    'customer_phone' => '0901000002',
                    'shipping_address' => '45 Hoang Quoc Viet, Co Nhue 1, Bac Tu Liem, Ha Noi',
                    'shipping_note' => 'Can lap truoc do day 4 tang.',
                    'payment_method' => 'bank_transfer',
                    'payment_status' => 'partial',
                    'status' => 'processing',
                    'placed_at' => Carbon::now()->subDays(6),
                    'processed_at' => Carbon::now()->subDays(5),
                    'items' => [
                        ['product_code' => 'SP0006', 'quantity' => 1],
                        ['product_code' => 'SP0025', 'quantity' => 2],
                    ],
                ],
                [
                    'order_code' => 'DH202605310003',
                    'customer_email' => 'thuy.linh@thongmai.local',
                    'customer_name' => 'Le Thuy Linh',
                    'customer_phone' => '0901000003',
                    'shipping_address' => '78 Le Loi, Hai Chau 1, Hai Chau, Da Nang',
                    'shipping_note' => 'Can sua truoc 1 ngay de doi khung gio giao.',
                    'payment_method' => 'cod',
                    'payment_status' => 'unpaid',
                    'status' => 'shipping',
                    'placed_at' => Carbon::now()->subDays(3),
                    'processed_at' => Carbon::now()->subDays(2),
                    'items' => [
                        ['product_code' => 'SP0017', 'quantity' => 1],
                        ['product_code' => 'SP0034', 'quantity' => 4],
                    ],
                ],
                [
                    'order_code' => 'DH202605310004',
                    'customer_email' => 'quang.huy@thongmai.local',
                    'customer_name' => 'Pham Quang Huy',
                    'customer_phone' => '0901000004',
                    'shipping_address' => '103 Tran Phu, Loc Tho, Nha Trang, Khanh Hoa',
                    'shipping_note' => 'Da thanh toan toan bo qua chuyen khoan.',
                    'payment_method' => 'bank_transfer',
                    'payment_status' => 'paid',
                    'status' => 'completed',
                    'placed_at' => Carbon::now()->subDays(10),
                    'processed_at' => Carbon::now()->subDays(9),
                    'completed_at' => Carbon::now()->subDays(7),
                    'items' => [
                        ['product_code' => 'SP0041', 'quantity' => 1],
                        ['product_code' => 'SP0048', 'quantity' => 2],
                    ],
                ],
                [
                    'order_code' => 'DH202605310005',
                    'customer_email' => 'mai.phuong@thongmai.local',
                    'customer_name' => 'Do Mai Phuong',
                    'customer_phone' => '0901000005',
                    'shipping_address' => '220 Nguyen Trai, Phong 3, Ninh Kieu, Can Tho',
                    'shipping_note' => 'Khach doi xem mau hoan thien truoc khi dat lai.',
                    'payment_method' => 'cod',
                    'payment_status' => 'unpaid',
                    'status' => 'cancelled',
                    'placed_at' => Carbon::now()->subDays(8),
                    'cancelled_at' => Carbon::now()->subDays(7),
                    'cancel_reason' => 'Khach doi chuyen sang mau noi that khac phu hop hon.',
                    'items' => [
                        ['product_code' => 'SP0057', 'quantity' => 1],
                        ['product_code' => 'SP0063', 'quantity' => 3],
                    ],
                ],
                [
                    'order_code' => 'DH202605310006',
                    'customer_email' => 'tuan.kiet@thongmai.local',
                    'customer_name' => 'Vo Tuan Kiet',
                    'customer_phone' => '0901000006',
                    'shipping_address' => '9 Phan Dang Luu, Phu Nhuan, Ho Chi Minh City',
                    'shipping_note' => 'Hang duoc dong goi cao cap de van chuyen xe tai nho.',
                    'payment_method' => 'bank_transfer',
                    'payment_status' => 'refunded',
                    'status' => 'returned',
                    'placed_at' => Carbon::now()->subDays(16),
                    'processed_at' => Carbon::now()->subDays(15),
                    'completed_at' => Carbon::now()->subDays(12),
                    'items' => [
                        ['product_code' => 'SP0001', 'quantity' => 1],
                        ['product_code' => 'SP0017', 'quantity' => 1],
                    ],
                ],
            ];

            foreach ($orders as $orderData) {
                $customer = $customers[$orderData['customer_email']] ?? null;
                if (! $customer) {
                    continue;
                }

                $lineItems = [];
                $subtotal = 0;

                foreach ($orderData['items'] as $item) {
                    $product = $products[$item['product_code']] ?? null;
                    if (! $product) {
                        continue;
                    }

                    $quantity = $item['quantity'];
                    $lineTotal = (float) $product->price * $quantity;
                    $subtotal += $lineTotal;

                    $lineItems[] = [
                        'product_id' => $product->id,
                        'product_code_snapshot' => $product->product_code,
                        'product_name_snapshot' => $product->name,
                        'product_image_path_snapshot' => null,
                        'quantity' => $quantity,
                        'unit_price' => $product->price,
                        'line_total' => $lineTotal,
                    ];
                }

                $taxAmount = round($subtotal * 0.08, 2);
                $shippingFee = $subtotal >= 15000000 ? 0 : 250000;
                $discountAmount = $orderData['status'] === 'cancelled' ? 0 : ($subtotal >= 20000000 ? 1200000 : 500000);
                $totalAmount = max($subtotal + $taxAmount + $shippingFee - $discountAmount, 0);

                $order = Order::query()->withTrashed()->updateOrCreate(
                    ['order_code' => $orderData['order_code']],
                    [
                        'user_id' => $customer->id,
                        'customer_name' => $orderData['customer_name'],
                        'customer_phone' => $orderData['customer_phone'],
                        'customer_email' => $customer->email,
                        'shipping_address' => $orderData['shipping_address'],
                        'shipping_note' => $orderData['shipping_note'],
                        'payment_method' => $orderData['payment_method'],
                        'payment_status' => $orderData['payment_status'],
                        'status' => $orderData['status'],
                        'subtotal' => $subtotal,
                        'tax_amount' => $taxAmount,
                        'shipping_fee' => $shippingFee,
                        'discount_amount' => $discountAmount,
                        'total_amount' => $totalAmount,
                        'cancel_reason' => $orderData['cancel_reason'] ?? null,
                        'placed_at' => $orderData['placed_at'],
                        'processed_at' => $orderData['processed_at'] ?? null,
                        'completed_at' => $orderData['completed_at'] ?? null,
                        'cancelled_at' => $orderData['cancelled_at'] ?? null,
                    ]
                );

                if ($order->trashed()) {
                    $order->restore();
                }

                $order->items()->delete();

                foreach ($lineItems as $lineItem) {
                    OrderItem::query()->create(array_merge($lineItem, [
                        'order_id' => $order->id,
                    ]));
                }
            }

            $requests = [
                [
                    'request_code' => 'YC202605310001',
                    'customer_email' => 'minh.anh@thongmai.local',
                    'customer_name' => 'Nguyen Minh Anh',
                    'customer_phone' => '0901000001',
                    'space_address' => 'Can ho 1208, 12 Nguyen Hue, Quan 1, Ho Chi Minh City',
                    'space_type' => 'living_room',
                    'space_area' => 28.5,
                    'ceiling_height' => 2.8,
                    'room_count' => 1,
                    'style_preference' => 'Modern Japandi',
                    'main_color' => 'Be - xam - go sang',
                    'budget_amount' => 85000000,
                    'desired_completion_date' => Carbon::now()->addDays(35)->toDateString(),
                    'requirements' => 'Can toi uu sofa, ban tra, ke tivi va anh sang am. Uu tien vat lieu de ve sinh.',
                    'status' => 'new',
                    'assigned_staff_id' => null,
                    'contacted_at' => null,
                    'surveyed_at' => null,
                    'completed_at' => null,
                    'cancelled_at' => null,
                ],
                [
                    'request_code' => 'YC202605310002',
                    'customer_email' => 'hoang.nam@thongmai.local',
                    'customer_name' => 'Tran Hoang Nam',
                    'customer_phone' => '0901000002',
                    'space_address' => 'Nha pho 45 Hoang Quoc Viet, Bac Tu Liem, Ha Noi',
                    'space_type' => 'whole_house',
                    'space_area' => 128.0,
                    'ceiling_height' => 3.2,
                    'room_count' => 4,
                    'style_preference' => 'Contemporary luxury',
                    'main_color' => 'Nau dam - trang - den',
                    'budget_amount' => 320000000,
                    'desired_completion_date' => Carbon::now()->addDays(60)->toDateString(),
                    'requirements' => 'Can bao gom phong khach, phong ngu master va phong lam viec tai nha.',
                    'status' => 'contacting',
                    'assigned_staff_id' => $staff->id,
                    'contacted_at' => Carbon::now()->subDay(),
                    'surveyed_at' => null,
                    'completed_at' => null,
                    'cancelled_at' => null,
                ],
                [
                    'request_code' => 'YC202605310003',
                    'customer_email' => 'thuy.linh@thongmai.local',
                    'customer_name' => 'Le Thuy Linh',
                    'customer_phone' => '0901000003',
                    'space_address' => '78 Le Loi, Hai Chau 1, Da Nang',
                    'space_type' => 'bedroom',
                    'space_area' => 18.2,
                    'ceiling_height' => 2.75,
                    'room_count' => 1,
                    'style_preference' => 'Soft minimal',
                    'main_color' => 'Trang - kem - xanh olive',
                    'budget_amount' => 45000000,
                    'desired_completion_date' => Carbon::now()->addDays(28)->toDateString(),
                    'requirements' => 'Can giuong boc nem, tab dau giuong va tu quan ao am tuong.',
                    'status' => 'surveyed',
                    'assigned_staff_id' => $staff->id,
                    'contacted_at' => Carbon::now()->subDays(3),
                    'surveyed_at' => Carbon::now()->subDay(),
                    'completed_at' => null,
                    'cancelled_at' => null,
                ],
                [
                    'request_code' => 'YC202605310004',
                    'customer_email' => 'quang.huy@thongmai.local',
                    'customer_name' => 'Pham Quang Huy',
                    'customer_phone' => '0901000004',
                    'space_address' => 'Can ho 1501, 103 Tran Phu, Nha Trang, Khanh Hoa',
                    'space_type' => 'apartment',
                    'space_area' => 72.0,
                    'ceiling_height' => 2.7,
                    'room_count' => 2,
                    'style_preference' => 'Warm modern',
                    'main_color' => 'Go sang - xam am',
                    'budget_amount' => 98000000,
                    'desired_completion_date' => Carbon::now()->addDays(40)->toDateString(),
                    'requirements' => 'Can thiet ke tron goi phong khach va bep, co them khu lam viec nho.',
                    'status' => 'designing',
                    'assigned_staff_id' => $staff->id,
                    'contacted_at' => Carbon::now()->subDays(5),
                    'surveyed_at' => Carbon::now()->subDays(4),
                    'completed_at' => null,
                    'cancelled_at' => null,
                ],
                [
                    'request_code' => 'YC202605310005',
                    'customer_email' => 'mai.phuong@thongmai.local',
                    'customer_name' => 'Do Mai Phuong',
                    'customer_phone' => '0901000005',
                    'space_address' => '220 Nguyen Trai, Ninh Kieu, Can Tho',
                    'space_type' => 'office',
                    'space_area' => 46.0,
                    'ceiling_height' => 3.0,
                    'room_count' => 2,
                    'style_preference' => 'Professional minimalist',
                    'main_color' => 'Trang - xam - xanh navy',
                    'budget_amount' => 72000000,
                    'desired_completion_date' => Carbon::now()->addDays(25)->toDateString(),
                    'requirements' => 'Van phong 6-8 cho ngoi, co ban lam viec, tu ho so va khu tiep khach nho.',
                    'status' => 'sent_design',
                    'assigned_staff_id' => $staff->id,
                    'contacted_at' => Carbon::now()->subDays(6),
                    'surveyed_at' => Carbon::now()->subDays(5),
                    'completed_at' => null,
                    'cancelled_at' => null,
                ],
                [
                    'request_code' => 'YC202605310006',
                    'customer_email' => 'tuan.kiet@thongmai.local',
                    'customer_name' => 'Vo Tuan Kiet',
                    'customer_phone' => '0901000006',
                    'space_address' => '9 Phan Dang Luu, Phu Nhuan, Ho Chi Minh City',
                    'space_type' => 'cafe',
                    'space_area' => 62.0,
                    'ceiling_height' => 3.1,
                    'room_count' => 1,
                    'style_preference' => 'Industrial cozy',
                    'main_color' => 'Nau go - den - cam dat',
                    'budget_amount' => 145000000,
                    'desired_completion_date' => Carbon::now()->addDays(50)->toDateString(),
                    'requirements' => 'Can lam ben trong cafe 40 cho, co khu bar va goc check-in dep.',
                    'status' => 'approved',
                    'assigned_staff_id' => $staff->id,
                    'contacted_at' => Carbon::now()->subDays(8),
                    'surveyed_at' => Carbon::now()->subDays(7),
                    'completed_at' => null,
                    'cancelled_at' => null,
                ],
            ];

            foreach ($requests as $requestData) {
                $customer = $customers[$requestData['customer_email']] ?? null;
                if (! $customer) {
                    continue;
                }

                $request = DesignRequest::query()->withTrashed()->updateOrCreate(
                    ['request_code' => $requestData['request_code']],
                    [
                        'user_id' => $customer->id,
                        'assigned_staff_id' => $requestData['assigned_staff_id'],
                        'customer_name' => $requestData['customer_name'],
                        'customer_phone' => $requestData['customer_phone'],
                        'customer_email' => $customer->email,
                        'space_address' => $requestData['space_address'],
                        'space_type' => $requestData['space_type'],
                        'space_area' => $requestData['space_area'],
                        'ceiling_height' => $requestData['ceiling_height'],
                        'room_count' => $requestData['room_count'],
                        'style_preference' => $requestData['style_preference'],
                        'main_color' => $requestData['main_color'],
                        'budget_amount' => $requestData['budget_amount'],
                        'desired_completion_date' => $requestData['desired_completion_date'],
                        'requirements' => $requestData['requirements'],
                        'status' => $requestData['status'],
                        'cancel_reason' => $requestData['cancel_reason'] ?? null,
                        'contacted_at' => $requestData['contacted_at'],
                        'surveyed_at' => $requestData['surveyed_at'],
                        'completed_at' => $requestData['completed_at'],
                        'cancelled_at' => $requestData['cancelled_at'],
                    ]
                );

                if ($request->trashed()) {
                    $request->restore();
                }
            }
        });
    }
}
