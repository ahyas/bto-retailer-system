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
                    <span id="header-title">Basic table layout</span>
                </div>
                <div class="card-body" id="card-body">
                <button class="btn btn-sm add" id="bto-button">Add</button>
                <br>
                <br>
                    <table class="tb_warehouse cell-border table-sm">
                        <thead>
                            <tr>
                                <td>Barcode</td>
                                <td>Category</td>
                                <td width="120px">Sub category</td>
                                <td width="250px">Name</td>
                                <td>Stock</td>
                                <td>Unit</td>
                                <td>Actions</td>
                            </tr>
                        </thead>
                            <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="formItemList" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <p id="addHeading"></p><button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="myform" class="form-horizontal">
                    {{csrf_field()}} {{method_field('POST')}}
                    <input type="hidden" class="form-control form-control-sm id_item" id="id_item" name="id_item" >

                    <div class="form-group">
                        <label style="padding-top: 0" class="col-sm-6 control-label">Barcode</label>
                        <div class="col-sm-10" >
                            <input type="text" class="form-control form-control-sm barcode" id="barcode" name="barcode" >
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label style="padding-top: 0" class="col-sm-6 control-label">Category</label>
                        <div class="col-sm-10">
                            <select class="form-control form-control-sm category" id="category" name="category">
                                    <option value="0">-- Choose category --</option>
                                @foreach($tb_jenis as $row)
                                    <option value="{{$row->kode}}">{{$row->keterangan}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label style="padding-top: 0" class="col-sm-6 control-label">Sub category</label>
                        <div class="col-sm-10">
                            <select class="form-control form-control-sm sub_category" id="sub_category" name="sub_category" disabled="true">
                                    <option value="0">-- Choose sub category --</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label style="padding-top: 0" class="col-sm-6 control-label">Name </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control form-control-sm item" id="item" name="item" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label style="padding-top: 0" class="col-sm-6 control-label">Stock </label>
                        <div class="col-sm-5">
                            <input type="number" class="form-control form-control-sm stock" id="stock" name="stock" value="0" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label style="padding-top: 0" class="col-sm-6 control-label">Unit </label>
                        <div class="col-sm-10">
                            <select class="form-control form-control-sm unit" id="unit" name="unit">
                                <option value="0">-- Choose unit --</option>
                                @foreach($satuan as $row)
                                <option value="{{$row->id}}">{{$row->satuan}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button class="btn btn-sm" id="saveBtn">Save</button>
                    <button class="btn btn-sm" id="updateBtn">Update</button>
                    <button type="button" class="btn btn-sm" data-dismiss="modal">Cancel</button>
                </div>
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

    $(".sub_category").select2({
        placeholder: "Choose category",
    });

    $(".tb_warehouse").DataTable({
        ajax            : "{{route('crud.table_layout1.show_data')}}",
        processing      : false,
        ordering        : false,
        bResetDisplay   : false,
        bPaginate       : true,
        serverSide      : false,
        columns         :
        [
            {data:"barcode"},
            {data:"jenis_barang"},
            {data:"kategori_barang"},
            {data:"item"},
            {data:"stock"},
            {data:"unit"},
            {data:"id_item",
                mRender: function(data, type, full)
                {
                    return'<div class="dropdown"><button class="btn btn-sm dropdown-toggle" type="button" id="bto-button" data-toggle="dropdown" aria-expanded="false">More</button><div class="dropdown-menu" aria-labelledby="dropdownMenuButton"><a data-category='+full["category"]+' data-id_item='+data+' class="dropdown-item edit">Edit</a><a data-id_item='+data+' class="dropdown-item delete">Delete</button></div></div>';
                }
            }
        ]
    });

    $("body").on("change", "#category", function(){
        console.log($(this).val());
        var category = $(this).val();
        $.ajax({
            type    :"GET",
            url     :"table_layout1/"+category+"/kategori_barang",
            datatype:"JSON",
            success:function(data){
                var html;
                html="<option value='0'>-- Choose category --</option>";
                for(var i=0; i<data.length; i++){
                    html+="<option value="+data[i].kode+">"+data[i].keterangan+"</option>";
                }
                document.getElementById("sub_category").disabled=false;
                $("#sub_category").html(html);
            }
        });
    });


    $("body").on("click", ".delete", function(){
        console.log($(this).data("id_item"));
        var id_item = $(this).data("id_item");
        if(confirm("Are you sure you want to delete this item?")){
            $.ajax({
                type    : "GET",
                url     : "table_layout1/"+id_item+"/delete",
                datatype: "JSON",
                success : function(data){
                    if(data==0){
                        alert("Tidak bisa menghapus. Barang ini sudah pernah di transaksikan")
                    }else{
                        $(".tb_warehouse").DataTable().ajax.reload();
                    }
                }
            });
        }
    });

    $("body").on("click", ".add", function(){
        document.getElementById("addHeading").innerHTML = "Add item";
        document.getElementById("saveBtn").style.display = "inline-block";
        document.getElementById("updateBtn").style.display = "none";
        document.getElementById("sub_category").disabled=true;
        $("#myform").trigger("reset");
        $("#sub_category").val("0");
        $("#formItemList").modal("show");
    });

    $("#saveBtn").click(function(e){
        e.preventDefault();
        console.log("save");
        $.ajax({
            type    : "POST",
            url     : "{{route('crud.table_layout1.save')}}",
            data    : $("#myform").serialize(),
            dataType: "JSON",
            success :function(data){
                console.log(data.exist);
                if(data.exist==true){
                    alert("Barcode has already inserted. Input another.");
                    $("#barcode").focus();
                }else{
                    $(".tb_warehouse").DataTable().ajax.reload();
                    $("#formItemList").modal("hide");
                }
            }
        });
    });

    $("body").on("click", ".edit", function(){
        document.getElementById("sub_category").disabled=false;
        document.getElementById("addHeading").innerHTML = "Edit item";
        document.getElementById("saveBtn").style.display = "none";
        document.getElementById("updateBtn").style.display = "inline-block";
        var id_item = $(this).data("id_item");
        var category=$(this).data("category");
        console.log(id_item);
        console.log(category);
        $.ajax({
            type    : "GET",
            url     : "table_layout1/"+id_item+"/edit",
            data    : {category:category}, 
            dataType: "JSON",
            success:function(data){
                
                var html;
                
                for(var i=0; i<data.kategori.length; i++){
                    html+="<option value="+data.kategori[i].kode+">"+data.kategori[i].keterangan+"</option>";
                }

                document.getElementById("sub_category").disabled=false;
                $("#sub_category").html(html);
                $("#id_item").val(id_item);
                $("#category").val(data.table.category);
                $("#sub_category").val(data.table.sub_category);
                $("#barcode").val(data.table.barcode);
                $("#item").val(data.table.item);
                $("#stock").val(data.table.stock);
                $("#unit").val(data.table.id_unit);
                $("#formItemList").modal("show");
            }
        });
    });

    $("#updateBtn").click(function(e){
        e.preventDefault();
        $.ajax({
            type        : "POST",
            url         : "{{route('crud.table_layout1.update')}}",
            dataType    : "JSON",
            data        : $("#myform").serialize(),
            success     : function(data){
                $(".tb_warehouse").DataTable().ajax.reload(null, false);
                $("#formItemList").modal("hide");
            }
        });
        
    });

});
</script>
@endpush