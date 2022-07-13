@extends('layout/app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Barang Persediaan</title>
    
</head>

<body>
    <div class="container">
        <div class="col-md-12 mt-5">
            <div class="card" id="card">
                <div class="card-header" id="card-header">
                    <span id="header-title">Daftar barang</span>
                </div>
                <div class="card-body" id="card-body">
                <button class="btn btn-sm add" id="bto-button">Add</button>
                <br>
                <br>
                    <table class="tb_barang cell-border table-sm">
                        <thead>
                            <tr>
                                <td>Kode barang</td>
                                <td>Jenis Barang</td>
                                <td width="120px">Kategori Barang</td>
                                <td width="250px">Nama Barang</td>
                                <td>Stock</td>
                                <td>Satuan</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                            <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="formDaftarbarang" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;">
            <div class="modal-header bg-info text-white" style="background-image: linear-gradient(#d0e2f8, #e2ecfb); height: 30px; line-height: 6px; font-size: 13px; border-top: 1px white solid">
                <p id="addHeading" style="line-height: 0; color:#0a4293; font-weight:normal; font-size:14px; font-weight:600;"></p><button style="line-height: 0; background-color:red; border-radius:3px;" type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="color:white">&times;</span></button>
            </div>
            <div class="modal-body" style="background-color:white; border-left:6px solid #e2ecfb; border-right:6px solid #e2ecfb; border-bottom:6px solid #e2ecfb; font-size:13px;" >
                <form id="myform" class="form-horizontal">
                    {{csrf_field()}} {{method_field('POST')}}
                    <input type="hidden" class="form-control form-control-sm id_barang" id="id_barang" name="id_barang" >
                    
                    <div class="form-group">
                        <label style="padding-top: 0" class="col-sm-6 control-label">Jenis Barang</label>
                        <div class="col-sm-10">
                            <select class="form-control form-control-sm fx kode_jenis " id="kode_jenis" name="kode_jenis">
                                    <option value="0">Pilih Jenis Barang</option>
                                @foreach($tb_jenis as $row)
                                    <option value="{{$row->kode}}">{{$row->keterangan}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label style="padding-top: 0" class="col-sm-6 control-label">Kategori Barang</label>
                        <div class="col-sm-10">
                            <select class="form-control form-control-sm fx kode_kategori" id="kode_kategori" name="kode_kategori" disabled="true">
                                    <option value="0">--Pilih Kategori Barang--</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label style="padding-top: 0" class="col-sm-6 control-label">Kode Barang</label>
                        <div class="col-sm-10" >
                            <input type="text" class="form-control form-control-sm fx kode_barang" id="kode_barang" name="kode_barang" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label style="padding-top: 0" class="col-sm-6 control-label">Nama Barang : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-sm fx nama_barang" id="nama_barang" name="nama_barang" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label style="padding-top: 0" class="col-sm-6 control-label">Satuan </label>
                        <div class="col-sm-10">
                            <select class="form-control form-control-sm fx satuan_barang" id="satuan_barang" name="satuan_barang">
                                <option value="0">--Pilih Satuan Barang--</option>
                                @foreach($satuan as $row)
                                <option value="{{$row->id}}">{{$row->satuan}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-sm" id="saveBtn">Save</button>
                        <button class="btn btn-sm" id="updateBtn">Update</button>
                        <button type="button" class="btn btn-sm" data-dismiss="modal">Cancel</button>
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

    $(".kode_kategori").select2({
        placeholder: "Pilih kategori",
    });

    $(".tb_barang").DataTable({
        ajax            : "{{route('daftar_barang.show_data')}}",
        processing      : false,
        ordering        : false,
        bResetDisplay   : false,
        bPaginate       : true,
        serverSide      : false,
        columns         :
        [
            {data:"kode_barang"},
            {data:"jenis_barang"},
            {data:"kategori_barang"},
            {data:"nama_barang"},
            {data:"stock"},
            {data:"satuan"},
            {data:"id_barang",
                mRender: function(data, type, full)
                {
                    return'<div class="dropdown"><button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">Dropdown button</button><div class="dropdown-menu" aria-labelledby="dropdownMenuButton"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div></div>';
                }
            }
        ]
    });

    $("body").on("change", "#kode_jenis", function(){
        console.log($(this).val());
        var kode_jenis = $(this).val();
        $.ajax({
            type    :"GET",
            url     :"daftar_barang/"+kode_jenis+"/kategori_barang",
            datatype:"JSON",
            success:function(data){
                var html;
                html="<option value='0'>--Pilih kategori barang--</option>";
                for(var i=0; i<data.length; i++){
                    html+="<option value="+data[i].kode+">"+data[i].keterangan+"</option>";
                }
                document.getElementById("kode_kategori").disabled=false;
                $("#kode_kategori").html(html);
            }
        });
    });

    $("body").on("click", ".delete", function(){
        console.log($(this).data("id_barang"));
        var id = $(this).data("id_barang");
        if(confirm("Yakin ingin menghapus data ini?")){
            $.ajax({
                type    : "GET",
                url     : "daftar_barang/"+id+"/delete",
                datatype: "JSON",
                success : function(data){
                    if(data==0){
                        alert("Tidak bisa menghapus. Barang ini sudah pernah di transaksikan")
                    }else{
                        $(".tb_barang").DataTable().ajax.reload();
                    }
                }
            });
        }
    });

    $("body").on("click", ".add", function(){
        document.getElementById("addHeading").innerHTML = "Tambah Barang";
        document.getElementById("saveBtn").style.display = "inline-block";
        document.getElementById("updateBtn").style.display = "none";
        document.getElementById("kode_kategori").disabled=true;
        $("#myform").trigger("reset");
        $("#kode_kategori").val("0");
        $("#formDaftarbarang").modal("show");
    });

    $("#saveBtn").click(function(e){
        e.preventDefault();
        console.log("save");
        $.ajax({
            type    : "POST",
            url     : "{{route('daftar_barang.save')}}",
            data    : $("#myform").serialize(),
            dataType: "JSON",
            success :function(data){
                console.log(data.ketemu);
                if(data.ketemu==true){
                    alert("Kode barang sudah dipakai. Masukan kode yang lain");
                    $("#kode_barang").focus();
                }else{
                    $(".tb_barang").DataTable().ajax.reload();
                    $("#formDaftarbarang").modal("hide");
                }
            }
        });
    });

    $("body").on("click", ".edit", function(){
        document.getElementById("kode_kategori").disabled=false;
        document.getElementById("addHeading").innerHTML = "Edit Jenis";
        document.getElementById("saveBtn").style.display = "none";
        document.getElementById("updateBtn").style.display = "inline-block";
        var id = $(this).data("id_barang");
        var kode_jenis=$(this).data("kode_jenis");
        $.ajax({
            type    : "GET",
            url     : "daftar_barang/"+id+"/edit",
            data    : {kode_jenis:kode_jenis}, 
            dataType: "JSON",
            success:function(data){
                
                if(data.table==0 && data.kategori==0){
                    alert("Data tidak dapat diedit. Barang ini sudah pernah ditransaksikan");
                }else{
                    console.log(data.kategori.length);
                    var html;
                    
                    for(var i=0; i<data.kategori.length; i++){
                        html+="<option value="+data.kategori[i].kode+">"+data.kategori[i].keterangan+"</option>";
                    }
                    document.getElementById("kode_kategori").disabled=false;
                    $("#kode_kategori").html(html);

                    $("#id_barang").val(id);
                    $("#kode_jenis").val(data.table.kode_jenis);
                    $("#kode_kategori").val(data.table.kode_kategori);
                    $("#kode_barang").val(data.table.kode_barang);
                    $("#nama_barang").val(data.table.nama_barang);
                    $("#satuan_barang").val(data.table.id_satuan);
                    $("#formDaftarbarang").modal("show");
                }
            }
        });
    });

    $("#updateBtn").click(function(e){
        e.preventDefault();
        $.ajax({
            type        : "POST",
            url         : "{{route('daftar_barang.update')}}",
            dataType    : "JSON",
            data        : $("#myform").serialize(),
            success     : function(data){
                $(".tb_barang").DataTable().ajax.reload(null, false);
                $("#formDaftarbarang").modal("hide");
            }
        });
        
    });

});
</script>
@endpush