@extends('layout/app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transaksi permintaan barang</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<style type="text/css">
    
    table tr td:last-child {
        white-space: nowrap;
        width: 1px;
    }
    table thead tr td {
        font-weight:600;
    }
    .fx{
        border:1px solid grey;  
        font-size:13px;
    }

    label{
        font-size:13px;
    }

    .badge{
        padding:5px;
        font-weight:bold;
    }

</style>
<body>
    <div class="container">
        <div class="col-md-12 mt-5">
            <div class="card" style="border:1px solid #9bbbe3; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                <div class="card-header" style="background-image: linear-gradient(#d0e2f8, #e2ecfb); height: 30px; line-height: 6px; font-size: 13px; border-top: 1px white solid">
                    <p style="line-height: 0; color:#0a4293; font-weight:normal; font-size:14px; font-weight:600;">Riwayat permintaan barang</p>
                </div>
                <div class="card-body" style="background-color:#f0f0f0; font-size:13px;">
                @if(Auth::user()->role==1)
                <button class="btn btn-primary btn-sm add_permintaan" style="margin-bottom:15px; display:none">Tambah</button>
                @elseif(Auth::user()->role==2)
                <button class="btn btn-primary btn-sm add_permintaan" style="margin-bottom:15px; display:inline-block">Tambah</button>
                @endif
                    <table class="display report" style="font-size:13px; border:1px solid #9c9a9a;">
                        <thead style="background-image: linear-gradient(#ecf6f8, #d7dfe1); line-height:3px;">
                            <tr>
                                <td width="95px">No. Ref.</td>
                                <td width="100px">Nama</td>
                                <td>Tgl. permintaan</td>
                                <td>Tgl. diterima</td>
                                <td>Penilaian</td>
                                <td width="120px">Status transaksi</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                            <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="formAddPermintaan" aria-hidden="true" style="overflow: hidden;" data-backdrop="false">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;">
                <div class="modal-header bg-info text-white" style="background-image: linear-gradient(#d0e2f8, #e2ecfb); height: 30px; line-height: 6px; font-size: 13px; border-top: 1px white solid">
                    <p style="line-height: 0; color:#0a4293; font-weight:normal; font-size:14px; font-weight:600;">Transaksi permintaan barang</p><button style="line-height: 0; background-color:red; border-radius:3px;" type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="color:white">&times;</span></button>
                </div>
                <div class="card-body" style="background-color:white; border-left:6px solid #e2ecfb; border-right:6px solid #e2ecfb; border-bottom:6px solid #e2ecfb;">
                <input type="hidden" class="tot_qty_diminta" id="tot_qty_diminta" style="margin-bottom:10px">
                <div class="row">
                    
                <div class="col">
                    <label><b>No. Referensi :</b></label>
                    <input type="text" value="{{$no_ref}}" class="form-control fx no-ref" id="no_ref" disabled="true" style="margin-bottom:10px">
                </div>

                <div class="col">
                    <?php $tgl = date("Y-m-d"); ?>
                    <label><b>Tanggal :</b></label>
                    <input type="text" value="{{$tgl}}" class="form-control fx tanggal" id="tanggal" readonly>
                </div>
                    <?php $id_user = Auth::user()->id; ?>
                    <input type="hidden" value="{{$id_user}}" class="form-control fx id_user" id="id_user">
                </div>
                
                <button href="javascript:void(0)" class="btn btn-success btn-sm add" style="margin-bottom:20px;">Add</button>
                
                    <table class="table table-sm display" style="font-size:13px; border:1px solid #9c9a9a;" width="100%">
                        <thead style="background-image: linear-gradient(#ecf6f8, #d7dfe1); line-height:3px;">
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Kode barang</td>
                                <td>Nama Barang</td>
                                <td style="text-align:right;">Qty. diminta</td>
                                <td style="text-align:right;">Qty. dikeluarkan</td>
                                <td width="100px">Action</td>
                            </tr>
                        </thead>
                            <tbody></tbody>
                            <tfoot style="background-image: linear-gradient(#ecf6f8, #d7dfe1); line-height:8px;">
                                <tr>
                                    <th colspan="4" style="text-align:center">TOTAL:</th>
                                    <th style="text-align:right"></th>
                                    <th style="text-align:right"></th>
                                    <th style="text-align:right"></th>
                                </tr>
                            </tfoot>
                    </table>
                    <button class="btn btn-primary btn-sm save" id="save" style="margin-top:20px;float:right" disabled>Save</button>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="formDetail" aria-hidden="true" style="overflow: hidden;" data-backdrop="false">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;">
            <div class="modal-header bg-info text-white" style="background-image: linear-gradient(#d0e2f8, #e2ecfb); height: 30px; line-height: 6px; font-size: 13px; border-top: 1px white solid">
            <p style="line-height: 0; color:#0a4293; font-weight:normal; font-size:14px; font-weight:600;">Detail permintaan</p><button style="line-height: 0; background-color:red; border-radius:3px;" type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="color:white">&times;</span></button>
            </div>
            <div class="modal-body" style="background-color:white; border-left:6px solid #e2ecfb; border-right:6px solid #e2ecfb; border-bottom:6px solid #e2ecfb; font-size:13px">
                <?php $role=Auth::user()->role; ?>
            <input type="hidden" id="role_user" value="{{$role}}" >
            <input type="hidden" id="ref_number" >
            <input type="hidden" id="id_user" >
            <input type="hidden" id="id_status" >
            <input type="hidden" class="tot_qty_dikeluarkan" id="tot_qty_dikeluarkan" style="margin-bottom:10px">
            <input type="hidden" id="state" value="0">
            <button class="btn btn-danger btn-sm batal" id="batal" style="float:right; margin-left:10px; display:none;">Batalkan</button>
            <button class="btn btn-success btn-sm terima" id="terima" style="float:right; margin-left:10px; display:none;">Terima barang</button>
            <button class="btn btn-primary btn-sm proses" id="proses" style="float:right; margin-left:10px; display:none;">Proses</button>
            <button class="btn btn-danger btn-sm tolak" id="tolak" style="float:right; display:none;">Tolak</button>

            <table border="0">
                <tr>
                    <td>No. Referensi</td>
                    <td>:</td>
                    <td><span id="detail_referensi" style="font-weight:bold;"></span></td>
                </tr>
                <tr>
                    <td>Atas nama</td>
                    <td>:</td>
                    <td><span id="detail_nama" style="font-weight:bold;"></span></td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td><span id="detail_tanggal" style="font-weight:bold;"></span></td>
                </tr>
                <tr>
                    <td>Status transaksi</td>
                    <td>:</td>
                    <td><span id="detail_status" style="font-weight:bold;"></span></td>
                </tr>
            </table>
            <br>
            @if($role==2)
                <?php $val="display:none"; ?>
            @else
                <?php $val="display:inline-block"; ?>
            @endif
                <div class="row" >
                    <div class="col" style="{{$val}}">
                    <label><b>Barcode :</b></label>
                        <input type="text" class="form-control fx barcode" id="barcode" placeholder="Scan barcode"/>
                        <small id="emailHelp" class="form-text text-muted" style="margin-bottom:15px">Scan barcode menggunakan barcode scanner.</small>
                    </div>
                </div>
                <table class="detail_report display table-sm" style="font-size:13px; border:1px solid #9c9a9a;">
                    <thead style="background-image: linear-gradient(#ecf6f8, #d7dfe1); line-height:3px;">
                        <tr>
                            <td>Kode </td>
                            <td>Nama barang</td>
                            <td style="text-align:right">Qty. Diminta</td>
                            <td style="text-align:right">Qty. Dikeluarkan</td>
                            <td style="text-align:right">Status</td>
                            <td style="text-align:right">Action</td>
                        </tr>
                    </thead>
                        <tbody></tbody>
                        <tfoot style="background-image: linear-gradient(#ecf6f8, #d7dfe1); line-height:8px;">
                            <tr>
                                <th colspan="2" style="text-align:center">TOTAL:</th>
                                <th style="text-align:right"></th>
                                <th style="text-align:right"></th>
                                <th style="text-align:right"></th>
                                <th style="text-align:right"></th>
                            </tr>
                        </tfoot>
                </table>
                <button class="btn btn-success btn-sm simpan_transaksi" id="simpan_transaksi" style="float:right; margin-top:15px" disabled="true">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="rating" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Feedback pelayanan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <div class="modal-body">
        <p>Berikan penilaian Anda untuk layanan ini.</p>
        <input type="hidden" id="noref">
        <input type="hidden" id="iduser">
        <input id="btn_tidak_puas" type="button" class="btn btn-danger" value="Tidak puas"> <input id="btn_kurang_puas"  type="button"  class="btn btn-warning" value="Kurang puas"> <input id="btn_puas" type="button" class="btn btn-success" value="Puas"> <input id="btn_sangat_puas" type="button" class="btn btn-primary" value="Sangat puas">
    </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="formSimpanBarang" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;">
            <div class="modal-header bg-info text-white" style="background-image: linear-gradient(#d0e2f8, #e2ecfb); height: 30px; line-height: 6px; font-size: 13px; border-top: 1px white solid">
                <p style="line-height: 0; color:#0a4293; font-weight:normal; font-size:14px; font-weight:600;">Edit item</p><button style="line-height: 0" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" style="background-color:white; border-left:6px solid #e2ecfb; border-right:6px solid #e2ecfb; border-bottom:6px solid #e2ecfb;">
                <form id="myForm" class="form-horizontal">

                    {{csrf_field()}} {{method_field('POST')}}
                    <input type="hidden" class="form-control form-control-sm id_transaksi" id="id_transaksi" name="id_transaksi" >
                    <input type="hidden" class="form-control form-control-sm ref_permintaan" id="ref_permintaan" name="ref_permintaan" >
                    <input type="hidden" class="form-control form-control-sm qty_gudang" id="qty_gudang" name="qty_gudang" >

                    <div class="form-group">
                        <label style="padding-top: 0" class="col-sm-6 control-label">Kode Barang</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control form-control-sm fx kode_barang" id="kode_barang" name="kode_barang" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label style="padding-top: 0" class="col-sm-6 control-label">Nama Barang : </label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control form-control-sm fx nama_barang" id="nama_barang" name="nama_barang" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label style="padding-top: 0" class="col-sm-6 control-label">Qty. Diminta : </label>
                        <div class="col-sm-5">
                            <input type="number" value="0" class="form-control form-control-sm fx qty_diminta" min="1" id="qty_diminta" name="qty_diminta" readonly="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label style="padding-top: 0" class="col-sm-6 control-label">Qty. Dikeluarkan : </label>
                        <div class="col-sm-5">
                            <input type="number" value="0" class="form-control form-control-sm fx qty_dikeluarkan" min="0" id="qty_dikeluarkan" name="qty_dikeluarkan" readonly="true">
                        </div>
                    </div>

                    <div class="modal-footer" style="display:inline-block;">
                        <button type="submit" class="btn btn-primary btn-sm" id="saveBtn">Save</button>
                        <button type="submit" class="btn btn-primary btn-sm" id="updateBtn">Update</button>
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="formDaftarBarang" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;">
            <div class="modal-header bg-info text-white"  style="background-image: linear-gradient(#d0e2f8, #e2ecfb); height: 30px; line-height: 6px; font-size: 13px; border-top: 1px white solid">
                <p style="line-height: 0; color:#0a4293; font-weight:normal; font-size:14px; font-weight:600;">Daftar barang</p><button style="line-height: 0; background-color:red; border-radius:3px;" type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="color:white">&times;</span></button>
            </div>
            <div class="modal-body" style="background-color:white; border-left:6px solid #e2ecfb; border-right:6px solid #e2ecfb; border-bottom:6px solid #e2ecfb; font-size:13px">
            <p>Masukan kata kunci pencarian barang yang diinginkan pada kotak pencarian agar lebih cepat</p>
                <table class="daftar_barang display table-sm" style="font-size:13px; border:1px solid #9c9a9a;" width="100%">
                    <thead style="background-image: linear-gradient(#ecf6f8, #d7dfe1); line-height:3px;">
                        <tr>
                            <td>Kode Barang</td>
                            <td>Nama Barang</td>
                            <td>Stock</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                        <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $("body").on("click","#btn_tidak_puas",function(){
            var result = 1;
            var no_ref = $("#noref").val();
            var id_user = $("#iduser").val();
            $.ajax({
                url:"{{route('permintaan.feedback')}}",
                type:"GET",
                data:{result:result, no_ref:no_ref, id_user:id_user},
                success:function(data){
                    console.log(data);
                    $("#rating").modal("hide");
                }
            });
        });

        $("body").on("click","#btn_kurang_puas",function(){
            var result = 2;
            var no_ref = $("#noref").val();
            var id_user = $("#iduser").val();
            $.ajax({
                url:"{{route('permintaan.feedback')}}",
                type:"GET",
                data:{result:result, no_ref:no_ref, id_user:id_user},
                success:function(data){
                    console.log(data);
                    $("#rating").modal("hide");
                }
            });
        });

        $("body").on("click","#btn_puas",function(){
            var result = 3;
            var no_ref = $("#noref").val();
            var id_user = $("#iduser").val();
            $.ajax({
                url:"{{route('permintaan.feedback')}}",
                type:"GET",
                data:{result:result, no_ref:no_ref, id_user:id_user},
                success:function(data){
                    console.log(data);
                    $("#rating").modal("hide");
                }
            });
        });

        $("body").on("click","#btn_sangat_puas",function(){
            var result = 4;
            var no_ref = $("#noref").val();
            var id_user = $("#iduser").val();
            $.ajax({
                url:"{{route('permintaan.feedback')}}",
                type:"GET",
                data:{result:result, no_ref:no_ref, id_user:id_user},
                success:function(data){
                    console.log(data);
                    $("#rating").modal("hide");
                }
            });
        });
    
        var role = $("#role_user").val();
        if(role==1){
            document.getElementById("terima").style.display = "none";
            document.getElementById("batal").style.display = "none";
            document.getElementById("proses").style.display = "inline-block";
            document.getElementById("tolak").style.display = "inline-block";
        }else{
            document.getElementById("batal").style.display = "inline-block";
            document.getElementById("terima").style.display = "inline-block";
            document.getElementById("proses").style.display = "none";
            document.getElementById("tolak").style.display = "none";
        }

        $(".report").DataTable({
            ajax:"{{route('permintaan_barang.daftar_permintaan')}}",
            ordering:false,
            processing:false,
            serverside:false,
            columns:[
                {data:"ref_permintaan"},
                {data:"nama_customer"},
                {data:"tanggal"},
                {data:"tgl_diterima"},
                {data:"penilaian",
                    mRender:function(data, type, full){
                        if(full['id_penilaian']=="1"){
                            return'<span class="badge badge-danger" style="padding-left:10px;padding-right:10px;">'+data+'</span>';
                        }else if(full['id_penilaian']=="2"){
                            return'<span class="badge badge-warning" style="padding-left:10px;padding-right:10px;">'+data+'</span>';
                        }else if(full['id_penilaian']=="3"){
                            return'<span class="badge badge-success" style="padding-left:10px;padding-right:10px;">'+data+'</span>';
                        }else if(full['id_penilaian']=="4"){
                            return'<span class="badge badge-primary" style="padding-left:10px;padding-right:10px;">'+data+'</span>';
                        }else{
                            return'-';
                        }
                    }
                },
                {data:"keterangan",
                    mRender:function(data, type, full){
                        //menunggu konfirmasi
                        if(full['id_status']=="1"){
                            return'<span class="badge badge-warning" style="padding-left:10px;padding-right:10px;">'+data+'</span>';
                            //status disproses    
                        }else if(full['id_status']=="2"){
                            return'<span class="badge badge-success" style="padding-left:10px;padding-right:10px;">'+data+'</span>';
                            //status diterima
                        }else if(full['id_status']=="3"){
                            return'<span class="badge badge-info" style="padding-left:10px;padding-right:10px;">'+data+'</span>';
                            //status ditolak
                        }else if(full['id_status']=="4"){
                            return'<span class="badge badge-danger" style="padding-left:10px;padding-right:10px;">'+data+'</span>';
                            //status dibatalkan
                        }else if(full['id_status']=="5"){
                            return'<span class="badge badge-secondary" style="padding-left:10px;padding-right:10px;">'+data+'</span>';
                            //status verified
                        }else if(full['id_status']=="6"){
                            return'<span class="badge badge-light" style="padding-left:10px;padding-right:10px;">'+data+'</span>';
                            //status not verified
                        }else if(full['id_status']=="7"){
                            return'<span class="badge badge-dark" style="padding-left:10px;padding-right:10px;">'+data+'</span>';
                        }
                        //status selesai
                        return'<span class="badge badge-primary" style="padding-left:10px;padding-right:10px;">'+data+'</span>';
                    }
                },
                {data:"ref_permintaan", 
                    mRender:function(data, type, full){
                        return"<button class='btn btn-primary btn-sm' id='detail' data-id_status='"+full['id_status']+"' data-status='"+full['keterangan']+"' data-nama_customer='"+full['nama_customer']+"' data-id_user='"+full['id_user']+"' data-tgl='"+full['tanggal']+"' data-ref_permintaan='"+data+"'>Detail</button>";
                    }
                }
            ]
        });

    var no_ref = $("#no_ref").val();

    keranjang(no_ref);
    function keranjang(no_ref){
        $(".table").DataTable().clear().destroy();
        $(".table").DataTable({
            ajax        : "permintaan_barang/"+no_ref+"/show_data",
            serverSide  : false,
            processing  : false,
            searching   : false,
            bPaginate   : false,
            bInfo       : false,
            ordering    : false,
            footerCallback: function ( row, data, start, end, display ) {
                var api = this.api(), data;
    
                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };
                qtyTotalDiminta = api
                    .column( 4, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                qtyTotalDikeluarkan = api
                    .column( 5, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                $("#tot_qty_diminta").val(qtyTotalDiminta);
                
                if(qtyTotalDiminta>0){
                    document.getElementById("save").disabled=false;
                }else{
                    document.getElementById("save").disabled=true;
                }
    
                // Update footer
                $( api.column( 4 ).footer() ).html(new Intl.NumberFormat().format(qtyTotalDiminta));
                $( api.column( 5 ).footer() ).html(new Intl.NumberFormat().format(qtyTotalDikeluarkan));
                        
            },
            columns     :
            [
                {data:"id", visible:false},
                {data:"id_user", visible:false},
                {data:"kode_barang"},
                {data:"nama_barang"},
                {data:"qty_diminta",className: 'dt-body-right'},
                {data:"qty_dikeluarkan",className: 'dt-body-right'},
                {data:"kode_barang",
                    mRender:function(data, type, full){
                        return'<button data-id_transaksi='+full['id']+' data-kode_barang='+data+' class="btn btn-warning btn-sm edit">Edit</button> <button data-kode_barang='+data+' class="btn btn-danger btn-sm delete">Delete</button>';
                    }
                }
            ]
        });
    }

    $(".daftar_barang").DataTable({
        ajax        :"{{route('daftar_barang.show_data')}}",
        serverSide  :false,
        order       :[[ 2, "desc" ]],
        processing  :false,
        ordering    :false,
        columns     :
        [
            {data:"kode_barang"},
            {data:"nama_barang"},
            {data:"stock"},
            {data:"kode_barang",
                mRender:function(data, type, full){
                    if(full['stock']<=0){
                        return'<button disabled data-kode_barang='+data+' class="btn btn-warning btn-sm pilih">Pilih</button>';
                    }else{
                        return'<button data-kode_barang='+data+' class="btn btn-warning btn-sm pilih">Pilih</button>';
                    }
                }
            },
        ]
    });

    $("body").on("click",".add_permintaan",function(){
        $("#formAddPermintaan").modal("show");
        console.log("tambah permintaan");
    });

    $("body").on("change","#barcode",function(){
        console.log($(this).val());
        var kode_barang = $(this).val();
        $("#barcode").val(""); 
        var no_ref = $("#ref_number").val();
        console.log(no_ref);
        $.ajax({
            url:"permintaan_barang/"+no_ref+"/"+kode_barang+"/verify",
            type:"GET",
            success:function(data){
                if(data.exist==true){
                    document.getElementById("saveBtn").style.display = "none";
                    document.getElementById("updateBtn").style.display = "inline-block";
                    $("#id_transaksi").val(data.table.id_transaksi);
                    $("#ref_permintaan").val(no_ref);
                    $("#kode_barang").val(data.table.kode_barang);
                    $("#nama_barang").val(data.table.nama_barang);
                    $("#qty_diminta").val(data.table.qty_diminta);
                    $("#qty_dikeluarkan").val(0);
                    document.getElementById("qty_diminta").readOnly=true;
                    document.getElementById("qty_dikeluarkan").readOnly=false;
                    $("#formSimpanBarang").modal("show");
                }else{
                    alert("Data tidak ditemukan, periksa kembali kode barang!");
                    $("#barcode").focus();
                }
                
            }
        })
    });

    $("body").on("click", ".add", function(){
        document.getElementById("saveBtn").style.display = "inline-block";
        document.getElementById("updateBtn").style.display = "none";
        $(".daftar_barang").DataTable().ajax.reload();
        $("#formDaftarBarang").modal("show");
    });

    $("body").on("click",".pilih",function(){
        
        var kode_barang = $(this).data("kode_barang");

        $.ajax({
            url     :"permintaan_barang/"+kode_barang+"/pilih",
            type    :"GET",
            dataType:"JSON",
            success :function(data){
                $("#formDaftarBarang").modal("hide");
                $("#qty_gudang").val(data.stock);
                $("#kode_barang").val(kode_barang);
                $("#nama_barang").val(data.nama_barang);
                $("#qty_diminta").val(1);
                $("#qty_dikeluarkan").val(0);
                $("#formSimpanBarang").modal("show");
                document.getElementById("qty_diminta").readOnly=false;
                document.getElementById("qty_dikeluarkan").readOnly=true;
                document.getElementById("save").disabled=false;
            }
        });
        
    });

    $("#formSimpanBarang").on("shown.bs.modal", function(){
        $("#qty_dikeluarkan").focus();
    });

    $("#formDetail").on("shown.bs.modal", function(){
        var id_status = $("#id_status").val();
        if(id_status==2){
            $("#barcode").focus();
        }
    });

    $("#saveBtn").on("click", function(e){
        e.preventDefault();
        var ref_permintaan = $("#no_ref").val();
        var kode_barang=$("#kode_barang").val();
        var qty_diminta = $("#qty_diminta").val();
        var id_user =$("#id_user").val();
        console.log(qty_diminta);
        let qty_gudang = $("#qty_gudang").val();
		
        if(qty_diminta<=qty_gudang ){
            if(qty_diminta==""){
                alert("Qty. Tidak boleh kosong.");
                return false;
            }
            $.ajax({
                url:"permintaan_barang/"+ref_permintaan+"/"+kode_barang+"/insert",
                type:"GET",
                data:{id_user:id_user,qty_diminta:qty_diminta},
                success:function(data){
                    $("#formSimpanBarang").modal("hide");
                    $(".table").DataTable().ajax.reload();
                    document.getElementById("save").disabled=false;
                }
            });
        }else{
            alert("Qty. Tidak bisa melebihi jumlah stock gudang.");
        }
    });

    $("body").on("click", ".edit", function(){
        var id_transaksi = $(this).data("id_transaksi");
        $("#id_transaksi").val(id_transaksi);
        document.getElementById("saveBtn").style.display = "none";
        document.getElementById("updateBtn").style.display = "inline-block";
        $.ajax({
            url     :"permintaan_barang/"+id_transaksi+"/edit",
            type    :"GET",
            dataType:"JSON",
            success:function(data){
                $("#id_transaksi").val(id_transaksi);
                $("#kode_barang").val(data.kode_barang);
                $("#nama_barang").val(data.nama_barang);
                $("#harga_satuan").val(data.harga_satuan);
                $("#qty_diminta").val(data.qty_diminta);
                let qty_gudang = data.stock;
                $("#qty_gudang").val(qty_gudang);
                document.getElementById("qty_diminta").readOnly=false;
                document.getElementById("qty_dikeluarkan").readOnly=true;
                $("#formSimpanBarang").trigger("reset");
                $("#formSimpanBarang").modal("show");
            }
        });
        
    });

    $("#updateBtn").click(function(e){
        $("#state").val(1);
        console.log("update");
        e.preventDefault();  
        var qty_diminta =$("#qty_diminta").val();
        var qty_dikeluarkan =$("#qty_dikeluarkan").val();
        var id_transaksi =$("#id_transaksi").val();    
        var role_user = $("#role_user").val();
        var ref_permintaan = $("#ref_permintaan").val();
        let qty_gudang = $("#qty_gudang").val();
        console.log("role "+role_user);
        if(role_user==1){
            
            $.ajax({
                    url     :"{{route('permintaan_barang.update')}}",
                    type    :"GET",
                    dataType:"JSON",
                    data    :{qty_diminta:qty_diminta, qty_dikeluarkan:qty_dikeluarkan,id_transaksi:id_transaksi, role_user:role_user, ref_permintaan:ref_permintaan},
                    success :function(data){
                        
                        $("#formSimpanBarang").modal("hide");
                        if(data.count==0){
                            document.getElementById("simpan_transaksi").disabled = false;
                        }else{
                            document.getElementById("simpan_transaksi").disabled = true;
                        }
                        if(role_user==1){
                            $(".detail_report").DataTable().ajax.reload();
                        }else{
                            $(".table").DataTable().ajax.reload();
                        }
                    }
            });
        }else{
            if(qty_diminta<=qty_gudang ){
            if(qty_diminta==""){
                alert("Qty. Tidak boleh kosong");
                return false;
            }
                $.ajax({
                    url     :"{{route('permintaan_barang.update')}}",
                    type    :"GET",
                    dataType:"JSON",
                    data    :{qty_diminta:qty_diminta, qty_dikeluarkan:qty_dikeluarkan,id_transaksi:id_transaksi, role_user:role_user, ref_permintaan:ref_permintaan},
                    success :function(data){
                        
                        $("#formSimpanBarang").modal("hide");
                        if(data.count==0){
                            document.getElementById("simpan_transaksi").disabled = false;
                        }else{
                            document.getElementById("simpan_transaksi").disabled = true;
                        }
                        if(role_user==1){
                            $(".detail_report").DataTable().ajax.reload();
                        }else{
                            $(".table").DataTable().ajax.reload();
                        }
                    }
                });
            }else{
                alert("Qty. Tidak bisa melebihi jumlah stock gudang.");
            }
        }
    });

    $("body").on("click",".save", function(){
        var ref_permintaan = $("#no_ref").val();
        var id_user =$("#id_user").val();
        if(confirm("Pastikan semua data sudah benar")){
            $.ajax({
                url     :"permintaan_barang/"+ref_permintaan+"/save",
                type    :"GET",
                data    :{id_user:id_user},
                dataType:"JSON",
                success : function(data){
                    $("#no_ref").val(data.no_ref);
                    keranjang(data.no_ref);
                    document.getElementById("save").disabled=true;
                    $("#formAddPermintaan").modal("hide");
                    $(".report").DataTable().ajax.reload();
                }
            });
        }
    });

    $("body").on("click",".delete", function(){
        
        var ref_permintaan = $("#no_ref").val();
        var kode_barang = $(this).data("kode_barang");
        if(confirm("Yakin ingin menghapus data ini?")){
                $.ajax({
                url     :"permintaan_barang/"+ref_permintaan+"/"+kode_barang+"/delete",
                type    :"GET",
                dataType:"JSON",
                success :function(data){
                    $(".table").DataTable().ajax.reload();
                }
            });
        }
    });

    function detail_transaksi(no_ref){
        $(".detail_report").DataTable().clear().destroy();
        $(".detail_report").DataTable({
            ajax:"permintaan_barang/"+no_ref+"/detail_transaksi",
            processing:false,
            serverside:false,
            ordering:false,
            bInfo:false,
            bPaginate:false,
            searching:false,
            footerCallback: function ( row, data, start, end, display ) {
                var api = this.api(), data;
    
                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };
                tot_qty_diminta = api
                    .column( 2, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                tot_qty_dikeluarkan = api
                    .column( 3, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
                $("#tot_qty_dikeluarkan").val(tot_qty_dikeluarkan);
                // Update footer
                $( api.column( 2 ).footer() ).html(new Intl.NumberFormat().format(tot_qty_diminta));
                $( api.column( 3 ).footer() ).html(new Intl.NumberFormat().format(tot_qty_dikeluarkan));
                    
            },
            columns:[
                {data:"kode_barang"},
                {data:"nama_barang"},
                {data:"qty_diminta",className: 'dt-body-right'},
                {data:"qty_dikeluarkan",className: 'dt-body-right'},
                {data:"keterangan",className: 'dt-body-right', 
                    mRender:function(data, type, full){
                        //status verified
                        if(full['id_status']==7){
                            return'<span class="badge badge-light">'+data+'</span>';
                        }
                        //status not verified
                        return'<span class="badge badge-dark">'+data+'</span>';
                    }
                },
                {data:"id", className:'dt-body-right',
                    mRender:function(data, type, full){       
                        var state = $("#state").val();
                        //status not verified
                        if(state==0 && full['id_status']==7){
                            return'<button class="btn btn-primary btn-sm" data-id='+data+' id="btnEdit" disabled>Edit</button>';
                        }else if(state==1 && full['id_status']==6){
                            return'<button class="btn btn-primary btn-sm" data-id='+data+' id="btnEdit">Edit</button>';
                        }             
                        return'<button class="btn btn-primary btn-sm" data-id='+data+' id="btnEdit" disabled>Edit</button>';  
                    }
                }
            ]
        });
    }

    $("body").on("click","#detail",function(){
        var no_ref = $(this).data("ref_permintaan");
        var tgl = $(this).data("tgl");
        var status= $(this).data("status");
        var id_status = $(this).data("id_status");
        var nama = $(this).data("nama_customer");
        $("#id_status").val(id_status);
        $("#state").val(0);
        $("#no_ref").val(no_ref);
        $("#id_user").val($(this).data("id_user"));
        console.log(id_status);
        //ditolak
        if(id_status==4){
            document.getElementById("barcode").readOnly = true;
            document.getElementById("batal").disabled = true;
            document.getElementById("tolak").disabled = true;
            document.getElementById("proses").disabled = true;
            document.getElementById("terima").disabled = true;
            document.getElementById("simpan_transaksi").disabled = true;
        }
        //dibatalkan
        else if(id_status==5){
            document.getElementById("barcode").readOnly = true;
            document.getElementById("batal").disabled = true;
            document.getElementById("tolak").disabled = true;
            document.getElementById("proses").disabled = true;
            document.getElementById("terima").disabled = true;
            document.getElementById("simpan_transaksi").disabled = true;
        }
        //dibatalkan
        else if(id_status==8){
            document.getElementById("barcode").readOnly = true;
            document.getElementById("batal").disabled = true;
            document.getElementById("tolak").disabled = true;
            document.getElementById("proses").disabled = true;
            document.getElementById("terima").disabled = true;
            document.getElementById("simpan_transaksi").disabled = true;
        }
        //diproses
        else if(id_status==2 || id_status==8){
            document.getElementById("barcode").readOnly = true;
            document.getElementById("tolak").disabled = true;
            document.getElementById("proses").disabled = true;
            document.getElementById("terima").disabled = false;
            document.getElementById("batal").disabled = true;
            document.getElementById("simpan_transaksi").disabled = true;
        //menunggu konfirmasi
        }else if(id_status==1){
            document.getElementById("barcode").readOnly = true;
            document.getElementById("tolak").disabled = false;
            document.getElementById("proses").disabled = false;
            document.getElementById("batal").disabled = false;
            document.getElementById("terima").disabled = true;
            document.getElementById("simpan_transaksi").disabled = true;
        }
        $("#ref_number").val(no_ref);
        document.getElementById("detail_referensi").innerHTML=no_ref;
        document.getElementById("detail_tanggal").innerHTML=tgl;
        document.getElementById("detail_status").innerHTML=status;
        document.getElementById("detail_nama").innerHTML=nama;
        detail_transaksi(no_ref);
        $("#formDetail").modal("show");
    });

    $("body").on("click","#btnEdit",function(){
        var id_transaksi = $(this).data("id");
        var no_ref = $("#ref_number").val();
        console.log(id_transaksi);
        $.ajax({
            url:"permintaan_barang/"+id_transaksi+"/edit",
            type:"GET",
            dataTyepe:"JSON",
            success:function(data){
                document.getElementById("saveBtn").style.display = "none";
                document.getElementById("updateBtn").style.display = "inline-block";
                $("#id_transaksi").val(id_transaksi);
                $("#ref_permintaan").val(no_ref);
                $("#kode_barang").val(data.kode_barang);
                $("#nama_barang").val(data.nama_barang);
                $("#qty_diminta").val(data.qty_diminta);
                $("#qty_dikeluarkan").val(data.qty_dikeluarkan);
                document.getElementById("qty_dikeluarkan").readOnly = false;
                $("#formSimpanBarang").modal("show");
            }
        });
    });

    $("body").on("click","#tolak",function(){
        var no_ref = $("#ref_number").val();
        console.log(no_ref);
        if(confirm("Anda yakin ingin menolaknya?")){
            document.getElementById("tolak").disabled = true;
            document.getElementById("proses").disabled = true;
            $.ajax({
                url:"permintaan_barang/"+no_ref+"/tolak",
                type:"GET",
                success:function(data){
                    $(".report").DataTable().ajax.reload();
                    $("#formDetail").modal("hide");
                }
            })
        }
    });

    $("body").on("click","#terima",function(){
        var no_ref = $("#ref_number").val();
        var id_user = $("#id_user").val();
        
        if(confirm("Mohon periksa kembali pesanan Anda!")){
            document.getElementById("terima").disabled = true;
            document.getElementById("batal").disabled = true;
            $.ajax({
                url:"permintaan_barang/"+no_ref+"/terima",
                type:"GET",
                success:function(data){
                    $(".report").DataTable().ajax.reload();
                    $("#formDetail").modal("hide");
                    $("#noref").val(no_ref);
                    $("#iduser").val(id_user);
                    console.log(no_ref);
                    console.log(id_user);
                    $("#rating").modal("show");
                }
            });
        }
    });

    $("body").on("click","#proses",function(){
            document.getElementById("barcode").readOnly = false;
            document.getElementById("tolak").disabled = true;
            document.getElementById("proses").disabled = true;
            document.getElementById("batal").disabled = true;
            document.getElementById("simpan_transaksi").disabled = true;
            $("#barcode").focus();
    });

    $("body").on("click","#simpan_transaksi",function(){
        if(confirm("Periksa lagi. Data yang sudah disimpan tidak dapat diubah kembali.")){
            var no_ref = $("#ref_number").val();
            console.log(no_ref);
            var total_qty_dikeluarkan = $("#tot_qty_dikeluarkan").val();
            $.ajax({
                url:"permintaan_barang/"+no_ref+"/proses",
                type:"GET",
                data:{total_qty_dikeluarkan:total_qty_dikeluarkan},
                success:function(data){
                    document.getElementById("simpan_transaksi").disabled = true;
                    $("#formDetail").modal("hide");
                    $(".report").DataTable().ajax.reload(null, false);
                    console.log("tersimpan");   
                }
            });
        }
    });

    $("body").on("click","#batal",function(){
        var no_ref = $("#ref_number").val();
        console.log(no_ref);
        if(confirm("Anda yakin ingin membatalkan transaksi ini?")){
            document.getElementById("batal").disabled = true;
            $.ajax({
                url:"permintaan_barang/"+no_ref+"/batal",
                type:"GET",
                success:function(data){
                    $(".report").DataTable().ajax.reload();
                    $("#formDetail").modal("hide");
                }
            })
        }
    });


    });
</script>
@endpush