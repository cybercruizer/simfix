<?php

use App\Services\MenuService;
use Illuminate\Support\Collection;

function getMenu()
    {

        $menus = MenuService::getMenuItems('admin');
        //print_r($menus);
        //dd($menus);
        return $menus;

    }

function getMenuAdmin() {
    $menus = new Collection([
        [
            'name' => 'Dashboard',
            'url' => '/adm/dashboard',
        ],
        [
            'hasSub' => true,
            'name' => 'Master Data',
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
                [
                    'name' => 'Data Tagihan',
                    'url' => '/adm/tagihan'
                ],
                [
                    'name' => 'Data Pembayaran',
                    'url' => '/adm/pembayaran'
                ],
            ],
        ],
        [
            'name' => 'Siswa AP',
            'url' => '#',
            'subMenu' => [
                [
                    'name' => 'Daftar AP',
                    'url' => '/adm/ap'
                ],
                [
                    'name' => 'Apply Diskon',
                    'url' => '/adm/diskon'
                ],
            ],
        ]
    ]);
    return $menus;
}

function getMenuGuru() {
    $menus = collect([
        [
            'hasSub' => false,
            'name' => 'Dashboard',
            'url' => '/guru/dashboard',
        ],
        [
            'hasSub' => true,
            'name' => 'Data Master',
            'url' => '#',
            'subMenu' => [
                [
                    'name' => 'Data Siswa',
                    'url' => '/guru/siswa'
                ],
                [
                    'name' => 'Data Kelas',
                    'url' => '/guru/kelas'
                ],
            ],
        ]
    ]);
    return $menus;
}

function getMenuKeuangan() {
    $menus = collect([
        [
            'hasSub' => false,
            'name' => 'Dashboard',
            'url' => '/keu/dashboard',
        ],
        [
            'hasSub' => true,
            'name' => 'Data Master',
            'url' => '#',
            'subMenu' => [
                [
                    'name' => 'Data Siswa',
                    'url' => '/keu/siswa'
                ],
                [
                    'name' => 'Data Kelas',
                    'url' => '/keu/kelas'
                ],
            ],
        ]
    ]);
    return $menus;
}

function getMenuWalikelas() {
    $menus = collect([
        [
            'hasSub' => false,
            'name' => 'Dashboard',
            'url' => '/wk/dashboard',
        ],
        [
            'hasSub' => true,
            'name' => 'Data Master',
            'url' => '#',
            'subMenu' => [
                [
                    'name' => 'Data Siswa',
                    'url' => '/wk/siswa'
                ],
                [
                    'name' => 'Data Kelas',
                    'url' => '/wk/kelas'
                ],
            ],
        ]
    ]);
    return $menus;
}
