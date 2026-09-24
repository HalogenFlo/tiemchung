<?php
/**
 * Chức năng: CenterSeeder nạp danh sách 2 chi nhánh trung tâm tiêm chủng chính thức thuộc hệ thống Medicare.
 * Lý do chỉnh sửa: Quản lý 2 chi nhánh hoạt động thực tế theo đúng yêu cầu hệ thống Medicare.
 */

namespace Modules\VaccineRegistration\Database\Seeders;

use Database\Seeders\Concerns\PreventsProductionSeeding;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Modules\VaccineRegistration\Models\Center;
use Modules\VaccineRegistration\Models\CenterVaccine;
use Modules\VaccineRegistration\Models\Vaccine;

class CenterSeeder extends Seeder
{
    use PreventsProductionSeeding;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->assertSafeSeedingTarget();

        // Clear existing centers and pricing
        CenterVaccine::query()->delete();
        Center::query()->delete();

        $centers = [
            [
                'name' => 'Medicare Cờ Đỏ',
                'slug' => 'medicare-co-do',
                'address' => 'Ấp Thới Bình, Xã Cờ Đỏ, Huyện Cờ Đỏ, TP. Cần Thơ (Cổng Bệnh Viện Quân Dân Y TP. Cần Thơ)',
                'phone' => '0938 603 839',
                'zalo_phone' => '0938 603 839',
                'map_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3928.751677322967!2d105.4327456!3d10.0864561!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a099002385f45d%3A0x794ab6e6dab32c92!2zUGjDsm5nIHRpw6ptIGNow7puZyB2YWNjaW4gTWVkaWNhcmUgQ-G7nSDEkOG7jw!5e0!3m2!1svi!2s',
                'working_hours' => '7:00 – 17:00 (Tất cả các ngày trong tuần kể cả Thứ 7, Chủ Nhật & Ngày Lễ)',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Medicare Phong Điền',
                'slug' => 'medicare-phong-dien',
                'address' => 'Ấp Nhơn Lộc 1, Xã Phong Điền, Huyện Phong Điền, TP. Cần Thơ (Phòng khám Đa Khoa Nhơn Ái)',
                'phone' => '0923331233',
                'zalo_phone' => '0923331233',
                'map_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3929.8660855219965!2d105.6666113!3d9.9947996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a08f00316d3267%3A0x8c35692cf5b2a45!2zUGjDsm5nIHRpw6ptIGNow7puZyBWYWNjaW4gTWVkaWNhcmUgUGhvbmcgxJBp4buBbg!5e0!3m2!1svi!2s',
                'working_hours' => '7:00 – 17:00 (Tất cả các ngày trong tuần kể cả Thứ 7, Chủ Nhật & Ngày Lễ)',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Medicare Trà Nóc',
                'slug' => 'medicare-tra-noc',
                'address' => '97 Đường Lê Hồng Phong, Phường Thới An Đông, Quận Bình Thủy, TP. Cần Thơ',
                'phone' => '0921 331 233',
                'zalo_phone' => '0921331233',
                'map_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3928.34960520286!2d105.7077651!3d10.0751336!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a087004a1f2cf1%3A0xdb6f978053d1b9a1!2zUGjDsm5nIHRpw6ptIGNow7puZyBWYWNjaW4gTWVkaWNhcmUgVHLDoCBOw7Nj!5e0!3m2!1svi!2s',
                'working_hours' => '7:00 – 17:00 (Tất cả các ngày trong tuần kể cả Thứ 7, Chủ Nhật & Ngày Lễ)',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Medicare Vị Thanh',
                'slug' => 'medicare-vi-thanh',
                'address' => '615B, Đường Trần Hưng Đạo, KV 10, Phường III, TP. Vị Thanh, Tỉnh Hậu Giang (kế CDC Hậu Giang cũ)',
                'phone' => '0921 989 798',
                'zalo_phone' => '0921989798',
                'map_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3932.2285191834273!2d105.464303!3d9.7850027!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a0f30501a35bb9%3A0xe5a3c61d56e0766c!2zNjE1QiDEkMaw4budbmcgVHLhuqduIEh1bmcgxJDhuqFvLCBQaMaw4budbmcgMywgVsG7iyBUaGFuaCwgSOG6rXUgR2lhbmc!5e0!3m2!1svi!2s',
                'working_hours' => '7:00 – 17:00 (Tất cả các ngày trong tuần kể cả Thứ 7, Chủ Nhật & Ngày Lễ)',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Medicare An Lạc Thôn',
                'slug' => 'medicare-an-lac-thon',
                'address' => 'Ấp An Ninh, Xã An Lạc Thôn, TP Cần Thơ',
                'phone' => '0928111233',
                'zalo_phone' => '0928111233',
                'map_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3928.0!2d105.8!3d10.0!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a06700684f853f%3A0x7baac9976d3e2431!2zUGjDsm5nIHRpw6ptIGNow7puZyBWYWNjaW4gTWVkaWNhcmUgQW4gTOG6oWMgVGjDtG4!5e0!3m2!1svi!2s',
                'working_hours' => '7:00 – 17:00 (Tất cả các ngày trong tuần kể cả Thứ 7, Chủ Nhật & Ngày Lễ)',
                'sort_order' => 5,
                'is_active' => true,
                'same_as_codo' => true,
            ],
            [
                'name' => 'Medicare 1000',
                'slug' => 'medicare-1000',
                'address' => 'Đường 3/2, Xã Tân Hoà, TP Cần Thơ (Ngang chợ 1000)',
                'phone' => '(Cập nhật sau)',
                'zalo_phone' => '0938 603 839',
                'map_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3928.0!2d105.8!3d10.0!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a08d00001eed99%3A0x556327d970cfa50b!2zUGjDsm5nIHRpw6ptIGNow7puZyBWYWNjaW4gTWVkaWNhcmUgMTAwMA!5e0!3m2!1svi!2s',
                'working_hours' => '7:00 – 17:00 (Tất cả các ngày trong tuần kể cả Thứ 7, Chủ Nhật & Ngày Lễ)',
                'sort_order' => 6,
                'is_active' => true,
                'same_as_codo' => true,
            ],
        ];

