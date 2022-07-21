<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel = "icon" href ="{{asset('public/logo/image2.png')}}" type = "image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('public/style/layout.css')}}">
    <style type="text/css">

</style>
</head>
<body>

<div class="wrapper">
    <div class="login-form">
        <div style="margin-left:30px; margin-top:25px;">
            
            <div style="color:white">
            <img src="{{asset('public/logo/image.png')}}" style="width:120px; display: block; float:left; margin-right:25px;"/>
                <div style="font-size:40px; font-weight:bold; line-height:30px; color:#ffe88e">Back to Office<br><span style="font-size:25px;"> Admin Panel v1.0</span></div>
                <p style="font-size:20  px; line-height:20px; padding-top:10px;">General purpose CRUD Management System </p>
            </div>
        </div>
        <br>
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

                <button type="submit" class="btn btn-sm btn-block" id="bto-button" style="height:35px; font-weight:normal">Log In</button>
            
            </form>
        </div>
</div>
</body>
</html>