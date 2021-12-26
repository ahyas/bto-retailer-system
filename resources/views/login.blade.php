<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel = "icon" href ="{{asset('public/logo/image.png')}}" type = "image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style type="text/css">
body {
        height: 100%;
        margin: 0;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-image: linear-gradient(#b1ccea, #98b8df, #638dc9);
    }

.form-control {
	
	box-shadow: none !important;
	border: transparent;
}
.form-control:focus {
	background: #e2e2e2;
}
.form-control, .btn {        
	border-radius: 2px;
}
.login-form {
    border: 2px solid #e8c248;
    border-radius: 25px;
    background-image: linear-gradient(#557cb1, #557cb1);
    left:65%;
	width: 500px;
	position: absolute;
    top: 25%;
    -ms-transform: translateX(-50%);
    transform: translateX(-50%);
}

.login-form form {
	color: white;
	border-radius: 3px;
	padding: 30px;
}
.login-form .btn {        
	font-size: 16px;
	font-weight: bold;
	background: #3598dc;
	border: none;
	outline: none !important;
}
.login-form .btn:hover, .login-form .btn:focus {
	background: #2389cd;
}
.login-form a {
    
	color: #fff;
	text-decoration: underline;
}
.login-form a:hover {
	text-decoration: none;
}
.login-form form a {
	color: #7a7a7a;
	text-decoration: none;
}
.login-form form a:hover {
	text-decoration: underline;
}

.footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        padding-top:5px;
        font-size:14px;
        height:30px;
        background-color: #bfdbff;
        color: #0a4293;
        text-align: center;
        background-image: linear-gradient(#a9d0fb, #7aa4ce);
        font-weight:600;
        border-top: 1px solid #577fb3;
    }

.inventory {
    border-radius: 25px 0 0 25px;
	position: absolute;
    -ms-transform: translateX(-50%);
    transform: translateX(-50%);
}

.broom {
    margin-top:32%;
	position: absolute;
    left:95%;
    
}

.wrapper {
    position: relative;
    width: 100%;
    
}

.fixed {
    width:810px;
    
    display: block;
    position: fixed;
    background-color: #000;
    top:30%;
    left:33%;
}

</style>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-light shadow-sm" style="background-image: linear-gradient(#c7d9ed, #b4c7e7, #c7d9ed); border-bottom: 1px solid #577fb3">
            
                <img src="{{asset('public/logo/logo.png')}}" class="d-inline-block align-top" alt="" style="width:75px; display: block; float:left; margin-right:15px;"><div style="font-size:25px; margin-top:0; color:#0a4293; line-height:27px"><b>MAHKAMAH AGUNG REPUBLIK INDONESIA<br>Pengadilan Agama Kaimana</b><br><p style="font-size:17px">Kompleks Stadion Triton, Utarom, Kaimana.</p></div>

</nav>

<div class="card bg-light mb-3" style="width: 350px; float:right; margin-right:20px; margin-top:20px; ">
  <div class="card-header" style="background-image: linear-gradient(#c7d9ed, #b4c7e7, #c7d9ed); color:#0a4293;"><b>Change log</b></div>
  <div class="card-body" style="border:5px #c7d9ed solid; padding-right:5px">
    <div style="max-height: 500px; overflow: auto; font-size:14px;">
    
        <h6 class="card-subtitle mb-2"><span class="badge badge-warning" style="font-size:15px; margin-top:10px; margin-bottom:10px;">versi 1.1.</span><b> - current version</b></h6>
        <h6 class="card-subtitle mb-2 text-muted">05 November 2021 </h6>
        <h6 class="card-subtitle mb-2 text-muted">Release notes: </h6>
        <ul>
            <li>Penambahan fitur penilaian/rating pengguna.</li>
            <li>Perbaikan modul Kategori barang.</li>      
            <li>Update stock gudang dan penambahan barang yang belum terdaftar.</li>  
            <li>Perbaikan tampilan report persediaan, permintaan dan pemesanan.</li>
            <li>Penambahan fitur grafik pada halaman dashboard.</li>
            <li>Penambahan fitur nomor bukti pembelian/nota pada modul pemesanan barang.</li>
            <li>Peningkatan fitur keamanan yang mencegah admin menghapus/mengedit barang yang sudah di transaksikan.</li>
        </ul> 

        <h6 class="card-subtitle mb-2"><span class="badge badge-warning" style="font-size:15px; margin-top:10px; margin-bottom:10px;">versi 1.0.</span></h6>
        <h6 class="card-subtitle mb-2 text-muted">07 Oktober 2021 </h6>
        <h6 class="card-subtitle mb-2 text-muted">Release notes: </h6>
        <ul>
            <li>Initial release</li>
            <li>Peresmian aplikasi oleh ketua PTA Jayapura, <b>Drs. H. Sudirman. S., S.H., M.H.</b></li>        
        </ul>     
    </div>
  </div>
</div>

<div class="wrapper">
    <div class="fixed">

    <div class="inventory">    
    <img src="{{asset('public/image/inventory2.png')}}" style="width:553px">
    </div>    

    <div class="login-form">
        <div style="margin-left:30px; margin-top:25px;">
            
            <img src="{{asset('public/logo/image.png')}}" style="width:120px; display: block; float:left; margin-right:25px;"/>

            <div style="color:white">
                <div style="font-size:35px; font-weight:bold">SIMBA <span class="badge badge-warning" style="font-size:20px; padding-left:10px;padding-right:10px;">versi 1.1.</span></div>
                <p style="font-size:20px; font-weight:bold">Sistem Informasi Manajemen Persediaan Barang</p>
            </div>
        </div>
                <form action="{{ route('login') }}" method="post">
                @csrf
                    @if(session('errors'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Ups!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    @if (Session::has('error'))
                        <div class="alert alert-danger">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    <div class="form-group">
                        <label for=""><strong>Username :</strong></label>
                        <input type="text" name="username" class="form-control" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for=""><strong>Password :</strong></label>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>

                    <button type="submit" class="btn btn-primary btn-block" style="background-color:orange">Log In</button>
                
                </form>
            </div>
    </div>   
</div>

            <div class="footer">
            <p>Copyright &copy; Pengadilan Agama Kaimana. Kompleks Stadion Bantemi, Utarom, Kaimana.</p>
            </div>
</body>
</html>