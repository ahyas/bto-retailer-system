@extends('layout/app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kategori Barang</title>
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
<body style="background-color:#ececec">
    <div class="container">
        <div class="col-md-12 mt-5">
            <div class="card" style="border:1px solid #9bbbe3; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                <div class="card-header" style="background-image: linear-gradient(#d0e2f8, #e2ecfb); height: 30px; line-height: 6px; font-size: 13px; border-top: 1px white solid">
                    <p style="line-height: 0; color:#0a4293; font-weight:normal; font-size:14px; font-weight:600;">Kategori Barang</p>
                </div>
                <div class="card-body" style="background-color:#f0f0f0; font-size:13px;">
                <a href="javascript:void(0)" class="btn btn-success btn-sm add" style="margin-bottom:15px">Add</a>
                    <table class="tb_kategori display table-sm" style="font-size:13px; border:1px solid #9c9a9a;" width="100%">
                        <thead style="background-image: linear-gradient(#ecf6f8, #d7dfe1); line-height:3px;">
                            <tr>
                                <td>Kode</td>
                                <td>Jenis</td>
                                <td>Kategoti</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                            <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="formKategoriBarang" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;">
            <div class="modal-header bg-info text-white" style="background-image: linear-gradient(#d0e2f8, #e2ecfb); height: 30px; line-height: 6px; font-size: 13px; border-top: 1px white solid">
                <p id="addHeading" style="line-height: 0; color:#0a4293; font-weight:normal; font-size:14px; font-weight:600;"></p><button style="line-height: 0; background-color:red; border-radius:3px;" type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="color:white">&times;</span></button>
            </div>
            <div class="modal-body" style="background-color:white; border-left:6px solid #e2ecfb; border-right:6px solid #e2ecfb; border-bottom:6px solid #e2ecfb; font-size:13px">
                <form id="myform" class="form-horizontal">

                    {{csrf_field()}} {{method_field('POST')}}
                    <input type="hidden" class="form-control form-control-sm kode" id="id" name="id" >

                    <div class="form-group">
                        <label style="padding-top: 0" class="col-sm-6 control-label">Kode : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-sm fx kode_kategori" id="kode_kategori" name="kode_kategori" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label style="padding-top: 0" class="col-sm-6 control-label">Keterangan : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-sm fx keterangan" id="keterangan" name="keterangan" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label style="padding-top: 0" class="col-sm-6 control-label">Jenis : </label>
                        <div class="col-sm-10">
                            <select class="form-control form-control-sm fx kode_jenis" id="kode_jenis" name="kode_jenis">
                                <option value="">Pilih jenis</option>
                                @foreach($jenis as $row)
                                <option value="{{$row->kode}}">{{$row->jenis}}</option>
                                @endforeach
                            </select>
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

</body>
</html>
@endsection

@push('scripts')
<script type="text/javascript">
$(document).ready(function(){
    $(".tb_kategori").DataTable({
        ajax: "{{route('kategori_barang.show_data')}}",
        processing: false,
        ordering:false,
        serverSide: false,
        columns:[
            {data:"kode_kategori"},
            {data:"nama_jenis"},
            {data:"nama_kategori"},
            {data:"id",
                mRender: function(data){
                    return'<a href="javascript:void(0)" data-id='+data+' class="btn btn-warning btn-sm edit">Edit</a> <a href="javascript:void(0)" data-id='+data+' class="btn btn-danger btn-sm delete">Delete</a>';
                }
            }
        ]
    });

    $("body").on("click", ".add", function(){
        document.getElementById("addHeading").innerHTML = "Tambah Kategori";
        document.getElementById("saveBtn").style.display = "inline-block";
        document.getElementById("kode_kategori").readOnly = false;
        document.getElementById("updateBtn").style.display = "none";
        $("#myform").trigger("reset");
        $("#formKategoriBarang").modal("show");
    });

    $("body").on("click", ".delete", function(){
        console.log($(this).data("id"));
        var id = $(this).data("id");
        if(confirm("Yakin ingin menghapus data ini?")){
        $.ajax({
            type    :"GET",
            url     :"kategori_barang/"+id+"/delete",
            datatype:"JSON",
            success: function(data){
                console.log("data "+data);
                if(data=="exist"){
                    alert("Tidak dapat menghapus. Data ini sudah pernah di transaksikan.");
                    return false;
                }
                    $(".tb_kategori").DataTable().ajax.reload();
                
            }
        });
        }
    });

    $("#saveBtn").click(function(e){
        e.preventDefault();
        var kode_jenis = $("#kode_jenis").val();
        var kode_kategori = $("#kode_kategori").val(); 
        var nama_kategori = $("#keterangan").val();
        $.ajax({
            type    : "GET",
            url     : "{{route('kategori_barang.save')}}",
            data    : {kode_kategori:kode_kategori, nama_kategori:nama_kategori, kode_jenis:kode_jenis},
            dataType: "JSON",
            success:function(data){
                if(data==0){
                    alert("Kode sudah pernah dipakai, gunakan kode yang lain")
                }else{
                    $(".tb_kategori").DataTable().ajax.reload();
                    $("#formKategoriBarang").modal("hide");
                }
            }
        });
    });

    $("body").on("click", ".edit", function(){
        document.getElementById("addHeading").innerHTML = "Edit Kategori";
        document.getElementById("kode_kategori").readOnly = true;
        document.getElementById("saveBtn").style.display = "none";
        document.getElementById("updateBtn").style.display = "inline-block";
        var id = $(this).data("id");

        $.ajax({
            type    : "GET",
            url     : "kategori_barang/"+id+"/edit",
            dataType: "JSON",
            success:function(data){
                $("#id").val(id);
                $("#kode_jenis").val(data.kode_jenis);
                $("#kode_kategori").val(data.kode);
                $("#keterangan").val(data.keterangan);
                $("#formKategoriBarang").modal("show");
        }
        });
        
    });

    $("#updateBtn").click(function(e){
        e.preventDefault();
        var kode_kategori = $("#kode_kategori").val(); 
        var nama_kategori = $("#keterangan").val();
        var kode_jenis = $("#kode_jenis").val();
        var id = $("#id").val();
        
        $.ajax({
            type        : "GET",
            url         : "{{route('kategori_barang.update')}}",
            dataType    : "JSON",
            data        : {kode_kategori:kode_kategori, nama_kategori:nama_kategori, id:id, kode_jenis:kode_jenis},
            success     : function(data){
                $(".tb_kategori").DataTable().ajax.reload();
                $("#formKategoriBarang").modal("hide");
            }
        });
    });

});
</script>
@endpush