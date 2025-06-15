<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DaftarSantriController;
use App\Http\Controllers\AbsensiSdController;
use App\Http\Controllers\InfakHariansdController;
use App\Http\Controllers\NilaiAlquransdController;
use App\Http\Controllers\Nilaihafalansurahsdcontroller;
use App\Http\Controllers\TabunganSantriControllersd;
use App\Http\Controllers\NilaihapalanDoaControllwr;
use App\Http\Controllers\nilaiHapalanHadistController;
//tk
use App\Http\Controllers\daftarSantritkController;
use App\Http\Controllers\AbsensiTKcontroller;
use App\Http\Controllers\TabunganTKcontroller;
use App\Http\Controllers\NilaiMembacaControoller;
use App\Http\Controllers\infaktkController;
use App\Http\Controllers\NilaiMenuliscontroller;
use App\Http\Controllers\NilaihapalanDoaTKController;
use App\Http\Controllers\NilaihapalansurahTKController;
use App\Http\Controllers\PraktekshalatController;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

// Auth::routes(['register' => false]); // Disable registration


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/inventori-dta', function () {
    return view('inventori-dta');
});

Route::get('/santri-tk', function () {
    return view('tk/santri-tk');
});

Route::get('/santri-sd', function () {
    return view('sd/santri-sd');
});

Route::get('/pengajian-ibu', function () {
    return view('pengajian-ibu');
});

//daftar santri
Route::get('sd/daftar', [DaftarSantriController::class, 'index'])->name('sd.daftar.index');
Route::get('sd/daftar/create', [DaftarSantriController::class, 'create'])->name('sd.daftar.create');
Route::post('sd/daftar', [DaftarSantriController::class, 'store'])->name('sd.daftar.store');
Route::get('sd/daftar/{santri}/edit', [DaftarSantriController::class, 'edit'])->name('sd.daftar.edit');
Route::put('sd/daftar/{santri}', [DaftarSantriController::class, 'update'])->name('sd.daftar.update');
Route::delete('sd/daftar/{santri}', [DaftarSantriController::class, 'destroy'])->name('sd.daftar.destroy');

// Routes for absensi
Route::get('sd/absensis', [AbsensiSdController::class, 'index'])->name('sd.absensis.index');
Route::post('sd/absensis', [AbsensiSdController::class, 'store'])->name('sd.absensis.store');
Route::get('sd/absensis/{absensi}/edit', [AbsensiSdController::class, 'edit'])->name('sd.absensis.edit');
Route::put('/sd/absensis/{id}', [AbsensiSdController::class, 'update'])->name('sd.absensis.update');
Route::delete('sd/absensis/reset', [AbsensiSdController::class, 'reset'])->name('sd.absensis.reset');

Route::delete('sd/absensis/{absensi}', [AbsensiSdController::class, 'destroy'])->name('sd.absensis.destroy');
Route::get('sd/absensis/report', [AbsensiSdController::class, 'report'])->name('sd.absensis.report');
Route::get('/sd/absensis/export', [AbsensiSdController::class, 'export'])->name('sd.absensis.export');
Route::get('/sd/absensis/export/{santri_id}', [AbsensiSdController::class, 'exportPerSantri'])->name('sd.absensis.exportPerSantri');

// Routes for tabungan
Route::get('sd/tabungan', [TabunganSantriControllersd::class, 'index'])->name('sd.tabungan.index');
Route::get('sd/tabungan/create', [TabunganSantriControllersd::class, 'create'])->name('sd.tabungan.create');
Route::post('sd/tabungan', [TabunganSantriControllersd::class, 'store'])->name('sd.tabungan.store');
Route::get('sd/tabungan/{tabungan}', [TabunganSantriControllersd::class, 'show'])->name('sd.tabungan.show');
Route::get('sd/tabungan/{tabungan}/edit', [TabunganSantriControllersd::class, 'edit'])->name('sd.tabungan.edit');
Route::put('sd/tabungan/{tabungan}', [TabunganSantriControllersd::class, 'update'])->name('sd.tabungan.update');
Route::delete('sd/tabungan/{tabungan}', [TabunganSantriControllersd::class, 'destroy'])->name('sd.tabungan.destroy');

