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

    .edit, .delete, #detail, .pilih{
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
                    <p style="line-height: 0; color:#0a4293; font-weight:normal; font-size:14px; font-weight:600;">Riwayat stock opname</p>
                </div>
                <div class="card-body" style="background-color:#f0f0f0; font-size:13px;">
                <input type="hidden" id="fix_noref" class="fix_noref" value=""> 
                <button class="btn btn-primary btn-sm tambah_transaksi" style="margin-bottom:15px;">Tambah</button>
                    <table class="display table-sm daftar_transaksi" style="font-size:13px; border:1px solid #9c9a9a;" width="100%">
                        <thead style="background-image: linear-gradient(#ecf6f8, #d7dfe1); line-height:3px;">
                            <tr>
                                <td style="width:100px">No. Referensi</td>
                                <td style="width:80px">Tanggal</td>
                                <td style="width:100px; text-align:right">Tot. Qty. sistem</td>
                                <td style="width:120px; text-align:right">Tot. Qty. gudang</td>
                                <td>Total selisih</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                            <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="formAddTransaksi" aria-hidden="true" style="overflow: hidden;" data-backdrop="false">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;">
                <div class="modal-header bg-info text-white" style="background-image: linear-gradient(#d0e2f8, #e2ecfb); height: 30px; line-height: 6px; font-size: 13px; border-top: 1px white solid">
                    <p id="addHeading" style="line-height: 0; color:#0a4293; font-weight:normal; font-size:14px; font-weight:600;">Transaksi stock opname</p><button style="line-height: 0; background-color:red; border-radius:3px;" type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="color:white">&times;</span></button>
                </div>
                <div class="card-body" style="background-color:white; border-left:6px solid #e2ecfb; border-right:6px solid #e2ecfb; border-bottom:6px solid #e2ecfb; font-size:13px">
                <input type="hidden" class="form-control tot_qty_sistem" id="tot_qty_sistem" name="tot_qty_sistem" style="margin-bottom:10px">
                <input type="hidden" class="form-control tot_qty_gudang" id="tot_qty_gudang" name="tot_qty_gudang" style="margin-bottom:10px">
                <input type="hidden" id="total_selisih">
                <input type="hidden" id="state">
                <div class="row">
                    <div class="col">
                        <label><b>No. Referensi :</b></label>
                        <input type="text" class="form-control fx no_referensi" value="{{$no_ref}}" id="no_referensi" disabled="true" style="margin-bottom:10px">
                    </div>

                    <div class="col">
                        <?php $tgl = date("d/m/Y"); ?>
                        <label><b>Tanggal:</b></label>
                        <input type="text" value="{{$tgl}}" class="form-control fx tanggal" id="tanggal" readonly>
                    </div>
                    <?php $id_user = Auth::user()->id; ?>
                    <input type="hidden" value="" class="form-control id_user" id="id_user">
                </div>
                
                <div class="row">
                    <div class="col">
                    <form autocomplete="off">
                        <label><b>Barcode :</b></label>
                        <input type="text" class="form-control fx barcode" id="barcode" placeholder="Scan barcode"/>
                        <small class="form-text text-muted">Scan barcode menggunakan barcode scanner.</small>
                    </form>
                    </div>
                </div>
                
                <button class="btn btn-success btn-sm add" id="add" style="margin-bottom:20px; margin-top:15px;">Add</button>

                    <table class="detail_transaksi display" style="font-size:13px; border:1px solid #9c9a9a;" width="100%">
                        <thead style="background-image: linear-gradient(#ecf6f8, #d7dfe1); line-height:3px;">
                            <tr>
                                <td>Kode barang</td>
                                <td width="120px">Nama Barang</td>
                                <td width="80px">Qty. sistem</td>
                                <td width="85px">Qty. gudang</td>
                                <td width="50px">Selisih</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr style="background-image: linear-gradient(#ecf6f8, #d7dfe1); line-height:3px;">
                                    <td style="font-weight:bold">TOTAL:</td>
                                    <td style="font-weight:bold"></td>
                                    <td style="font-weight:bold"></td>
                                    <td style="font-weight:bold"></td>
                                    <td style="font-weight:bold"></td>
                                    <td style="font-weight:bold"></td>
                                </tr>
                            </tfoot>
                    </table>
                    <br>
                        <button class="btn btn-primary btn-sm save_transaksi" id="save_transaksi" style="float:right; margin-left:10px;">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="formInputData" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;">
            <div class="modal-header bg-info text-white" style="background-image: linear-gradient(#d0e2f8, #e2ecfb); height: 30px; line-height: 6px; font-size: 13px; border-top: 1px white solid">
                <p id="addHeading" style="line-height: 0; color:#0a4293; font-weight:normal; font-size:14px; font-weight:600;">Stock opname gudang</p><button style="line-height: 0; background-color:red; border-radius:3px;" type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="color:white">&times;</span></button>
            </div>
            <div class="modal-body" style="background-color:white; border-left:6px solid #e2ecfb; border-right:6px solid #e2ecfb; border-bottom:6px solid #e2ecfb; font-size:13px">
                <form id="myForm" class="form-horizontal">

                    {{csrf_field()}} {{method_field('POST')}}
                    <input type="hidden" class="form-control form-control-sm no_ref" id="no_ref" name="no_ref" >
                    
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
                        <label style="padding-top: 0" class="col-sm-6 control-label">Qty. Sistem: </label>
                        <div class="col-sm-5">
                            <input type="number" value="0" class="form-control form-control-sm fx qty_sistem" id="qty_sistem" name="qty_sistem" readonly="true">
                        </div>
                    </div>

                    <div class="form-group">
                        <label style="padding-top: 0" class="col-sm-6 control-label">Qty. Gudang: </label>
                        <div class="col-sm-5">
                            <input type="number" value="0" class="form-control form-control-sm fx qty_gudang" id="qty_gudang" name="qty_gudang">
                        </div>
                    </div>

                    <div class="modal-footer" style="font-size:11px; display:inline-block;">
                        <button type="submit" class="btn btn-primary btn-sm" id="saveBtn">Save</button>
                        <!--<button type="submit" class="btn btn-success btn-sm" id="save_verify">Save</button>-->
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
                <p id="addTitle" style="line-height: 0; color:#0a4293; font-weight:normal; font-size:14px; font-weight:600;">Daftar barang</p><button style="line-height: 0; background-color:red; border-radius:3px;" type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="color:white">&times;</span></button>
            </div>
            <div class="modal-body" style="background-color:white; border-left:6px solid #e2ecfb; border-right:6px solid #e2ecfb; border-bottom:6px solid #e2ecfb; font-size:13px">
                <table class="daftar_barang display table-sm" style="font-size:12px; border:1px solid #9c9a9a;" width="100%">
                    <thead style="background-image: linear-gradient(#ecf6f8, #d7dfe1); line-height:3px;">
                        <tr>
                            <td>Kode Barang</td>
                            <td>Nama Barang</td>
                            <td>Qty</td>
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
        $(".daftar_transaksi").DataTable({ //menampilkan daftar transaksi yang sudah berjalan
            ajax        :"{{route('stock_opname.show_data')}}",
            processing  :false,
            serverside  :false,
            ordering    :false,
            columns     :
            [
                {data:"no_ref"},
                {data:"tanggal"},
                {data:"tot_qty_sistem"},
                {data:"tot_qty_gudang"},
                {data:"tot_selisih"}, 
                {data:"no_ref",
                    mRender:function(data){
                        return"<button class='btn btn-primary btn-sm show_detail' data-no_ref='"+data+"'>Detail</button>";
                    }
                },
            ]
        });

    $(".daftar_barang").DataTable({ //menampilkan daftar barang yang ada di aplikasi
        ajax:"{{route('daftar_barang.show_data')}}",
        processing:false,
        serverside:false,
        ordering:false,
        columns:
        [
            {data:"kode_barang"},
            {data:"nama_barang"},
            {data:"stock"},
            {data:"kode_barang", 
                mRender:function(data){
                    return"<button class='btn btn-warning btn-sm' id='pilih' data-kode_barang='"+data+"'>Pilih</button>";
                }
            },
        ]
    });

    function detail_transaksi(no_ref){
        var id_state = $("#state").val();
        $(".detail_transaksi").DataTable().clear().destroy();
        $(".detail_transaksi").DataTable({
            ajax:{
                url : "{{route('stock_opname.detail_transaksi')}}",
                type: "GET",
                data: {no_ref:no_ref}
            },
            processing  :false,
            pageLength  :5,
            serverside  :false,
            ordering    :false,
            footerCallback: function ( row, data, start, end, display ) {
                var api = this.api(), data;
    
                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };
                var qty_sistem = api
                    .column( 2, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                var qty_gudang = api
                    .column( 3, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
                
                var tot_selisih = api
                    .column( 4, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
                
                    
                $("#tot_qty_sistem").val(qty_sistem);
                $("#tot_qty_gudang").val(qty_gudang);
                $("#total_selisih").val(tot_selisih);
                // Update footer
                $( api.column( 2 ).footer() ).html(new Intl.NumberFormat().format(qty_sistem));
                $( api.column( 3 ).footer() ).html(new Intl.NumberFormat().format(qty_gudang));
                $( api.column( 4 ).footer() ).html(new Intl.NumberFormat().format(tot_selisih));
            },
            columns     :
            [
                {data:"kode_barang"},
                {data:"nama_barang"},
                {data:"qty_sistem"},
                {data:"qty_gudang"},
                {data:"selisih"},
                {data:"kode_barang",
                    mRender:function(data){
                        if(id_state==1){
                            return"<button class='btn btn-warning btn-sm' id='edit_barang' data-kode_barang='"+data+"'>Edit</button> <button class='btn btn-danger btn-sm' id='delete_barang' data-kode_barang='"+data+"'>Delete</button>";
                        }else{
                            return"<button class='btn btn-warning btn-sm' id='edit_barang' data-kode_barang='"+data+"' disabled>Edit</button> <button class='btn btn-danger btn-sm' id='delete_barang' data-kode_barang='"+data+"' disabled>Delete</button>";
                        }
                        
                    }
                }               
            ]
        });
    }

    $("body").on("click", ".tambah_transaksi", function(){
        var no_ref = $("#no_referensi").val();
        $("#state").val(1);
        detail_transaksi(no_ref);
        document.getElementById("save_transaksi").disabled=false;
        document.getElementById("add").disabled=false;
        document.getElementById("barcode").disabled=false;
        $("#formAddTransaksi").modal("show");
    });

    $(".barcode").on("change",function(){
        console.log($(this).val());
        var barcode = $(this).val();
        $.ajax({
            url     :"{{route('stock_opname.find_barang')}}",
            type    :"GET",
            data    :{barcode:barcode},
            success :function(data){
                if(data.hasOwnProperty('kode_barang')){
                    $("#formInputData").modal("show");
                    $("#no_ref").val($("#no_referensi").val());
                    $("#kode_barang").val(data.kode_barang);
                    $("#nama_barang").val(data.nama_barang);
                    $("#qty_sistem").val(data.stock);
                    $("#qty_gudang").val("0");
                }else{
                    alert("Data tidak ditemukan");
                }
            }
        });
    });

    $("body").on("click","#add",function(){
        document.getElementById("save_transaksi").disabled=true;
        $("#formDaftarBarang").modal("show");
        
    });

    $(".daftar_barang").on("click","tr",function(){
        $("#formDaftarBarang").modal("hide");
        document.getElementById("updateBtn").style.display="none";
        document.getElementById("saveBtn").style.display="inline-block";
        var data = $(".daftar_barang").DataTable().row(this).data();
        $("#no_ref").val($("#no_referensi").val());
        $("#kode_barang").val(data.kode_barang);
        $("#nama_barang").val(data.nama_barang);
        $("#qty_sistem").val(data.stock);
        $("#qty_gudang").val("0");
        $("#formInputData").modal("show");
    });

    $("#saveBtn").click(function(e){
        e.preventDefault();
        $.ajax({
            url:"{{route('stock_opname.save_barang')}}",
            type:"POST",
            dataType:"JSON",
            data:$("#myForm").serialize(),
            success:function(data){
                document.getElementById("save_transaksi").disabled=false;
                $(".detail_transaksi").DataTable().ajax.reload();
                $("#formInputData").modal("hide");
            }
        });
    });

    $("body").on("click","#edit_barang",function(){
        console.log($(this).data("kode_barang"));
        var kode_barang = $(this).data("kode_barang");
        var no_ref = $("#no_referensi").val();
        document.getElementById("updateBtn").style.display="inline-block";
        document.getElementById("saveBtn").style.display="none";
        $.ajax({
            url:"{{route('stock_opname.edit_barang')}}",
            type:"GET",
            data:{kode_barang:kode_barang, no_ref:no_ref},
            success:function(data){
                $("#no_ref").val(no_ref);
                $("#kode_barang").val(kode_barang);
                $("#nama_barang").val(data.nama_barang);
                $("#qty_sistem").val(data.qty_sistem);
                $("#qty_gudang").val(data.qty_gudang);
                $("#formInputData").modal("show");
            }
        })
    });

    $("#updateBtn").click(function(e){
        e.preventDefault();
        var no_ref = $("#no_referensi").val();
        var kode_barang = $(this).data("kode_barang");
        $.ajax({
            url:"{{route('stock_opname.update_barang')}}",
            type:"POST",
            data:$("#myForm").serialize(),
            success:function(data){
                $("#formInputData").modal("hide");
                $(".detail_transaksi").DataTable().ajax.reload();
            }
        });
        
    });

    $("body").on("click","#delete_barang",function(){
        var no_ref = $("#no_referensi").val();
        var kode_barang = $(this).data("kode_barang");
        $.ajax({
            url :"{{route('stock_opname.delete_barang')}}",
            type:"GET",
            data:{no_ref:no_ref, kode_barang:kode_barang},
            success:function(data){
                if(data.count==0){
                    document.getElementById("save_transaksi").disabled=true;
                }else{
                    document.getElementById("save_transaksi").disabled=false;
                }
                $(".detail_transaksi").DataTable().ajax.reload();
            }
        });
        console.log($(this).data("kode_barang"));
    });

    $("body").on("click","#save_transaksi",function(){
        var no_ref = $("#no_referensi").val();
        var tgl = $("#tanggal").val();
        var total_selisih = $("#total_selisih").val();
        var tot_qty_sistem = $("#tot_qty_sistem").val();
        var tot_qty_gudang =$("#tot_qty_gudang").val();

        if(confirm("Pastikan seluruh barang sudah dihitung dengan benar")){
            $.ajax({
                url     :"{{route('stock_opname.save_transaksi')}}",
                type    :"GET",
                dataType:"JSON",
                data    :{no_ref:no_ref,tgl:tgl, tot_qty_sistem:tot_qty_sistem, tot_qty_gudang:tot_qty_gudang, total_selisih:total_selisih},
                success:function(data){
                    $("#formAddTransaksi").modal("hide");
                    $("#no_referensi").val(data.no_ref);
                    $(".daftar_transaksi").DataTable().ajax.reload();
                }
            });
        }
    });

    $("body").on("click",".show_detail",function(){
        var no_ref = $(this).data("no_ref");
        $("#state").val(0);
        $("#formAddTransaksi").modal("show");
        detail_transaksi(no_ref);
        document.getElementById("save_transaksi").disabled=true;
        document.getElementById("add").disabled=true;
        document.getElementById("barcode").disabled=true;
    });
});
</script>
@endpush