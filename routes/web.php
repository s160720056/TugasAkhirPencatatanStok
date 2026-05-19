<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HakAksesController;
use App\Http\Controllers\HomeController;
// use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BukuStokController;
use App\Http\Controllers\RekapStokBarangController;
use App\Http\Controllers\TransaksiController;
 use App\Http\Controllers\DeployController;

// use App\Http\Controllers\PerusahaanController;
// use App\Http\Controllers\PengangkutanController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PengajuanTokoController;
use App\Http\Controllers\LaporanTimbanganController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TwoFactorController;
use App\Http\Middleware\SetDynamicDatabase;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
// php ../composer.phar install
// ====================== AUTH & ROOT ======================
Auth::routes();
// Route::get('/test', function () {
//     return undefinedFunction();
// });
Route::get('/', function () {
    if (Auth::guard('admin')->check()) {
        return redirect('/pengajuanToko');
    }
    if (Auth::guard('user')->check()) {
        return redirect('/home');
    }
    return redirect('/login');
});

Route::group([], function () {
    Route::get('/2fa/verify', [TwoFactorController::class, 'show'])
         ->name('2fa.verify');

    Route::post('/2fa/verify', [TwoFactorController::class, 'verify'])
         ->name('2fa.verify.post');
});

// Setup 2FA
Route::middleware('auth')->group(function () {
    Route::get('/2fa/setup', [TwoFactorController::class, 'setup'])->name('2fa.setup');
    Route::post('/2fa/setup/confirm', [TwoFactorController::class, 'confirmSetup'])->name('2fa.confirm');
    Route::post('/2fa/disable', [TwoFactorController::class, 'disable'])->name('2fa.disable');
    Route::post('/2fa/disable/{id}', [TwoFactorController::class, 'disableForUser'])
         ->name('2fa.disable.user');
    Route::get('/2fa/setup/{id}', [TwoFactorController::class, 'setupForUser'])->name('2fa.setup.user');
    Route::post('/2fa/setup/confirm/{id}', [TwoFactorController::class, 'confirmSetupForUser'])
         ->name('2fa.confirm.user');
});

// ====================== ADMIN AREA ======================
Route::middleware('auth:admin')->group(function () {
    Route::resource('admin', AdminController::class);

    // Pengajuan Toko
    Route::get('/detailPengajuanToko/{id}', [PengajuanTokoController::class, 'detailPengajuanToko'])->name('detailPengajuanToko');
    Route::get('/detailAnggotaToko/{id}', [PengajuanTokoController::class, 'detailAnggotaToko'])->name('detailAnggotaToko');
    Route::post('/submitStatusChange', [PengajuanTokoController::class, 'submitStatusChange'])->name('submitStatusChange');
    Route::resource('pengajuanToko', PengajuanTokoController::class);
});