// Routes for infak harian
Route::get('sd/infak', [InfakHariansdController::class, 'index'])->name('sd.infak.index');
Route::get('sd/infak/create', [InfakHariansdController::class, 'create'])->name('sd.infak.create');
Route::delete('/sd/infak/reset', [InfakHariansdController::class, 'reset'])->name('sd.infak.reset');
Route::post('sd/infak', [InfakHariansdController::class, 'store'])->name('sd.infak.store');
Route::get('sd/infak/{infakHariansd}/edit', [InfakHariansdController::class, 'edit'])->name('sd.infak.edit');
Route::put('sd/infak/{infakHariansd}', [InfakHariansdController::class, 'update'])->name('sd.infak.update');
Route::delete('sd/infak/{infakHariansd}', [InfakHariansdController::class, 'destroy'])->name('sd.infak.destroy');
Route::get('sd/infak/{santri}', [InfakHariansdController::class, 'show'])->name('sd.infak.show');
Route::get('/sd/infak/export/{santri_id}', [InfakHariansdController::class, 'exportPerSantri'])->name('sd.infak.exportPerSantri');


//Route nilai sd
Route::get('sd/nilaialquran', [NilaiAlquransdController::class, 'index'])->name('sd.nilaialquran.index');
Route::get('sd/nilaialquran/create', [NilaiAlquransdController::class, 'create'])->name('sd.nilaialquran.create');
Route::post('sd/nilaialquran', [NilaiAlquransdController::class, 'store'])->name('sd.nilaialquran.store');
Route::get('sd/nilaialquran/{NilaiAlquransd}/edit', [NilaiAlquransdController::class, 'edit'])->name('sd.nilaialquran.edit');
Route::put('sd/nilaialquran/{NilaiAlquransd}', [NilaiAlquransdController::class, 'update'])->name('sd.nilaialquran.update');
Route::delete('/sd/nilaialquran/reset', [NilaiAlquransdController::class, 'reset'])->name('sd.nilaialquran.reset');
Route::delete('sd/nilaialquran/{NilaiAlquransd}', [NilaiAlquransdController::class, 'destroy'])->name('sd.nilaialquran.destroy');
Route::get('sd/nilaialquran/{santri}', [NilaiAlquransdController::class, 'show'])->name('sd.nilaialquran.show');
Route::get('/sd/nilaialquran/export/{id}', [NilaiAlquransdController::class, 'exportPdf'])->name('sd.nilaialquran.export');


// Routes for Nilai Hafalan Surah SD
Route::get('sd/nilaihafalansurah', [Nilaihafalansurahsdcontroller::class, 'index'])->name('sd.nilaihafalansurah.index');
Route::get('sd/nilaihafalansurah/create', [Nilaihafalansurahsdcontroller::class, 'create'])->name('sd.nilaihafalansurah.create');
Route::post('sd/nilaihafalansurah', [Nilaihafalansurahsdcontroller::class, 'store'])->name('sd.nilaihafalansurah.store');
Route::get('sd/nilaihafalansurah/{nilaihafalansurahsd}/edit', [Nilaihafalansurahsdcontroller::class, 'edit'])->name('sd.nilaihafalansurah.edit');
Route::put('sd/nilaihafalansurah/{nilaihafalansurahsd}', [Nilaihafalansurahsdcontroller::class, 'update'])->name('sd.nilaihafalansurah.update');
Route::delete('sd/nilaihafalansurah/reset', [Nilaihafalansurahsdcontroller::class, 'reset'])->name('sd.nilaihafalansurah.reset');
Route::delete('sd/nilaihafalansurah/{nilaihafalansurahsd}', [Nilaihafalansurahsdcontroller::class, 'destroy'])->name('sd.nilaihafalansurah.destroy');
Route::get('sd/nilaihafalansurah/{santri}', [Nilaihafalansurahsdcontroller::class, 'show'])->name('sd.nilaihafalansurah.show');
Route::get('sd/nilaihafalansurah/export/{id}', [Nilaihafalansurahsdcontroller::class, 'exportPdf'])->name('sd.nilaihafalansurah.export');

