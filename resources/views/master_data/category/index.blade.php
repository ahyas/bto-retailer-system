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
                <table class="tb_category cell-border table-sm" id="selected_row">
                    <thead>
                        <tr>
                            <td></td>
                            <td><span class="inline-container" title>Category name</span></td>
                        </tr>
                    </thead>
                        <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
@include('master_data/category/form')
@include('master_data/popup/index')
@endsection

@push('scripts')
<script type="text/javascript">
$(document).ready(function(){
    var success = new Audio("{{asset('public/sound/chime2.wav')}}");
    var warning = new Audio("{{asset('public/sound/chime.wav')}}");

    disabledButton(true);

    var tb_category = $(".tb_category").DataTable({
        ajax        :"{{route('master_data.category.fetch')}}",
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
            {data:"category_name"},
        ]
    });
    
    // start section numbering column
    tb_category.on('order.dt search.dt', function () {
        let i = 1;
        tb_category.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
    }).draw();
    // end section numbering column

    $("body").on("click",".add", function(){
        formSetter(false);
    });

    $("body").on("click",".edit", function(){
        formSetter(true);
        var id_category = $("#id_category").val();
        $.ajax({
            url:"{{route('master_data.category.edit')}}",
            type:"GET",
            data:{id_category:id_category},
            success:function(data){
                $("#category_name").val(data.category_name);
            }
        });
    });

    //start section select row
    $('.tb_category tbody').on('click', 'tr', function(){
        var id_category = tb_category.row( this ).data().id;
        console.log(id_category);
        $("#id_category").val(id_category);

        if ($(this).hasClass('selected')) {
            disabledButton(true);
            $(this).removeClass('selected');
        }else{
            tb_category.$('tr.selected').removeClass('selected');
            disabledButton(false);
            $(this).addClass('selected');
        }
    });
    //end section select row

    $("#saveBtn").click(function(e){
        e.preventDefault();
        if(formValidation()!==false){
            $.ajax({
                url     :"{{route('master_data.category.save')}}",
                type    :"POST",
                data    :$("#categoryForm").serialize(),
                success :function(data){
                    $("#formCategory").modal("hide");
                    $(".tb_category").DataTable().ajax.reload();
                    popupMsg("Data successfuly added!");
                }
            });
        }
    });

    $("#updateBtn").click(function(e){
        e.preventDefault();
        $.ajax({
            url     :"{{route('master_data.category.update')}}",
            type    :"POST",
            data    :$("#categoryForm").serialize(),
            success :function(data){
                $("#formCategory").modal("hide");
                popupMsg("Data successfuly updated!");
            }
        });
    });

    $("body").on("click",".delete", function(){
        var id_category = $("#id_category").val();
        console.log(id_category);
        if(confirm("Are you sure you want to delete this data?")){
            $.ajax({
                url     :"{{route('master_data.category.delete')}}",
                type    :"GET",
                data    :{id_category:id_category},
                success :function(data){
                    if(data.result == false){
                        popupMsg("Error: This category has been assigned to product!");
                        return false;
                    }
                    disabledButton(true);
                    $(".tb_category").DataTable().ajax.reload();
                    popupMsg("Data successfuly deleted!");
                }
            });
        }
    });

    $("#formCategory").on('hide.bs.modal', function(){
        disabledButton(true);
        $(".tb_category").DataTable().ajax.reload();
    });

    //start section set form state
    function formSetter(value){
        if(value==true){
            $("#formCategory").modal("show");
            $("#category_name").val("");
            $("#category_name").focus();
            document.getElementById("saveBtn").style.display = "none";
            document.getElementById("updateBtn").style.display = "inline-block";
            document.getElementById("addHeading").innerHTML = "Edit category";
        }else{
            $("#formCategory").modal("show");
            $("#category_name").val("");
            $("#category_name").focus();
            document.getElementById("saveBtn").style.display = "inline-block";
            document.getElementById("updateBtn").style.display = "none";
            document.getElementById("addHeading").innerHTML = "Add category";
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