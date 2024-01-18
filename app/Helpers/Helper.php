<?php

function getMenuAdmin() {
    $menus = [
        [
            'hasSub' => false,
            'name' => 'Dashboard',
            'url' => '/adm/dashboard',
        ],
        [
            'hasSub' => true,
            'name' => 'Data Master',
            'url' => '#',
            'subMenu' => [
                [
                    'name' => 'Data Siswa',
                    'url' => '/adm/siswa'
                ],
                [
                    'name' => 'Data Kelas',
                    'url' => '/adm/kelas'
                ],
            ],
        ]
    ];
    return $menus;
}
