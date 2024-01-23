<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Services\MenuService;

class MenuController extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = $this->menuService->getMenuItems('admin');
        $menuItems = Menu::all();

        return view('admin.menu.index', ['title'=>'Dashboard Admin', 'menus'=>$menus, 'menuItems'=>$menuItems]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menus = $this->menuService->getMenuItems('admin');
        $menuItems = Menu::all();
        $roles = collect(['admin'=>'admin','guru'=>'guru','bk'=>'bk','walikelas'=>'walikelas']);
        return view('admin.menu.create',  ['title'=>'Dashboard Admin', 'menus'=>$menus, 'menuItems'=>$menuItems, 'roles'=>$roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'url' => 'required',
            'icon' => 'nullable',
            'parent_id' => 'nullable',
            'role' => 'required',
        ]);

        Menu::create($request->all());

        return redirect()->route('adm.menu.index')->with('success', 'Item menu berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        return view('admin.menu.edit', compact('menu'));
    }

    public function editModal(Menu $menu)
    {
        return view('admin.menu.edit_modal', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required',
            'url' => 'required',
            'icon' => 'nullable',
            'parent_id' => 'nullable',
            'role' => 'required',
        ]);

        $menu->update($request->all());

        return redirect()->route('adm.menu.index')->with('success', 'Item menu berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu  $menu)
    {
        $menu->delete();

        return redirect()->route('adm.menu.index')->with('success', 'Item menu berhasil dihapus.');
    }
}
