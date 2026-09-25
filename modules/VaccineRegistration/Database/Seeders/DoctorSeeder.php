<?php

namespace Modules\VaccineRegistration\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\VaccineRegistration\Models\Center;
use Modules\VaccineRegistration\Models\Doctor;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $branchesData = [
            'medicare-co-do' => [
                'center_name_pattern' => 'Cờ Đỏ',
                'doctors' => [
                    [
                        'name' => 'BS.CK1 Lê Thị Bé Tua',
                        'title' => 'BS.CK1',
                        'role' => 'Bác sĩ chuyên môn tiêm chủng',
                        'avatar' => '/images/avt_pktn.png',
                        'phone' => '0938 603 839',
                        'sort_order' => 1,
                    ],
                    [
                        'name' => 'CN. Nguyễn Thị Lan Vy',
                        'title' => 'CN',
                        'role' => 'Cử nhân tiêm chủng',
                        'avatar' => null,
                        'phone' => null,
                        'sort_order' => 2,
                    ],
                    [
                        'name' => 'YS. Phan Bảo Ngọc',
                        'title' => 'YS',
                        'role' => 'Y sĩ tiêm chủng',
                        'avatar' => null,
                        'phone' => null,
                        'sort_order' => 3,
                    ],
                ],
            ],
            'medicare-phong-dien' => [
                'center_name_pattern' => 'Phong Điền',
                'doctors' => [
                    [
                        'name' => 'BS.CK1 Lại Khắc Nhơn',
                        'title' => 'BS.CK1',
                        'role' => 'Bác sĩ chuyên môn tiêm chủng',
                        'avatar' => '/images/avt_pkpđ.png',
                        'phone' => '0923331233',
                        'sort_order' => 1,
                    ],
                    [
                        'name' => 'CN. Nguyễn Phan Khoa Trâm',
                        'title' => 'CN',
                        'role' => 'Cử nhân tiêm chủng',
                        'avatar' => null,
                        'phone' => null,
                        'sort_order' => 2,
                    ],
                    [
                        'name' => 'YS. Huỳnh Thị Trà My',
                        'title' => 'YS',
                        'role' => 'Y sĩ tiêm chủng',
                        'avatar' => null,
                        'phone' => null,
                        'sort_order' => 3,
                    ],
                ],
            ],
            'medicare-tra-noc' => [
                'center_name_pattern' => 'Trà Nóc',
                'doctors' => [
                    [
                        'name' => 'BS.CK2 Võ Thị Khánh Nguyệt',
                        'title' => 'BS.CK2',
                        'role' => 'Giám đốc chuyên môn tiêm chủng',
                        'avatar' => '/images/avt_pktn.png',
                        'phone' => '0921 331 233',
                        'sort_order' => 1,
                    ],
                    [
                        'name' => 'Ths.Bs Trần Quang Đạo',
                        'title' => 'ThS.BS',
                        'role' => 'Bác sĩ chuyên môn tiêm chủng',
                        'avatar' => null,
                        'phone' => '0921 331 233',
                        'sort_order' => 2,
                    ],
                    [
                        'name' => 'CN. Lâm Vũ Thái Ngọc',
                        'title' => 'CN',
                        'role' => 'Cử nhân tiêm chủng',
                        'avatar' => null,
                        'phone' => null,
                        'sort_order' => 3,
                    ],
                    [
                        'name' => 'YS. Đặng Thị Huệ Mai',
                        'title' => 'YS',
                        'role' => 'Y sĩ tiêm chủng',
                        'avatar' => null,
                        'phone' => null,
                        'sort_order' => 4,
                    ],
                ],
            ],
            'medicare-an-lac-thon' => [
                'center_name_pattern' => 'An Lạc Thôn',
                'doctors' => [
                    [
                        'name' => 'BS. Nguyễn Huỳnh Phương Quyên',
                        'title' => 'BS',
                        'role' => 'Bác sĩ chuyên môn tiêm chủng',
                        'avatar' => null,
                        'phone' => '0928111233',
                        'sort_order' => 1,
                    ],
                    [
                        'name' => 'CN. Phạm Ngọc Trân',
                        'title' => 'CN',
                        'role' => 'Cử nhân tiêm chủng',
                        'avatar' => null,
                        'phone' => null,
                        'sort_order' => 2,
                    ],
                    [
                        'name' => 'YS. Trịnh Nguyễn Thuý An',
                        'title' => 'YS',
                        'role' => 'Y sĩ tiêm chủng',
                        'avatar' => null,
                        'phone' => null,
                        'sort_order' => 3,
                    ],
                ],
            ],
            'medicare-1000' => [
                'center_name_pattern' => '1000',
                'doctors' => [
                    [
                        'name' => 'BS. Trần Văn Đông',
                        'title' => 'BS',
                        'role' => 'Bác sĩ chuyên môn tiêm chủng',
                        'avatar' => null,
                        'phone' => '0938 603 839',
                        'sort_order' => 1,
                    ],
                    [
                        'name' => 'CN. Trần Trung Tín',
                        'title' => 'CN',
                        'role' => 'Cử nhân tiêm chủng',
                        'avatar' => null,
                        'phone' => null,
                        'sort_order' => 2,
                    ],
                    [
                        'name' => 'ĐD. Trịnh Phương Ngân',
                        'title' => 'ĐD',
                        'role' => 'Điều dưỡng phòng tiêm',
                        'avatar' => null,
                        'phone' => null,
                        'sort_order' => 3,
                    ],
                ],
            ],
        ];

        foreach ($branchesData as $slug => $config) {
            $center = Center::where('slug', $slug)
                ->orWhere('name', 'like', '%' . $config['center_name_pattern'] . '%')
                ->first();

            if (!$center) {
                continue;
            }

            foreach ($config['doctors'] as $docData) {
                Doctor::updateOrCreate(
                    [
                        'center_id' => $center->id,
                        'name' => $docData['name'],
                    ],
                    [
                        'title' => $docData['title'],
                        'role' => $docData['role'],
                        'avatar' => $docData['avatar'],
                        'phone' => $docData['phone'],
                        'sort_order' => $docData['sort_order'],
                        'is_active' => true,
                    ]
                );
            }
        }
    }
}
