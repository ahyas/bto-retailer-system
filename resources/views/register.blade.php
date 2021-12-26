@extends('layout/app')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    
</head>
<style type="text/css">

    label{
        font-size:13px;
    }

</style>
<body>
    <div class="container">
        <div class="col-md-5 mt-5">
            <div class="card" style="border:1px solid #9bbbe3; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                <div class="card-header" style="background-image: linear-gradient(#d0e2f8, #e2ecfb); height: 30px; line-height: 6px; font-size: 13px; border-top: 1px white solid">
                    <p style="line-height: 0; color:#0a4293; font-weight:normal; font-size:14px; font-weight:600;">Registrasi pegawai baru</p>
                </div>
                <div class="card-body" style="background-color:#f0f0f0; font-size:13px;">
                <p>Anda dapat menambahkan pegawai yang belum terdaftar pada aplikasi SIMBA sebagai user baru.</p>
                <form action="{{ route('register') }}" method="post">
                @csrf
                    @if(session('errors'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Something it's wrong:
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
                    <div class="form-group">
                        <label style="padding-top: 0" class="control-label">Nama lengkap</label>
                        
                            <input type="text" name="name" class="form-control" placeholder="Nama Lengkap">
                        
                    </div>

                    <div class="form-group">
                        <label style="padding-top: 0" class="control-label">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Username">

                    </div>

                    <div class="form-group">
                        <label style="padding-top: 0" class="control-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>

                    <div class="form-group">
                    <label style="padding-top: 0" class="control-label">Konfirmasi password</label>
                    
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Password">

                    </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm">Register</button>
                </div>
                </form>
            </div>
            </div>
        </div>
    </div>
</body>
</html>
@endsection 