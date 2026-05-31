<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DemoUserSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $adminRole = Role::query()->where('code', 'admin')->firstOrFail();
            $staffRole = Role::query()->where('code', 'staff')->firstOrFail();
            $customerRole = Role::query()->where('code', 'customer')->firstOrFail();

            $seedUser = function (array $attributes, Role $role): void {
                $user = User::query()->withTrashed()->updateOrCreate(
                    ['email' => $attributes['email']],
                    $attributes
                );

                if ($user->trashed()) {
                    $user->restore();
                }

                $user->roles()->sync([$role->id]);
            };

            $seedUser([
                'email' => 'admin@thongmai.local',
                'name' => 'System Admin',
                'phone' => '0900000001',
                'birthday' => null,
                'gender' => null,
                'address_line_1' => null,
                'address_line_2' => null,
                'ward' => null,
                'district' => null,
                'province' => null,
                'postal_code' => null,
                'preferred_contact_method' => 'both',
                'notes' => null,
                'password' => Hash::make('Password@123'),
                'status' => 'active',
                'email_verified_at' => now(),
            ], $adminRole);

            $seedUser([
                'email' => 'staff@thongmai.local',
                'name' => 'System Staff',
                'phone' => '0900000002',
                'birthday' => null,
                'gender' => null,
                'address_line_1' => null,
                'address_line_2' => null,
                'ward' => null,
                'district' => null,
                'province' => null,
                'postal_code' => null,
                'preferred_contact_method' => 'both',
                'notes' => null,
                'password' => Hash::make('Password@123'),
                'status' => 'active',
                'email_verified_at' => now(),
            ], $staffRole);

            $seedUser([
                'email' => 'customer@thongmai.local',
                'name' => 'Demo Customer',
                'phone' => '0900000003',
                'birthday' => '1995-01-01',
                'gender' => 'other',
                'address_line_1' => '115 Nguyen Xien',
                'address_line_2' => null,
                'ward' => 'Bac Nha Trang',
                'district' => 'Nha Trang',
                'province' => 'Khanh Hoa',
                'postal_code' => null,
                'preferred_contact_method' => 'both',
                'notes' => 'Seeded customer account.',
                'password' => Hash::make('Password@123'),
                'status' => 'active',
                'email_verified_at' => now(),
            ], $customerRole);

            $customers = [
                [
                    'email' => 'minh.anh@thongmai.local',
                    'name' => 'Nguyen Minh Anh',
                    'phone' => '0901000001',
                    'birthday' => '1992-04-12',
                    'gender' => 'female',
                    'address_line_1' => '12 Nguyen Hue',
                    'address_line_2' => 'Can ho 1208',
                    'ward' => 'Ben Nghe',
                    'district' => 'Quan 1',
                    'province' => 'Ho Chi Minh City',
                    'postal_code' => '700000',
                    'preferred_contact_method' => 'both',
                    'notes' => 'Uu tien giao hang buoi chieu.',
                ],
                [
                    'email' => 'hoang.nam@thongmai.local',
                    'name' => 'Tran Hoang Nam',
                    'phone' => '0901000002',
                    'birthday' => '1988-09-23',
                    'gender' => 'male',
                    'address_line_1' => '45 Hoang Quoc Viet',
                    'address_line_2' => null,
                    'ward' => 'Co Nhue 1',
                    'district' => 'Bac Tu Liem',
                    'province' => 'Ha Noi',
                    'postal_code' => '100000',
                    'preferred_contact_method' => 'phone',
                    'notes' => 'Thuong dat noi that cho can ho cho thuê.',
                ],
                [
                    'email' => 'thuy.linh@thongmai.local',
                    'name' => 'Le Thuy Linh',
                    'phone' => '0901000003',
                    'birthday' => '1996-06-08',
                    'gender' => 'female',
                    'address_line_1' => '78 Le Loi',
                    'address_line_2' => null,
                    'ward' => 'Hai Chau 1',
                    'district' => 'Hai Chau',
                    'province' => 'Da Nang',
                    'postal_code' => '550000',
                    'preferred_contact_method' => 'email',
                    'notes' => 'Thich mau trung tinh, de phoi voi phong ngu nho.',
                ],
                [
                    'email' => 'quang.huy@thongmai.local',
                    'name' => 'Pham Quang Huy',
                    'phone' => '0901000004',
                    'birthday' => '1990-11-17',
                    'gender' => 'male',
                    'address_line_1' => '103 Tran Phu',
                    'address_line_2' => 'Tang 5',
                    'ward' => 'Loc Tho',
                    'district' => 'Nha Trang',
                    'province' => 'Khanh Hoa',
                    'postal_code' => '650000',
                    'preferred_contact_method' => 'both',
                    'notes' => 'Can tu van sofa va ban tra cho can ho bien.',
                ],
                [
                    'email' => 'mai.phuong@thongmai.local',
                    'name' => 'Do Mai Phuong',
                    'phone' => '0901000005',
                    'birthday' => '1993-02-27',
                    'gender' => 'female',
                    'address_line_1' => '220 Nguyen Trai',
                    'address_line_2' => 'Phong 3',
                    'ward' => 'An Phu',
                    'district' => 'Ninh Kieu',
                    'province' => 'Can Tho',
                    'postal_code' => '900000',
                    'preferred_contact_method' => 'phone',
                    'notes' => 'Mua sam cho nha pho moi hoan thien.',
                ],
                [
                    'email' => 'tuan.kiet@thongmai.local',
                    'name' => 'Vo Tuan Kiet',
                    'phone' => '0901000006',
                    'birthday' => '1987-08-03',
                    'gender' => 'male',
                    'address_line_1' => '9 Phan Dang Luu',
                    'address_line_2' => null,
                    'ward' => 'Phu Nhuan',
                    'district' => 'Phu Nhuan',
                    'province' => 'Ho Chi Minh City',
                    'postal_code' => '700000',
                    'preferred_contact_method' => 'both',
                    'notes' => 'Quan tam den san pham cho van phong tai nha.',
                ],
                [
                    'email' => 'ngoc.han@thongmai.local',
                    'name' => 'Bui Ngoc Han',
                    'phone' => '0901000007',
                    'birthday' => '1998-12-14',
                    'gender' => 'female',
                    'address_line_1' => '56 Nguyen Van Cu',
                    'address_line_2' => null,
                    'ward' => 'An Hoa',
                    'district' => 'Ninh Kieu',
                    'province' => 'Can Tho',
                    'postal_code' => '900000',
                    'preferred_contact_method' => 'email',
                    'notes' => 'Thich noi that tre trung, sang mau.',
                ],
                [
                    'email' => 'duc.minh@thongmai.local',
                    'name' => 'Nguyen Duc Minh',
                    'phone' => '0901000008',
                    'birthday' => '1985-05-19',
                    'gender' => 'male',
                    'address_line_1' => '31 Le Thanh Ton',
                    'address_line_2' => 'Can ho 1501',
                    'ward' => 'Ben Thanh',
                    'district' => 'Quan 1',
                    'province' => 'Ho Chi Minh City',
                    'postal_code' => '700000',
                    'preferred_contact_method' => 'both',
                    'notes' => 'Can bo tri noi that phong khach va phong lam viec.',
                ],
                [
                    'email' => 'khanh.van@thongmai.local',
                    'name' => 'Tran Khanh Van',
                    'phone' => '0901000009',
                    'birthday' => '1994-07-21',
                    'gender' => 'female',
                    'address_line_1' => '84 Nguyen Chi Thanh',
                    'address_line_2' => null,
                    'ward' => 'Lang Thuong',
                    'district' => 'Dong Da',
                    'province' => 'Ha Noi',
                    'postal_code' => '100000',
                    'preferred_contact_method' => 'phone',
                    'notes' => 'Co nhu cau mua giuong va tu quan ao cho gia dinh tre.',
                ],
                [
                    'email' => 'anh.khoa@thongmai.local',
                    'name' => 'Le Anh Khoa',
                    'phone' => '0901000010',
                    'birthday' => '1991-03-30',
                    'gender' => 'male',
                    'address_line_1' => '19 Vo Van Tan',
                    'address_line_2' => null,
                    'ward' => 'Vo Thi Sau',
                    'district' => 'Quan 3',
                    'province' => 'Ho Chi Minh City',
                    'postal_code' => '700000',
                    'preferred_contact_method' => 'both',
                    'notes' => 'Thuong xem mau thuc te truoc khi dat hang.',
                ],
            ];

            foreach ($customers as $customerData) {
                $seedUser([
                    'email' => $customerData['email'],
                    'name' => $customerData['name'],
                    'phone' => $customerData['phone'],
                    'birthday' => $customerData['birthday'],
                    'gender' => $customerData['gender'],
                    'address_line_1' => $customerData['address_line_1'],
                    'address_line_2' => $customerData['address_line_2'],
                    'ward' => $customerData['ward'],
                    'district' => $customerData['district'],
                    'province' => $customerData['province'],
                    'postal_code' => $customerData['postal_code'],
                    'preferred_contact_method' => $customerData['preferred_contact_method'],
                    'notes' => $customerData['notes'],
                    'password' => Hash::make('Password@123'),
                    'status' => 'active',
                    'email_verified_at' => now(),
                ], $customerRole);
            }
        });
    }
}
