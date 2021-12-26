@extends('layout/app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan stock opname</title>
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
</style>
<body>
    <div class="container">
        <div class="col-md-12 mt-5">
            <div class="card" style="border:1px solid #9bbbe3; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                <div class="card-header" style="background-image: linear-gradient(#d0e2f8, #e2ecfb); height: 30px; line-height: 6px; font-size: 13px; border-top: 1px white solid">
                    <p style="line-height: 0; color:#0a4293; font-weight:normal; font-size:14px; font-weight:600;">Riwayat stock opname</p>
                </div>
                <div class="card-body" style="background-color:#f0f0f0; font-size:13px;">
                
                    <table class="display report" style="font-size:13px; border:1px solid #9c9a9a;">
                        <thead style="background-image: linear-gradient(#ecf6f8, #d7dfe1); line-height:3px;">
                            <tr>
                                <td width="95px">No. Ref.</td>
                                <td width="100px">Nama</td>
                                <td>Tgl. permintaan</td>
                                <td>Tgl. diterima</td>
                                <td>Penilaian</td>
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
@endsection

@push('scripts')
<script type="text/javascript">
    $(".report").DataTable({
        ajax:"{{route('report_stock.show_data')}}",
        processing:false,
        serverside:false,
        columns:[
            {data:"no_ref"},
            {data:"tanggal"},
            {data:"tot_qty_sistem"},
            {data:"tot_qty_gudang"},
            {data:"tot_selisih"},
            {data:"no_ref",
                mRender:function(data){
                    return"<button class='btn btn-primary btn-sm print' data-no_ref='"+data+"'>Print</button>";
                }
            }
        ]
    });

    $("body").on("click",".print",function(){
        let no_ref =  $(this).data("no_ref");
        window.open("stock_opname/"+no_ref+"/print");
    });
</script>
@endpush