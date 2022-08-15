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
                <table class="tb_supplier cell-border table-sm" id="selected_row">
                    <thead>
                        <tr>
                            <td></td>
                            <td><span class="inline-container" title>Supplier name</span></td>
                            <td><span class="inline-container" title>Email</span></td>
                            <td><span class="inline-container" title>Address</span></td>
                            <td><span class="inline-container" title>City</span></td>
                            <td><span class="inline-container" title>State</span></td>
                            <td><span class="inline-container" title>Phone</span></td>
                        </tr>
                    </thead>
                        <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
@include('master_data/supplier/form')
@include('master_data/popup/index')
@endsection

@push('scripts')
<script type="text/javascript">
$(document).ready(function(){
    var success = new Audio("{{asset('public/sound/chime2.wav')}}");
    var warning = new Audio("{{asset('public/sound/chime.wav')}}");

    disabledButton(true);

    var tb_supplier = $(".tb_supplier").DataTable({
        ajax        :"{{route('master_data.supplier.fetch')}}",
        serverside  :false,
        columns    :
        [
            {
                "width" :"5px",
                "className":      'numbering',
                "orderable":      false,
                "data":           1,
                "defaultContent": ''
            },
            {data:"name"},
            {data:"email"},
            {data:"address"},
            {data:"city"},
            {data:"state"},
            {data:"phone"},
        ]
    });
    
    // start section numbering column
    tb_supplier.on('order.dt search.dt', function () {
        let i = 1;
        tb_supplier.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
    }).draw();
    // end section numbering column

    $("body").on("click",".add", function(){
        formSetter(false);
    });

    $("body").on("click",".edit", function(){
        formSetter(true);
        var id_supplier = $("#id_supplier").val();
        console.log(id_supplier);
        $.ajax({
            url:"{{route('master_data.supplier.edit')}}",
            type:"GET",
            data:{id_supplier:id_supplier},
            success:function(data){
                $("#supplier_name").val(data.name);
                $("#email").val(data.email);
                $("#address").val(data.address);
                $("#city").val(data.city);
                $("#state").val(data.state);
                $("#postal").val(data.postal);
                $("#phone").val(data.phone);
                $("#fax").val(data.fax);
            }
        });
    });

    //start section select row
    $('.tb_supplier tbody').on('click', 'tr', function(){
        var id_supplier = tb_supplier.row( this ).data().id;
        $("#id_supplier").val(id_supplier);
        
        if ($(this).hasClass('selected')) {
            disabledButton(true);
            $(this).removeClass('selected');
        }else{
            tb_supplier.$('tr.selected').removeClass('selected');
            disabledButton(false);
            $(this).addClass('selected');
        }
    });
    //end section select row

    $("#saveBtn").click(function(e){
        e.preventDefault();
        $.ajax({
            url     :"{{route('master_data.supplier.save')}}",
            type    :"POST",
            data    :$("#supplierForm").serialize(),
            success :function(data){
                $("#formSupplier").modal("hide");
                $(".tb_supplier").DataTable().ajax.reload();
                popupMsg("Data successfuly added!");
            }
        });
    });

    $("#updateBtn").click(function(e){
        e.preventDefault();
        $.ajax({
            url     :"{{route('master_data.supplier.update')}}",
            type    :"POST",
            data    :$("#supplierForm").serialize(),
            success :function(data){
                $("#formSupplier").modal("hide");
                $(".tb_supplier").DataTable().ajax.reload();
                popupMsg("Data successfuly updated!");
            }
        });
    });

    $("body").on("click",".delete", function(){
        var id_supplier = $("#id_supplier").val();
        
        if(confirm("Are you sure you want to delete this data?")){
            $.ajax({
                url     :"{{route('master_data.supplier.delete')}}",
                type    :"GET",
                data    :{id_supplier:id_supplier},
                success :function(data){
                    //validate if a customer has been assigned to a transaction
                    if(data.find_supplier >0){
                        popupMsg("Error: This supplier has been assigned to transaction!");
                        return false;
                    }

                    disabledButton(true);
                    $(".tb_supplier").DataTable().ajax.reload();
                    popupMsg("Data successfuly deleted!");
                }
            });
        }
    });

    $("#formCustomer").on('hide.bs.modal', function(){
        disabledButton(true);
        $(".tb_customer").DataTable().ajax.reload();
    });

    //start section set form state
    function formSetter(value){
        if(value==true){
            $("#formSupplier").modal("show");
            $("#supplier_name").val("");
            $("#supplier_name").focus();

            document.getElementById("saveBtn").style.display = "none";
            document.getElementById("updateBtn").style.display = "inline-block";
            document.getElementById("addHeading").innerHTML = "Edit customer";
        }else{
            $("#formSupplier").modal("show");
            $("#supplier_name").val("");
            $("#supplier_name").focus();
            $("#email").val("");
            $("#address").val("");
            $("#city").val("");
            $("#state").val("");
            $("#country").val("");
            $("#postal").val("");
            $("#phone").val("");
            $("#fax").val("");

            document.getElementById("saveBtn").style.display = "inline-block";
            document.getElementById("updateBtn").style.display = "none";
            document.getElementById("addHeading").innerHTML = "Add supplier";
        }
    }
    //end section set form state

    function disabledButton(value){
        document.querySelector('.edit').disabled = value;
        document.querySelector('.delete').disabled = value;
    }

    function formValidation(){
        var category = $("#category_name").val();
        if(category == ""){
            warning.play();
            alert("Oops! Please fill out category name");
            $("#category_name").focus();
            return false;
        }
    }

    function popupMsg(msg){
        setTimeout(function(){
            $("#alertOK").modal("show");
            document.getElementById("alertMsg").innerHTML = msg;
            success.play();
        },500);
    }

});
</script>
@endpush