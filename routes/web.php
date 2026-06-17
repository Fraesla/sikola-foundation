<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyProfileController;

Route::get('/', function () {
    return view('welcome');
});

// ── PUBLIK (tanpa auth) ──────────────────────────────────────────
Route::get('/',                     [CompanyProfileController::class, 'beranda']);
Route::get('/tentang',              [CompanyProfileController::class, 'tentang']);
Route::get('/berita',               [CompanyProfileController::class, 'beritaIndex']);
Route::get('/berita/{slug}',        [CompanyProfileController::class, 'beritaShow']);
Route::get('/event',                [CompanyProfileController::class, 'eventIndex']);
Route::get('/event/{slug}',         [CompanyProfileController::class, 'eventShow'])->name('event.show');
Route::get('/donasi',               [CompanyProfileController::class, 'donasi']);
Route::get('/merchandise',          [CompanyProfileController::class, 'merchandise']);
Route::get('/merchandise/{slug}',   [MerchandisePublicController::class, 'show']);
Route::get('/tim',                  [CompanyProfileController::class, 'tim']);
Route::get('/relawan',              [CompanyProfileController::class, 'relawan']);
Route::get('/kontak',               [CompanyProfileController::class, 'kontak']);
Route::get('/login',                [CompanyProfileController::class, 'login']);


Route::post('/dashboard', [CompanyProfileController::class, 'dashboard']);
Route::get('/admin/dashboard', function () {return view('admin.dashboard.index');})->name('admin.dashboard');
Route::get('/admin/konten', function () {return view('admin.konten.index');})->name('admin.konten');
Route::get('/admin/event', function () {return view('admin.event.index');})->name('admin.event');
Route::get('/admin/relawan', function () {return view('admin.relawan.index');})->name('admin.relawan');
Route::get('/admin/donasi', function () {return view('admin.donasi.index');})->name('admin.donasi');
Route::get('/admin/merchandise', function () {return view('admin.merchandise.index');})->name('admin.merchandise');
Route::get('/admin/pengguna', function () {return view('admin.pengguna.index');})->name('admin.pengguna');
Route::get('/admin/laporan', function () {return view('admin.laporan.index');})->name('admin.laporan');
