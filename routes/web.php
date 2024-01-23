<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::group(['middleware'=>'role:admin','prefix'=>'adm', 'as'=>'adm.'],function () {
    Route::get('dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');
    Route::get('menu', [App\Http\Controllers\MenuController::class, 'index'])->name('menu.index');
    Route::get('menu/create', [App\Http\Controllers\MenuController::class, 'create'])->name('menu.create');
    Route::post('menu/store', [App\Http\Controllers\MenuController::class, 'store'])->name('menu.store');
    Route::get('menu/{menu}/edit', [App\Http\Controllers\MenuController::class, 'edit'])->name('menu.edit');
    Route::put('menu/{menu}', [App\Http\Controllers\MenuController::class, 'update'])->name('menu.update');
    Route::delete('menu/{menu}', [App\Http\Controllers\MenuController::class, 'destroy'])->name('menu.destroy');
    Route::get('/menu/{menu}/edit-modal', [App\Http\Controllers\MenuController::class, 'editModal'])->name('menu.edit-modal');
});
Route::group(['middleware'=>'role:guru','prefix'=>'guru', 'as'=>'guru.'],function () {
    Route::get('dashboard', [App\Http\Controllers\GuruController::class, 'index'])->name('dashboard');
});
Route::group(['middleware'=>'role:walikelas','prefix'=>'wk', 'as'=>'wk.'],function () {
    Route::get('dashboard', [App\Http\Controllers\WalikelasController::class, 'index'])->name('dashboard');
});
Route::group(['middleware'=>'role:bk','prefix'=>'bk', 'as'=>'bk.'],function () {
    Route::get('dashboard', [App\Http\Controllers\BkController::class, 'index'])->name('dashboard');
});
Route::group(['middleware'=>'role:keu','prefix'=>'keu', 'as'=>'keu.'],function () {
    Route::get('dashboard', [App\Http\Controllers\KeuanganController::class, 'index'])->name('dashboard');
});
require __DIR__.'/auth.php';
