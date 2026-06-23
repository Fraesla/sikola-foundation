<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\KontenController;
use App\Http\Controllers\Admin\PostinganController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\DonasiController;
use App\Http\Controllers\Admin\MerchandiseController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\RelawanApprovalController;
use App\Http\Controllers\Admin\RelawanController;
use App\Http\Controllers\Admin\DonasiPublicController;
use App\Http\Controllers\Admin\MerchandisePublicController;

Route::get('/', function () {
    return view('welcome');
});

// ── PUBLIK (tanpa auth) ──────────────────────────────────────────
Route::get('/',                     [CompanyProfileController::class, 'beranda']);
Route::get('/tentang',              [CompanyProfileController::class, 'tentang']);
Route::get('/berita',               [CompanyProfileController::class, 'beritaIndex'])->name('berita.index');
Route::get('/berita/{slug}',        [CompanyProfileController::class, 'beritaShow'])->name('berita.show');
Route::get('/event',                [CompanyProfileController::class, 'eventIndex'])->name('event.index');
Route::get('/event/{slug}',         [CompanyProfileController::class, 'eventShow'])->name('event.show');
Route::get('/donasi',               [CompanyProfileController::class, 'donasi']);
Route::get('/merchandise',          [CompanyProfileController::class, 'merchandise'])->name('merchandise');
Route::get('/merchandise/{slug}',   [MerchandisePublicController::class, 'show']);
Route::get('/tim',                  [CompanyProfileController::class, 'tim']);
Route::get('/relawan',              [CompanyProfileController::class, 'relawan']);
Route::get('/kontak',               [CompanyProfileController::class, 'kontak']);
Route::get('/login',                [CompanyProfileController::class, 'login']);

// ── AUTH Google ──────────────────────────────────────────────────
Route::get('/auth/google',           [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');
Route::post('/logout',              [GoogleController::class, 'logout'])->name('logout');

// ── ADMIN (email+password login) ─────────────────────────────────
Route::post('/login', [AdminAuthController::class, 'login'])->name('login.process');
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('banners',       BannerController::class);
    Route::resource('postingans',    PostinganController::class);
    Route::resource('events',        EventController::class);
    Route::resource('team',          TeamController::class);
    Route::resource('donasis',       DonasiController::class);
    Route::resource('merchandise',   MerchandiseController::class);
    Route::resource('orders',        OrderController::class);
    Route::resource('relawans',      RelawanApprovalController::class);
    Route::post('donasis/{donasi}/konfirmasi', [DonasiController::class, 'konfirmasi']);
    Route::post('donasis/{donasi}/tolak',      [DonasiController::class, 'tolak']);
    Route::post('orders/{order}/konfirmasi',    [OrderController::class, 'konfirmasi']);
    Route::post('orders/{order}/kirim',         [OrderController::class, 'kirim']);
    Route::post('relawans/{relawan}/setujui',    [RelawanApprovalController::class, 'setujui']);
    Route::post('relawans/{relawan}/tolak',      [RelawanApprovalController::class, 'tolak']);
    Route::post('events/{event}/hadir/{registrasi}', [EventController::class, 'konfirmasiHadir']);
});

// ── RELAWAN (disetujui admin) ─────────────────────────────────────
Route::middleware(['auth', 'role:relawan', 'relawan.approved'])->group(function () {
    Route::post('events/{event}/daftar', [RelawanController::class, 'daftarEvent']);
    Route::post('donasi',               [DonasiPublicController::class, 'store']);
    Route::post('donasi/bulanan',       [DonasiPublicController::class, 'storeBulanan']);
    Route::resource('orders',           MerchandisePublicController::class);
    Route::post('orders/{order}/terima', [MerchandisePublicController::class, 'konfirmasiTerima']);
});

// ── DONATUR ───────────────────────────────────────────────────────
Route::middleware(['auth', 'role:donatur'])->group(function () {
    Route::post('donasi',         [DonasiPublicController::class, 'store']);
    Route::post('donasi/bulanan', [DonasiPublicController::class, 'storeBulanan']);
    Route::resource('orders',     MerchandisePublicController::class);
});

// ── PEMBELI ───────────────────────────────────────────────────────
Route::middleware(['auth', 'role:pembeli'])->group(function () {
    Route::resource('orders', MerchandisePublicController::class);
    Route::get('relawan/daftar', [RelawanController::class, 'form']);
    Route::post('relawan/daftar', [RelawanController::class, 'store']);
});

Route::post('/dashboard', [CompanyProfileController::class, 'dashboard']);
Route::get('/admin/dashboard', function () {return view('admin.dashboard.index');})->name('admin.dashboard');
Route::get('/admin/konten',              [KontenController::class, 'index'])->name('admin.konten');

Route::get('/admin/event', function () {return view('admin.event.index');})->name('admin.event');
Route::get('/admin/relawan', function () {return view('admin.relawan.index');})->name('admin.relawan');
Route::get('/admin/donasi', function () {return view('admin.donasi.index');})->name('admin.donasi');
Route::get('/admin/produk',              [MerchandiseController::class, 'produk'])->name('admin.produk');

Route::get('/admin/pengguna', function () {return view('admin.pengguna.index');})->name('admin.pengguna');
Route::get('/admin/laporan', function () {return view('admin.laporan.index');})->name('admin.laporan');

//Banner
