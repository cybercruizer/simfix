<?php

use App\Models\Menu;
use App\Services\MenuService;
use Illuminate\Support\Collection;

function getMenuItems($role) {
    switch($role) {
        case 'admin':
            $prefix='adm';
            break;
        case 'guru':
            $prefix='guru';
            break;
        case 'bk':
            $prefix='bk';
        case 'keuangan':
            $prefix='keu';
            break;
        case 'walikelas':
            $prefix = 'wk';
            break;
        default:
            $prefix=null;
    }
    $data['prefix']=$prefix;
    $data['menus']= Menu::where('role', $role)->with('children')->get();
    return $data;
}
function getPrefix($role) {
    switch($role) {
        case 'admin':
            $prefix='adm';
            break;
        case 'guru':
            $prefix='guru';
            break;
        case 'bk':
            $prefix='bk';
        case 'keuangan':
            $prefix='keu';
            break;
        case 'walikelas':
            $prefix = 'wk';
            break;
        default:
            $prefix=null;
    }
    return $prefix;
}

function getRole() {
    $role= [
        'admin','guru','bk','keuangan','walikelas'
    ];
    return $role;
}
