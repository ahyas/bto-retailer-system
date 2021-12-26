<body style="font-size:13.5px; font-family: arial; ">
<h3>Pengadilan Agama Kaimana<br>
Nota Pengambilan Barang dari Gudang
</h3>
<table style="font-size: 13.5px; font-family: arial">
<tr>
    <td>Nama penerima</td>
    <td width="5px">:</td>
    <td><b>{{$pengguna->nama_pemakai}}</b></td>
</tr>
<tr>
    <td>Hari tanggal</td>
    <td>:</td>
    <td><b>{{$pengguna->tanggal_keluar}}</b></td>
</tr>
</table>

<table class="table" border="1" style="border-collapse:collapse; font-size: 13.5px; font-family: arial">
    <tr>
        <th>No</th>
        <th width="200px">Nama barang</th>
        <th>Jumlah</th>
        <th>Satuan</th>
    </tr>
    <?php $no=1; ?>
    @foreach($table as $row)
    <tr>
        <td>{{$no}}</td>
        <td>{{$row->nama_barang}}</td>
        <td>{{$row->qty}}</td>
        <td></td>
    </tr>
    <?php $no++; ?>
    @endforeach
</table>
</body>
<script type="text/javascript">
window.print();

</script>