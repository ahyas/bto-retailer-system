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

    Route::get("home", "HomeController@index")->name("home");
    Route::get("logout", "AuthController@logout")->name("logout");

    Route::get("crud/table_layout1", "TableLayout1Controller@index")->name("crud.table_layout1");
    Route::get("crud/table_layout1/{id}/edit", "TableLayout1Controller@edit");
    Route::get("crud/table_layout1/show_data", "TableLayout1Controller@show_data")->name("crud.table_layout1.show_data");
    Route::post("crud/table_layout1/save", "TableLayout1Controller@save")->name("crud.table_layout1.save");
    Route::post("crud/table_layout1/update", "TableLayout1Controller@update")->name("crud.table_layout1.update");
    Route::get("crud/table_layout1/{id}/delete", "TableLayout1Controller@delete");
    Route::get("crud/table_layout1/{kode_jenis}/kategori_barang","TableLayout1Controller@kategori_barang");
    Route::get("crud/table_layout1/save_pdf","TableLayout1Controller@savePDF")->name("crud.table_layout1.savepdf");
    Route::get("crud/table_layout1/save_excel","TableLayout1Controller@saveExcel")->name("crud.table_layout1.saveexcel");

    Route::get("crud/table_layout2", "TableLayout2Controller@index")->name("crud.table_layout2");

    Route::get("crud/table_layout3","TableLayout3Controller@index")->name("crud.table_layout3");

    Route::get("crud/table_layout4","TableLayout4Controller@index")->name("crud.table_layout4");

    Route::get("crud/table_layout5","TableLayout5Controller@index")->name("crud.table_layout5");
   
});
