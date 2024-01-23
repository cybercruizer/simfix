<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menu1 = Menu::create(['nama' => 'Dashboard', 'url' => '/adm/dashboard', 'icon'=>'fas fa-tachometer', 'role' => 'admin']);
        $menu2 = Menu::create(['nama' => 'Data Master', 'url' => '#', 'icon'=>'fas folder-open', 'role' => 'admin']);

        // Add submenus
        $submenu1 = Menu::create(['nama' => 'Data Siswa', 'url' => '/adm/siswa', 'parent_id' => $menu2->id, 'role' => 'admin']);
        $submenu2 = Menu::create(['nama' => 'Data Kelas', 'url' => '/adm/kelas', 'parent_id' => $menu2->id, 'role' => 'admin']);
        $submenu3 = Menu::create(['nama' => 'Data Angkatan', 'url' => '/adm/angkatan', 'parent_id' => $menu1->id, 'role' => 'admin']);
    }
}
