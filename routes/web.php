<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\kategori_kelasController;
use App\Http\Controllers\barangController;
use App\Http\Controllers\level_kelasController;
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
Route::get('/kategori', function () {
    return view('kategori_kelas');
});
Route::get('/barang', function () {
    return view('barang');
});
Route::resource('/kategori_kelas', kategori_kelasController::class);
Route::resource('/barang', barangController::class);