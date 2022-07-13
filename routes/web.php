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

Route::get('/', 'AuthController@showFormLogin')->name('login');
Route::get('login', 'AuthController@showFormLogin')->name('login');
Route::post('login', 'AuthController@login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('register', 'AuthController@showFormRegister')->name('register');
    Route::post('register', 'AuthController@register');

    Route::get("home", "HomeController@index")->name("home");
    Route::get("warehouse", "HomeController@warehouse")->name('warehouse');
    Route::get("logout", "AuthController@logout")->name("logout");
    
    Route::get("change_password","ChangePasswordController@showFormChangePassword")->name("showFormChangePassword");
    Route::post("change_password","ChangePasswordController@change_password");
 
    //--start jenis barang--
    Route::get("inventory/jenis_barang", "JenisBarangController@index")->name("jenis_barang.index");
    Route::get("inventory/jenis_barang/show_data", "JenisBarangController@show_data")->name("jenis_barang.show_data");
    Route::post("inventory/jenis_barang/save", "JenisBarangController@save")->name("jenis_barang.save");
    Route::get("inventory/jenis_barang/{id}/edit", "JenisBarangController@edit");
    Route::get("inventory/jenis_barang/update", "JenisBarangController@update")->name("jenis_barang.update");
    Route::get("inventory/jenis_barang/{id}/delete", "JenisBarangController@delete");
    //--end jenis barang--

    //--start kategori barang--
    Route::get("inventory/kategori_barang", "KategoriBarangController@index")->name("kategori_barang.index");
    Route::get("inventory/kategori_barang/show_data", "KategoriBarangController@show_data")->name("kategori_barang.show_data");
    Route::get("inventory/kategori_barang/save", "KategoriBarangController@save")->name("kategori_barang.save");
    Route::get("inventory/kategori_barang/{id}/edit", "KategoriBarangController@edit");
    Route::get("inventory/kategori_barang/update", "KategoriBarangController@update")->name("kategori_barang.update");
    Route::get("inventory/kategori_barang/{id}/delete", "KategoriBarangController@delete");
    //--end jenis barang--

    //--start daftar barang--
    Route::get("inventory/daftar_barang", "DaftarBarangController@index")->name("daftar_barang.index");
    Route::get("inventory/daftar_barang/{id}/edit", "DaftarBarangController@edit");
    Route::get("inventory/daftar_barang/show_data", "DaftarBarangController@show_data")->name("daftar_barang.show_data");
    Route::post("inventory/daftar_barang/save", "DaftarBarangController@save")->name("daftar_barang.save");
    Route::post("inventory/daftar_barang/update", "DaftarBarangController@update")->name("daftar_barang.update");
    Route::get("inventory/daftar_barang/{id}/delete", "DaftarBarangController@delete");
    Route::get("inventory/daftar_barang/{kode_jenis}/kategori_barang","DaftarBarangController@kategori_barang");
    //--end daftar barang--

    Route::get("crud/table_layout1", "TableLayout1Controller@index")->name("crud.table_layout1");
    Route::get("crud/table_layout1/{id}/edit", "TableLayout1Controller@edit");
    Route::get("crud/table_layout1/show_data", "TableLayout1Controller@show_data")->name("crud.table_layout1.show_data");
    Route::post("crud/table_layout1/save", "TableLayout1Controller@save")->name("crud.table_layout1.save");
    Route::post("crud/table_layout1/update", "TableLayout1Controller@update")->name("crud.table_layout1.update");
    Route::get("crud/table_layout1/{id}/delete", "TableLayout1Controller@delete");
    Route::get("crud/table_layout1/{kode_jenis}/kategori_barang","TableLayout1Controller@kategori_barang");

    Route::get("crud/table_layout2", "TableLayout2Controller@index")->name("crud.table_layout2");

    Route::get("crud/table_layout3","TableLayout3Controller@index")->name("crud.table_layout3");

    Route::get("crud/table_layout4","TableLayout4Controller@index")->name("crud.table_layout4");
   
});