        foreach ($centers as $center) {
            $center['slug'] = $center['slug'] ?? Str::slug($center['name']);
            $legacyNames = $center['legacy_names'] ?? [];
            $sameAsCodo = !empty($center['same_as_codo']);
            unset($center['legacy_names'], $center['same_as_codo']);

            $savedCenter = Center::where('slug', $center['slug'])
                ->orWhere('name', $center['name'])
                ->when(!empty($legacyNames), fn ($q) => $q->orWhereIn('name', $legacyNames))
                ->first();

            if ($savedCenter) {
                $savedCenter->update($center);
            } else {
                $savedCenter = Center::create($center);
            }

            Vaccine::query()->get()->each(function (Vaccine $vaccine) use ($savedCenter, $sameAsCodo) {
                $multiplier = $sameAsCodo ? 1.0 : (1 + (max(0, (int) $savedCenter->sort_order - 1) * 0.01));
                $branchPrice = (int) (round(($vaccine->price * $multiplier) / 1000) * 1000);
                $branchSalePrice = $vaccine->sale_price
                    ? (int) (round(($vaccine->sale_price * $multiplier) / 1000) * 1000)
                    : null;

                CenterVaccine::firstOrCreate(
                    ['center_id' => $savedCenter->id, 'vaccine_id' => $vaccine->id],
                    [
                        'price' => $branchPrice,
                        'sale_price' => $branchSalePrice,
                        'stock_quantity' => 0,
                        'stock_status' => $vaccine->stock_status ?? 'available',
                        'is_active' => true,
                        'is_featured' => (bool) $vaccine->is_featured,
                        'sort_order' => (int) $vaccine->sort_order,
                    ]
                );
            });
        }

        CenterVaccine::whereNotIn('center_id', Center::pluck('id'))->delete();
    }
}
