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
                    <span id="header-title">Integrated outside form</span>
                </div>
                <div class="card-body" id="card-body">

                <button class="btn btn-sm add" id="bto-button">Add</button> <button class="btn btn-sm edit" id="bto-button">Edit</button> <button class="btn btn-sm delete" id="bto-button">Delete</button> <input type="hidden" id="id_item2"/>

                <div style="float:right;">Export as <button class="btn btn-sm savePDF" id="bto-button"><span id="icon-pdf"></span> PDF</button> <button class="btn btn-sm saveExcel" id="bto-button"><span id="icon-excel"></span> Excel</button></div>
                <br>
                <br>

                <form id="myform" class="form-horizontal" style="padding-left:15px; padding-right:15px">
                    {{csrf_field()}} {{method_field('POST')}}
                    <input type="hidden" class="form-control form-control-sm id_item" id="id_item" name="id_item" >

                    <div class="form-group row">
                        <div class="col-sm-4" >
                            <label for="barcode">Barcode</label>
                            <input type="text" class="form-control form-control-sm barcode" id="barcode" name="barcode" readonly>
                        </div>

                        <div class="col-sm-4">
                            <label for="category">Category</label>
                            <select class="form-control form-control-sm category" id="category" name="category" disabled="true">
                                    <option value="0">-- Choose category --</option>
                                    @foreach($tb_category as $row)
                                        <option value="{{$row->code}}">{{$row->name}}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="col-sm-4">
                            <label for="sub_category">Sub category</label>
                            <select class="form-control form-control-sm sub_category" id="sub_category" name="sub_category" disabled="true">
                                <option value="0">-- Choose sub category --</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-8" >
                            <label for="item">Item </label>
                            <input type="text" class="form-control form-control-sm item" id="item" name="item" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-2" >
                            <label for="stock">Stock </label>
                            <input type="number" class="form-control form-control-sm stock" id="stock" name="stock" value="0" readonly>
                        </div>

                        <div class="col-sm-4" >
                            <label for="unit">Unit </label>
                            <select class="form-control form-control-sm unit" id="unit" name="unit" disabled="true">
                                <option value="0">-- Choose unit --</option>
                                @foreach($unit as $row)
                                <option value="{{$row->id}}">{{$row->unit}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
               
                <div class="modal-footer">
                    <button class="btn btn-sm saveBtn" id="saveBtn">Save</button>
                    <button class="btn btn-sm updateBtn" id="updateBtn">Update</button>
                    <button type="button" class="btn btn-sm cancelBtn" id="cancelBtn" data-dismiss="modal">Cancel</button>
                </div>

                <br>
                    <table class="tb_warehouse cell-border table-sm" id="selected_row" width="100%">
                        <thead>
                            <tr>
                                <td><i class="bi small bi-caret-down-fill" style="color:white"></i></td>
                                <td>Barcode</td>
                                <td>Item</td>
                                <td></td>
                                <td></td>
                                <td></td>
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
            {data:"id_unit", visible:false},
            {data:"category", visible:false},
            {data:"sub_category", visible:false},
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

    var button_add = document.querySelector('.add');
    var button_edit = document.querySelector('.edit');
    var button_delete = document.querySelector('.delete');
    var button_save = document.querySelector('.saveBtn');
    var button_update = document.querySelector('.updateBtn');
    var button_cancel = document.querySelector('.cancelBtn');

    function disabledButton(value1, value2){
        
        button_edit.disabled = value1;
        button_delete.disabled = value1;

        if(value2=="edit"){
            button_add.disabled = true;
            button_save.disabled = true;
            button_update.disabled = false;
            button_cancel.disabled = false;
        }else if(value2=="add"){
            button_add.disabled = true;
            button_save.disabled = false;
            button_update.disabled = true;
            button_cancel.disabled = false;
        }else if(value2="cancel"){
            button_add.disabled = false;
            button_save.disabled = true;
            button_update.disabled = true;
            button_cancel.disabled = true;
        }else if(value2="delete"){
            button_add.disabled = false;
            button_save.disabled = true;
            button_update.disabled = true;
            button_cancel.disabled = true;
        }
    }

    function disabledInput(value){
        if(value==true){
            document.getElementById("barcode").readOnly = true;
            document.getElementById("category").disabled = true;
            document.getElementById("sub_category").disabled = true;
            document.getElementById("item").readOnly = true;
            document.getElementById("stock").readOnly = true;
            document.getElementById("unit").disabled = true;
        }else{
            document.getElementById("barcode").readOnly = false;
            document.getElementById("category").disabled = false;
            document.getElementById("sub_category").disabled = false;
            document.getElementById("item").readOnly = false;
            document.getElementById("stock").readOnly = false;
            document.getElementById("unit").disabled = false;

        }
    }

    disabledInput(true);

    disabledButton(true, null);

    $('.tb_warehouse tbody').on('click', 'tr', function () {

        var id_item = tb_warehouse.row( this ).data().id_item;
        var category = tb_warehouse.row( this ).data().category;
        console.log(id_item+" "+category);
        //find sub category
        $.ajax({
            url:"table_layout1/"+id_item+"/edit",
            data    : {category:category}, 
            type:"GET",
            dataType:"JSON",
            success:function(data){
                var html;
                
                for(var i=0; i<data.sub_category.length; i++){
                    html+="<option value="+data.sub_category[i].code+">"+data.sub_category[i].sub_category+"</option>";
                }

                $("#sub_category").html(html);
                $("#sub_category").val(data.table.sub_category);
            }
        });

        $("#barcode").val(tb_warehouse.row( this ).data().barcode);
        $("#category").val(tb_warehouse.row( this ).data().category);
        $("#item").val(tb_warehouse.row( this ).data().item);
        $("#stock").val(tb_warehouse.row( this ).data().stock);
        $("#unit").val(tb_warehouse.row( this ).data().id_unit);
        $("#id_item").val(id_item);
        $("#id_item2").val(id_item);
        $("#category2").val(category);
        
        if ($(this).hasClass('selected')) {
            disabledButton(false, true);
            $(this).addClass('selected');
            disabledInput(true);
        } else {
            tb_warehouse.$('tr.selected').removeClass('selected');
            disabledButton(false, true);
            $(this).addClass('selected');
            
            disabledInput(true);
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

    $("body").on("click",".edit", function(){
        disabledButton(true, "edit");
        
        document.getElementById("barcode").focus();
        disabledInput(false);
        
    });

    $("body").on("click",".cancelBtn", function(){
        $("#myform").trigger("reset");
        disabledButton(true, "cancel");
        disabledInput(true);
        $(".tb_warehouse").DataTable().ajax.reload(null, false);
        
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
                    $("#myform").trigger("reset");
                    $(".tb_warehouse").DataTable().ajax.reload();
                    disabledButton(true,"delete");

                    popupMsg("Data successfuly deleted!");
                }
            });
        }
    });

    $("body").on("click", ".add", function(){
        $("#myform").trigger("reset");
        disabledButton(true, "add");
        disabledInput(false);
        document.getElementById("barcode").focus();
        $("#sub_category").val("0");
        document.getElementById("sub_category").disabled = true;

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
                        $("#myform").trigger("reset");
                        disabledInput(true);
                        popupMsg("Data successfuly added!");
                    }
                }
            });
        }
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
                    disabledButton(true);
                    disabledInput(true);
                    $("#myform").trigger("reset");
                    $("#sub_category").val("0");
                    $("#alertOK").modal("show");
                    document.getElementById("alertMsg").innerHTML = "Data successfuly changed!";
                }
            });
        }
        
    });

    function popupMsg(msg){
        setTimeout(function(){
            $("#alertOK").modal("show");
            document.getElementById("alertMsg").innerHTML = msg;
            success.play();
        },1000);
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