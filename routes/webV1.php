<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HakAksesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\RelasiController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\PengangkutanController;
use App\Http\Controllers\ArmadaController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PengajuanTokoController;
use App\Http\Controllers\TimbanganController;
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
//note dev 
//composer install = php ../composer.phar install
// ====================== AUTH & ROOT ======================
Auth::routes();

Route::get('/', function () {
    if (Auth::guard('admin')->check()) {
        return redirect('/pengajuanToko');
    }
    if (Auth::guard('user')->check()) {
        return redirect('/home');
    }
    return view('home');
});

Route::group([],function () {

    Route::get('/2fa/verify', [TwoFactorController::class, 'show'])
         ->name('2fa.verify');

    Route::post('/2fa/verify', [TwoFactorController::class, 'verify'])
         ->name('2fa.verify.post');
});

// Setup 2FA (harus sudah login dulu)
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
    Route::get('/pengajuanToko', [PengajuanTokoController::class, 'index'])->name('pengajuanToko');
    Route::get('/detailPengajuanToko/{id}', [PengajuanTokoController::class, 'detailPengajuanToko'])->name('detailPengajuanToko');
    Route::get('/detailAnggotaToko/{id}', [PengajuanTokoController::class, 'detailAnggotaToko'])->name('detailAnggotaToko');
    Route::post('/submitStatusChange', [PengajuanTokoController::class, 'submitStatusChange'])->name('submitStatusChange');
    Route::resource('pengajuanToko', PengajuanTokoController::class);
});

