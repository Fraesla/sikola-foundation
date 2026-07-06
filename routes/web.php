<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\PembeliDashboardController;
use App\Http\Controllers\DonaturDashboardController;
use App\Http\Controllers\RelawanDashboardController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\KontenController;
use App\Http\Controllers\Admin\PostinganController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Relawan\EventController as EventRelawanController;
use App\Http\Controllers\Admin\DaftarEventController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\DonasiController;
use App\Http\Controllers\Admin\MerchandiseController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\RelawanApprovalController;
use App\Http\Controllers\Admin\RelawanController;
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\DonasiPublicController;
use App\Http\Controllers\Admin\DonationCategoryController;
use App\Http\Controllers\Admin\MerchandisePublicController;
use App\Http\Controllers\Pembeli\KeranjangController;

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
Route::get('/donasi',               [CompanyProfileController::class, 'donasi'])->name('donasi');
Route::get('/merchandise',          [CompanyProfileController::class, 'merchandise'])->name('merchandise');
Route::get('/merchandise/{slug}',   [MerchandisePublicController::class, 'show']);
Route::get('/tim',                  [CompanyProfileController::class, 'tim']);
Route::get('/relawan',              [CompanyProfileController::class, 'relawan']);
Route::get('/kontak',               [CompanyProfileController::class, 'kontak'])->name('kontak');;
Route::get('/login',                [CompanyProfileController::class, 'login'])->name('login');

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
    Route::resource('eventDaftar',   DaftarEventController::class);
    Route::resource('team',          TeamController::class);
    Route::resource('donasis',       DonasiController::class);
    Route::resource('donasiKategori',DonationCategoryController::class);
    Route::resource('merchandise',   MerchandiseController::class);
    Route::resource('orders',        OrderController::class);
    Route::resource('relawans',      RelawanApprovalController::class);
    Route::resource('pengguna',      PenggunaController::class);
    Route::get('konten',             [KontenController::class, 'index'])->name('konten');
    Route::get('laporan',            [LaporanController::class,'index'])->name('laporan');
    Route::get('/laporan/export/excel',[LaporanController::class,'exportExcel'])->name('laporan.export.excel');
    Route::get('/laporan/export/pdf',[LaporanController::class,'exportPdf'])->name('laporan.export.pdf');
    Route::post('/admin/pengguna/{id}/nonaktif',[PenggunaController::class,'nonaktif'])->name('pengguna.nonaktif');
    Route::post('/admin/pengguna/{id}/aktif',[PenggunaController::class,'aktif'])->name('pengguna.aktif');
    Route::get('/donasi',              [DonationCategoryController::class, 'kategori'])->name('donasi');
    Route::post('donasis/{donasi}/konfirmasi', [DonasiController::class, 'konfirmasi'])->name('donasis.konfirmasi');
    Route::post('donasis/{donasi}/tolak',      [DonasiController::class, 'tolak'])->name('donasis.tolak');
    Route::post('orders/{order}/konfirmasi',    [OrderController::class, 'konfirmasi'])->name('orders.konfirmasi');
    Route::post('orders/{order}/proses',        [OrderController::class,'proses'])->name('orders.proses');
    Route::post('orders/{order}/kirim',         [OrderController::class, 'kirim']);
    Route::post('relawans/{relawan}/setujui',    [RelawanApprovalController::class, 'setujui'])->name('relawans.setujui');
    Route::post('relawans/{relawan}/tolak',      [RelawanApprovalController::class, 'tolak'])->name('relawans.tolak');
    Route::post('/eventDaftar/{registrasi}/konfirmasi',[DaftarEventController::class, 'konfirmasi'])->name('events.konfirmasi');
    Route::post('events/{event}/hadir/{registrasi}', [EventController::class, 'konfirmasiHadir'])->name('events.hadir');
    Route::post('events/{event}/alfa/{registrasi}', [EventController::class, 'konfirmasiAlfa'])->name('events.alfa');
    Route::get('/profile',[AdminDashboardController::class,'profile'])->name('profile');
    Route::put('/profile',[AdminDashboardController::class,'updateProfile'])->name('profile.update');
    Route::get('/profile/password',[AdminDashboardController::class,'password'])->name('password');
    Route::post('/profile/password',[AdminDashboardController::class,'updatePassword'])->name('password.update');

});

