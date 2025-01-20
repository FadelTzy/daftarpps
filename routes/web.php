<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VaUserController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\RiwayatLoginController;
use App\Http\Controllers\User;
use App\Http\Controllers\PelanggaranController;
use App\Http\Controllers\BatasPelanggaranController;
use App\Http\Controllers\PelanggaranSiswaController;
use App\Http\Controllers\KonsultasiSiswaController;
use App\Http\Controllers\TopikController;
use App\Http\Controllers\VaTagihanController;
use App\Http\Controllers\VaBankController;
use App\Http\Controllers\VaTahunController;
use App\Http\Controllers\VaBtnController;
use App\Http\Controllers\PvsemesterController;
use App\Http\Controllers\PvmahasiswaController;
use App\Http\Controllers\PvtagihanController;
use App\Http\Controllers\PvgelController;
use App\Http\Controllers\PvlaporanController;

Route::get('/reporting/{id}', [Controller::class, 'reporting']);
Route::get('/checking/unique', [VaTagihanController::class, 'check']);
Route::get('/export/pembayaran', [VaTagihanController::class, 'ex'])->name('ex');
Route::get('/export/lunas', [VaTagihanController::class, 'exb'])->name('exb');
// Route::post('/unm-calback', [VaTagihanController::class, 'callback']);
Route::post('/service/cbunm', [VaTagihanController::class, 'pvcallback']);



Route::get('/landing', function () {
    return view('landing');
});

Route::get('/request-kap', function () {
    return view('requestKAP');
});


Route::get('/registrasi-awal', function () {
    return view('wizard1');
});


