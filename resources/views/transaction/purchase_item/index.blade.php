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
                <table class="tb_purchase cell-border table-sm" id="selected_row">
                    <thead>
                        <tr>
                            <td></td>
                            <td><span class="inline-container" title>Code</span></td>
                            <td><span class="inline-container" title>Supplier</span></td>
                            <td><span class="inline-container" title>Total amount</span></td>
                            <td><span class="inline-container" title>Total purchase</span></td>
                            <td><span class="inline-container" title>Date</span></td>
                        </tr>
                    </thead>
                        <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
@include('transaction/purchase_item/form_purchase')
@endsection

@push('scripts')
<script type="text/javascript">
$(document).ready(function(){
    $(".tb_purchase").DataTable({
        ajax:"{{route('transaction.purchase_item.fetch')}}",
        ordering:false,
        serverside:false,
        columns:[
            {
                "width" :"5px",
                "className":      'numbering',
                "orderable":      false,
                "data":           1,
                "defaultContent": ''
            },
            {data:"purchase_code"},
            {data:"supplier"},
            {data:"total_amount"},
            {data:"total_purchase"},
            {data:"created_at"},
        ]
    });

    function good_purchase(receipt_code){
        $(".tb_detail_purchase").DataTable({
            ajax:{
                url: "{{route('transaction.purchase_item.good_purchase')}}",
                type:"GET",
                data:{receipt_code:receipt_code}
            },
            searching:false,
            ordering:false,
            serverside:false,
            columns:[
                {
                    "width" :"5px",
                    "className":      'numbering',
                    "orderable":      false,
                    "data":           1,
                    "defaultContent": ''
                },
                {data:"barcode"},
                {data:"product_name"},
                {data:"selling_price"},
                {data:"purchase_price"},
                {data:"qty"},
            ]
        });
    }

    $("body").on("click",".add",function(){
        document.getElementById("addHeading").innerHTML = "Good purchase - Add new";
        
        good_purchase();
        $("#formPurchase").modal("show");
    });

});
</script>
@endpush