// ====================== USER AREA ======================
Route::middleware([SetDynamicDatabase::class, 'auth:user', 'throttle:user-area'])->group(function () {

    // ==================== PRINT & PDF ====================
    Route::post('/printTimbangan', [PrintController::class, 'printTimbangan'])->name('printStrukTimbangan');
    Route::post('/printStrukNota', [PrintController::class, 'printNota'])->name('printStrukNota');
    Route::post('/printSlipGaji', [PrintController::class, 'printSlipGaji'])->name('printSlipGaji');
    Route::get('/pdf', [PdfController::class, 'generate']);
    Route::get('/pdfView', fn() => view('page.pdf.example'));

    // ==================== UNLOCK SCREEN ====================
    Route::post('/unlock', [App\Http\Controllers\LockController::class, 'unlock']);

    // ==================== HOME ====================
    Route::resource('home', HomeController::class);


    // Barang
    Route::get('/barang/data', [BarangController::class, 'getDataTable'])->name('barang.data');
    Route::get('/barang/indexWebView', [BarangController::class, 'indexWebView'])->name('barang.indexWebView');
    Route::get('/barang/getKodeBarang', [BarangController::class, 'getKodeBarang'])->name('getKodeBarang');
    Route::get('/barang/getBarangDetail/{id}', [BarangController::class, 'getBarangDetail'])->name('getBarangDetail');
    Route::get('/barang/get-data', [BarangController::class, 'getData'])->name('barang.getData');
    Route::post('/barang/check-duplicate', [BarangController::class, 'checkDuplicate'])->name('barang.checkDuplicate');
    Route::resource('barang', BarangController::class);

    // Buku Stok
    Route::get('/bukuStok/rekap/{bulan}', [BukuStokController::class, 'rekapMonth'])->name('bukuStok.rekap');
    Route::get('/bukuStok/month/{month}', [BukuStokController::class, 'flipbookMonth'])->name('flipbookMonth');
    // Route::get('/buku-stok/clear-cache', [BukuStokController::class, 'clearAllCache'])
    //     ->name('buku-stok.clear-cache');

    //rekapStokBarang
    // Route::get('/rekap StokBarang', [BukuStokController::class, 'rekapHarian'])->name('rekapStokBarang.index');
    Route::resource('/bukuStok', BukuStokController::class);

    // //rekap stok barang
    Route::get('rekapStokBarang/rekap-harian', [RekapStokBarangController::class, 'rekapHarian'])->name('rekapHarian');
    Route::resource('/rekapStokBarang', RekapStokBarangController::class);

    // Transaksi
    Route::get('/transaksi/data', [TransaksiController::class, 'getDataTable'])->name('transaksi.data');
    Route::get('/transaksi/getTransaksiDetail/{id}', [TransaksiController::class, 'getTransaksiDetail'])->name('getTransaksiDetail');
    Route::resource('transaksi', TransaksiController::class);

    // ==================== USER & HAK AKSES ====================
    Route::get('/user/data', [UserController::class, 'getDataTable'])->name('user.data');
    Route::get('/user/getSettings', [UserController::class, 'getSettings'])->name('getSettings');
    Route::get('/user/detail/{id}', [UserController::class, 'getUserDetail'])->name('detailUser');
    Route::resource('user', UserController::class);

    Route::get('/hakAkses/data', [HakAksesController::class, 'getDataTable'])->name('hakAkses.data');
    Route::post('/cekHakAkses', [HakAksesController::class, 'cekHakAkses'])->name('cekHakAkses');
    Route::post('/hakAkses/store', [HakAksesController::class, 'store'])->name('simpanHakAkses');
    Route::get('/hakAkses/detailHakAkses/{id}', [HakAksesController::class, 'detailHakAkses'])->name('detailHakAkses');
    Route::post('/hakAkses/updateHakAkses/{id}', [HakAksesController::class, 'updateHakAkses'])->name('updateHakAkses');
    Route::resource('hakAkses', HakAksesController::class);

    // ==================== PENGATURAN TOKO ====================
    Route::get('/pengaturanToko', [PengaturanController::class, 'pengaturanToko'])->name('PengaturanToko');
    Route::get('/pengaturanStruk', [PengaturanController::class, 'pengaturanStruk'])->name('PengaturanStruk');

    Route::post('/toko/store', [PengaturanController::class, 'store'])->name('toko.store');
    Route::post('/toko/verifikasiUlang', [PengaturanController::class, 'verifikasiUlang'])->name('toko.verifikasiUlang');
    Route::post('/toko/connect/{id}', [PengaturanController::class, 'connect'])->name('toko.connect');
    Route::post('/toko/disconnect', [PengaturanController::class, 'disconnect'])->name('toko.disconnect');
    Route::get('/toko/getInfoToko', [PengaturanController::class, 'getInfoToko'])->name('getInfoToko');
    Route::post('/toko/simpanTokoBaru', [PengaturanController::class, 'simpanTokoBaru'])->name('toko.simpanTokoBaru');



Route::post('/deploy', [DeployController::class, 'deploy'])
     ->name('deploy')
     ->middleware('auth'); // atau middleware custom



    // ==================== TESTING / DEVELOPMENT ====================
    Route::get('/tes', fn() => view('page.tes1'));

    Route::get('/send-email', function () {
        $data = ['name' => 'Syahrizal As', 'body' => 'Testing Kirim Email'];
        Mail::to('secretentrance911@gmail.com')->send(new SendEmail($data));
        dd("Email Berhasil dikirim.");
    });
});
