@extends('layout/app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transaksi pemesanan barang</title>
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
    table.dataTable thead td {
    border-bottom: 1px solid #c5c3c3;
    }
 
    table.dataTable tfoot td {
        border-top: 1px solid #9c9a9a;
    }
    .fx{
        border:1px solid #9c9a9a;  
        font-size:13px;
    }

    label{
        font-size:13px;
    }

    .edit, .delete,{
        font-size:12px;
        padding:2px;
        margin:0;
    }

</style>

<body style="background-color:#ececec">
    <div class="container">
        <div class="col-md-12 mt-5">
            <div class="card" style="border:1px solid #9bbbe3; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                
                <div class="card-header" style="background-image: linear-gradient(#d0e2f8, #e2ecfb); height: 30px; line-height: 6px; font-size: 13px; border-top: 1px white solid">
                    <p style="line-height: 0; color:#0a4293; font-weight:normal; font-size:14px; font-weight:600;">Riwayat pemesanan barang</p>
                </div>
                <div class="card-body" style="background-color:#f0f0f0; font-size:13px;">
                <input type="hidden" id="fix_noref" class="fix_noref" value="{{$no_ref}}"> 
                <button class="btn btn-primary btn-sm add_pesanan" style="margin-bottom:15px;">Tambah</button>
                    <table class="display table-sm daftar_transaksi" style="font-size:13px; border:1px solid #9c9a9a;" width="100%">
                        <thead style="background-image: linear-gradient(#ecf6f8, #d7dfe1); line-height:3px;">
                            <tr>
                                <td>No. Referensi</td>
                                <td>Tgl. Pemesanan</td>
                                <td>Tgl. diterima</td>
                                <td>Total item dipesan</td>
                                <td>Total item diterima</td>
                                <td>Status</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                            <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="formAddPesanan" aria-hidden="true" style="overflow: hidden;" data-backdrop="false">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;">
                <div class="modal-header bg-info text-white" style="background-image: linear-gradient(#d0e2f8, #e2ecfb); height: 30px; line-height: 6px; font-size: 13px; border-top: 1px white solid">
                    <p id="addHeading" style="line-height: 0; color:#0a4293; font-weight:normal; font-size:14px; font-weight:600;">Transaksi pemesanan barang</p><button style="line-height: 0; background-color:red; border-radius:3px;" type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="color:white">&times;</span></button>
                </div>
                <div class="card-body" style="background-color:white; border-left:6px solid #e2ecfb; border-right:6px solid #e2ecfb; border-bottom:6px solid #e2ecfb; font-size:13px">
                <input type="hidden" class="form-control tot_qty_dipesan" id="tot_qty_dipesan" name="tot_qty_dipesan" style="margin-bottom:10px">
                <input type="hidden" class="form-control tot_qty_diterima" id="tot_qty_diterima" name="tot_qty_diterima" style="margin-bottom:10px">
                <input type="hidden" id="state" name="state" style="margin-bottom:10px" value="0">
                <input type="hidden" id="proses" name="state" style="margin-bottom:10px">
                <div class="row">
                    <div class="col">
                        <label><b>No. Referensi :</b></label>
                        <input type="text" class="form-control fx no-ref" value="{{$no_ref}}" id="no_ref" disabled="true" style="margin-bottom:10px">
                    </div>

                    <div class="col">
                        <label><b>Nomor bukti pembelian/kwitansi :</b></label>
                        <input type="text" class="form-control fx" id="no_bukti" readonly="true"/>
                    </div>

                    <div class="col">
                        <?php $tgl = date("Y-m-d"); ?>
                        <label><b>Tanggal diterima:</b></label>
                        <input type="text" value="{{$tgl}}" class="form-control fx tanggal" id="tanggal">
                    </div>
                    <?php $id_user = Auth::user()->id; ?>
                    <input type="hidden" value="{{$id_user}}" class="form-control id_user" id="id_user">
                </div>

                <div class="row">

                    <div class="col">
                    
                        <label><b>Barcode :</b></label>
                        <input type="text" class="form-control fx barcode" id="barcode" placeholder="Scan barcode" readonly="true"/>
                        <small class="form-text text-muted">Scan barcode menggunakan barcode scanner.</small>
                    
                    </div>
                </div>
                
                <button class="btn btn-success btn-sm add" id="add" style="margin-bottom:20px; margin-top:15px;">Add</button>

                <button class="btn btn-primary btn-sm terima_barang" id="terima_barang" style="margin-bottom:20px; margin-top:15px; float:right">Terima barang</button>
                    <table class="detail_transaksi display" style="font-size:13px; border:1px solid #9c9a9a;" width="100%">
                        <thead style="background-image: linear-gradient(#ecf6f8, #d7dfe1); line-height:3px;">
                            <tr>
                                <td>Kode</td>
                                <td width="100px">Nama Barang</td>
                                <td width="100px" style="text-align:right">Qty. Dipesan</td>
                                <td width="100px" style="text-align:right">Qty. Diterima</td>
                                <td>Status</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr style="background-image: linear-gradient(#ecf6f8, #d7dfe1); line-height:3px; font-weight:bold">
                                    <td colspan="2" style="text-align:center">TOTAL:</th>
                                    <td style="text-align:right"></td>
                                    <td style="text-align:right"></td>
                                    <td style="text-align:right"></td>
                                    <td style="text-align:right"></td>
                                </tr>
                            </tfoot>
                    </table>
                    <br>
                <button class="btn btn-primary btn-sm save" id="save" style="float:right; margin-left:10px; display:none;">Save</button>
                <button class="btn btn-success btn-sm simpan_terima" id="simpan_terima" style="float:right; margin-left:10px; display:none;">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="formSimpanBarang" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;">
            <div class="modal-header bg-info text-white" style="background-image: linear-gradient(#d0e2f8, #e2ecfb); height: 30px; line-height: 6px; font-size: 13px; border-top: 1px white solid">
                <p id="addHeading" style="line-height: 0; color:#0a4293; font-weight:normal; font-size:14px; font-weight:600;">Edit item</p><button style="line-height: 0; background-color:red; border-radius:3px;" type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="color:white">&times;</span></button>
            </div>
            <div class="modal-body" style="background-color:white; border-left:6px solid #e2ecfb; border-right:6px solid #e2ecfb; border-bottom:6px solid #e2ecfb; font-size:13px">
                <form id="myForm" class="form-horizontal">

                    {{csrf_field()}} {{method_field('POST')}}
                    <input type="hidden" class="form-control form-control-sm id_transaksi" id="id_transaksi" name="id_transaksi" >
                    <input type="hidden" class="form-control form-control-sm ref_pemakaian" id="ref_pemakaian" name="ref_pemakaian" >
                    
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
                        <label style="padding-top: 0" class="col-sm-6 control-label">Qty. Dipesan : </label>
                        <div class="col-sm-5">
                            <input type="number" value="0" class="form-control form-control-sm fx qty" id="qty_dipesan" name="qty_dipesan" readonly="true">
                        </div>
                    </div>

                    <div class="form-group">
                        <label style="padding-top: 0" class="col-sm-6 control-label">Qty. Diterima : </label>
                        <div class="col-sm-5">
                            <input type="number" value="0" class="form-control form-control-sm fx qty_diterima" id="qty_diterima" name="qty_diterima" readonly="true">
                        </div>
                    </div>

                    <div class="modal-footer" style="font-size:11px; display:inline-block;">
                        <button type="submit" class="btn btn-primary btn-sm" id="saveBtn">Save</button>
                        <button type="submit" class="btn btn-success btn-sm" id="save_verify">Save</button>
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
            <div class="modal-header bg-info text-white" style="background-image: linear-gradient(#d0e2f8, #e2ecfb); height: 30px; line-height: 6px; font-size: 13px; border-top: 1px white solid">
                <p id="addTitle" style="line-height: 0; color:#0a4293; font-weight:normal; font-size:14px; font-weight:600;"></p><button style="line-height: 0; background-color:red; border-radius:3px;" type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="color:white">&times;</span></button>
            </div>
            <div class="modal-body"  style="background-color:white; border-left:6px solid #e2ecfb; border-right:6px solid #e2ecfb; border-bottom:6px solid #e2ecfb; font-size:13px">
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
        $(".daftar_transaksi").DataTable({
            ajax:"{{route('pesan_barang.daftar_pesanan')}}",
            ordering:false,
            processing:false,
            serverside:false,
            columns:[
                {data:"ref_pemesanan"},
                {data:"tgl_pemesanan"},
                {data:"tgl_diterima"},
                {data:"total_qty_dipesan"},
                {data:"total_qty_diterima"},
                {data:"keterangan",
                    mRender:function(data,type,full){
                        //menunggu konfirmasi
                        if(full['id_status']==1){
                            return'<span class="badge badge-warning" style="padding-left:10px;padding-right:10px;">'+data+'</span>';
                            //status disproses    
                        }else if(full['id_status']==2){
                            return'<span class="badge badge-success" style="padding-left:10px;padding-right:10px;">'+data+'</span>';
                            //status diterima
                        }else if(full['id_status']==3){
                            return'<span class="badge badge-info" style="padding-left:10px;padding-right:10px;">'+data+'</span>';
                            //status ditolak
                        }else if(full['id_status']==4){
                            return'<span class="badge badge-danger" style="padding-left:10px;padding-right:10px;">'+data+'</span>';
                            //status dibatalkan
                        }else if(full['id_status']==5){
                            return'<span class="badge badge-secondary" style="padding-left:10px;padding-right:10px;">'+data+'</span>';
                            //status verified
                        }else if(full['id_status']==6){
                            return'<span class="badge badge-light" style="padding-left:10px;padding-right:10px;">'+data+'</span>';
                            //status not verified
                        }else if(full['id_status']==7){
                            return'<span class="badge badge-dark" style="padding-left:10px;padding-right:10px;">'+data+'</span>';
                        }
                        //status selesai
                        return'<span class="badge badge-primary" style="padding-left:10px;padding-right:10px;">'+data+'</span>';
                    }
                },
                {data:"ref_pemesanan",
                    mRender:function(data, type, full){
                        return"<button class='btn btn-primary btn-sm' id='detail' data-status='"+full['keterangan']+"' data-ref_pemesanan='"+data+"'>Detail</button>";                        
                    }
                }
            ]
        });

        var no_ref=$("#no_ref").val();
        console.log(no_ref);
        detail_transaksi(no_ref);

        $("body").on("click",".add_pesanan",function(){
            $("#proses").val("tambah");
            var fix_noref = $("#fix_noref").val();
            console.log(fix_noref);
            $("#no_ref").val(fix_noref);
            document.getElementById("save").style.display="inline-block";
            document.getElementById("simpan_terima").style.display="none";
            document.getElementById("add").disabled=false;
            document.getElementById("terima_barang").disabled=true;
            document.getElementById("barcode").readOnly=true;
            document.getElementById("no_bukti").readOnly=true;
            document.getElementById("tanggal").readOnly=true;
            $("#no_bukti").val("");
            $("#tanggal").val("");
            document.getElementById("saveBtn").style.display="inline-block";
            document.getElementById("save_verify").style.display="none";
            document.getElementById("updateBtn").style.display="none";
            $("#state").val(1);
            detail_transaksi(fix_noref);
            $("#formAddPesanan").modal("show");
        });

        function detail_transaksi(no_ref){
            $(".detail_transaksi").DataTable().clear().destroy();
            $(".detail_transaksi").DataTable({
                ajax        :"pesan_barang/"+no_ref+"/detail_transaksi",
                processing  :false,
                pageLength  :5,
                serverside  :false,
                searching   :false,
                info        :false,
                footerCallback: function ( row, data, start, end, display ) {
                    var api = this.api(), data;
        
                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };
                    tot_qty_dipesan = api
                    .column( 2, { page: 'all'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                    tot_qty_diterima = api
                    .column( 3, { page: 'all'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                    $("#tot_qty_dipesan").val(tot_qty_dipesan);
                    $("#tot_qty_diterima").val(tot_qty_diterima);
                    
                    if(tot_qty_dipesan>0){
                        document.getElementById("save").disabled=false;
                    }else{
                        document.getElementById("save").disabled=true;
                    }
                    // Update footer
                    $( api.column( 2 ).footer() ).html(new Intl.NumberFormat().format(tot_qty_dipesan));
                    $( api.column( 3 ).footer() ).html(new Intl.NumberFormat().format(tot_qty_diterima));
                },
                columns:[
                    {data:"kode_barang"},
                    {data:"nama_barang"},
                    {data:"qty_dipesan",className: 'dt-body-right'},
                    {data:"qty_diterima",className: 'dt-body-right'},
                    {data:"status",
                        mRender:function(data,type,full){
                            //status verified
                            if(full['id_status']==7){
                                return'<span class="badge badge-light">'+data+'</span>';
                            }
                                //status not verified
                                return'<span class="badge badge-dark">'+data+'</span>';
                        }
                    },
                    {data:"kode_barang",
                        mRender:function(data, type, full){
                            var state = $("#state").val();
                            if(state==0 && full['id_status']==7){
                                return"<button class='btn btn-warning btn-sm edit' id='edit' data-id_transaksi='"+full['id_transaksi']+"' disabled>Edit</button> <button class='btn btn-danger btn-sm delete' id='delete' data-kode_barang='"+data+"' disabled>Delete</button>";
                            }else if(state==1 && full['id_status']==6){
                                return"<button class='btn btn-warning btn-sm edit' id='edit' data-id_transaksi='"+full['id_transaksi']+"'>Edit</button> <button class='btn btn-danger btn-sm delete' id='delete' data-kode_barang='"+data+"' disabled>Delete</button>";
                            }else if(state==1 && full['id_status']==7){
                                return"<button class='btn btn-warning btn-sm edit' id='edit' data-id_transaksi='"+full['id_transaksi']+"'>Edit</button> <button class='btn btn-danger btn-sm delete' id='delete' data-kode_barang='"+data+"' >Delete</button>";
                            }else{
                                return"<button class='btn btn-warning btn-sm edit' id='edit' data-id_transaksi='"+full['id_transaksi']+"' disabled>Edit</button> <button class='btn btn-danger btn-sm delete' id='delete' data-kode_barang='"+data+"' disabled>Delete</button>";
                            }
                            
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
                            return'<button data-kode_barang='+data+' class="btn btn-warning btn-sm pilih">Pilih</button>';
                        }
                    },
                ]
        });

        $("body").on("click","#add",function(){
            $(".daftar_barang").DataTable().ajax.reload();
            $("#formDaftarBarang").modal("show");
            document.getElementById("addTitle").innerHTML = "Daftar Barang";
        });

        $("body").on("click",".pilih",function(){
            var kode_barang = $(this).data("kode_barang");
            document.getElementById("saveBtn").style.display = "inline-block";
            document.getElementById("updateBtn").style.display = "none";
            $.ajax({
                url     :"pesan_barang/"+kode_barang+"/pilih",
                type    :"GET",
                dataType:"JSON",
                success :function(data){
                    $("#formDaftarBarang").modal("hide");
                    $("#kode_barang").val(kode_barang);
                    $("#nama_barang").val(data.nama_barang);
                    document.getElementById("qty_dipesan").readOnly=false;
                    document.getElementById("qty_diterima").readOnly=true;
                    $("#qty_dipesan").val(1);
                    $("#qty_diterima").val(0);
                    $("#formSimpanBarang").modal("show");
                }
            });
        });

        $("#formSimpanBarang").on("shown.bs.modal", function(){
            $("#qty_dipesan").focus();
        });

        $("#saveBtn").on("click", function(e){
            e.preventDefault();
            var ref_pemesanan = $("#no_ref").val();
            var kode_barang=$("#kode_barang").val();
            var qty_dipesan = $("#qty_dipesan").val();
            
            $.ajax({
                url:"pesan_barang/"+ref_pemesanan+"/"+kode_barang+"/insert",
                type:"GET",
                data:{qty_dipesan:qty_dipesan},
                success:function(data){
                    $("#formSimpanBarang").modal("hide");
                    $(".detail_transaksi").DataTable().ajax.reload();
                }
            });
        });

        $(".simpan_terima").on("click",function(){
            var no_bukti = $("#no_bukti").val();
            var tanggal = $("#tanggal").val();
            if(no_bukti=="" || tanggal=="" ){
                alert("Masukan tanggal dan Nomor bukti pembelian/kwitansi sebelum lanjut");
            }else{
                if(confirm("Pastikan semua data sudah benar. Data yang sudah diinput tidak dapat diubah kembali")){
                    console.log("simpan terima");
                    document.getElementById("simpan_terima").style.display=true;
                    document.getElementById("simpan_terima").disabled=true;
                    document.getElementById("save").style.display="none";
                    document.getElementById("barcode").readOnly=true;
                    document.getElementById("add").disabled=true;
                    var no_ref = $("#no_ref").val();
                    var qty_diterima = $("#qty_diterima").val();
                    $.ajax({
                        url:"pesan_barang/"+no_ref+"/simpan_terima",
                        data:{qty_diterima:qty_diterima, no_bukti:no_bukti, tanggal:tanggal},
                        type:"GET",
                        success:function(data){
                            $("#formAddPesanan").modal("hide");
                            $(".daftar_transaksi").DataTable().ajax.reload(null, false);
                        }
                    });
                }
            }
        });

        $("#save_verify").on("click", function(e){
            e.preventDefault();
            var ref_pemesanan = $("#no_ref").val();
            var kode_barang=$("#kode_barang").val();
            var qty_diterima = $("#qty_diterima").val();
            var id_transaksi = $("#id_transaksi").val();

                $.ajax({
                    url:"pesan_barang/"+ref_pemesanan+"/"+kode_barang+"/update_verify",
                    type:"GET",
                    data:{qty_diterima:qty_diterima, id_transaksi:id_transaksi},
                    success:function(data){
                        $("#formSimpanBarang").modal("hide");
                        $(".detail_transaksi").DataTable().ajax.reload(null, false);
                        if(data.enabled==true){
                            document.getElementById("simpan_terima").disabled=false;
                        }else{
                            document.getElementById("simpan_terima").disabled=true;
                        }
                        console.log("result "+data.result);
                        $("#state").val(1);
                    }
                });
        });

        $("body").on("click",".delete", function(){
            var ref_pemesanan = $("#no_ref").val();
            var kode_barang = $(this).data("kode_barang");
            if(confirm("Yakin ingin menghapus data ini?")){
                    $.ajax({
                    url     :"pesan_barang/"+ref_pemesanan+"/"+kode_barang+"/delete",
                    type    :"GET",
                    dataType:"JSON",
                    success :function(data){
                        $(".detail_transaksi").DataTable().ajax.reload();
                    }
                });
            }
        });

        $("body").on("click",".save", function(){
            var ref_pemesanan = $("#no_ref").val();
            var tot_qty_dipesan = $("#tot_qty_dipesan").val();
            if(confirm("Pastikan semua data sudah benar")){
                $.ajax({
                    url     :"pesan_barang/"+ref_pemesanan+"/save",
                    type    :"GET",
                    data    :{tot_qty_dipesan:tot_qty_dipesan},
                    dataType:"JSON",
                    success : function(data){
                        console.log(data.no_ref);
                        $("#fix_noref").val(data.no_ref);
                        detail_transaksi(data.no_ref);
                        document.getElementById("save").disabled=true;
                        $("#formAddPesanan").modal("hide");
                        $(".daftar_transaksi").DataTable().ajax.reload(null, false);
                    }
                });
            }
        });

        $("body").on("click", ".edit", function(){
            var proses = $("#proses").val();
            var id_transaksi = $(this).data("id_transaksi");
            $("#id_transaksi").val(id_transaksi);
            console.log(id_transaksi);
            document.getElementById("addTitle").innerHTML = "Edit Barang";

            $.ajax({
                url     :"pesan_barang/"+id_transaksi+"/edit",
                type    :"GET",
                dataType:"JSON",
                success:function(data){
                    
                    if(proses=="detail"){
                        document.getElementById("qty_diterima").readOnly=false;
                        document.getElementById("qty_dipesan").readOnly=true;
                        document.getElementById("save_verify").style.display = "none";
                        document.getElementById("saveBtn").style.display = "none";
                        document.getElementById("updateBtn").style.display = "inline-block";
                    }else{
                        document.getElementById("qty_diterima").readOnly=true;
                        document.getElementById("qty_dipesan").readOnly=false;
                        document.getElementById("save_verify").style.display = "none";
                        document.getElementById("saveBtn").style.display = "none";
                        document.getElementById("updateBtn").style.display = "inline-block";
                    }
                    $("#id_transaksi").val(id_transaksi);
                    $("#kode_barang").val(data.kode_barang);
                    $("#nama_barang").val(data.nama_barang);
                    $("#harga_satuan").val(data.harga_satuan);
                    
                    $("#qty_dipesan").val(data.qty_dipesan);
                    $("#qty_diterima").val(data.qty_diterima);
                    $("#formSimpanBarang").trigger("reset");
                    $("#formSimpanBarang").modal("show");
                }
            });
            
        });

        $("body").on("change","#barcode",function(){
            console.log($(this).val());
            var kode_barang = $(this).val();
            $("#barcode").val(""); 
            var no_ref = $("#no_ref").val();
            console.log(no_ref);
            $.ajax({
                url:"pesan_barang/"+no_ref+"/"+kode_barang+"/verify",
                type:"GET",
                success:function(data){
                    if(data.exist==true){
                        $("#id_transaksi").val(data.table.id_transaksi);
                        $("#kode_barang").val(data.table.kode_barang);
                        $("#nama_barang").val(data.table.nama_barang);
                        $("#harga_satuan").val(data.table.harga_satuan);
                        document.getElementById("qty_diterima").readOnly=false;
                        document.getElementById("qty_dipesan").readOnly=true;
                        $("#qty_dipesan").val(data.table.qty_dipesan);
                        $("#qty_diterima").val(0);

                        document.getElementById("saveBtn").style.display="none";
                        document.getElementById("save_verify").style.display="inline-block";
                        document.getElementById("updateBtn").style.display="none";
                        $("#formSimpanBarang").modal("show");
                    }else{
                        alert("Data tidak ditemukan, periksa kembali kode barang!");
                        $("#barcode").focus();
                    }
                }
            })
        });

        $("#updateBtn").click(function(e){
            e.preventDefault();  
            var qty_dipesan =$("#qty_dipesan").val();
            var qty_diterima =$("#qty_diterima").val();
            var id_transaksi =$("#id_transaksi").val();     
            $.ajax({
                url     :"{{route('pesan_barang.update')}}",
                type    :"GET",
                dataType:"JSON",
                data    :{qty_dipesan:qty_dipesan, qty_diterima:qty_diterima, id_transaksi:id_transaksi},
                success :function(data){
                    $(".detail_transaksi").DataTable().ajax.reload();
                    $("#formSimpanBarang").modal("hide");
                }
            });
        });

        $("body").on("click","#detail",function(){
            $("#state").val("0");
            $("#proses").val("detail");
            document.getElementById("simpan_terima").style.display="inline-block";
            document.getElementById("simpan_terima").disabled=true;
            document.getElementById("save").style.display="none";
            document.getElementById("barcode").readOnly=true;
            document.getElementById("tanggal").readOnly=true;
            document.getElementById("no_bukti").readOnly=true;
            document.getElementById("add").disabled=true;
            var no_ref = $(this).data("ref_pemesanan");
            $("#no_ref").val($(this).data("ref_pemesanan"));
            var status = $(this).data("status");
            if(status=="Selesai"){
                document.getElementById("terima_barang").disabled=true;
            }else{
                document.getElementById("terima_barang").disabled=false;
            }
            $.ajax({
                url:"pesan_barang/"+no_ref+"/terima",
                type:"GET",
                success:function(data){
                    detail_transaksi(no_ref);
                    console.log(data.tgl_pemesanan);
                    $("#tanggal").val(data.tgl_pemesanan);
                    $("#no_bukti").val(data.no_bukti);
                    $("#state").val(0);
                    $("#formAddPesanan").modal("show");
                }
            });
        });

        $("body").on("click","#terima_barang",function(){
            $("#state").val(1);
            document.getElementById("simpan_terima").style.display="inline-block";
            document.getElementById("simpan_terima").disabled=true;
            document.getElementById("save").style.display="none";
            document.getElementById("barcode").readOnly=false;
            document.getElementById("no_bukti").readOnly=false;
            document.getElementById("add").disabled=true;
            document.getElementById("terima_barang").disabled=true;
            document.getElementById("tanggal").readOnly=false;
            $("#barcode").focus();
        });

        $('#tanggal').datepicker({
            format          : "yyyy-mm-dd",
            autoclose       : true,
            todayHighlight  : true,
            weekStart       : 1,
            daysOfWeekHighlighted: "0,6"
        });
    });
</script>
@endpush