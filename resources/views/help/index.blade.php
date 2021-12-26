@extends('layout/app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Petunjuk penggunaan</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<style type="text/css">
    p{
        font-size: 14px;
    }
</style>

</head>
<body>
<div class="container">
        <div class="col-md-12 mt-5">
            <div class="card" style="border:1px solid #9bbbe3; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                <div class="card-header" style="background-image: linear-gradient(#d0e2f8, #e2ecfb); height: 30px; line-height: 6px; font-size: 13px; border-top: 1px white solid">
                    <p style="line-height: 0; color:#0a4293; font-weight:normal; font-size:14px; font-weight:600;">Petunjuk penggunaan</p>
                </div>
                <div class="card-body" style="font-size:13px; margin-left:20px; margin-right:20px">
                <h3 style="font-weight:bold">PETUNJUK PENGGUNAAN APLIKASI SIMBA</h3>

<p>Aplikasi SIMBA (Sistem Informasi Manajemen Barang Persediaan) merupakan inovasi dari Pengadilan Agama Kaimana yang bertujuan untuk membantu Kasubag Umum dan Keuangan dalam melakukan distribusi barang-barang persediaan dan ATK. Sebelumnya proses distribusi barang persediaan dilakukan sepenuhnya oleh Kasubag Umum dan keuangan. Hal ini dikarenakan masih menggunakan aplikasi terpusat dari kementerian keuangan sehingga proses pencatatan barang masuk dan keluar hanya bisa dilakukan oleh Admin. Dengan adanya aplikasi SIMBA, maka dimungkinkan setiap pegawai/user di Pengadilan Agama Kaimana dapat melakukan permintaan barang secara mandiri.</p>

<p>Dengan menerapkan sistem desentralisasi semacam itu, maka user diharapkan dapat lebih terlibat langsung dalam proses permintaan dan pendistribusian barang. Adapun admin gudang yang berada di bidang kesekretariatan bertugas untuk memverifikasi permintaan dan mengantarkan barang yang diminta.</p>

<p>Aplikasi SIMBA mengadopsi proses bisnis dari aplikasi-aplikasi ecommerce yang sering sekali kita gunakan seperti Tokopedia atau Bukalapak. Dengan mengadopsi proses bisnis yang sudah familiar maka diharapkan aplikasi SIMBA ini dapat lebih mudah digunakan oleh user.</p>  

<h4 style="font-weight:bold">Admin gudang</h4>
<p>Admin gudang adalah orang yang bertanggung jawab untuk mengelola barang persediaan serta me-monitoring dan memilah barang yang sudah rusak/kehabisan stock. Peran admin gudang juga meliputi proses pemesanan dan pendistribusian barang kepada user. Adapun Admin gudang memiliki peran sebagai berikut:</p>

<h5>Validasi permintaan barang.</h5>
<p>Daftar permintaan yang telah diajukan oleh setiap user akan ditampilkan ke dalam satu tabel. Dari sini admin gudang dapat memonitoring dan memvalidasi permintaan-permintaan barang dari user.</p>

<p>Agar proses validasi barang dapat lebih presisi, maka dapat digunakan perangkat barcode scanner untuk memastikan bahwa barang yang diambil dari gudang sama dengan barang yang diminta oleh user.</p>

<h5>Pemesanan barang.</h5>
<p>Proses pemesanan barang biasanya dilakukan setelah melihat salah satu dari kondisi berikut: 1) Stock barang yang sudah habis/menipis, 2) Barang yang belum di list kedalam database namun diperlukan untuk operasional kantor.</p>

<p>Proses pemesanan barang masih dilakukan secara manual dikarenakan belum ada kerjasama dengan penyedia barang pihak ketiga. Sehingga setelah daftar pemesanan barang dibuat maka ada satu orang yang ditugaskan untuk berbelanja barang sesuai dengan daftar pemesanan yang telah dibuat tersebut</p>   

<h5>Stock opname.</h5>
<p>Proses stock opname dilakukan secara berkala untuk memeriksa jumlah aktual barang yang ada di gudang dengan yang ada di aplikasi. Saat melakukan stock opname, aktivitas transaksi pemesanan dan permintaan untuk sementara dihentikan. Hal ini bertujuan agar proses perhitungan barang dapat lebih optimal.</p>

<p>Setelah proses penghitungan barang selesai, maka perlu dibuat berita acara stock opname yang ditandatangani oleh Admin gudang dan Kasubag umum dan keuangan.</p>

<h4 style="font-weight:bold">User biasa</h5>
<p>User biasa atau End user adalah seluruh pegawai yang ada di lingkungan Pengadilan Agama Kaimana yang menggunakan secara langsung barang persediaan/ATK untuk menunjang aktivitas pekerjaan. Sebelum dapat menggunakan, maka perlu dilakukan proses permintaan barang terlebih dahulu yang bisa dilakukan secara mandiri melalui aplikasi SIMBA.</p>
 
<h5>Permintaan barang.</h5>
<p>Setiap user dapat masuk kedalam aplikasi SIMBA menggunakan user account yang telah diberikan oleh admin gudang. Setelah masuk kedalam aplikasi, user dapat menambahkan transaksi permintaan barang.</p>

<p>Daftar barang yang ditampilkan pada menu transaksi permintaan adalah barang-barang yang memiliki stok di gudang. User dapat memilih barang apa yang dibutuhkan dan memasukan jumlah quantity.</p>

<p>Setelah selesai memasukan barang kedalam daftar transaksi, maka user menunggu proses validasi dari admin gudang. Setelah itu admin gudang akan melakukan pencocokan barang yang diminta dengan aktual barang yang ada di gudang. User hanya perlu menunggu sampai barang diantarkan oleh admin gudang.</p>

<p>Setelah barang diterima oleh user, maka jangan lupa untuk melakukan konfirmasi penerimaan barang dan memberikan penilaian terhadap kualitas dari pelayanan yang didapatkan. Ada 4 level penilaian yang bisa diberikan oleh user: Sangat puas, Puas, Kurang puas dan Tidak Puas.</p>
                   
                </div>
            </div>
        </div>
    </div>
</body>
</html>
@endsection()