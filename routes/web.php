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

    //--Start barang masuk--
    Route::get("transaksi/barang_masuk", "BarangMasukController@index")->name("barang_masuk.index");
    Route::get("transaksi/barang_masuk/show_data", "BarangMasukController@show_data")->name("barang_masuk.show_data");
    Route::get("transaksi/barang_masuk/{kode_barang}/pilih", "BarangMasukController@pilih");
    Route::get("transaksi/barang_masuk/{ref_pembelian}/{kode_barang}/insert", "BarangMasukController@insert");
    Route::get("transaksi/barang_masuk/{id_transaksi}/delete", "BarangMasukController@delete");
    Route::get("transaksi/barang_masuk/{id_transaksi}/edit", "BarangMasukController@edit");
    Route::get("transaksi/barang_masuk/{ref_pembelian}/{kode_barang}/update", "BarangMasukController@update")->name("barang_masuk.update");
    Route::get("transaksi/barang_masuk/{ref_pembelian}/getQty", "BarangMasukController@getQty");
    Route::get("transaksi/barang_masuk/{ref_pembelian}/save", "BarangMasukController@save");
    //--End barang masuk--

    //--Start barang keluar--
    Route::get("transaksi/barang_keluar", "BarangKeluarController@index")->name("barang_keluar.index");
    Route::get("transaksi/barang_keluar/show_data", "BarangKeluarController@show_data")->name("barang_keluar.show_data");
    Route::get("transaksi/barang_keluar/{ref_pemakaian}/{kode_barang}/pilih", "BarangKeluarController@pilih");
    Route::get("transaksi/barang_keluar/{ref_pemakaian}/{kode_barang}/delete", "BarangKeluarController@delete");
    Route::get("transaksi/barang_keluar/{ref_pemakaian}/{kode_barang}/edit", "BarangKeluarController@edit");
    Route::post("transaksi/barang_keluar/update", "BarangKeluarController@update")->name("barang_keluar.update");
    Route::get("transaksi/barang_keluar/{ref_pemakaian}/save", "BarangKeluarController@save");
    Route::get("transaksi/barang_keluar/{ref_pemakaian}/getQty", "BarangKeluarController@getQty");
    Route::get("transaksi/barang_keluar/{ref_pemakaian}/print", "ReportBarangKeluarController@print");
    //--End barang keluar--

    //--Permintaan barang--
    Route::get("transaksi/permintaan_barang", "PermintaanBarangController@index")->name("permintaan_barang.index");
    Route::get("transaksi/permintaan_barang/daftar_permintaan", "PermintaanBarangController@daftar_permintaan")->name("permintaan_barang.daftar_permintaan");
    Route::get("transaksi/permintaan_barang/{ref_permintaan}/show_data", "PermintaanBarangController@show_data");
    Route::get("transaksi/permintaan_barang/{kode_barang}/pilih", "PermintaanBarangController@pilih");
    Route::get("transaksi/permintaan_barang/{ref_permintaan}/{kode_barang}/insert", "PermintaanBarangController@insert");
    Route::get("transaksi/permintaan_barang/{ref_permintaan}/{kode_barang}/delete", "PermintaanBarangController@delete");
    Route::get("transaksi/permintaan_barang/{id_transaksi}/edit", "PermintaanBarangController@edit");
    Route::get("transaksi/permintaan_barang/update", "PermintaanBarangController@update")->name("permintaan_barang.update");
    Route::get("transaksi/permintaan_barang/{ref_permintaan}/save", "PermintaanBarangController@save");
    Route::get("transaksi/permintaan_barang/{ref_permintaan}/getQty", "PermintaanBarangController@getQty");
    Route::get("transaksi/permintaan_barang/{ref_permintaan}/print", "PermintaanBarangController@print");
    Route::get("transaksi/permintaan_barang/{ref_permintaan}/detail_transaksi","PermintaanBarangController@detail_transaksi");
    Route::get("transaksi/permintaan_barang/{ref_permintaan}/tolak","PermintaanBarangController@tolak");
    Route::get("transaksi/permintaan_barang/{ref_permintaan}/proses","PermintaanBarangController@proses");
    Route::get("transaksi/permintaan_barang/{ref_permintaan}/batal","PermintaanBarangController@batal");
    Route::get("transaksi/permintaan_barang/{ref_permintaan}/{kode_barang}/verify","PermintaanBarangController@verify");
    Route::get("transaksi/permintaan_barang/{ref_permintaan}/terima","PermintaanBarangController@terima");
    //--End permintaan barang--

    //--start feedback
    Route::get("transaksi/permintaan_barang/feedback","PermintaanBarangController@feedback")->name("permintaan.feedback");
    //--end feedback 

    //--Start Pemesanan barang--
    Route::get("transaksi/pesan_barang","PesanBarangController@index")->name("pesan_barang.index");
    Route::get("transaksi/pesan_barang/daftar_pesanan","PesanBarangController@daftar_pesanan")->name("pesan_barang.daftar_pesanan");
    Route::get("transaksi/pesan_barang/{ref_pesansn}/detail_transaksi","PesanBarangController@detail_transaksi");
    Route::get("transaksi/pesan_barang/{kode_barang}/pilih","PesanBarangController@pilih");
    Route::get("transaksi/pesan_barang/{ref_pesansn}/{kode_barang}/insert","PesanBarangController@insert");
    Route::get("transaksi/pesan_barang/{ref_pesansn}/{kode_barang}/delete", "PesanBarangController@delete");
    Route::get("transaksi/pesan_barang/{ref_pesansn}/save", "PesanBarangController@save");
    Route::get("transaksi/pesan_barang/{id_transaksi}/edit", "PesanBarangController@edit");
    Route::get("transaksi/pesan_barang/update", "PesanBarangController@update")->name("pesan_barang.update");
    Route::get("transaksi/pesan_barang/{id_transaksi}/terima", "PesanBarangController@terima");
    Route::get("transaksi/pesan_barang/{ref_pesansn}/{kode_barang}/verify","PesanBarangController@verify");
    Route::get("transaksi/pesan_barang/{ref_pesansn}/{kode_barang}/update_verify","PesanBarangController@update_verify");
    Route::get("transaksi/pesan_barang/{ref_pesansn}/simpan_terima","PesanBarangController@simpan_terima");
    //--End pemesanan barang--

    //--Start report persediaan barang--
    Route::get("report/persediaan_barang", "ReportPersediaanBarang@index")->name("report_persediaan.index");
    Route::get("report/persediaan_barang/show_data", "ReportPersediaanBarang@show_data")->name("report_persediaan.show_data");
    Route::get("report/persediaan_barang/detail_barang", "ReportPersediaanBarang@detail_barang")->name("report_persediaan.detail_barang");
    Route::get("report/persediaan_barang/detail_keluar", "ReportPersediaanBarang@detail_keluar")->name("report_persediaan.detail_keluar");
    Route::get("report/persediaan_barang/detail_masuk", "ReportPersediaanBarang@detail_masuk")->name("report_persediaan.detail_masuk");
    Route::get("report/persediaan_barang/daftar_barang", "ReportPersediaanBarang@daftar_barang")->name("report_persediaan.daftar_barang");
    //--End report persediaan barang--

    //Start report pemesanan barang
    Route::get("report/pemesanan_barang","ReportPemesananBarang@index")->name("report_pemesanan.index");
    Route::get("report/pemesanan_barang/show_data","ReportPemesananBarang@show_data")->name("report_pemesanan.show_data");
    Route::get("report/pemesanan_barang/filter_data","ReportPemesananBarang@filter_data")->name("report_pemesanan.filter_data");
    Route::get("report/pemesanan_barang/{dari_tanggal}/{sampai_tanggal}/print_simple","ReportPemesananBarang@print_simple")->name("report_pemesanan.print_simple");
    Route::get("report/pemesanan_barang/{dari_tanggal}/{sampai_tanggal}/print_detail","ReportPemesananBarang@print_detail")->name("report_pemesanan.print_detail");
    //End report pemesanan barang

    //Start report permintaan barang
    Route::get("report/permintaan_barang","ReportPermintaanBarang@index")->name("report_permintaan.index");
    Route::get("report/permintaan_barang/show_data","ReportPermintaanBarang@show_data")->name("report_permintaan.show_data");
    Route::get("report/permintaan_barang/filter_data","ReportPermintaanBarang@filter_data")->name("report_permintaan.filter_data");
    Route::get("report/permintaan_barang/{dari_tanggal}/{sampai_tanggal}/print_simple","ReportPermintaanBarang@print_simple")->name("report_permintaan.print_simple");
    Route::get("report/permintaan_barang/{dari_tanggal}/{sampai_tanggal}/{user}/print_detail","ReportPermintaanBarang@print_detail")->name("report_permintaan.print_detail");
    //End report permintaan barang

    //Start report stock opname
    Route::get("report/stock_opname","ReportStockOpname@index")->name("report_stock_opname.index");
    Route::get("report/stock_opname/show_data","ReportStockOpname@show_data")->name("report_stock.show_data");
    Route::get("report/stock_opname/{no_ref}/print","ReportStockOpname@print")->name("report_stock.print");
    //End report stock opname

    //--Start master data pegawai--
    Route::get("referensi/daftar_pegawai", "DaftarPegawaiController@index")->name("daftar_pegawai.index");
    Route::get("referensi/daftar_pegawai/show_data", "DaftarPegawaiController@show_data")->name("daftar_pegawai.show_data");
    Route::post("referensi/daftar_pegawai/save","DaftarPegawaiController@save")->name("daftar_pegawai.save");
    Route::get("referensi/daftar_pegawai/{id}/edit", "DaftarPegawaiController@edit");
    Route::post("referensi/daftar_pegawai/update", "DaftarPegawaiController@update")->name("daftar_pegawai.update");
    Route::get("referensi/daftar_pegawai/{id}/delete", "DaftarPegawaiController@delete");
    //--End master data pegawai--

    //Start referensi barang
    Route::get("referensi/satuan_barang","ReferensiBarangController@index")->name("satuan_barang.index");
    Route::get("referensi/satuan_barang/show_data","ReferensiBarangController@show_data")->name("satuan_barang.show_data");
    Route::get("referensi/satuan_barang/{id}/edit","ReferensiBarangController@edit");
    Route::post("referensi/satuan/update","ReferensiBarangController@update")->name("satuan_barang.update");
    //End referensi barang

    //--Start master data supplier--
    Route::get("referensi/daftar_supplier", "DaftarSupplierController@index")->name("daftar_supplier.index");
    Route::get("referensi/daftar_supplier/show_data", "DaftarSupplierController@show_data")->name("daftar_supplier.show_data");
    Route::post("referensi/daftar_supplier/save", "DaftarSupplierController@save")->name("daftar_supplier.save");
    Route::get("referensi/daftar_supplier/{id_supplier}/edit", "DaftarSupplierController@edit");
    Route::post("referensi/daftar_supplier/update", "DaftarSupplierController@update")->name("daftar_supplier.update");
    Route::get("referensi/daftar_supplier/{id}/delete", "DaftarSupplierController@delete");
    //--End master data supplier--

    //--start daftar barang--
    Route::get("inventory/daftar_barang", "DaftarBarangController@index")->name("daftar_barang.index");
    Route::get("inventory/daftar_barang/{id}/edit", "DaftarBarangController@edit");
    Route::get("inventory/daftar_barang/show_data", "DaftarBarangController@show_data")->name("daftar_barang.show_data");
    Route::post("inventory/daftar_barang/save", "DaftarBarangController@save")->name("daftar_barang.save");
    Route::post("inventory/daftar_barang/update", "DaftarBarangController@update")->name("daftar_barang.update");
    Route::get("inventory/daftar_barang/{id}/delete", "DaftarBarangController@delete");
    Route::get("inventory/daftar_barang/{kode_jenis}/kategori_barang","DaftarBarangController@kategori_barang");
    //--end daftar barang--

    //--Start stock opname--
    Route::get("transaksi/stock_opname", "StockOpnameController@index")->name("stock_opname.index");
    Route::get("transaksi/stock_opname/show_data","StockOpnameController@show_data")->name("stock_opname.show_data");
    Route::get("transaksi/stock_opname/detail_transaksi","StockOpnameController@detail_transaksi")->name("stock_opname.detail_transaksi");
    Route::get("transaksi/stock_opname/find_barang","StockOpnameController@find_barang")->name("stock_opname.find_barang");
    Route::post("transaksi/stock_opname/save_barang","StockOpnameController@save_barang")->name("stock_opname.save_barang");
    Route::get("transaksi/stock_opname/delete_barang","StockOpnameController@delete_barang")->name("stock_opname.delete_barang");
    Route::get("transaksi/stock_opname/edit_barang","StockOpnameController@edit_barang")->name("stock_opname.edit_barang");
    Route::post("transaksi/stock_opname/update_barang","StockOpnameController@update_barang")->name("stock_opname.update_barang");
    Route::get("transaksi/stock_opname/save_transaksi","StockOpnameController@save_transaksi")->name("stock_opname.save_transaksi");
    //--End stock opname--

    

    //--Start petunjuk penggunaan--
    Route::get("help/petunjuk_penggunaan","PetunjukPenggunaanController@index")->name("help.index");
    //--End petunjuk penggunaan--

    //--Strat laporan dashboard--
    Route::get("/home/total_pemakaian","ReportDashboardController@total_pemakaian")->name("dashboard.total_pemakaian");
    
    //--End laporan dashboard--
});
