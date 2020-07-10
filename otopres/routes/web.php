<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/logout', 'BerandaController@logout')->name('logout')->middleware('auth');

Route::get('/home', 'BerandaController@index')->name('home')->middleware('auth');

Route::get('/beranda', 'BerandaController@index')->name('beranda')->middleware('auth');

//=========================================== JABATAN ROUTE ==================================
Route::get('/jabatan', 'JabatanController@index')->name('jabatan')->middleware('auth');

Route::get('/jabatan/create', 'JabatanController@create')->name('jabatan.create')->middleware('auth');

Route::post('/jabatan/store', 'JabatanController@store')->name('jabatan.store')->middleware('auth');

Route::get('/jabatan/destroy', 'JabatanController@destroy')->name('jabatan.destroy')->middleware('auth');

Route::get('/jabatan/edit', 'JabatanController@edit')->name('jabatan.edit')->middleware('auth');

Route::patch('/jabatan/update', 'JabatanController@update')->name('jabatan.update')->middleware('auth');

//=========================================== Pangkat ROUTE ==================================
Route::get('/pangkat', 'PangkatController@index')->name('pangkat')->middleware('auth');

Route::get('/pangkat/create', 'PangkatController@create')->name('pangkat.create')->middleware('auth');

Route::post('/pangkat/store', 'PangkatController@store')->name('pangkat.store')->middleware('auth');

Route::get('/pangkat/destroy', 'PangkatController@destroy')->name('pangkat.destroy')->middleware('auth');

Route::get('/pangkat/edit', 'PangkatController@edit')->name('pangkat.edit')->middleware('auth');

Route::patch('/pangkat/update', 'PangkatController@update')->name('pangkat.update')->middleware('auth');

//=========================================== Admin ROUTE ==================================
Route::get('/admin', 'AdminController@index')->name('admin')->middleware('auth');

Route::get('/admin/create', 'AdminController@create')->name('admin.create')->middleware('auth');

Route::post('/admin/store', 'AdminController@store')->name('admin.store')->middleware('auth');

Route::get('/admin/destroy', 'AdminController@destroy')->name('admin.destroy')->middleware('auth');

Route::get('/admin/edit', 'AdminController@edit')->name('admin.edit')->middleware('auth');

Route::patch('/admin/update', 'AdminController@update')->name('admin.update')->middleware('auth');

//=========================================== Pegawai ROUTE ==================================
Route::get('/pegawai', 'PegawaiController@index')->name('pegawai')->middleware('auth');

Route::get('/pegawai/create', 'PegawaiController@create')->name('pegawai.create')->middleware('auth');

Route::post('/pegawai/store', 'PegawaiController@store')->name('pegawai.store')->middleware('auth');

Route::get('/pegawai/destroy', 'PegawaiController@destroy')->name('pegawai.destroy')->middleware('auth');

Route::get('/pegawai/edit', 'PegawaiController@edit')->name('pegawai.edit')->middleware('auth');

Route::patch('/pegawai/update', 'PegawaiController@update')->name('pegawai.update')->middleware('auth');

//=========================================== Komdanas ROUTE ==================================
Route::get('/komdanas', 'KomdanasController@index')->name('komdanas')->middleware('auth');

Route::get('/komdanas/create', 'KomdanasController@create')->name('komdanas.create')->middleware('auth');

Route::post('/komdanas/store', 'KomdanasController@store')->name('komdanas.store')->middleware('auth');

Route::get('/komdanas/destroy', 'KomdanasController@destroy')->name('komdanas.destroy')->middleware('auth');

Route::get('/komdanas/edit', 'KomdanasController@edit')->name('komdanas.edit')->middleware('auth');

Route::patch('/komdanas/update', 'KomdanasController@update')->name('komdanas.update')->middleware('auth');


//=========================================== Fingerprint ROUTE ==================================
Route::get('/fingerprint', 'FingerprintController@index')->name('fingerprint')->middleware('auth');
Route::post('/fingerprint', 'FingerprintController@index')->name('fingerprint')->middleware('auth');
Route::get('/fingerprint/destroy', 'FingerprintController@destroy')->name('fingerprint.destroy')->middleware('auth');

//=========================================== Presensi ROUTE ==================================
Route::get('/presensi', 'PresensiController@index')->name('presensi')->middleware('auth');
Route::post('/presensi', 'PresensiController@index')->name('presensi')->middleware('auth');
Route::get('/presensi/destroy', 'PresensiController@destroy')->name('presensi.destroy')->middleware('auth');

//=========================================== Kehadiran ROUTE ==================================
Route::get('/kehadiran', 'KehadiranController@index')->name('kehadiran')->middleware('auth');

Route::post('/kehadiran', 'KehadiranController@index')->name('kehadiran')->middleware('auth');

Route::get('/kehadiran/create', 'KehadiranController@create')->name('kehadiran.create')->middleware('auth');

Route::post('/kehadiran/store', 'KehadiranController@store')->name('kehadiran.store')->middleware('auth');

Route::get('/kehadiran/destroy', 'KehadiranController@destroy')->name('kehadiran.destroy')->middleware('auth');

Route::patch('/kehadiran/update', 'KehadiranController@update')->name('kehadiran.update')->middleware('auth');

//=========================================== Laporan ROUTE ==================================
Route::get('/laporan/semua', 'LaporanController@semua')->name('laporan.semua')->middleware('auth');

Route::post('/laporan/semua', 'LaporanController@semua')->name('laporan.semua')->middleware('auth');

Route::get('/laporan/cetak_semua', 'LaporanController@cetak_semua')->name('laporan.cetak_semua')->middleware('auth');


Route::get('/laporan/perseorangan', 'LaporanController@perseorangan')->name('laporan.perseorangan')->middleware('auth');

Route::post('/laporan/perseorangan', 'LaporanController@perseorangan')->name('laporan.perseorangan')->middleware('auth');

Route::get('/laporan/cetak_perseorangan', 'LaporanController@cetak_perseorangan')->name('laporan.cetak_perseorangan')->middleware('auth');


Route::get('/laporan/perjabatan', 'LaporanController@perjabatan')->name('laporan.perjabatan')->middleware('auth');

Route::post('/laporan/perjabatan', 'LaporanController@perjabatan')->name('laporan.perjabatan')->middleware('auth');

Route::get('/laporan/cetak_perjabatan', 'LaporanController@cetak_perjabatan')->name('laporan.cetak_perjabatan')->middleware('auth');

Route::get('/laporan/download', 'LaporanController@download')->name('laporan.download')->middleware('auth');
