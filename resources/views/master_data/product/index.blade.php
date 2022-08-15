@extends('layout/app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$tab_title}}</title>
</head>

<body>
    <div class="col-md-12">
        <div class="card" id="card">
            <div class="card-header" id="card-header">
                <span id="header-title">{{$header_title}}</span>
            </div>
            <div class="card-body" id="card-body">
                <button class="btn btn-sm add" id="bto-button">Add</button> 
                <button class="btn btn-sm edit" id="bto-button">Edit</button> 
                <button class="btn btn-sm delete" id="bto-button">Delete</button>  
                <br>
                <br>
                <table class="tb_product cell-border table-sm" id="selected_row">
                    <thead>
                        <tr>
                            <td></td>
                            <td><span class="inline-container" title>Product name</span></td>
                            <td><span class="inline-container" title>Category</span></td>
                            <td><span class="inline-container" title>Selling price (Normal)</span></td>
                            <td><span class="inline-container" title>Promo price</span></td>
                            <td><span class="inline-container" title>Current stock</span></td>
                        </tr>
                    </thead>
                        <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
@include('master_data/product/form')
@include('master_data/popup/index')
@endsection

@push('scripts')
<script type="text/javascript">
$(document).ready(function(){
    var success = new Audio("{{asset('public/sound/chime2.wav')}}");
    var warning = new Audio("{{asset('public/sound/chime.wav')}}");

    disabledButton(true);
    //start section product list
    var tb_product = $(".tb_product").DataTable({
        ajax        :"{{route('master_data.product.fetch')}}",
        serverside  :false,
        ordering    :false,
        columns    :
        [
            {
                "width" :"5px",
                "className":      'numbering',
                "orderable":      false,
                "data":           1,
                "defaultContent": ''
            },
            {data:"product_name", width:"500px"},
            {data:"category_name"},
            {data:"selling_price", className: 'dt-body-right'},
            {data:"selling_promo_price", className: 'dt-body-right'},
            {data:"current_stock", width:"100px", className: 'dt-body-right'},
        ]
    });
    //end section product list

    //show form add product
    $("body").on("click",".add", function(){
        formSetter(false);
    });

    //start section edit product
    $("body").on("click",".edit", function(){
        formSetter(true);
        var id_product = $("#id_product").val();
        $.ajax({
            url:"{{route('master_data.product.edit')}}",
            type:"GET",
            data:{id_product:id_product},
            success:function(data){
                //get data from JSON and assign into form 
                $("#barcode").val(data.barcode);
                $("#product_name").val(data.product_name);
                $("#id_category").val(data.id_category);
                $("#selling_price").val(data.selling_price);
                $("#selling_promo_price").val(data.selling_promo_price);
                $("#wholesale_price").val(data.wholesale_price);
                $("#wholesale_promo_price").val(data.wholesale_promo_price);
                $("#current_stock").val(data.current_stock);
                $("#purchase_price").val(data.purchase_price);
                $("#tax").val(data.tax);
                $("#notes").val(data.notes);
            }
        });
    });
    //end section edit product

    //start section select row
    $('.tb_product tbody').on('click', 'tr', function(){

        if ($(this).hasClass('selected')) {
            disabledButton(true);
            $(this).removeClass('selected');
        }else{
            tb_product.$('tr.selected').removeClass('selected');
            //get id from selected row
            var id_product = tb_product.row( this ).data().id;
            $("#id_product").val(id_product);
            disabledButton(false);
            $(this).addClass('selected');
        }
    });
    //end section select row

    $("#saveBtn").click(function(e){
        e.preventDefault();
        if(formValidation()!==false){
            $.ajax({
                url     :"{{route('master_data.product.save')}}",
                type    :"POST",
                data    :$("#productForm").serialize(),
                success :function(data){
                    if(data.count > 0){
                        $("#barcode").focus();
                        popupMsg("Oops! Duplicate barcode.!");
                        return false;
                    }
                    $("#formProduct").modal("hide"); 
                    $(".tb_product").DataTable().ajax.reload();
                    popupMsg("Data successfuly added!");
                }
            });
        }
    });

    $("#updateBtn").click(function(e){
        e.preventDefault();
        if(formValidation()!==false){
            $.ajax({
                url     :"{{route('master_data.product.update')}}",
                type    :"POST",
                data    :$("#productForm").serialize(),
                success :function(data){
                    if(data.count > 0){
                        $("#barcode").focus();
                        popupMsg("Oops! Duplicate barcode.!");
                        return false;
                    }

                    $("#formProduct").modal("hide");
                    disabledButton(true);
                    $(".tb_product").DataTable().ajax.reload();
                    popupMsg("Data successfuly updated!");
                }
            });
        }
    });

    //start section delete selected product 
    $("body").on("click",".delete", function(){
        var id_product = $("#id_product").val();

        if(confirm("Are you sure you want to delete this data?")){
            $.ajax({
                url     :"{{route('master_data.product.delete')}}",
                type    :"GET",
                data    :{id_product:id_product},
                success :function(data){
                    disabledButton(true);
                    $(".tb_product").DataTable().ajax.reload();
                    popupMsg("Data successfuly deleted!");
                }
            });
        }
    });
    //end section delete selected product

    // start section numbering column
    tb_product.on('order.dt search.dt', function () {
        let i = 1;
        tb_product.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
    }).draw();
    // end section numbering column

    //start section set form state
    function formSetter(value){
        if(value==true){
            $("#formProduct").modal("show");
            $("#barcode").focus();

            document.getElementById("saveBtn").style.display = "none";
            document.getElementById("updateBtn").style.display = "inline-block";
            document.getElementById("addHeading").innerHTML = "Edit product";
        }else{
            $("#formProduct").modal("show");
            $("#barcode").val("");
            $("#barcode").focus();
            $("#product_name").val("");
            $("#id_category").val("0");
            $("#selling_price").val("0");
            $("#selling_promo_price").val("0");
            $("#wholesale_price").val("0");
            $("#wholesale_promo_price").val("0");
            $("#current_stock").val("0");
            $("#purchase_price").val("0");
            $("#tax").val("0");
            $("#notes").val("");

            document.getElementById("saveBtn").style.display = "inline-block";
            document.getElementById("updateBtn").style.display = "none";
            document.getElementById("addHeading").innerHTML = "Add product";
        }
    }
    //end section set form state

    $("#formProduct").on('hide.bs.modal', function(){
        disabledButton(true);
        $(".tb_product").DataTable().ajax.reload();
    });

    //start section disabled button when necessary
    function disabledButton(value){
        document.querySelector('.edit').disabled = value;
        document.querySelector('.delete').disabled = value;
    }
    //end section disabled button when necessary

    //start section form validation before submiting
    function formValidation(){
        var product_name = $("#product_name").val();
        var id_category = $("#id_category").val();
        var selling_price = $("#selling_price").val();

        if(product_name == ""){
            warning.play(); //plays sound when errors
            alert("Oops! Please fill out product name");
            $("#product_name").focus();
            return false;
        }else if(id_category == 0){
            warning.play(); //plays sound when errors
            alert("Oops! Please choose category");
            $("#id_category").focus();
            return false;
        }else if(selling_price == 0){
            warning.play(); //plays sound when errors
            alert("Oops! Please fill out selling price");
            $("#selling_price").focus();
            return false;
        }
    }
    //end section form validation before submiting

    function popupMsg(msg){
        setTimeout(function(){
            $("#alertOK").modal("show");
            document.getElementById("alertMsg").innerHTML = msg;
            success.play();
        },500);
    }

    //prevent non numeric value
    $("body").on("input","#barcode, #selling_price, #selling_promo_price, #selling_promo_price, #wholesale_price, #wholesale_promo_price, #tax",function(){
        this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
    });    
    //prevent non numeric value

});
</script>
@endpush