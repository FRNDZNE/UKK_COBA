<?php

use Illuminate\Support\Facades\Route;

use App\Models\User;
use App\Models\Pengaduan;
use App\Models\Tanggapan;

use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\TanggapanController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/template-depan', function(){
    return view('welcome2');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'role:admin|petugas'])->prefix('petugas')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('index.petugas');

    //CRUD Tanggapan
    Route::post('proses/{id}', [App\Http\Controllers\TanggapanController::class, 'proses'])->name('proses.pengaduan');
    Route::post('menanggapi',[App\Http\Controllers\TanggapanController::class, 'store_tanggapan'])->name('store.tanggapan');
    Route::post('selesai/{id}',[App\Http\Controllers\TanggapanController::class, 'selesai'])->name('selesai');
});

Route::middleware(['auth' , 'role:admin'])->prefix('petugas')->group(function(){
    Route::get('cetak/{id}', [App\Http\Controllers\PengaduanController::class, 'cetak'])->name('cetak');
});

Route::middleware(['auth', 'role:masyarakat'])->prefix('masyarakat')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('index.masyarakat');

    //CRUD Pengaduan
    Route::get('/create-pengaduan', [App\Http\Controllers\PengaduanController::class, 'create'])->name('create.pengaduan');
    Route::post('/store-pengaduan', [App\Http\Controllers\PengaduanController::class, 'store'])->name('store.pengaduan');
    Route::get('/edit-pengaduan/{id}', [App\Http\Controllers\PengaduanController::class, 'edit'])->name('edit.pengaduan');
    Route::post('/update-pengaduan/{id}', [App\Http\Controllers\PengaduanController::class, 'update'])->name('update.pengaduan');
    Route::post('/destroy-pengaduan/{id}', [App\Http\Controllers\PengaduanController::class, 'destroy'])->name('destroy.pengaduan');
});

Route::get('/home', function () {
    if (Auth::user()->hasRole(['admin', 'petugas'])) {
        return redirect()->route('index.petugas');
    } else {
        return redirect()->route('index.masyarakat');
    }
});
