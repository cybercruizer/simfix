<?php
namespace App\Services;
use App\Models\Menu;
class MenuService
{
    public function getMenuItems($role)
    {
        return Menu::where('role', $role)->with('children')->get();
    }
}
