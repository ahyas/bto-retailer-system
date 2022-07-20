@extends('layout/app')
@section('content')

        <div class="col-md-6">
            <div class="card" id="card">
                <div class="card-header" id="card-header"><span id="header-title">Change current password</span></div>
   
                <div class="card-body" id="card-body">
                    <div class="form-horizontal" style="margin-bottom:15px">
                        <form id="form_ubah_password" method="POST">
                            @csrf 
    
                            @foreach ($errors->all() as $error)
                                <p class="text-danger">{{ $error }}</p>
                            @endforeach 
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Username </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control form-control-sm" name="username" value="{{$table->username}}" readOnly>
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right control-label">Current Password </label>
    
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control form-control-sm" name="current_password" autocomplete="off">
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right control-label">New Password </label>
    
                                <div class="col-md-6">
                                    <input id="new_password" type="password" class="form-control form-control-sm" name="new_password" autocomplete="off">
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right control-label"> Confirm New Password </label>
        
                                <div class="col-md-6">
                                    <input id="new_confirm_password" type="password" class="form-control form-control-sm" name="new_confirm_password">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-sm update_password">
                                    Update Password
                                </button>
                                <button class="btn btn-sm reset_password">
                                    Reset
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@include('crud/notification/index')
@endsection
@push('scripts')
<script type="text/JavaScript">
    
    $(document).ready(function(){
        var success = new Audio("{{asset('public/sound/chime2.wav')}}");
        var warning = new Audio("{{asset('public/sound/chime.wav')}}");

        $("body").on("click",".update_password",function(e){
            e.preventDefault();
            let current_password = $("#password").val();
            let new_password = $("#new_password").val();
            let confirm_new_password=$("#new_confirm_password").val(); 
            
            if(current_password=="" || new_password=="" || confirm_new_password==""){
                warning.play();
                alert("Oops! Please fill in all data.");
            }else{
                if(new_password!=confirm_new_password){
                    warning.play();
                    alert("Oops! New password and confirmation mismatch!");
                    $("#new_password").val("");
                    $("#new_confirm_password").val("");
                    $("#new_password").focus();
                }else{
                    $.ajax({
                        url:"{{ route('crud.change_password.update') }}",
                        type:"POST",
                        data:$("#form_ubah_password").serialize(),
                        success:function(data){
                            console.log(data);
                            if(data==1){
                                warning.play();
                                alert("Current password incorrect!");
                                $("#password").val("");
                                $("#password").focus();
                            }else{
                                popupMsg("Your password successfuly changed!!<br>Please re-login with your new password.");
                            }
                        }
                    });
                }
            }
        });

        $("body").on("click",".reset_password",function(e){
            e.preventDefault();
            $("#password").val("");
            $("#new_password").val("");
            $("#new_confirm_password").val("");
        });

        $("#alertOK").on('hide.bs.modal', function(){
            window.open("{{route('login')}}","_self");
        });

        function popupMsg(msg){
            setTimeout(function(){
                success.play();
                $("#alertOK").modal("show");
                document.getElementById("alertMsg").innerHTML = msg;
            },500);
        }
        
    });
</script>
@endpush