// Routes for Nilai Hapalan Doa SD
Route::get('sd/nilaidoa', [NilaihapalanDoaControllwr::class, 'index'])->name('sd.nilaidoa.index');
Route::get('sd/nilaidoa/create', [NilaihapalanDoaControllwr::class, 'create'])->name('sd.nilaidoa.create');
Route::post('sd/nilaidoa', [NilaihapalanDoaControllwr::class, 'store'])->name('sd.nilaidoa.store');
Route::get('sd/nilaidoa/{nilaidoa}/edit', [NilaihapalanDoaControllwr::class, 'edit'])->name('sd.nilaidoa.edit');
Route::put('sd/nilaidoa/{nilaidoa}', [NilaihapalanDoaControllwr::class, 'update'])->name('sd.nilaidoa.update');
Route::delete('sd/nilaidoa/reset', [NilaihapalanDoaControllwr::class, 'reset'])->name('sd.nilaidoa.reset');
Route::delete('sd/nilaidoa/{nilaidoa}', [NilaihapalanDoaControllwr::class, 'destroy'])->name('sd.nilaidoa.destroy');
Route::get('sd/nilaidoa/{santri}', [NilaihapalanDoaControllwr::class, 'show'])->name('sd.nilaidoa.show');
Route::get('sd/nilaidoa/generatePDF/{santri_id}', [NilaihapalanDoaControllwr::class, 'generatePDF'])->name('sd.nilaidoa.generatePDF');

// Route untuk menampilkan hadist SD
Route::get('sd/nilaihadist', [nilaiHapalanHadistController::class, 'index'])->name('sd.nilaihadist.index');
Route::get('sd/nilaihadist/create', [nilaiHapalanHadistController::class, 'create'])->name('sd.nilaihadist.create');
Route::post('sd/nilaihadist', [nilaiHapalanHadistController::class, 'store'])->name('sd.nilaihadist.store');
Route::get('sd/nilaihadist/{santri}/edit', [nilaiHapalanHadistController::class, 'edit'])->name('sd.nilaihadist.edit');
Route::put('sd/nilaihadist/{santri}', [nilaiHapalanHadistController::class, 'update'])->name('sd.nilaihadist.update');
Route::delete('sd/nilaihadist/reset', [nilaiHapalanHadistController::class, 'reset'])->name('sd.nilaihadist.reset');
Route::delete('sd/nilaihadist/{santri}', [nilaiHapalanHadistController::class, 'destroy'])->name('sd.nilaihadist.destroy');
Route::get('sd/nilaihadist/{santri}', [nilaiHapalanHadistController::class, 'show'])->name('sd.nilaihadist.show');
Route::get('sd/nilaihadist/generatePDF/{santri_id}', [nilaiHapalanHadistController::class, 'generatePDF'])->name('sd.nilaihadist.generatePDF');


// Route untuk menampilkan daftar santri TK
Route::get('tk/daftar', [daftarSantritkController::class, 'index'])->name('tk.daftar.index');
Route::get('tk/daftar/create', [daftarSantritkController::class, 'create'])->name('tk.daftar.create');
Route::post('tk/daftar', [daftarSantritkController::class, 'store'])->name('tk.daftar.store');
Route::get('tk/daftar/{santri}/edit', [daftarSantritkController::class, 'edit'])->name('tk.daftar.edit');
Route::put('tk/daftar/{santri}', [daftarSantritkController::class, 'update'])->name('tk.daftar.update');
Route::delete('tk/daftar/{santri}', [daftarSantritkController::class, 'destroy'])->name('tk.daftar.destroy');
//absensi tk
Route::get('/absensis', [AbsensiTKcontroller::class, 'index'])->name('tk.absensis.index');
Route::post('/absensis', [AbsensiTKcontroller::class, 'store'])->name('tk.absensis.store');
Route::put('/absensis/{id}', [AbsensiTKcontroller::class, 'update'])->name('tk.absensis.update');
Route::delete('/absensis/reset', [AbsensiTKcontroller::class, 'reset'])->name('tk.absensis.reset');
Route::delete('/absensis/{id}', [AbsensiTKcontroller::class, 'destroy'])->name('tk.absensis.destroy');
Route::get('/absensis/report', [AbsensiTKcontroller::class, 'repport'])->name('tk.absensis.report');
Route::get('/absensis/export', [AbsensiTKcontroller::class, 'export'])->name('tk.absensis.export');
Route::get('/absensis/export/{santri_id}', [AbsensiTKcontroller::class, 'exportPerSantri'])->name('tk.absensis.exportPerSantri');

