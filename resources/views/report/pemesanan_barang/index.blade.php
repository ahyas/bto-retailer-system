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
                
                <div class="card-header"  style="background-image: linear-gradient(#d0e2f8, #e2ecfb); height: 30px; line-height: 6px; font-size: 13px; border-top: 1px white solid">
                    <p style="line-height: 0; color:#0a4293; font-weight:normal; font-size:14px; font-weight:600;">Report pemesanan barang</p>
                </div>
                <div class="card-body" style="background-color:#f0f0f0; font-size:13px;">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm">
                                <form autocomplete="off">
                                <label>Dari tanggal</label>
                                <input type="text" class="form-control form-control-sm fx dari_tanggal" id="dari_tanggal" style="margin-bottom:15px;" value="">
                                </form>
                            </div>
                            <div class="col-sm">
                                <form autocomplete="off">
                                <label>Sampai tanggal</label>
                                <input type="text" class="form-control form-control-sm fx sampai_tanggal" id="sampai_tanggal" style="margin-bottom:15px;" value="">
                                </form>
                            </div>
                            <div class="col-sm">
                                <button class="btn btn-primary btn-sm" style="margin-top:25px;" id="cari">Cari</button> <button class="btn btn-success btn-sm" style="margin-top:25px;" id="reset" disabled>Reset</button>
                            </div>
                            
                        </div>
                        <button class="btn btn-primary btn-sm" style="margin-bottom:15px;" id="print_simple" disabled>Print simple</button>
                        <button class="btn btn-primary btn-sm" style="margin-bottom:15px;" id="print_detail" disabled>Print detail</button>
                    </div>
                
                    <table class="display table-sm daftar_transaksi" style="font-size:13px; border:1px solid #9c9a9a;" width="100%">
                        <thead style="background-image: linear-gradient(#ecf6f8, #d7dfe1); line-height:3px;">
                            <tr>
                                <td>No. Referensi</td>
                                <td>Tanggal</td>
                                <td>Total item</td>
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
    filter_data(null, null, null);

    function filter_data(dari_tanggal, sampai_tanggal){
        $(".daftar_transaksi").DataTable().clear().destroy();
        $(".daftar_transaksi").DataTable({
            ajax:{
                "url":"{{route('report_pemesanan.filter_data')}}",
                "type":"GET",
                "data":{dari_tanggal:dari_tanggal, sampai_tanggal:sampai_tanggal}
            },
            serverside:false,
            processing:false,
            searching:false,
            ordering:false,
            drawCallback:function(){
                var sum = $('.daftar_transaksi').DataTable().column(2).data().sum();
                if(sum>0){
                    document.getElementById("print_simple").disabled=false;
                    document.getElementById("print_detail").disabled=false;
                }else{
                    document.getElementById("print_simple").disabled=true;
                    document.getElementById("print_detail").disabled=true;
                }

                document.getElementById("reset").disabled=false;
            },
            columns:[
                {data:"ref_pemesanan"},
                {data:"tgl_diterima"},
                {data:"total_qty_diterima"},
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
        var dari_tanggal = $("#dari_tanggal").val();
        var sampai_tanggal = $("#sampai_tanggal").val();
        if(dari_tanggal=="" || sampai_tanggal==""){
            alert("Masukan tanggal");
        }else{
            if(dari_tanggal>sampai_tanggal){
                alert("Tanggal salah");
                return false;
            }
            filter_data(dari_tanggal, sampai_tanggal);
        }
    });

    $("body").on("click","#reset",function(){
        $(".daftar_transaksi").DataTable().clear().destroy();
        filter_data(null, null, null);
        document.getElementById("reset").disabled=true;
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
        window.open("pemesanan_barang/"+dari_tanggal+"/"+sampai_tanggal
        +"/print_detail");
    });
});
</script>
@endpush