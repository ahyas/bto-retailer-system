@extends('layout/app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BtO - Warehouse</title>
</head>

<body>
    <div class="col-md-12">
        <div class="card" id="card">
            <div class="card-header" id="card-header">
                <span id="header-title">Selected row</span>
            </div>
            <div class="card-body" id="card-body">
            <button class="btn btn-sm add" id="bto-button">Add</button> <button class="btn btn-sm edit" id="bto-button">Edit</button> <button class="btn btn-sm delete" id="bto-button">Delete</button> <input type="hidden" id="id_item2"/> <input type="hidden" id="category2"/>
            <div style="float:right">Export as <button class="btn btn-sm savePDF" id="bto-button"><span id="icon-pdf"></span> PDF</button> <button class="btn btn-sm saveExcel" id="bto-button"><span id="icon-excel"></span> Excel</button></div>
            <br>
            <br>
                <table class="tb_warehouse cell-border table-sm" id="selected_row" width="100%">
                    <thead>
                        <tr>
                            <td><i class="bi small bi-caret-down-fill" style="color:white"></i></td>
                            <td>Barcode</td>
                            <td>Item</td>
                            <td>Category</td>
                            <td>Sub category</td>
                            <td>Stock</td>
                            <td>Unit</td>
                        </tr>
                    </thead>
                        <tbody></tbody>
                </table>
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
                        <label style="padding-top: 0" class="col-sm-6 control-label">Item </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control form-control-sm item" id="item" name="item" >
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label style="padding-top: 0" class="col-sm-6 control-label">Category</label>
                        <div class="col-sm-10">
                            <select class="form-control form-control-sm category" id="category" name="category">
                                    <option value="0">-- Choose category --</option>
                                    @foreach($tb_category as $row)
                                        <option value="{{$row->code}}">{{$row->name}}</option>
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
                                @foreach($unit as $row)
                                <option value="{{$row->id}}">{{$row->unit}}</option>
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
@include('crud/notification/index')
@endsection

@push('scripts')
<script type="text/javascript">
$(document).ready(function(){
    var success = new Audio("{{asset('public/sound/chime2.wav')}}");
    var warning = new Audio("{{asset('public/sound/chime.wav')}}");

    //start input number only in barcode field
    $("input[name='barcode']").on('input', function(e) {
        $(this).val($(this).val().replace(/[^0-9]/g, ''));
    });
    //End input number only in barcode field

    $("body").on("click",".savePDF",function(){
        window.open("{{route('crud.table_layout1.savepdf')}}");
    });

    $("body").on("click",".saveExcel",function(){
        window.open("{{route('crud.table_layout1.saveexcel')}}");
    });

    var tb_warehouse = $(".tb_warehouse").DataTable({
        ajax            : "{{route('crud.table_layout1.show_data')}}",
        processing      : false,
        ordering        : false,
        bResetDisplay   : false,
        select          : true,
        bPaginate       : true,
        columnDefs: [
            {
                searchable: false,
                orderable: false,
                targets: 0,
            },
        ],
        serverSide      : false,
        columns         :
        [
            {

                "width" :"5px",
                "className":      'numbering',
                "orderable":      false,
                "data":           1,
                "defaultContent": ''
            },
            {data:"barcode", width:"100px"},
            {data:"item"},
            {data:"category_name"},
            {data:"sub_category_name"},
            {data:"stock", width:"40px", className:"dt-body-right"},
            {data:"unit"}
        ]
    });

    tb_warehouse.on('order.dt search.dt', function () {
        let i = 1;
 
        tb_warehouse.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
    }).draw();

    var button_edit = document.querySelector('.edit');
    var button_delete = document.querySelector('.delete');

    function disabledButton(value){
        button_edit.disabled = value;
        button_delete.disabled = value;
    }

    disabledButton(true);

    $('.tb_warehouse tbody').on('click', 'tr', function () {
        var id_item = tb_warehouse.row( this ).data().id_item;
        var category = tb_warehouse.row( this ).data().category;
        
        $("#id_item2").val(id_item);
        $("#category2").val(category);
        
        if ($(this).hasClass('selected')) {
            disabledButton(true);
            $(this).removeClass('selected');
        } else {
            tb_warehouse.$('tr.selected').removeClass('selected');
            disabledButton(false);
            $(this).addClass('selected');
        }
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
                    html+="<option value="+data[i].code+">"+data[i].sub_category+"</option>";
                }
                document.getElementById("sub_category").disabled=false;
                $("#sub_category").html(html);
            }
        });
    });


    $("body").on("click", ".delete", function(){
        console.log($(this).data("id_item"));
        var id_item = $("#id_item2").val();
        if(confirm("Are you sure you want to delete this item?")){
            $.ajax({
                type    : "GET",
                url     : "table_layout1/"+id_item+"/delete",
                datatype: "JSON",
                success : function(data){
                   
                    $(".tb_warehouse").DataTable().ajax.reload();
                    disabledButton(true);
                    popupMsg("Data successfuly deleted!");
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
        $("#barcode").focus();
    });

    $("#saveBtn").click(function(e){
        e.preventDefault();
        if(formValidation()!==false){
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
                        disabledButton(true);
                        popupMsg("Data successfuly added!");
                    }
                }
            });
        }
    });

    $("body").on("click", ".edit", function(){
        
        document.getElementById("addHeading").innerHTML = "Edit item";
        document.getElementById("saveBtn").style.display = "none";
        document.getElementById("updateBtn").style.display = "inline-block";
        var id_item = $("#id_item2").val();
        var category= $("#category2").val();
        
        $.ajax({
            type    : "GET",
            url     : "table_layout1/"+id_item+"/edit",
            data    : {category:category}, 
            dataType: "JSON",
            success:function(data){
                
                var html;
                
                for(var i=0; i<data.sub_category.length; i++){
                    html+="<option value="+data.sub_category[i].code+">"+data.sub_category[i].sub_category+"</option>";
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
                $("#barcode").focus();
            }
        });
    });

    $("#updateBtn").click(function(e){
        e.preventDefault();
        if(formValidation()!==false){
            $.ajax({
                type        : "POST",
                url         : "{{route('crud.table_layout1.update')}}",
                dataType    : "JSON",
                data        : $("#myform").serialize(),
                success     : function(data){
                    $(".tb_warehouse").DataTable().ajax.reload(null, false);
                    $("#formItemList").modal("hide");
                    disabledButton(true);
                    popupMsg("Data successfuly updated!");
                }
            });
        }
        
    });

    function popupMsg(msg){
        setTimeout(function(){
            $("#alertOK").modal("show");
            document.getElementById("alertMsg").innerHTML = msg;
            success.play();
        },500);
    }

    function formValidation(){

        let barcode =  $("#barcode").val();
        let item =  $("#item").val();
        let category = $("#category").val();
        let sub_category =  $("#sub_category").val();
        let stock = $("#stock").val();
        let unit = $("#unit").val();

        if(barcode == ""){
            warning.play();
            alert("Oops! Please fill out barcode");
            $("#barcode").focus();
            return false;
        }

        if(item == ""){
            warning.play();
            alert("Oops! Please fill out item name");
            $("#item").focus();
            return false;
        }

        if(category == 0){
            warning.play();
            alert("Oops! Please select apropriate category");
            $("#category").focus();
            return false;
        }

        if(sub_category == 0){
            warning.play();
            alert("Oops! Please select apropriate sub category");
            $("#sub_category").focus();
            return false;
        }

        if(unit == 0){
            warning.play();
            alert("Oops! Please select apropriate unit");
            $("#unit").focus();
            return false;
        }
    }

});
</script>
@endpush