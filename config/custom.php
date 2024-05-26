<?php
return [
    'type_work' => [
        ['id'=>'0','name'=>'Thực tập'],
        ['id'=>'1','name'=>'Bán thời gian'],
        ['id'=>'2','name'=>'Toàn thời gian'],
        ['id'=>'3','name'=>'Tại nhà'],
    ],
    'gender' => [
        ['id'=>'0','name'=>'--Chọn--'],
        ['id'=>'1','name'=>'Nam'],
        ['id'=>'2','name'=>'Nữ'],
    ],
    'level' => [
        ['id'=>'0','name'=>'Thực tập sinh'],
        ['id'=>'1','name'=>'Nhân viên'],
        ['id'=>'2','name'=>'Trưởng nhóm'],
        ['id'=>'3','name'=>'Trưởng phòng'],
        ['id'=>'4','name'=>'Trưởng chi nhánh'],
        ['id'=>'5','name'=>'Phó giám đốc'],
        ['id'=>'6','name'=>'Giám đốc'],
    ],
    'job_post_status' => [
        'block' => '0',
        'active' => '1',
    ],
    'experience' => [
        ['id'=>'0','name'=>'Chưa có kinh nghiệm'],
        ['id'=>'1','name'=>'Dưới 1 năm kinh nghiệm'],
        ['id'=>'2','name'=>'1 năm kinh nghiệm'],
        ['id'=>'3','name'=>'2 năm kinh nghiệm'],
        ['id'=>'4','name'=>'3 năm kinh nghiệm'],
        ['id'=>'5','name'=>'4 năm kinh nghiệm'],
        ['id'=>'6','name'=>'5 năm kinh nghiệm'],
        ['id'=>'7','name'=>'Trên 5 năm kinh nghiệm'],
    ],
    'type_degree' => [
        ['id'=>'Đại học','name'=>'Đại học'],
        ['id'=>'Cao đẳng','name'=>'Cao đẳng'],
        ['id'=>'Trung cấp','name'=>'Trung cấp'],
        ['id'=>'Sau đại học (Thạc sỹ/Tiến sĩ)','name'=>'Sau đại học (Thạc sỹ/Tiến sĩ)'],
        ['id'=>'Trung tâm đào tạo','name'=>'Trung tâm đào tạo'],
        ['id'=>'Du học','name'=>'Du học'],
    ],
    'language_level'=> [
        ['id'=>'0','name'=>'N/A'],
        ['id'=>'1','name'=>'Sơ cấp'],
        ['id'=>'2','name'=>'Trung cấp'],
        ['id'=>'3','name'=>'Cao cấp'],
        ['id'=>'4','name'=>'Bản ngữ'],
    ],
    'company_model'=> [
        ['id'=>'0','name'=>'Doanh nghiệp tư nhân'],
        ['id'=>'1','name'=>'Công ty trách nhiệm hữu hạn một thành viên'],
        ['id'=>'2','name'=>'Công ty trách nhiệm hữu hạn từ hai thành viên trở lên'],
        ['id'=>'3','name'=>'Công ty cổ phần'],
        ['id'=>'4','name'=>' Công ty hợp danh.'],
    ],
    'wage' => [
        ['id' => '0', 'name' => 'dưới 10 triệu', 'min' => 0, 'max' => 10000000],
        ['id' => '1', 'name' => '10 - 15 triệu', 'min' => 10000000, 'max' => 15000000],
        ['id' => '2', 'name' => '15 - 20 triệu', 'min' => 15000000, 'max' => 20000000],
        ['id' => '3', 'name' => '20 - 25 triệu', 'min' => 20000000, 'max' => 25000000],
        ['id' => '4', 'name' => '25 - 30 triệu', 'min' => 25000000, 'max' => 30000000],
        ['id' => '5', 'name' => '30 - 50 triệu', 'min' => 30000000, 'max' => 50000000],
        ['id' => '6', 'name' => 'trên 50 triệu', 'min' => 50000000, 'max' => PHP_INT_MAX],
    ]

];