Route::group(['middleware' => ['auth']], function () {
    Route::prefix('admin')->group(function () {
        //new
        //pelaporan
        Route::get('/pv-pelaporan', [PvlaporanController::class, 'pelaporan'])->name('pvpembayaran.index');


        //pembayaran
        Route::get('/pv-pembayaran', [PvgelController::class, 'pembayaran'])->name('pvpembayaran.index');
        Route::get('/pv-pembayaran/{periode}/{gel}', [PvgelController::class, 'gelombang'])->name('pvgelombang.index');
        Route::get('/pv-pembayaran/{periode}', [PvgelController::class, 'periode'])->name('pvperiode.index');
        Route::post('/pv-pembayaran/import/periodegel', [PvgelController::class, 'importdata'])->name('pvimport.index');

        //tagihan
        Route::get('/pv-tagihan/{id}', [PvtagihanController::class, 'tagihan'])->name('pvtagihan.index');
        Route::post('/pv-createtagihaneb', [PvtagihanController::class, 'create'])->name('pvtagihan.create');
        Route::post('/pv-edittagihaneb', [PvtagihanController::class, 'edit'])->name('pvtagihan.edit');
        Route::post('/pv-deletettagihaneb', [PvtagihanController::class, 'delete'])->name('pvtagihan.delete');

        //data-mahasiswa
        Route::get('/pv-datamahasiswa', [PvmahasiswaController::class, 'mahasiswa'])->name('pvmahasiswa.index');
        Route::post('/pv-datamahasiswa', [PvmahasiswaController::class, 'store'])->name('pvmahasiswa.store');
        Route::post('/pv-datamahasiswa/update', [PvmahasiswaController::class, 'update'])->name('pvmahasiswa.update');
        Route::post('/pv-datamahasiswa/delete', [PvmahasiswaController::class, 'delete'])->name('pvmahasiswa.delete');


        //data-gel
        Route::get('/pvsemester', [PvsemesterController::class, 'gel'])->name('pvsemester.index');
        Route::post('/pvsemester', [PvsemesterController::class, 'gelstore'])->name('pvsemester.store');
        Route::post('/pvsemester/update', [PvsemesterController::class, 'gelupdate'])->name('pvsemester.update');
        Route::post('/pvsemester/aktivasi', [PvsemesterController::class, 'aktifasi'])->name('pvsemester.aktif');

        //lama
        Route::get('/get-total', [VaTagihanController::class, 'gettotal'])->name('get.total');
        Route::post('/change-va', [VaTagihanController::class, 'changeva'])->name('change.va');

        //daftar mhs pps
        Route::get('/mahasiswa-pps', [VaUserController::class, 'mhspps'])->name('mhspps.index');
        Route::get('/import-data', [VaUserController::class, 'importdata'])->name('importdata.index');
        Route::post('/import-data/import', [VaUserController::class, 'importmhspps'])->name('importmhspps.import');
        Route::get('/status-data', [VaTagihanController::class, 'statusdata'])->name('statusdata.index');
        Route::post('/import-data/update', [VaUserController::class, 'importdataupd'])->name('importdata.update');

        //data-mahasiswa
        Route::get('/data-mahasiswa', [VaUserController::class, 'mahasiswa'])->name('mahasiswa.index');
        Route::post('/data-mahasiswa', [VaUserController::class, 'mahasiswastore'])->name('mahasiswa.store');
        Route::post('/data-mahasiswa/import', [VaUserController::class, 'mahasiswaimport'])->name('mahasiswa.import');

        Route::post('/data-mahasiswa/update', [VaUserController::class, 'mahasiswaupdate'])->name('mahasiswa.update');
        Route::delete('/data-mahasiswa/{id}', [VaUserController::class, 'deleteuser'])->name('mahasiswa.destroy');

        //data-pembayaran
        Route::get('/pembayaran', [VaBtnController::class, 'index'])->name('bayar.index');
        Route::post('/pembayaran', [VaBtnController::class, 'store'])->name('bayar.store');
        Route::post('/pembayaran/update', [VaBtnController::class, 'update'])->name('bayar.update');
        Route::delete('/pembayaran/{id}', [VaBtnController::class, 'delete'])->name('bayar.destroy');
        //data-va
        Route::post('/proses/data-va', [VaTagihanController::class, 'proses'])->name('va.proses');
        Route::post('/proses/data-va2', [VaTagihanController::class, 'proses2'])->name('va.proses2');

        Route::get('/data-va', [VaTagihanController::class, 'va'])->name('va.index');
        Route::post('/data-va', [VaTagihanController::class, 'vastore'])->name('va.store');
        Route::post('/data-va/cek', [VaTagihanController::class, 'cekbayar'])->name('va.cekbayar');

        Route::post('/data-vau', [VaTagihanController::class, 'vaustore'])->name('vau.store');

        Route::post('/data-va/update', [VaTagihanController::class, 'vaupdate'])->name('va.update');
        Route::delete('/data-va/{id}', [VaTagihanController::class, 'deleteuser'])->name('va.destroy');
        Route::get('/data-reports', [VaTagihanController::class, 'reports'])->name('report.va');
        //data-tahun
        Route::get('/data-tahun', [VaTahunController::class, 'tahun'])->name('tahun.index');
        Route::post('/data-tahun', [VaTahunController::class, 'tahunstore'])->name('tahun.store');
        Route::post('/data-tahun/update', [VaTahunController::class, 'tahunupdate'])->name('tahun.update');
        Route::delete('/data-tahun/{id}', [VaTahunController::class, 'deletetahun'])->name('tahun.destroy');
        Route::delete('/data-tahun/aktif/{id}', [VaTahunController::class, 'aktiftahun'])->name('tahun.aktif');

        //data-bank
        Route::get('/data-bank', [VaBankController::class, 'bank'])->name('bank.index');
        Route::post('/data-bank', [VaBankController::class, 'bankstore'])->name('bank.store');
        Route::post('/data-bank/update', [VaBankController::class, 'bankupdate'])->name('bank.update');
        Route::delete('/data-bank/{id}', [VaBankController::class, 'deletebank'])->name('bank.destroy');

        //data-gel
        Route::get('/data-gelombang', [VaBankController::class, 'gel'])->name('gel.index');
        Route::post('/data-gelombang', [VaBankController::class, 'gelstore'])->name('gel.store');
        Route::post('/data-gelombang/update', [VaBankController::class, 'gelupdate'])->name('gel.update');
        Route::post('/data-gelombang/aktivasi/{id}', [VaBankController::class, 'aktifasi'])->name('gel.aktif');
        //qr-code
        Route::get('/qr-code', [KonsultasiSiswaController::class, 'qrcode'])->name('qrcode.index');
        Route::get('/qr-code/{id}', [KonsultasiSiswaController::class, 'qrcodesiswa']);
        //konsultasi
        Route::get('/konsultasi-siswa', [KonsultasiSiswaController::class, 'konsul'])->name('konsul.index');
        Route::get('/konsultasi-siswa/{id}', [KonsultasiSiswaController::class, 'konsulsiswa']);
        Route::get('/konsultasi-pesan/{id}', [KonsultasiSiswaController::class, 'pesansiswa']);

        Route::post('/konsultasi-siswa', [KonsultasiSiswaController::class, 'konsulstore'])->name('konsulsiswa.store');
        Route::post('/konsultasi-pesan', [KonsultasiSiswaController::class, 'konsulpesan'])->name('konsulpesan.store');

        //manajemen poin pelanggaran

        // data pelanggaran
        Route::get('/pelanggaran-siswa', [PelanggaranController::class, 'pesi'])->name('pesi.index');
        Route::post('/pelanggaran-siswa', [PelanggaranController::class, 'pesistore'])->name('pesi.store');
        Route::post('/pelanggaran-siswa/update', [PelanggaranController::class, 'pesiupdate'])->name('pesi.update');
        Route::post('/pelanggaran-siswa/reset/{id}', [PelanggaranController::class, 'pesireset'])->name('pesi.reset');

        Route::delete('/pelanggaran-siswa/{id}', [PelanggaranController::class, 'pesihapus'])->name('pesi.destroy');
        // data batas pelanggaran
        Route::get('/data-bataspelanggaran', [BatasPelanggaranController::class, 'bpelanggaran'])->name('bpelanggaran.index');
        Route::post('/data-bataspelanggaran', [BatasPelanggaranController::class, 'bpelanggaranstore'])->name('bpelanggaran.store');
        Route::post('/data-bataspelanggaran/update', [BatasPelanggaranController::class, 'bpelanggaranupdate'])->name('bpelanggaran.update');
        Route::delete('/data-bataspelanggaran/{id}', [BatasPelanggaranController::class, 'bpelanggaranhapus'])->name('bpelanggaran.destroy');
        //pelanggaran per siswa
        Route::get('/data-pelanggaran/{id}', [PelanggaranController::class, 'siswa']);
        Route::post('/data-pelanggaran/siswa', [PelanggaranSiswaController::class, 'pelanggaran'])->name('pelanggaransiswa.store');
        Route::delete('/data-pelanggaran/siswa/{id}', [PelanggaranSiswaController::class, 'delete']);
        //sanksi
        Route::get('/data-sanksi/{id}', [BatasPelanggaranController::class, 'siswa']);
        Route::post('/data-sanksi/verif/{id}', [BatasPelanggaranController::class, 'verif']);

        // data pelanggaran
        Route::get('/data-topik', [topikController::class, 'topik'])->name('topik.index');
        Route::post('/data-topik', [topikController::class, 'topikstore'])->name('topik.store');
        Route::post('/data-topik/update', [topikController::class, 'topikupdate'])->name('topik.update');
        Route::delete('/data-topik/{id}', [topikController::class, 'topikhapus'])->name('topik.destroy');

        // data pelanggaran
        Route::get('/data-pelanggaran', [PelanggaranController::class, 'pelanggaran'])->name('pelanggaran.index');
        Route::post('/data-pelanggaran', [PelanggaranController::class, 'pelanggaranstore'])->name('pelanggaran.store');
        Route::post('/data-pelanggaran/update', [PelanggaranController::class, 'pelanggaranupdate'])->name('pelanggaran.update');
        Route::delete('/data-pelanggaran/{id}', [PelanggaranController::class, 'pelanggaranhapus'])->name('pelanggaran.destroy');
        //riwayat login
        Route::get('/data-log', [RiwayatLoginController::class, 'log'])->name('log.index');
        Route::delete('/data-log/{id}', [RiwayatLoginController::class, 'loghapus']);

        Route::get('/data-pengaturan', [SettingController::class, 'pengaturan'])->name('pengaturan.index');
        Route::post('/data-pengaturan/update', [SettingController::class, 'pengaturanupdate'])->name('pengaturan');

        Route::get('/', [Controller::class, 'index'])->name('admin');
        // Route::get('/data-mahasiswa', [Controller::class, 'mahasiswa'])->name('mahasiswa.index');
        // Route::post('/data-mahasiswa', [Controller::class, 'mahasiswastore'])->name('mahasiswa.store');
        // Route::post('/data-mahasiswa/update', [Controller::class, 'mahasiswaupdate'])->name('mahasiswa.update');
        // Route::delete('/data-mahasiswa/{id}', [Controller::class, 'mahasiswahapus'])->name('mahasiswa.destroy');

        Route::get('/data-siswa', [Controller::class, 'dosen'])->name('dosen.index');
        Route::get('/data-siswa/riwayat-quiz/{id}', [Controller::class, 'riwayat'])->name('riwayat.quiz');

        Route::post('/data-siswa', [Controller::class, 'dosenstore'])->name('dosen.store');
        Route::post('/data-siswa/update', [Controller::class, 'dosenupdate'])->name('dosen.update');
        Route::delete('/data-siswa/{id}', [Controller::class, 'deleteuser'])->name('dosen.destroy');

        Route::get('/data-guru', [Controller::class, 'guru'])->name('guru.index');
        Route::post('/data-guru', [Controller::class, 'gurustore'])->name('guru.store');
        Route::post('/data-guru/update', [Controller::class, 'guruupdate'])->name('guru.update');
        Route::delete('/data-guru/{id}', [Controller::class, 'deleteuser'])->name('guru.destroy');

        Route::get('/data-admin', [Controller::class, 'admin'])->name('admin.index');
        Route::post('/data-admin', [Controller::class, 'adminstore'])->name('admin.store');
        Route::post('/data-admin/update', [Controller::class, 'adminupdate'])->name('admin.update');
        Route::delete('/data-admin/{id}', [Controller::class, 'deleteuser'])->name('admin.destroy');

        //text
    });
    Route::group(['middleware' => ['role']], function () {
        Route::prefix('user')->group(function () {
            Route::get('/', [User::class, 'index']);
            Route::get('/profil', [User::class, 'profiluser']);
            Route::get('/riwayat', [User::class, 'rr']);

            Route::post('/profil', [User::class, 'profilstore'])->name('profilstore');

            Route::get('/tentang', [User::class, 'tentang']);
            Route::get('/mulai', [User::class, 'mulai']);
            Route::get('/quiz', [User::class, 'quiz']);
            Route::post('/quiz', [User::class, 'postq'])->name('postquiz');
            Route::get('/report/{id}', [User::class, 'report']);

            // Route::get('/qui', [User::class, 'mulai']);
            Route::post('/getsearch', [User::class, 'getsearch'])->name('getsearch');

            Route::get('/materi/{id}', [User::class, 'materi']);
            Route::get('/materi/{id}/{materi}', [User::class, 'detail']);
        });
    });

    Route::get('/profil', [Controller::class, 'profil']);
    Route::post('/profil', [Controller::class, 'storeprofil']);
});

Route::get('/', [AuthenticatedSessionController::class, 'create']);

Route::get('/dashboard', function () {
    return view('dashboard');
})
    ->middleware(['auth'])
    ->name('dashboard');

require __DIR__ . '/auth.php';