// ── RELAWAN (disetujui admin) ─────────────────────────────────────
Route::prefix('relawan')->name('relawan.')->middleware(['auth', 'role:relawan'])->group(function () {
    Route::get('/', [RelawanDashboardController::class, 'index'])->name('dashboard');
    Route::post('events/{event}/daftar', [RelawanController::class, 'daftarEvent'])->name('events.daftar');
    Route::resource('donasi', DonasiPublicController::class);
    Route::resource('orders',     MerchandisePublicController::class);
    Route::resource('keranjang', KeranjangController::class);
    Route::resource('events', EventRelawanController::class);
    Route::get('events/available', [EventRelawanController::class,'available'])->name('events.available');
    Route::delete('events/registrasi/{registrasi}', [EventController::class,'batal'])->name('events.batal');
    Route::post('donasi',         [DonasiPublicController::class, 'store'])->name('donasi.sekali');
    Route::get('donasi/{id}/bayar',         [DonasiPublicController::class, 'bayar'])->name('donasi.bayar');
    Route::post('/donasi/{id}/upload', [DonasiPublicController::class,'uploadBukti'])->name('donasi.upload');
    Route::delete('/donasi/{id}/batal', [DonasiPublicController::class,'batal'])->name('donasi.batal');
    Route::post('donasi/bulanan', [DonasiPublicController::class, 'storeBulanan'])->name('donasi.langganan');
    Route::get('orders/{order}/bayar',[MerchandisePublicController::class,'bayar'])->name('orders.bayar');
    Route::post('orders/{order}/upload-bukti',[MerchandisePublicController::class,'uploadBukti'])->name('orders.upload-bukti');
    Route::get('/orders/{order}/komplain',[MerchandisePublicController::class,'komplain'])->name('orders.komplain');
    Route::get('/orders/{order}/batal',[MerchandisePublicController::class,'batal'])->name('orders.batal');
    Route::post('/orders/{order}/selesai', [MerchandisePublicController::class,'selesai'])->name('orders.selesai');
    Route::post('orders/{order}/terima', [MerchandisePublicController::class, 'konfirmasiTerima']);
    Route::get('/profile',[RelawanDashboardController::class,'profile'])->name('profile');
    Route::put('/profile',[RelawanDashboardController::class,'updateProfile'])->name('profile.update');
});

// ── DONATUR ───────────────────────────────────────────────────────
Route::prefix('donatur')->name('donatur.')->middleware(['auth', 'role:donatur'])->group(function () {
    Route::get('/', [DonaturDashboardController::class, 'index'])->name('dashboard');
    Route::resource('donasi', DonasiPublicController::class);
    Route::post('donasi',         [DonasiPublicController::class, 'store'])->name('donasi.sekali');
    Route::get('donasi/{id}/bayar',         [DonasiPublicController::class, 'bayar'])->name('donasi.bayar');
    Route::post('/donasi/{id}/upload', [DonasiPublicController::class,'uploadBukti'])->name('donasi.upload');
    Route::delete('/donasi/{id}/batal', [DonasiPublicController::class,'batal'])->name('donasi.batal');
    Route::post('donasi/bulanan', [DonasiPublicController::class, 'storeBulanan'])->name('donasi.langganan');
    Route::resource('orders',     MerchandisePublicController::class);
    Route::resource('keranjang', KeranjangController::class);
    Route::get('orders/{order}/bayar',[MerchandisePublicController::class,'bayar'])->name('orders.bayar');
    Route::post('orders/{order}/upload-bukti',[MerchandisePublicController::class,'uploadBukti'])->name('orders.upload-bukti');
    Route::post('/orders/{order}/selesai', [MerchandisePublicController::class,'selesai'])->name('orders.selesai');
    Route::get('/orders/{order}/komplain',[MerchandisePublicController::class,'komplain'])->name('orders.komplain');
    Route::get('/orders/{order}/batal',[MerchandisePublicController::class,'batal'])->name('orders.batal');
    Route::get('relawan/daftar', [RelawanController::class, 'form'])->name('relawan.daftar');
    Route::post('relawan/daftar', [RelawanController::class, 'store']);
    Route::get('/profile',[DonaturDashboardController::class,'profile'])->name('profile');
    Route::put('/profile',[DonaturDashboardController::class,'updateProfile'])->name('profile.update');
});

// ── PEMBELI ───────────────────────────────────────────────────────
Route::prefix('pembeli')->name('pembeli.')->middleware(['auth', 'role:pembeli'])->group(function () {
    Route::get('/', [PembeliDashboardController::class, 'index'])->name('dashboard');
    Route::put('/daftar/donatur', [PembeliDashboardController::class, 'daftar'])->name('daftar.donatur');
    Route::resource('orders', MerchandisePublicController::class);
    Route::resource('keranjang', KeranjangController::class);
    Route::get('orders/{order}/bayar',[MerchandisePublicController::class,'bayar'])->name('orders.bayar');
    Route::post('orders/{order}/upload-bukti',[MerchandisePublicController::class,'uploadBukti'])->name('orders.upload-bukti');
    Route::post('/orders/{order}/selesai', [MerchandisePublicController::class,'selesai'])->name('orders.selesai');
    Route::get('/orders/{order}/komplain',[MerchandisePublicController::class,'komplain'])->name('orders.komplain');
    Route::get('/orders/{order}/batal',[MerchandisePublicController::class,'batal'])->name('orders.batal');
    Route::get('relawan/daftar', [RelawanController::class, 'form'])->name('relawan.daftar');
    Route::post('relawan/daftar', [RelawanController::class, 'store']);
    Route::get('/profile',[PembeliDashboardController::class,'profile'])->name('profile');
    Route::put('/profile',[PembeliDashboardController::class,'updateProfile'])->name('profile.update');

});

Route::post('/dashboard', [CompanyProfileController::class, 'dashboard']);


Route::get('/admin/event', function () {return view('admin.event.index');})->name('admin.event');
// Route::get('/admin/relawan', function () {return view('admin.relawan.index');})->name('admin.relawan');
Route::get('admin/donasi/{slug}',        [DonationCategoryController::class,'donasiShow'])->name('admin.donasiDetail');
Route::get('/admin/produk',              [MerchandiseController::class, 'produk'])->name('admin.produk');

// Route::get('/admin/pengguna', function () {return view('admin.pengguna.index');})->name('admin.pengguna');


//Banner
