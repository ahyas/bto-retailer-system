@extends('layout/app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transaksi Barang Masuk</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body style="background-color:#ececec">
<?php date_default_timezone_set('Asia/Jayapura'); ?>
    <div class="container" >
        <div class="col-md-12 mt-5">
            <div class="card">

                <div class="card-header" style="background-image: linear-gradient(#9fbbc6, #2a88b0); height: 30px; line-height: 6px; font-size: 14px; border-top: 1px white solid">
                   <h6 style="line-height: 0; color:white">Transaksi Barang Masuk</h6>
                </div>
                <div class="card-body" style="background-color:#BDE1F1">
                <div class="row">
                    <div class="col">
                        <label><b>No. Referensi :</b></label>
                        <input type="text" value="{{$no_ref}}" class="form-control no-ref" id="no_ref" disabled="true">
                    </div>
                    <div class="col">
                        <?php $tgl = date("d/m/Y"); ?>
                        <label><b>Tanggal :</b></label>
                        <input type="text" value="{{$tgl}}" class="form-control tanggal" id="tanggal">
                    </div>

                    <div class="col">
                        <label><b>Supplier :</b></label>
                        <select class="form-control id_supplier" id="id_supplier">
                            <option value="">Pilih supplier</option>
                            @foreach($supplier as $row)
                            <option value="{{$row->id}}">{{$row->nama_supplier}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button href="javascript:void(0)" class="btn btn-success btn-sm add" style=" margin-bottom:20px; margin-top:20px">Add</button>
                <button class="btn btn-primary btn-sm save" id="save" style=" margin-bottom:20px; margin-top:20px">Save</button>
                    <table class="table display" style="font-size:14px" width="100%">
                        <thead style="background-color:#cecece">
                            <tr>
                                <th>ID</th>
                                <th>Kode barang</th>
                                <th width="300px">Nama Barang</th>
                                <th style="text-align:right">Qty.</th>
                                <th style="text-align:right">Harga satuan</th>
                                <th style="text-align:right">Subtotal</th>
                                <th width="100px">Action</th>
                            </tr>
                        </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr style="background-color:#cecece">
                                    <th colspan="2" style="text-align:center">TOTAL:</th>
                                    <th style="text-align:right"></th>
                                    <th style="text-align:right"></th>
                                    <th style="text-align:right"></th>
                                    <th style="text-align:right"></th>
                                    <th style="text-align:right"></th>
                                </tr>
                            </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="formSimpanBarang" aria-hidden="true">
    
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="font-size: 13px;">
            <div class="modal-header bg-info text-white" style="background-image: linear-gradient(#9fbbc6, #2a88b0); height: 30px; line-height: 6px; font-size: 14px; border-top: 1px white solid">
                <h6 id="addTitle" style="line-height: 0"></h6><button style="line-height: 0" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" style="background-color: #BDE1F1">
                <form id="myform" class="form-horizontal">

                    {{csrf_field()}} {{method_field('POST')}}
                    <input type="hidden" class="form-control form-control-sm id_transaksi" id="id_transaksi" name="id_transaksi" >
                    <div class="form-group">
                        <label style="padding-top: 0" class="col-sm-6 control-label">Kode Barang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-sm kode_barang" id="kode_barang" name="kode_barang" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label style="padding-top: 0" class="col-sm-6 control-label">Nama Barang : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-sm nama_barang" id="nama_barang" name="nama_barang" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label style="padding-top: 0" class="col-sm-6 control-label">Harga satuan : </label>
                        <div class="col-sm-10">
                            <input type="text" value="0" class="form-control form-control-sm harga_satuan" id="harga_satuan" name="harga_satuan" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label style="padding-top: 0" class="col-sm-6 control-label">Qty : </label>
                        <div class="col-sm-4">
                            <input type="number" value="1" min="1" class="form-control form-control-sm qty" id="qty" name="qty" >
                        </div>
                    </div>

                    <div class="modal-footer" style="font-size:11px; display:inline-block;">

                        <button type="submit" class="btn btn-primary btn-sm" id="insertBtn">Insert</button>

                        <button type="submit" class="btn btn-primary btn-sm" id="updateBtn">Update</button>
                        
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="formDaftarBarang" aria-hidden="true">
    
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" style="font-size: 13px;">
            <div class="modal-header bg-info text-white" style="background-image: linear-gradient(#9fbbc6, #2a88b0); height: 30px; line-height: 6px; font-size: 14px; border-top: 1px white solid">
                <h6 id="addTitle" style="line-height: 0">Daftar barang</h6><button style="line-height: 0" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" style="background-color: #BDE1F1">
                <table class="daftar_barang display" style="font-size:13px" width="100%">
                    <thead>
                        <tr>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Stock</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                        <tbody></tbody>
                </table>
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

    $('#tanggal').datepicker({
        format: "dd/mm/yyyy",
        autoclose: true,
        todayHighlight: true,
        weekStart: 1,
        daysOfWeekHighlighted: "0,6"
    });

    $("#tanggal").prop('disabled', false);
    
    $(".table").DataTable({
        ajax        : "{{route('barang_masuk.show_data')}}",
        serverSide  : false,
        processing  : false,
        searching   : false,
        scrollY     :"200px",
        bPaginate   : false,
        ordering    : false,
        footerCallback: function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
            qtyTotal = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            grandTotal = api
                .column( 5, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            
            if(grandTotal>0){
                document.getElementById("save").disabled=false;
            }else{
                document.getElementById("save").disabled=true;
            }
 
            // Update footer
            $( api.column( 3 ).footer() ).html(new Intl.NumberFormat().format(qtyTotal));
            $( api.column( 5 ).footer() ).html(new Intl.NumberFormat().format(grandTotal));           

        },
        columns:
        [
            {data:"id", visible:false},
            {data:"kode_barang"},
            {data:"nama_barang"},
            {data:"qty", className: 'dt-body-right'},
            {data:"harga_satuan", className: 'dt-body-right'},
            {data:"subtotal", className: 'dt-body-right'},
            {data:"kode_barang",
                mRender:function(data, type, full){
                    return'<a href="javascript:void(0)" data-id_transaksi='+full['id']+' data-kode_barang='+data+' class="btn btn-warning btn-sm edit">Edit</a> <a href="javascript:void(0)" data-id_transaksi='+full['id']+' data-kode_barang='+data+' class="btn btn-danger btn-sm delete">Delete</a>';
                }
            }
        ]
    });

    $(".daftar_barang").DataTable({
        ajax        :"{{route('daftar_barang.show_data')}}",
        serverSide  :false,
        processing  :false,
        ordering    :false,
        columns     :
        [
            {data:"kode_barang"},
            {data:"nama_barang"},
            {data:"stock"},
            {data:"kode_barang",
                mRender:function(data){
                    return'<a href="javascript:void(0)" data-kode_barang='+data+' class="btn btn-warning btn-sm pilih">Pilih</a>';
                }
            },
        ]
    });

    getQty();
    //mencari total qty
    function getQty(){
        var ref_pembelian = $("#no_ref").val();
        $.ajax({
            url:"barang_masuk/"+ref_pembelian+"/getQty",
            type:"GET",
            dataType:"JSON",
            success:function(data){
                if(data==0){
                    document.getElementById("save").disabled=true;
                }else{
                    document.getElementById("save").disabled=false;
                }
                console.log(data);
            }
        });
    }

    $("body").on("click", ".add", function(){
        document.getElementById("addTitle").innerHTML = "Cari Barang";
        document.getElementById("insertBtn").style.display = "inline-block";
        document.getElementById("updateBtn").style.display = "none";
        $(".daftar_barang").DataTable().ajax.reload();
        $("#formDaftarBarang").modal("show");
    });

    $("body").on("click", ".edit", function(){
        var id_transaksi = $(this).data("id_transaksi");
        document.getElementById("addTitle").innerHTML = "Edit Barang";
        document.getElementById("insertBtn").style.display = "none";
        document.getElementById("updateBtn").style.display = "inline-block";
        $.ajax({
            url     :"barang_masuk/"+id_transaksi+"/edit",
            type    :"GET",
            dataType:"JSON",
            success:function(data){
                $("#id_transaksi").val(id_transaksi);
                $("#kode_barang").val(data.kode_barang);
                $("#nama_barang").val(data.nama_barang);
                $("#harga_satuan").val(data.harga_satuan);
                $("#qty").val(data.qty);
                $("#formSimpanBarang").trigger("reset");
                $("#formSimpanBarang").modal("show");
            }
        });
        
    });

    $("#updateBtn").click(function(e){
        e.preventDefault();
        var qty = $("#qty").val();
        var kode_barang = $("#kode_barang").val();
        var ref_pembelian = $("#no_ref").val();
        if(qty==0){
            alert("Qty. tidak boleh kosong");
        }else{
            $.ajax({
                url     :"barang_masuk/"+ref_pembelian+"/"+kode_barang+"/update",
                type    :"GET",
                dataType:"JSON",
                data    :$("#myform").serialize(),
                success :function(data){
                    $(".table").DataTable().ajax.reload();
                    $("#formSimpanBarang").modal("hide");
                }
            });
        }
    });

    $("body").on("click",".pilih",function(){
        var kode_barang = $(this).data("kode_barang");
        var ref_pembelian = $("#no_ref").val();
        console.log(ref_pembelian);
        console.log($(this).data("kode_barang"));
        $.ajax({
            url     :"barang_masuk/"+kode_barang+"/pilih",
            type    :"GET",
            dataType:"JSON",
            success :function(data){
                $("#formDaftarBarang").modal("hide");
                $("#kode_barang").val(data.kode_barang);
                $("#nama_barang").val(data.nama_barang);
                $("#harga_satuan").val(0);
                $("#qty").val(1);
                $("#formSimpanBarang").modal("show");
                document.getElementById("save").disabled=false;
            }
        });
    });

    $("#formSimpanBarang").on("shown.bs.modal", function(){
        $("#harga_satuan").focus();
    });

    $("#insertBtn").on("click", function(e){
        e.preventDefault();
        var ref_pembelian = $("#no_ref").val();
        var kode_barang=$("#kode_barang").val();
        var harga_satuan=$("#harga_satuan").val();
        var qty = $("#qty").val();
        
		if(harga_satuan>0){
            $.ajax({
                url:"barang_masuk/"+ref_pembelian+"/"+kode_barang+"/insert",
                type:"GET",
                data:$("#myform").serialize(),
                success:function(data){
                    $("#formSimpanBarang").modal("hide");
                    $(".table").DataTable().ajax.reload();
                    document.getElementById("save").disabled=false;
                }
            });
        }else{
            alert("Harga satuan tidak boleh kosong");
        }
    });

    $("body").on("click",".save", function(){
        var ref_pembelian = $("#no_ref").val();
        var id_supplier = $("#id_supplier").val();
        if(confirm("Pastikan semua data sudah benar")){
            $.ajax({
                url     :"barang_masuk/"+ref_pembelian+"/save",
                type    :"GET",
                data    :{id_supplier:id_supplier},
                dataType:"JSON",
                success : function(data){
                    $("#no_ref").val(data.no_ref);
                    $("#id_supplier").val("");
                    $(".table").DataTable().ajax.reload();
                    document.getElementById("save").disabled=true;
                }
            });
        }
    });

    $("body").on("click",".delete", function(){
        
        var id_transaksi = $(this).data("id_transaksi");
        console.log(id_transaksi);
        if(confirm("Yakin ingin menghapus data ini?")){
                $.ajax({
                url     :"barang_masuk/"+id_transaksi+"/delete",
                type    :"GET",
                dataType:"JSON",
                success :function(data){
                    $(".table").DataTable().ajax.reload();
                
                }
            });
        }
        
    });

});
</script>
@endpush