// Tabungan TK
Route::get('tk/tabungan', [TabunganTKcontroller::class, 'index'])->name('tk.tabungan.index');
Route::get('tk/tabungan/create', [TabunganTKcontroller::class, 'create'])->name('tk.tabungan.create');
Route::post('tk/tabungan', [TabunganTKcontroller::class, 'store'])->name('tk.tabungan.store');
Route::get('tk/tabungan/{id}', [TabunganTKcontroller::class, 'show'])->name('tk.tabungan.show');
Route::get('tk/tabungan/{id}/edit', [TabunganTKcontroller::class, 'edit'])->name('tk.tabungan.edit');
Route::put('tk/tabungan/{id}', [TabunganTKcontroller::class, 'update'])->name('tk.tabungan.update');
Route::delete('tk/tabungan/{id}', [TabunganTKcontroller::class, 'destroy'])->name('tk.tabungan.destroy');

//infak tk
Route::get('tk/infak', [infaktkController::class, 'index'])->name('tk.infak.index');
Route::get('tk/infak/create', [infaktkController::class, 'create'])->name('tk.infak.create');
Route::post('tk/infak', [infaktkController::class, 'store'])->name('tk.infak.store');
Route::get('tk/infak/{id}', [infaktkController::class, 'show'])->name('tk.infak.show');
Route::get('tk/infak/{id}/edit', [infaktkController::class, 'edit'])->name('tk.infak.edit');
Route::put('tk/infak/{id}', [infaktkController::class, 'update'])->name('tk.infak.update');
Route::delete('tk/infak/hapus', [infaktkController::class, 'reset'])->name('tk.infak.hapus');
Route::delete('tk/infak/{id}', [infaktkController::class, 'destroy'])->name('tk.infak.destroy');
Route::get('tk/infak/export/{santri_id}', [infaktkController::class, 'exportPerSantri'])->name('tk.infak.exportPerSantri');

// Nilai Membaca TK
route::get('tk/nilaimembaca', [NilaiMembacaControoller::class, 'index'])->name('tk.nilaimembaca.index');
route::get('tk/nilaimembaca/create', [NilaiMembacaControoller::class, 'create'])->name('tk.nilaimembaca.create');
route::post('tk/nilaimembaca', [NilaiMembacaControoller::class, 'store'])->name('tk.nilaimembaca.store');
route::get('tk/nilaimembaca/{id}', [NilaiMembacaControoller::class, 'show'])->name('tk.nilaimembaca.show');
route::get('tk/nilaimembaca/{id}/edit', [NilaiMembacaControoller::class, 'edit'])->name('tk.nilaimembaca.edit');
route::put('tk/nilaimembaca/{id}', [NilaiMembacaControoller::class, 'update'])->name('tk.nilaimembaca.update');
Route::delete('/tk/nilaimembaca/reset', [NilaiMembacaControoller::class, 'reset'])->name('tk.nilaimembaca.reset');
route::delete('tk/nilaimembaca/{id}', [NilaiMembacaControoller::class, 'destroy'])->name('tk.nilaimembaca.destroy');
route::get('tk/nilaimembaca/export/{santri_id}', [NilaiMembacaControoller::class, 'exportPdf'])->name('tk.nilaimembaca.exportPerSantri');

// Nilai Menulis TK
Route::get('tk/nilaimenulis', [NilaiMenuliscontroller::class, 'index'])->name('tk.nilaimenulis.index');
Route::get('tk/nilaimenulis/create', [NilaiMenuliscontroller::class, 'create'])->name('tk.nilaimenulis.create');
Route::post('tk/nilaimenulis', [NilaiMenuliscontroller::class, 'store'])->name('tk.nilaimenulis.store');
Route::get('tk/nilaimenulis/{id}', [NilaiMenuliscontroller::class, 'show'])->name('tk.nilaimenulis.show');
Route::get('tk/nilaimenulis/{id}/edit', [NilaiMenuliscontroller::class, 'edit'])->name('tk.nilaimenulis.edit');
Route::put('tk/nilaimenulis/{id}', [NilaiMenuliscontroller::class, 'update'])->name('tk.nilaimenulis.update');
Route::post('/tk/nilaimenulis/reset', [NilaiMenuliscontroller::class, 'reset'])->name('tk.nilaimenulis.reset');
Route::get('/generate-pdf/{santri_id}', [NilaiMenuliscontroller::class, 'generatePDF'])->name('tk.nilaimenulis.generatePDF');
Route::delete('tk/nilaimenulis/{id}', [NilaiMenuliscontroller::class, 'destroy'])->name('tk.nilaimenulis.destroy');

