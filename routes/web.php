<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;

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

// Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('jadwal', [App\Http\Controllers\Users\JadwalController::class, 'index']);
Route::get('perkembangan', [App\Http\Controllers\Users\PerkembanganController::class, 'index']);

Auth::routes();

Route::post('/action-login', [AuthController::class, 'action_login']);
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::get('/register-institusi', [AuthController::class, 'register_institusi']);
Route::get('/lengkapi-institusi', [AuthController::class, 'lengkapi_institusi']);

Route::post('/insert-register', [AuthController::class, 'insert_register']);
Route::post('/insert-register-institusi', [AuthController::class, 'insert_register_institusi']);
Route::post('/update-lengkapi-institusi', [AuthController::class, 'update_lengkapi_insititusi']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('logout', [AuthController::class, 'logout']);
Route::get('profile-users', [AuthController::class, 'profile_users']);
Route::get('profile', [AuthController::class, 'profile']);
Route::post('update-profile-users', [AuthController::class, 'update_profile'])->name('update');

Route::get('data-kategori', [App\Http\Controllers\DataKategoriController::class, 'index']);
Route::post('insert-kategori', [App\Http\Controllers\DataKategoriController::class, 'insert']);
Route::post('update-kategori', [App\Http\Controllers\DataKategoriController::class, 'update']);
Route::get('delete-kategori/{id}', [App\Http\Controllers\DataKategoriController::class, 'delete']);


Route::get('donasi-uang', [App\Http\Controllers\Users\DonasiUangController::class, 'index']);
Route::get('pembayaran-lunas', [App\Http\Controllers\Users\DonasiUangController::class, 'pembayaran_lunas']);
Route::get('pembayaran-pending/{id}', [App\Http\Controllers\Users\DonasiUangController::class, 'pembayaran_pending']);

Route::get('donasi-makanan', [App\Http\Controllers\Users\DonasiMakananController::class, 'index']);
Route::get('get-detail-donasi-makanan', [App\Http\Controllers\Users\DonasiMakananController::class, 'detail']);
Route::post('insert-donasi-makanan', [App\Http\Controllers\Users\DonasiMakananController::class, 'insert']);
Route::post('update-donasi-makanan', [App\Http\Controllers\Users\DonasiMakananController::class, 'update']);
Route::get('delete-donasi-makanan/{id}', [App\Http\Controllers\Users\DonasiMakananController::class, 'delete']);

Route::get('pembayaran', [App\Http\Controllers\Users\PembayaranController::class, 'index']);
Route::get('berita-users', [App\Http\Controllers\Users\DataBeritaController::class, 'index']);
Route::get('detail-informasi-users/{id}', [App\Http\Controllers\Users\DataBeritaController::class, 'detail']);

Route::get('history-users', [App\Http\Controllers\Users\HistoryController::class, 'index']);
Route::get('detail-history/{id}', [App\Http\Controllers\Users\HistoryController::class, 'detail']);



// Role Admin
Route::get('dashboard-admin', [App\Http\Controllers\DashboardController::class, 'index']);

Route::get('data-admin', [App\Http\Controllers\DataAdminController::class, 'index']);
Route::post('non-aktiv', [App\Http\Controllers\DataAdminController::class, 'non_aktiv']);
Route::post('insert-admin', [App\Http\Controllers\DataAdminController::class, 'insert']);
Route::post('update-admin', [App\Http\Controllers\DataAdminController::class, 'update']);
Route::get('delete-admin/{id}', [App\Http\Controllers\DataAdminController::class, 'delete']);

Route::get('data-bidan', [App\Http\Controllers\DataBidanController::class, 'index']);
Route::post('non-aktiv-bidan', [App\Http\Controllers\DataBidanController::class, 'non_aktiv']);
Route::post('insert-bidan', [App\Http\Controllers\DataBidanController::class, 'insert']);
Route::post('update-bidan', [App\Http\Controllers\DataBidanController::class, 'update']);
Route::get('delete-bidan/{id}', [App\Http\Controllers\DataBidanController::class, 'delete']);

Route::get('data-orangtua', [App\Http\Controllers\DataOrangtuaController::class, 'index']);
Route::post('non-aktiv-orangtua', [App\Http\Controllers\DataOrangtuaController::class, 'non_aktiv']);
Route::post('insert-orangtua', [App\Http\Controllers\DataOrangtuaController::class, 'insert']);
Route::post('update-orangtua', [App\Http\Controllers\DataOrangtuaController::class, 'update']);
Route::get('delete-orangtua/{id}', [App\Http\Controllers\DataOrangtuaController::class, 'delete']);

Route::get('data-petugas', [App\Http\Controllers\DataPetugasController::class, 'index']);
Route::post('insert-petugas', [App\Http\Controllers\DataPetugasController::class, 'insert']);
Route::post('update-petugas', [App\Http\Controllers\DataPetugasController::class, 'update']);
Route::get('delete-petugas/{id}', [App\Http\Controllers\DataPetugasController::class, 'delete']);
Route::get('detail-petugas/{id}', [App\Http\Controllers\DataPetugasController::class, 'detail']);
Route::get('data-balita-petugas', [App\Http\Controllers\DataBalitaPetugasController::class, 'index']);
Route::get('data-pemeriksaan-petugas', [App\Http\Controllers\DataPemeriksaanPetugasController::class, 'index']);
Route::get('laporan-pemeriksaan-petugas', [App\Http\Controllers\LaporanPemeriksaanPetugasController::class, 'index']);

Route::get('data-balita', [App\Http\Controllers\DataBalitaController::class, 'index']);
Route::post('insert-balita', [App\Http\Controllers\DataBalitaController::class, 'insert']);
Route::post('update-balita', [App\Http\Controllers\DataBalitaController::class, 'update']);
Route::get('delete-balita/{id}', [App\Http\Controllers\DataBalitaController::class, 'delete']);
Route::get('data-balita-bidan', [App\Http\Controllers\DataBalitaBidanController::class, 'index']);

Route::get('data-jadwal', [App\Http\Controllers\DataJadwalController::class, 'index']);
Route::post('insert-jadwal', [App\Http\Controllers\DataJadwalController::class, 'insert']);
Route::post('update-jadwal', [App\Http\Controllers\DataJadwalController::class, 'update']);
Route::get('delete-jadwal/{id}', [App\Http\Controllers\DataJadwalController::class, 'delete']);

Route::get('data-pemeriksaan', [App\Http\Controllers\DataPemeriksaanController::class, 'index']);
Route::get('tambah-pemeriksaan', [App\Http\Controllers\DataPemeriksaanController::class, 'create']);
Route::post('insert-pemeriksaan', [App\Http\Controllers\DataPemeriksaanController::class, 'insert']);
Route::post('update-pemeriksaan', [App\Http\Controllers\DataPemeriksaanController::class, 'update']);
Route::get('delete-pemeriksaan/{id}', [App\Http\Controllers\DataPemeriksaanController::class, 'delete']);
Route::get('detail-pemeriksaan/{id}', [App\Http\Controllers\DataPemeriksaanController::class, 'detail']);
Route::get('data-pemeriksaan-bidan', [App\Http\Controllers\DataPemeriksaanBidanController::class, 'index']);
Route::get('detail-pemeriksaan-bidan/{id}', [App\Http\Controllers\DataPemeriksaanBidanController::class, 'detail']);


Route::get('laporan-pemeriksaan', [App\Http\Controllers\LaporanPemeriksaanController::class, 'index']);
Route::post('filter-laporan', [App\Http\Controllers\LaporanPemeriksaanController::class, 'filter']);
