<?php
return [
    'company' => [
        'sidebar'=>[
            'dashboard'=>[
                'title' => "Tổng quan",
                'route' => 'company.dashboard',
                'icon'  => 'la la-home',
            ],
            'post' => [
                'title' => "Tin tuyển dụng",
                'route' => 'company.post.index',
                'icon'  => 'la la-paper-plane',
            ],
            // 'filter' => [
            //     'title' => "Tìm CV",
            //     'route' => 'company.filter',
            //     'icon'  => 'la la-search',
            // ],
            'manage-cv' => [
                'title' => "Quản lý CV",
                'route' => 'company.manageCV',
                'icon'  => 'fa-regular fa-address-card',
            ],
            // 'history-payment' => [
            //     'title' => "Lịch sử giao dịch",
            //     'route' => 'company.historyPayment',
            //     'icon'  => 'la la-history',
            // ],
            'profile' => [
                'title' => "Sửa thông tin",
                'route' => 'company.info',
                'icon'  => 'la la-user-tie',
            ],
            'image-paper' => [
                'title' => "Giấy phép kinh doanh",
                'route' => 'company.imagePaper',
                'icon'  => 'la la-file',
            ],
        ]
    ]
];