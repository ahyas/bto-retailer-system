<head>
    <style type="text/css" rel="stylesheet">
        .invoice-title{
        margin-left: 20px;
    }

    .invoice-title h3 {
        margin-left: 30px;
        margin-bottom: 10px;
        margin-top: 0px;
    }

    .invoice-title h2 {
        margin-left: 30px;
        margin-bottom: 0px;
        margin-top: 0px;
    }

    .invoice-title h1 {
        margin-left: 30px;
        margin-bottom: 0px;
        margin-top: 0px;
    }

    .invoice-title p { 
        margin-left: 30px;
        margin-bottom: 5px;
        margin-top: 0px;
    }

    .invoice-title img {
        margin-left: 10px;
        position: absolute;
        filter: grayscale(100%);
        left: 0px;
        right: 0px;
        width: 80px;
    }

    #arsh {
        white-space: pre-wrap;
    }

    hr.style2 {
        border-top      : 5px double #8c8b8b;
        margin-top     : 0px;
        margin-bottom  : 0px;
    }

    </style>
</head>

<div style="font-family:Helvetica" class="invoice-title" align="center"><img src="{{asset('public/logo/2ipzlvx.png')}}" alt="logo" />

<h1>PENGADILAN AGAMA KAIMANA</h1>
<!--<h2>BADAN KEPEGAWAIAN PENDIDIKAN DAN <br>PELATIHAN DAERAH</h2>-->
<p style="font-size:14px; color:#404040;">KOMPLEK STADION TRITON, JL. UTARUM BANTEMI, KAIMANA<br>
<i>Website: www.pa-kaimana.go.id / Email: pa.kaimana2018@gmail.com / Telp.: (0957) 2225747</i><br>
<h3>KAIMANA - PAPUA BARAT 98654</h3>
</div>
<hr class="style2">

<h2>Laporan permintaan barang</h2>
<p>Dari tanggal: {{$dari_tanggal}} Sampai tanggal: {{$sampai_tanggal}}</p>
<table border="1" style="border-collapse:collapse">
    <tr>
        <td><b>No. Referensi</b></td>
        <td><b>Nama</b></td>
        <td><b>Tanggal</b></td>
        <td><b>Total item</b></td>
    </tr>
@foreach($table as $row)
    <tr>
        <td>{{$row->ref_permintaan}}</td>
        <td>{{$row->nama_pemakai}}</td>
        <td>{{$row->tgl_diterima}}</td>
        <td>{{$row->total_qty_dikeluarkan}}</td>
    </tr>
@endforeach
</table>

<script type="text/javascript">
window.print();
</script>