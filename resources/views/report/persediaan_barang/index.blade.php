@extends('layout/app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report persediaan  barang</title>
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
                
                <div class="card-header"  style="background-image: linear-gradient(#d0e2f8, #e2ecfb); height: 30px; line-height: 6px; font-size: 13px; border-top: 1px white solid">
                    <p style="line-height: 0; color:#0a4293; font-weight:normal; font-size:14px; font-weight:600;">Report persediaan barang</p>
                </div>
                <div class="card-body" style="background-color:#f0f0f0; font-size:13px;">
                
                    <table class="display table-sm daftar_barang" style="font-size:13px; border:1px solid #9c9a9a;" width="100%">
                        <thead style="background-image: linear-gradient(#ecf6f8, #d7dfe1); line-height:3px;">
                            <tr>
                                <td width="100px">Kode</td>
                                <td>Nama barang</td>
                                <td>Kategori</td>
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

<div class="modal fade" id="formDetail" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;">
            <div class="modal-header bg-info text-white" style="background-image: linear-gradient(#d0e2f8, #e2ecfb); height: 30px; line-height: 6px; font-size: 13px; border-top: 1px white solid">
                <p id="addHeading" style="line-height: 0; color:#0a4293; font-weight:normal; font-size:14px; font-weight:600;">Detail transaksi</p><button style="line-height: 0; background-color:red; border-radius:3px;" type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="color:white">&times;</span></button>
            </div>
            <div class="modal-body" style="background-color:white; border-left:6px solid #e2ecfb; border-right:6px solid #e2ecfb; border-bottom:6px solid #e2ecfb; font-size:13px">
            <table border="0">
                <tr>
                    <td width="100px">Nama barang</td>
                    <td width="5px">:</td>
                    <td><b><span id="nama_item"></span></b></td>
                </tr>
                <tr>
                    <td>Jenis</td>
                    <td>:</td>
                    <td><b><span id="jenis_item"></span></b></td>
                </tr>
                <tr>
                    <td>Kategori</td>
                    <td>:</td>
                    <td><b><span id="kategori_item"></span></b></td>
                </tr>
                <tr>
                    <td>Saldo</td>
                    <td>:</td>
                    <td><b><span id="stock_item"></span></b></td>
                </tr>
            </table>
            <br>
            <p style="line-height:5px"><b>Riwayat pemesanan barang</b></p>
                <table class="display table-sm transaksi_masuk" style="font-size:13px; border:1px solid #9c9a9a;" width="100%">
                    <thead style="background-image: linear-gradient(#ecf6f8, #d7dfe1); line-height:3px;">
                        <tr>
                            <td width="80px">Tanggal</td>
                            <td>No. Referensi</td>
                            <td style="text-align:right">qty</td>
                        </tr>
                    </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr style="background-image: linear-gradient(#ecf6f8, #d7dfe1); line-height:3px;">
                                <th colspan="2" style="text-align:center">TOTAL:</th>
                                <th style="text-align:right"></th>
                            </tr>
                        </tfoot>
                </table>
                <br>
            <p style="line-height:5px"><b>Riwayat permintaan barang</b></p>
                <table class="display table-sm transaksi_keluar" style="font-size:13px; border:1px solid #9c9a9a;" width="100%">
                    <thead style="background-image: linear-gradient(#ecf6f8, #d7dfe1); line-height:3px;">
                        <tr>
                            <td width="80px">Tanggal</td>
                            <td width="100px">No. Referensi</td>
                            <td>Pengguna</td>
                            <td>qty</td>
                        </tr>
                    </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr style="background-image: linear-gradient(#ecf6f8, #d7dfe1); line-height:3px;">
                                <th colspan="3" style="text-align:center">TOTAL:</th>
                                <th style="text-align:right"></th>
                            </tr>
                        </tfoot>
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
    show_all();
    function show_all(){
        $(".daftar_barang").DataTable({
            ajax        :"{{route('report_persediaan.daftar_barang')}}",
            serverside  :false,
            processing  :false,
            searching   :true,
            ordering    :false,
            columns     :
            [
                {data:"kode_barang"},
                {data:"nama_barang"},
                {data:"kategori_barang"},
                {data:"stock"},
                {data:"kode_barang", 
                    mRender:function(data, type, full){
                        return"<button class='btn btn-primary btn-sm detail' data-kode_barang='"+data+"'>Detail</button>";
                    }
                }
            ]
        });
    }

    $("body").on("click",".detail",function(){
        console.log($(this).data("kode_barang"));
        var kode_barang = $(this).data("kode_barang");
        $.ajax({
            url     :"{{route('report_persediaan.detail_barang')}}",
            type    :"GET",
            dataType:"JSON",
            data    :{kode_barang:kode_barang},
            success:function(data){
                document.getElementById("nama_item").innerHTML = data.nama_barang;
                document.getElementById("jenis_item").innerHTML = data.jenis_item;
                document.getElementById("kategori_item").innerHTML = data.kategori_barang;
                document.getElementById("stock_item").innerHTML = data.stock;
            }
        });

        $(".transaksi_masuk").DataTable().clear().destroy();
        $(".transaksi_masuk").DataTable({
            ajax:{
                url     :"{{route('report_persediaan.detail_masuk')}}",
                type    :"GET",
                dataType:"JSON",
                data    :{kode_barang:kode_barang}
            },
            serverside:false,
            paging:false,
            processing:false,
            info:false,
            searching:false,
            ordering:false,
            footerCallback: function ( row, data, start, end, display ) {
                    var api = this.api(), data;
        
                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };
                    total_masuk = api
                    .column( 2, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
                    
                    // Update footer
                    $( api.column( 2 ).footer() ).html(new Intl.NumberFormat().format(total_masuk));
                },
            columns:[
                {data:"tgl_masuk"},
                {data:"ref_pemesanan"},
                {data:"barang_masuk"},
            ]
        });
        
        $(".transaksi_keluar").DataTable().clear().destroy();
        $(".transaksi_keluar").DataTable({
            ajax:{
                url     :"{{route('report_persediaan.detail_keluar')}}",
                type    :"GET",
                dataType:"JSON",
                data    :{kode_barang:kode_barang}
            },
            serverside:false,
            processing:false,
            info:false,
            paging:false,
            searching:false,
            ordering:false,
            footerCallback: function ( row, data, start, end, display ) {
                    var api = this.api(), data;
        
                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };
                    total_keluar = api
                    .column( 3, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
                    
                    // Update footer
                    $( api.column( 3 ).footer() ).html(new Intl.NumberFormat().format(total_keluar));
                },
            columns:[
                {data:"tgl_keluar"},
                {data:"ref_permintaan"},
                {data:"nama_pemakai"},
                {data:"barang_keluar"},
            ]
        });

        $("#formDetail").modal("show");

    });

    function filter_data(dari_tanggal, sampai_tanggal, user){
        $(".daftar_transaksi").DataTable().clear().destroy();
        $(".daftar_transaksi").DataTable({
            ajax:{
                url:"{{route('report_permintaan.filter_data')}}",
                type:"GET",
                data:{dari_tanggal:dari_tanggal, sampai_tanggal:sampai_tanggal, user:user}
            },
            serverside:false,
            processing:false,
            searching:false,
            ordering:false,
            drawCallback:function(){
                var sum = $('.daftar_transaksi').DataTable().column(3).data().sum();
                if(sum>0){
                    document.getElementById("print_simple").disabled=false;
                    document.getElementById("print_detail").disabled=false;
                }else{
                    document.getElementById("print_simple").disabled=true;
                    document.getElementById("print_detail").disabled=true;
                }

                document.getElementById("show_all").disabled=false;
            },
            columns:[
                {data:"ref_permintaan"},
                {data:"nama_pemakai"},
                {data:"tgl_diterima"},
                {data:"total_qty_dikeluarkan"},
            ]
        });
    }

    $('#dari_tanggal').datepicker({
        format          : "yyyy-mm-dd",
        autoclose       : true,
        todayHighlight  : true,
        weekStart       : 1,
        daysOfWeekHighlighted: "0,6"
    });

    $('#sampai_tanggal').datepicker({
        format          : "yyyy-mm-dd",
        autoclose       : true,
        todayHighlight  : true,
        weekStart       : 1,
        daysOfWeekHighlighted: "0,6"
    });

    $("body").on("click","#cari", function(){
        var user = $("#user").val();
        console.log(user);
        var dari_tanggal = $("#dari_tanggal").val();
        var sampai_tanggal = $("#sampai_tanggal").val();
        console.log(dari_tanggal);
        console.log(sampai_tanggal);
        if(dari_tanggal=="" || sampai_tanggal==""){
            alert("Masukan tanggal");
        }else{
            filter_data(dari_tanggal, sampai_tanggal, user);
        }
        
    });

    $("body").on("click","#show_all",function(){
        $(".daftar_transaksi").DataTable().clear().destroy();
        show_all();
        document.getElementById("show_all").disabled=true;
        document.getElementById("print_simple").disabled=true;
        document.getElementById("print_detail").disabled=true;
        $("#dari_tanggal").val("");
        $("#sampai_tanggal").val("");
    });

    $("body").on("click","print_simple",function(){
        console.log("print simple");
    });

    $("body").on("click","#print_simple",function(){
        var dari_tanggal = $("#dari_tanggal").val();
        var sampai_tanggal = $("#sampai_tanggal").val();
        window.open("pemesanan_barang/"+dari_tanggal+"/"+sampai_tanggal
        +"/print_simple");
    });

    $("body").on("click","#print_detail",function(){
        var dari_tanggal = $("#dari_tanggal").val();
        var sampai_tanggal = $("#sampai_tanggal").val();
        var user = $("#user").val();
        window.open("permintaan_barang/"+dari_tanggal+"/"+sampai_tanggal
        +"/"+user+"/print_detail");
    });
});
</script>
@endpush