// ====================== USER AREA (SetDynamicDatabase) ======================
Route::middleware([SetDynamicDatabase::class, 'auth:user','throttle:user-area'])->group(function () {

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

    // ==================== MASTER DATA ====================
    // Kategori
    Route::get('/kategori/data', [KategoriController::class, 'getDataTable'])->name('kategori.data');
    Route::resource('kategori', KategoriController::class);

    // Barang
    Route::get('/barang/data', [BarangController::class, 'getDataTable'])->name('barang.data');
    Route::get('/barang/indexWebView', [BarangController::class, 'indexWebView'])->name('barang.indexWebView');
    Route::get('/barang/getKodeBarang', [BarangController::class, 'getKodeBarang'])->name('getKodeBarang');
    Route::get('/barang/getBarangDetail/{id}', [BarangController::class, 'getBarangDetail'])->name('getBarangDetail');
    Route::get('/barang/export_excel', [BarangController::class, 'export_excel'])->name('export_excel');
    Route::resource('barang', BarangController::class);

    // Relasi
    Route::get('/relasi/data', [RelasiController::class, 'getDataTable'])->name('relasi.data');
    Route::get('/relasi/indexWebView', [RelasiController::class, 'indexWebView'])->name('relasi.indexWebView');
    Route::get('/relasi/getRelasiDetail/{id}', [RelasiController::class, 'show'])->name('getRelasiDetail');
    Route::get('/relasi/get-data', [RelasiController::class, 'getData'])->name('relasi.getData');
    Route::resource('relasi', RelasiController::class);

    // Perusahaan
    Route::get('/perusahaan/data', [PerusahaanController::class, 'getDataTable'])->name('perusahaan.data');
    Route::get('/perusahaan/getPerusahaanDetail/{id}', [PerusahaanController::class, 'show'])->name('getPerusahaanDetail');
    Route::resource('perusahaan', PerusahaanController::class);

    // Pengangkutan
    Route::get('/pengangkutan/data', [PengangkutanController::class, 'getDataTable'])->name('pengangkutan.data');
    Route::get('/pengangkutan/getPengangkutanDetail/{id}', [PengangkutanController::class, 'show'])->name('getPengangkutanDetail');
    Route::resource('pengangkutan', PengangkutanController::class);

    // Armada
    Route::get('/armada/data', [ArmadaController::class, 'getDataTable'])->name('armada.data');
    Route::get('/armada/getArmadaDetail/{id}', [ArmadaController::class, 'getArmadaDetail'])->name('getArmadaDetail');
    Route::resource('armada', ArmadaController::class);

    // Timbangan
    Route::get('/timbangan/data', [TimbanganController::class, 'getDataTable'])->name('timbangan.data');
    Route::get('/timbangan/raw', [TimbanganController::class, 'raw'])->name('timbangan.raw');
    Route::get('/timbangan/getKodeSlip', [TimbanganController::class, 'getKodeSlip'])->name('getKodeSlip');
    Route::get('/timbangan/getRelasi/{id}', [TimbanganController::class, 'getRelasi'])->name('getRelasi');
    Route::get('/timbangan/getArmada', [TimbanganController::class, 'getArmada'])->name('getArmada');
    Route::get('/timbangan/getTimbanganDetail/{id}', [TimbanganController::class, 'getTimbanganDetail'])->name('getTimbanganDetail');
    Route::post('/timbangan/store', [TimbanganController::class, 'store'])->name('simpanTimbangan');
    Route::post('/timbangan/load', [TimbanganController::class, 'loadData'])->name('loadTimbangan');
    Route::post('/timbangan/tarikTarra', [TimbanganController::class, 'tarikTarra'])->name('tarikTarra');
    Route::post('/timbangan/updateTarra', [TimbanganController::class, 'updateTarra'])->name('updateTarra');
    Route::post('/timbangan/update/{id}', [TimbanganController::class, 'update'])->name('updateTimbangan');
    Route::resource('timbangan', TimbanganController::class);

    // ==================== LAPORAN ====================
    Route::get('/laporanTimbangan/data', [LaporanTimbanganController::class, 'getDataTable'])->name('laporanTimbangan.data');
    Route::get('/laporanTimbangan/exportPdf', [LaporanTimbanganController::class, 'exportPdf'])->name('laporanTimbangan.exportPdf');
    Route::resource('laporanTimbangan', LaporanTimbanganController::class);

    // ==================== USER & HAK AKSES ====================
    Route::get('/user/data', [UserController::class, 'getDataTable'])->name('user.data');
    Route::get('/user/getSettings', [UserController::class, 'getSettings'])->name('getSettings');
    Route::get('/user/detail/{id}', [UserController::class, 'getUserDetail'])->name('detailUser');
    Route::put('/user/update/{id}', [UserController::class, 'update'])->name('updateUser');    
    Route::delete('/user/delete/{id}', [UserController::class, 'destroy'])->name('deleteUser');
    Route::delete('/user/deletePermanent/{id}', [UserController::class, 'deletePermanent'])->name('deletePermanentUser');
    Route::post('/user/add', [UserController::class, 'store'])->name('addUser');
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
    Route::get('/pengaturanTimbangan', [PengaturanController::class, 'pengaturanTimbangan'])->name('PengaturanTimbangan');
    Route::get('/pengaturanAbsensi', [PengaturanController::class, 'pengaturanAbsensi'])->name('PengaturanAbsensi');
    Route::get('/pengaturanPoinMember', [PengaturanController::class, 'pengaturanPoinMember'])->name('PengaturanPoin');

    Route::post('/toko/store', [PengaturanController::class, 'store'])->name('toko.store');
    Route::post('/toko/verifikasiUlang', [PengaturanController::class, 'verifikasiUlang'])->name('toko.verifikasiUlang');
    Route::post('/toko/connect/{id}', [PengaturanController::class, 'connect'])->name('toko.connect');
    Route::post('/toko/disconnect', [PengaturanController::class, 'disconnect'])->name('toko.disconnect');
    Route::get('/toko/getInfoToko', [PengaturanController::class, 'getInfoToko'])->name('getInfoToko');
    Route::post('/toko/simpanTokoBaru', [PengaturanController::class, 'simpanTokoBaru'])->name('toko.simpanTokoBaru');

    // ==================== TESTING / DEVELOPMENT ====================
    Route::get('/tes', fn() => view('page.tes1'));

    Route::get('/send-email', function () {
        $data = ['name' => 'Syahrizal As', 'body' => 'Testing Kirim Email'];
        Mail::to('secretentrance911@gmail.com')->send(new SendEmail($data));
        dd("Email Berhasil dikirim.");
    });
});