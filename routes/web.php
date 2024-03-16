<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PresensiController;

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

Route::group(['middleware'=>'role:admin','prefix'=>'adm', 'as'=>'adm.'],function () {
    Route::get('dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');
    Route::get('menu', [App\Http\Controllers\MenuController::class, 'index'])->name('menu.index');
    Route::get('menu/create', [App\Http\Controllers\MenuController::class, 'create'])->name('menu.create');
    Route::post('menu/store', [App\Http\Controllers\MenuController::class, 'store'])->name('menu.store');
    Route::get('menu/{menu}/edit', [App\Http\Controllers\MenuController::class, 'edit'])->name('menu.edit');
    Route::put('menu/{menu}', [App\Http\Controllers\MenuController::class, 'update'])->name('menu.update');
    Route::delete('menu/{menu}', [App\Http\Controllers\MenuController::class, 'destroy'])->name('menu.destroy');
    Route::get('/menu/{menu}/edit-modal', [App\Http\Controllers\MenuController::class, 'editModal'])->name('menu.edit-modal');
    Route::get('students', [StudentController::class, 'index'])->name('students.index');
    Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');
    Route::get('/students/{id}/details', [StudentController::class, 'details'])->name('students.details');
    Route::resource('presensi', PresensiController::class);
    Route::get('guru', [App\Http\Controllers\GuruController::class, 'listGuru'])->name('guru.index');
    Route::get('walikelas',[App\Http\Controllers\AdminController::class, 'manageWalikelas'])->name('walikelas.index');
    Route::post('walikelas',[App\Http\Controllers\AdminController::class, 'storeWalikelas'])->name('walikelas.store');

});
Route::group(['middleware'=>'role:guru','prefix'=>'guru', 'as'=>'guru.'],function () {
    Route::get('dashboard', [App\Http\Controllers\GuruController::class, 'index'])->name('dashboard');
    Route::get('students', [StudentController::class, 'index'])->name('students.index');
});
Route::group(['middleware'=>'role:walikelas','prefix'=>'wk', 'as'=>'wk.'],function () {
    Route::get('dashboard', [App\Http\Controllers\WalikelasController::class, 'index'])->name('dashboard');
    Route::get('presensi', [PresensiController::class,'index'])->name('presensi.index');
    Route::post('presensi/store/{kelasId}', [PresensiController::class, 'store'])->name('presensi.store');
    Route::get('presensi/edit/', [PresensiController::class, 'edit'])->name('presensi.edit');
    Route::put('presensi/update/', [PresensiController::class, 'update'])->name('presensi.update');
    Route::get('presensi/report/', [PresensiController::class, 'report2'])->name('presensi.report');
});
Route::group(['middleware'=>'role:bk','prefix'=>'bk', 'as'=>'bk.'],function () {
    Route::get('dashboard', [App\Http\Controllers\BkController::class, 'index'])->name('dashboard');
});
Route::group(['middleware'=>'role:keu','prefix'=>'keu', 'as'=>'keu.'],function () {
    Route::get('dashboard', [App\Http\Controllers\KeuanganController::class, 'index'])->name('dashboard');
});
require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
