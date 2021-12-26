@extends('layout/app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jenis Barang</title>
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
    .fx{
        border:1px solid grey;  
        font-size:13px;
    }

    label{
        font-size:13px;
    }

</style>

    <div class="container">
        <div class="col-md-5 mt-5">
            <div class="card" style="border:1px solid #9bbbe3; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                <div class="card-header" style="background-image: linear-gradient(#d0e2f8, #e2ecfb); height: 30px; line-height: 6px; font-size: 13px; border-top: 1px white solid">
                    <p style="line-height: 0; color:#0a4293; font-weight:normal; font-size:14px; font-weight:600;">Jenis barang</p>
                </div>
                <div class="card-body" style="background-color:#f0f0f0; font-size:13px;">
                <a href="javascript:void(0)" class="btn btn-success btn-sm add" >Add</a>
                    <table class="tb_jenis display table-sm" style="font-size:13px; border:1px solid #9c9a9a;" width="100%">
                        <thead style="background-image: linear-gradient(#ecf6f8, #d7dfe1); line-height:3px;">
                            <tr>
                                <td>Kode</td>
                                <td>Keterangan</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                            <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="formJenisbarang" aria-hidden="true" style="overflow: hidden;" data-backdrop="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;">
            <div class="modal-header bg-info text-white" style="background-image: linear-gradient(#d0e2f8, #e2ecfb); height: 30px; line-height: 6px; font-size: 13px; border-top: 1px white solid">
                <p id="addHeading" style="line-height: 0; color:#0a4293; font-weight:normal; font-size:14px; font-weight:600;"></p><button style="line-height: 0; background-color:red; border-radius:3px;" type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="color:white">&times;</span></button>
            </div>
            <div class="modal-body" style="background-color:white; border-left:6px solid #e2ecfb; border-right:6px solid #e2ecfb; border-bottom:6px solid #e2ecfb; font-size:13px">
                <form id="myform" class="form-horizontal">

                    {{csrf_field()}} {{method_field('POST')}}
                    <input type="hidden" class="form-control form-control-sm id" id="id" name="id" >
                    <div class="form-group">
                        <label style="padding-top: 0" class="col-sm-6 control-label">Kode : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-sm kode fx" id="kode" name="kode" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label style="padding-top: 0" class="col-sm-6 control-label">Keterangan : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-sm keterangan fx" id="keterangan" name="keterangan" >
                        </div>
                    </div>

                    <div class="modal-footer" style="font-size:11px; display:inline-block;">

                        <button type="submit" class="btn btn-primary btn-sm" id="saveBtn">Save</button>

                        <button type="submit" class="btn btn-primary btn-sm" id="updateBtn">Update</button>
                        
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</html>
@endsection

@push('scripts')
<script type="text/javascript">
$(document).ready(function(){
    $(".tb_jenis").DataTable({
        ajax: "{{route('jenis_barang.show_data')}}",
        processing: false,
        ordering:false,
        bPaginate: false,
        serverSide: false,
        columns:[
            {data:"kode"},
            {data:"keterangan"},
            {data:"id",
                mRender: function(data){
                    return'<a href="javascript:void(0)" data-id='+data+' class="btn btn-warning btn-sm edit">Edit</a> <a href="javascript:void(0)" data-id='+data+' class="btn btn-danger btn-sm delete">Delete</a>';
                }
            }
        ]
    });

    $("body").on("click", ".add", function(){
        document.getElementById("addHeading").innerHTML = "Tambah Jenis";
        document.getElementById("saveBtn").style.display = "inline-block";
        document.getElementById("updateBtn").style.display = "none";
        document.getElementById("kode").readOnly=false;
        $("#myform").trigger("reset");
        $("#formJenisbarang").modal("show");
    });

    $("body").on("click", ".delete", function(){
        console.log($(this).data("id"));
        var id = $(this).data("id");
        if(confirm("Yakin ingin menghapus data ini?")){
            $.ajax({
                type    :"GET",
                url     :"jenis_barang/"+id+"/delete",
                datatype:"JSON",
                success: function(data){
                    if(data=="data_exist"){
                        alert("Tidak bisa menghapus, data ini sudah pernah di transaksikan");
                        return false;
                    }
                    $(".tb_jenis").DataTable().ajax.reload();
                }
            });
        }
    });

    $("#saveBtn").click(function(e){
        e.preventDefault();
        $.ajax({
            type    :"POST",
            url     : "{{route('jenis_barang.save')}}",
            data    : $("#myform").serialize(),
            dataType:"JSON",
            success:function(data){
                if(data=="data_exist"){
                    alert("Kode barang sudah pernah dipakai.");
                    return false;
                }
                $(".tb_jenis").DataTable().ajax.reload();
                $("#formJenisbarang").modal("hide");
            }
        })
    });

    $("body").on("click", ".edit", function(){
        document.getElementById("addHeading").innerHTML = "Edit Jenis";
        document.getElementById("saveBtn").style.display = "none";
        document.getElementById("updateBtn").style.display = "inline-block";
        var id = $(this).data("id");
        document.getElementById("kode").readOnly=true;
        $.ajax({
            type    : "GET",
            url     : "jenis_barang/"+id+"/edit",
            dataType: "JSON",
            success:function(data){
                $("#id").val(id);
                $("#kode").val(data.kode);
                $("#keterangan").val(data.keterangan);
                $("#formJenisbarang").modal("show");
        }
        });
        
    });

    $("#updateBtn").click(function(e){
        e.preventDefault();
        var id = $("#id").val();
        var kode = $("#kode").val();
        var keterangan = $("#keterangan").val();
        $.ajax({
            type        : "GET",
            url         : "{{route('jenis_barang.update')}}",
            dataType    : "JSON",
            data        : {kode:kode, keterangan:keterangan, id:id},
            success     : function(data){
                $(".tb_jenis").DataTable().ajax.reload();
                $("#formJenisbarang").modal("hide");
            }
        });
    });

});
</script>
@endpush