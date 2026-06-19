<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\PostinganController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\MerchandiseController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DonasiPublicController;
use App\Http\Controllers\MerchandisePublicController;

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

// ── AUTH Google ──────────────────────────────────────────────────
Route::get('/auth/google',           [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');
Route::post('/logout',              [GoogleController::class, 'logout'])->name('logout');

// ── ADMIN (email+password login) ─────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('banners',       Admin\BannerController::class);
    Route::resource('postingans',    Admin\PostinganController::class);
    Route::resource('events',        Admin\EventController::class);
    Route::resource('team',          Admin\TeamController::class);
    Route::resource('donasis',       Admin\DonasiController::class);
    Route::resource('merchandise',   Admin\MerchandiseController::class);
    Route::resource('orders',        Admin\OrderController::class);
    Route::resource('relawans',      Admin\RelawanApprovalController::class);
    Route::post('donasis/{donasi}/konfirmasi', [Admin\DonasiController::class, 'konfirmasi']);
    Route::post('donasis/{donasi}/tolak',      [Admin\DonasiController::class, 'tolak']);
    Route::post('orders/{order}/konfirmasi',    [Admin\OrderController::class, 'konfirmasi']);
    Route::post('orders/{order}/kirim',         [Admin\OrderController::class, 'kirim']);
    Route::post('relawans/{relawan}/setujui',    [Admin\RelawanApprovalController::class, 'setujui']);
    Route::post('relawans/{relawan}/tolak',      [Admin\RelawanApprovalController::class, 'tolak']);
    Route::post('events/{event}/hadir/{registrasi}', [Admin\EventController::class, 'konfirmasiHadir']);
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
Route::get('/admin/konten', function () {return view('admin.konten.index');})->name('admin.konten');
Route::get('/admin/event', function () {return view('admin.event.index');})->name('admin.event');
Route::get('/admin/relawan', function () {return view('admin.relawan.index');})->name('admin.relawan');
Route::get('/admin/donasi', function () {return view('admin.donasi.index');})->name('admin.donasi');
Route::get('/admin/merchandise', function () {return view('admin.merchandise.index');})->name('admin.merchandise');
Route::get('/admin/pengguna', function () {return view('admin.pengguna.index');})->name('admin.pengguna');
Route::get('/admin/laporan', function () {return view('admin.laporan.index');})->name('admin.laporan');