// hapalan doa tk
Route::get('tk/nilaidoa', [NilaihapalanDoaTKController::class, 'index'])->name('tk.nilaidoa.index');
Route::get('tk/nilaidoa/create', [NilaihapalanDoaTKController::class, 'create'])->name('tk.nilaidoa.create');
Route::post('tk/nilaidoa', [NilaihapalanDoaTKController::class, 'store'])->name('tk.nilaidoa.store');
Route::get('tk/nilaidoa/{nilaidoa}/edit', [NilaihapalanDoaTKController::class, 'edit'])->name('tk.nilaidoa.edit');
Route::put('tk/nilaidoa/{nilaidoa}', [NilaihapalanDoaTKController::class, 'update'])->name('tk.nilaidoa.update');
Route::delete('tk/nilaidoa/reset', [NilaihapalanDoaTKController::class, 'reset'])->name('tk.nilaidoa.reset');
Route::delete('tk/nilaidoa/{nilaidoa}', [NilaihapalanDoaTKController::class, 'destroy'])->name('tk.nilaidoa.destroy');
Route::get('tk/nilaidoa/{santri}', [NilaihapalanDoaTKController::class, 'show'])->name('tk.nilaidoa.show');
Route::get('tk/nilaidoa/generatePDF/{santri_id}', [NilaihapalanDoaTKController::class, 'generatePDF'])->name('tk.nilaidoa.generatePDF');

// hapalan surah tk
Route::prefix('tk/nilaihafalansurah')->name('tk.nilaihafalansurah.')->group(function () {
    Route::get('/', [NilaihapalansurahTKController::class, 'index'])->name('index');
    Route::get('/create', [NilaihapalansurahTKController::class, 'create'])->name('create');
    Route::post('/', [NilaihapalansurahTKController::class, 'store'])->name('store');
    Route::get('/{santri_id}', [NilaihapalansurahTKController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [NilaihapalansurahTKController::class, 'edit'])->name('edit'); 
    Route::put('/{id}', [NilaihapalansurahTKController::class, 'update'])->name('update');  
    Route::delete('/reset', [NilaihapalansurahTKController::class, 'reset'])->name('reset');
    Route::delete('/{id}', [NilaihapalansurahTKController::class, 'destroy'])->name('destroy');
    Route::get('/generatePDF/{santri_id}', [NilaihapalansurahTKController::class, 'exportPdf'])->name('export');
});

//praktek sholat
Route::get('tk/praktekshalat', [PraktekshalatController::class, 'index'])->name('tk.praktekshalat.index');
Route::get('tk/praktekshalat/create', [PraktekshalatController::class, 'create'])->name('tk.praktekshalat.create');
Route::post('tk/praktekshalat', [PraktekshalatController::class, 'store'])->name('tk.praktekshalat.store');
Route::get('tk/praktekshalat/{praktekshalat}/edit', [PraktekshalatController::class, 'edit'])->name('tk.praktekshalat.edit');
Route::put('tk/praktekshalat/{praktekshalat}', [PraktekshalatController::class, 'update'])->name('tk.praktekshalat.update');
Route::delete('tk/praktekshalat/reset', [PraktekshalatController::class, 'reset'])->name('tk.praktekshalat.reset');
Route::delete('tk/praktekshalat/{praktekshalat}', [PraktekshalatController::class, 'destroy'])->name('tk.praktekshalat.destroy');
Route::get('tk/praktekshalat/{santri}/show', [PraktekshalatController::class, 'show'])->name('tk.praktekshalat.show');
Route::get('tk/praktekshalat/{santri_id}/generatePDF', [PraktekshalatController::class, 'pdfpersantri'])->name('tk.praktekshalat.generatePDF');
