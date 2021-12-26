@extends('layout/app')
@section('content')
<?php
$dataPoints = array();
    foreach($table as $row){
        array_push($dataPoints, 
        array("y"=> $row->total_qty_dikeluarkan, "label"=> $row->nama_pemakai));
    }
?>
<!DOCTYPE HTML>
<html>
<head>
<style type="text/css">
table tr td:last-child {
        white-space: nowrap;
        width: 1px;
    }
</style>
<script type="text/javascript">

window.onload = function() {
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title: {
		text: "Tingkat konsumsi barang per pegawai"
	},
	data: 
    [{
		type            : "pie",
		startAngle      : 240,
		yValueFormatString  : "##0.00\"%\"",
		indexLabel      : "{label} {y}",
		dataPoints      : <?php echo json_encode($dataPoints); ?>
	}]
});
chart.render();

}
</script>
</head>

<body>
    <div class="container">
        <div class="col-md-12 mt-5">
            <div class="card" style="border:1px solid #9bbbe3; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                <div class="card-header" style="background-image: linear-gradient(#d0e2f8, #e2ecfb); height: 30px; line-height: 6px; font-size: 13px; border-top: 1px white solid">
                <p style="line-height: 0; color:#0a4293; font-weight:normal; font-size:14px; font-weight:600;">Dashboard</p>
                </div>
                <div class="card-body" style="background-color:#f0f0f0; font-size:13px;">
                    <p>Selamat datang di halaman dashboard, <strong>{{ Auth::user()->name }}</strong></p>
                    @if(Auth::user()->role==1)
                        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                    @else
                        <p>Berikut ini adalah status permintaan barang Anda. Untuk lebih detail silahkan masuk ke halaman <b>permintaan barang.</b></p>
                        <table class="table table-striped" style="background-color:white" border="1px">
                            <thead>
                            <tr>
                                <th>No. Referensi</th>
                                <th>Tanggal permintaan</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            @foreach($riwayat_permintaan as $row)
                            <tr>
                                <td>{{$row->ref_permintaan}}</td>
                                <td>{{$row->tanggal}}</td>
                                <td>
                                    @if($row->id_status==1)
                                    <span class="badge badge-warning" style="padding-left:10px;padding-right:10px;">{{$row->status}}</span>
                                    @elseif($row->id_status==2)
                                    <span class="badge badge-success" style="padding-left:10px;padding-right:10px;">{{$row->status}}</span>
                                    @elseif($row->id_status==3)
                                    <span class="badge badge-info" style="padding-left:10px;padding-right:10px;">{{$row->status}}</span>
                                    @elseif($row->id_status==4)
                                    <span class="badge badge-danger" style="padding-left:10px;padding-right:10px;">{{$row->status}}</span>
                                    @elseif($row->id_status==5)
                                    <span class="badge badge-secondary" style="padding-left:10px;padding-right:10px;">{{$row->status}}</span>
                                    @elseif($row->id_status==6)
                                    <span class="badge badge-light" style="padding-left:10px;padding-right:10px;">{{$row->status}}</span>
                                    @elseif($row->id_status==7)
                                    <span class="badge badge-dark" style="padding-left:10px;padding-right:10px;">{{$row->status}}</span>
                                    @else
                                    <span class="badge badge-primary" style="padding-left:10px;padding-right:10px;">{{$row->status}}</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>
@endsection     

@push('script')
<script type="text/javascript">

</script>
@endpush