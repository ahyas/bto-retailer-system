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

    Route::get("crud/change_password","ControllerChangePassword@index")->name("crud.change_password.index");
    Route::post("crud/change_password/update","ControllerChangePassword@updatePassword")->name("crud.change_password.update");

    /* Category module */
    Route::get("master_data/category/index","ControllerCategory@index")->name("master_data.category.index");
    Route::get("master_data/category/fetch","ControllerCategory@fetch")->name("master_data.category.fetch");
    Route::post("master_data/category/save","ControllerCategory@save")->name("master_data.category.save");
    Route::get("master_data/category/delete","ControllerCategory@delete")->name("master_data.category.delete");
    Route::get("master_data/category/edit","ControllerCategory@edit")->name("master_data.category.edit");
    Route::post("master_data/category/update","ControllerCategory@update")->name("master_data.category.update");
    /* Category module */

    /* Produxt module */
    Route::get("master_data/product/index","ControllerProduct@index")->name("master_data.product.index");
    Route::get("master_data/product/fetch","ControllerProduct@fetch")->name("master_data.product.fetch");
    Route::post("master_data/product/save","ControllerProduct@save")->name("master_data.product.save");
    Route::get("master_data/product/delete","ControllerProduct@delete")->name("master_data.product.delete");
    Route::get("master_data/product/edit","ControllerProduct@edit")->name("master_data.product.edit");
    Route::post("master_data/product/update","ControllerProduct@update")->name("master_data.product.update");
    /* Product module */

    /* Customer module */
    Route::get("master_data/customer/index","ControllerCustomer@index")->name("master_data.customer.index");
    Route::get("master_data/customer/fetch","ControllerCustomer@fetch")->name("master_data.customer.fetch");
    Route::post("master_data/customer/save","ControllerCustomer@save")->name("master_data.customer.save");
    Route::get("master_data/customer/delete","ControllerCustomer@delete")->name("master_data.customer.delete");
    Route::get("master_data/customer/edit","ControllerCustomer@edit")->name("master_data.customer.edit");
    Route::post("master_data/customer/update","ControllerCustomer@update")->name("master_data.customer.update");
    /* Customer module */

    /* Supplier module */
    Route::get("master_data/supplier/index","ControllerSupplier@index")->name("master_data.supplier.index");
    Route::get("master_data/supplier/fetch","ControllerSupplier@fetch")->name("master_data.supplier.fetch");
    Route::post("master_data/supplier/save","ControllerSupplier@save")->name("master_data.supplier.save");
    Route::get("master_data/supplier/delete","ControllerSupplier@delete")->name("master_data.supplier.delete");
    Route::get("master_data/supplier/edit","ControllerSupplier@edit")->name("master_data.supplier.edit");
    Route::post("master_data/supplier/update","ControllerSupplier@update")->name("master_data.supplier.update");
    /* Supplier module */

    /* Purchase item module*/
    Route::get("transaction/purchase_item/index","ControllerPurchaseItem@index")->name("transaction.purchase_item.index");
    Route::get("transaction/purchase_item/fetch","ControllerPurchaseItem@fetch")->name("transaction.purchase_item.fetch");
    Route::get("transaction/purchase_item/good_purchase", "ControllerPurchaseItem@good_purchase")->name("transaction.purchase_item.good_purchase");
    /* Purchase item module*/
   
});
