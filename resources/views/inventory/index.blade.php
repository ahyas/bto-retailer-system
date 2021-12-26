@extends('layout/app')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inventory</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="col-md-12 mt-5">
            <div class="card">

                <div class="card-header">
                    <h3>Inventory</h3>
                </div>
                <div class="card-body">
                <a href="javascript:void(0)" class="btn btn-success btn-sm add" style="font-size:11px; margin-bottom:20px">Add</a>
                    <table class="inventory display">
                        <thead>
                            <tr>
                                <th>Barcode</th>
                                <th>Item</th>
                                <th>Kategori</th>
                                <th>Stock</th>
                                <th></th>
                            </tr>
                        </thead>
                            <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="formInventory" aria-hidden="true">
    
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="font-size: 13px;">
            <div class="modal-header bg-info text-white" style="background-image: linear-gradient(#9fbbc6, #2a88b0); height: 30px; line-height: 6px; font-size: 14px; border-top: 1px white solid">
                <h6 id="addHeading" style="line-height: 0"></h6><button style="line-height: 0" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" style="background-color: #BDE1F1">
                <form id="myform" class="form-horizontal">

                    {{csrf_field()}} {{method_field('POST')}}

                    <input type="hidden" name="id_barang" id="id_barang">

                    <div class="form-group">
                        <label style="padding-top: 0" class="col-sm-6 control-label">Barcode : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-sm barcode" id="barcode" name="barcode" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label style="padding-top: 0" class="col-sm-6 control-label">Item : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-sm item" id="item" name="item" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label style="padding-top: 0" class="col-sm-6 control-label">Kategori : </label>
                        <div class="col-sm-10">
                            <select class="form-control form-control-sm kategori" id="kategori" name="kategori" >
                                <option value="0">Pilih kategori</option>
                                @foreach($kategori as $row)
                                <option value="{{$row->id}}">{{$row->nama_kategori}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label style="padding-top: 0" class="col-sm-6 control-label">Satuan : </label>
                        <div class="col-sm-10">
                            <select class="form-control form-control-sm satuan" id="satuan" name="satuan" >
                                <option value="0">Pilih satuan</option>
                                @foreach($table as $row)
                                <option value="{{$row->id}}">{{$row->nama_satuan}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label style="padding-top: 0" class="col-sm-6 control-label">Stock : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-sm stock" value="0" id="stock" name="stock" >
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

        $(".inventory").DataTable({
            ajax:"{{route('inventory.show_data')}}",
            processing:false,
            serverside:false,
            ordering:false,
            columns:[
                {data: "barcode"},
                {data: "nama_barang"},
                {data: "nama_kategori"},
                {data: "stock"},
                {data: "id", 
                    render: function(data, type, row){
                        return '<a href="javascript:void(0)" data-id="'+data+'" class="btn btn-primary btn-sm edit" style="font-size:11px; display:inline-block;">Edit</a> <a href="javascript:void(0)" data-id="'+data+'" class="btn btn-danger btn-sm delete" style="font-size:11px; display:inline-block;">Delete</a>';
                    }
                }
            ]
        });

        $("body").on("click",".edit",function(){
            console.log("edit "+$(this).data("id"));
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                url: "inventory/"+id+"/edit",
                dataType:"JSON",
                success:function(data){
                    document.getElementById("addHeading").innerHTML="Edit";
                    var a = document.getElementById("saveBtn");
                    a.style.display = "none";

                    var b = document.getElementById("updateBtn");
                    b.style.display = "inline-block";

                    $("#id_barang").val(data.id);
                    $("#barcode").val(data.barcode);
                    $("#item").val(data.nama_barang);
                    $("#kategori").val(data.id_kategori);
                    $("#stock").val(data.stock);

                    $("#formInventory").modal("show");
                }
            });
            
        });

        $("#updateBtn").on("click", function(e){
            e.preventDefault();
            $.ajax({
                type    : "POST",
                url     : "{{route('inventory.update')}}",
                dataType: "JSON",
                data    : $("#myform").serialize(),
                success : function(data){
                    $(".inventory").DataTable().ajax.reload(null, false);
                    $("#formInventory").modal("hide");
                }
            });
            
        });

        $("body").on("click",".add",function(){
            document.getElementById("addHeading").innerHTML="Add";
            $("#myform").trigger("reset");
            var a = document.getElementById("saveBtn");
            a.style.display = "inline-block";

            var b = document.getElementById("updateBtn");
            b.style.display = "none";

            $("#formInventory").modal("show");
        });

        $("#saveBtn").on("click", function(e){
            e.preventDefault();
            $.ajax({
                type    : "POST",
                url     : "{{route('inventory.save')}}",
                dataType:"JSON",
                data    : $("#myform").serialize(),
                success : function(data){
                    $(".inventory").DataTable().ajax.reload();
                    $("#formInventory").modal("hide");
                }
            });
            
        });

        $("body").on("click",".delete",function(){
            var id = $(this).data("id");
            if(confirm("Anda yakin ingin menghapus data ini?")){
                    $.ajax({
                    type      : "GET",
                    url       : "inventory/"+id+"/delete",
                    dataType  : "JSON",
                    success   : function(data){
                        $(".inventory").DataTable().ajax.reload();
                    }
                });
            }
        });

    });
</script>
@endpush