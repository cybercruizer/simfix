<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Services\MenuService;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.index',['title'=>'Dashboard Admin']);
    }

    public function manageWalikelas()
    {
        $gurus=User::where('role','guru')->pluck( 'name','id');
        $kelas=Classroom::select('class_id','class_name')->get();
        return view('admin.managewalikelas',['title'=>'Manage Wali Kelas','gurus'=>$gurus,'kelas'=>$kelas]);
    }

    public function storeWalikelas(Request $request) {
        $guru=User::where('role','guru');
        $validatedData= $request->validate([
            'wk.*.id' => 'nullable',
            'wk.*.class_id' => 'nullable',
        ]);
        //dd($validatedData['wk']);
        //dd($validatedData['1']['1']);
        //simpan ke database
        foreach ($validatedData['wk'] as $waliData) {
        User::whereIn('id', $waliData['id'])->update(['classroom_id' => $waliData['class_id']]);
//        foreach ($validatedData['wk'] as $waliData) {
//            $guru->update(
//                ['id' => $waliData['id']],
//                ['classroom_id' => $waliData['class_id']]
//            );
        }
        return redirect()->route(getPrefix(Auth::user()->role).'.managewali.index')->with('success', 'Data wali kelas berhasil diubah');

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
