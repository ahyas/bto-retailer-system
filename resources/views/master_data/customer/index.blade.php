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
                <span id="header-title">{{$header_title}}</span>
            </div>
            <div class="card-body" id="card-body">
                <button class="btn btn-sm add" id="bto-button">Add</button> 
                <button class="btn btn-sm edit" id="bto-button">Edit</button> 
                <button class="btn btn-sm delete" id="bto-button">Delete</button>  
                <br>
                <br>
                <table class="tb_customer cell-border table-sm" id="selected_row">
                    <thead>
                        <tr>
                            <td></td>
                            <td><span class="inline-container" title>Customer name</span></td>
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
@include('master_data/customer/form')
@include('master_data/popup/index')
@endsection

@push('scripts')
<script type="text/javascript">
$(document).ready(function(){
    var success = new Audio("{{asset('public/sound/chime2.wav')}}");
    var warning = new Audio("{{asset('public/sound/chime.wav')}}");

    disabledButton(true);

    var tb_customer = $(".tb_customer").DataTable({
        ajax        :"{{route('master_data.customer.fetch')}}",
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
    tb_customer.on('order.dt search.dt', function () {
        let i = 1;
        tb_customer.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
    }).draw();
    // end section numbering column

    $("body").on("click",".add", function(){
        formSetter(false);
    });

    $("body").on("click",".edit", function(){
        formSetter(true);
        var id_customer = $("#id_customer").val();
        $.ajax({
            url:"{{route('master_data.customer.edit')}}",
            type:"GET",
            data:{id_customer:id_customer},
            success:function(data){
                $("#customer_name").val(data.name);
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
    $('.tb_customer tbody').on('click', 'tr', function(){
        var id_customer = tb_customer.row( this ).data().id;
        $("#id_customer").val(id_customer);

        if ($(this).hasClass('selected')) {
            disabledButton(true);
            $(this).removeClass('selected');
        }else{
            tb_customer.$('tr.selected').removeClass('selected');
            disabledButton(false);
            $(this).addClass('selected');
        }
    });
    //end section select row

    $("#saveBtn").click(function(e){
        e.preventDefault();
        $.ajax({
            url     :"{{route('master_data.customer.save')}}",
            type    :"POST",
            data    :$("#customerForm").serialize(),
            success :function(data){
                $("#formCustomer").modal("hide");
                $(".tb_customer").DataTable().ajax.reload();
                popupMsg("Data successfuly added!");
            }
        });
    });

    $("#updateBtn").click(function(e){
        e.preventDefault();
        $.ajax({
            url     :"{{route('master_data.customer.update')}}",
            type    :"POST",
            data    :$("#customerForm").serialize(),
            success :function(data){
                $("#formCustomer").modal("hide");
                $(".tb_customer").DataTable().ajax.reload();
                popupMsg("Data successfuly updated!");
            }
        });
    });

    $("body").on("click",".delete", function(){
        var id_customer = $("#id_customer").val();
        console.log(id_customer);
        if(confirm("Are you sure you want to delete this data?")){
            $.ajax({
                url     :"{{route('master_data.customer.delete')}}",
                type    :"GET",
                data    :{id_customer:id_customer},
                success :function(data){
                    //validate if a customer has been assigned to a transaction
                    if(data.find_customer >0){
                        popupMsg("Error: This customer has been assigned to transaction!");
                        return false;
                    }

                    disabledButton(true);
                    $(".tb_customer").DataTable().ajax.reload();
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
            $("#formCustomer").modal("show");
            $("#customer_name").val("");
            $("#customer_name").focus();

            document.getElementById("saveBtn").style.display = "none";
            document.getElementById("updateBtn").style.display = "inline-block";
            document.getElementById("addHeading").innerHTML = "Edit customer";
        }else{
            $("#formCustomer").modal("show");
            $("#customer_name").val("");
            $("#customer_name").focus();
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
            document.getElementById("addHeading").innerHTML = "Add customer";
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