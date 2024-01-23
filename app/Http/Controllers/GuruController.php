<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MenuService;

class GuruController extends Controller
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
        $menus = $this->menuService->getMenuItems('guru');
        //print_r($menus);
        //dd($menus);
        return view('guru.index',['title'=>'Dashboard Guru', 'menus'=>$menus]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
