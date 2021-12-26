@extends('layout/app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transaksi Barang Keluar</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body style="background-color:#ececec">
    <div class="container">
        <div class="col-md-12 mt-5">
            <div class="card">

                <div class="card-header" style="background-image: linear-gradient(#9fbbc6, #2a88b0); height: 30px; line-height: 6px; font-size: 14px; border-top: 1px white solid">
                    <h6 style="line-height: 0; color:white">Transaksi Barang Keluar</h6>
                </div>
                <div class="card-body" style="background-color:#BDE1F1">
                
                <div class="row">
                    <div class="col">
                <label><b>No. Referensi :</b></label>
                    <input type="text" value="{{$no_ref}}" class="form-control no-ref" id="no_ref" disabled="true" style="margin-bottom:10px">
                </div>

                <div class="col">
                        <?php $tgl = date("d/m/Y"); ?>
                        <label><b>Tanggal :</b></label>
                        <input type="text" value="{{$tgl}}" class="form-control tanggal" id="tanggal">
                    </div>

                <div class="col">
                <label><b>Penerima :</b></label>
                    <select class="form-control penerima" name="penerima" id="penerima" style="margin-bottom:10px">
                        <option value="0">Pilih penerima</option>
                        @foreach($penerima as $row)
                            <option value="{{$row->id}}">{{$row->penerima}}</option>
                        @endforeach
                    </select>
                </div>
                </div>

                <div class="row">
                    <div class="col">
                    <label style="margin-top:10px"><b>Barcode :</b></label>
                        <input type="text" class="form-control barcode" id="barcode" placeholder="Scan barcode"/>
                        <small id="emailHelp" class="form-text text-muted">Scan barcode menggunakan barcode scanner.</small>
                    </div>
                </div>

                <button href="javascript:void(0)" class="btn btn-success btn-sm add" style="margin-bottom:20px; margin-top:20px">Add</button>
                <button class="btn btn-primary btn-sm save" id="save" style="margin-bottom:20px; margin-top:20px" disabled>Save</button>
                    <table class="table display" style="font-size:14px" width="100%">
                        <thead style="background-color:#cecece">
                            <tr>
                                <th>Kode barang</th>
                                <th width="300px">Nama Barang</th>
                                <th style="text-align:right">Qty.</th>
                                <th width="100px">Action</th>
                            </tr>
                        </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr style="background-color:#cecece">
                                    <th colspan="2" style="text-align:center">TOTAL:</th>
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
                <h6 id="addHeading" style="line-height: 0">Edit item</h6><button style="line-height: 0" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" style="background-color: #BDE1F1">
                <form id="myForm" class="form-horizontal">

                    {{csrf_field()}} {{method_field('POST')}}
                    <input type="hidden" class="form-control form-control-sm ref_pemakaian" id="ref_pemakaian" name="ref_pemakaian" >
                    
                    <div class="form-group">
                        <label style="padding-top: 0" class="col-sm-6 control-label">Kode Barang</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control form-control-sm kode_barang" id="kode_barang" name="kode_barang" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label style="padding-top: 0" class="col-sm-6 control-label">Nama Barang : </label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control form-control-sm nama_barang" id="nama_barang" name="nama_barang" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label style="padding-top: 0" class="col-sm-6 control-label">Qty : </label>
                        <div class="col-sm-5">
                            <input type="number" min="1" class="form-control form-control-sm qty" id="qty" name="qty" >
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

<div class="modal fade" id="formDaftarBarang" aria-hidden="true">
    
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" style="font-size: 13px;">
            <div class="modal-header bg-info text-white" style="background-image: linear-gradient(#9fbbc6, #2a88b0); height: 30px; line-height: 6px; font-size: 14px; border-top: 1px white solid">
                <h6 id="addTitle" style="line-height: 0"></h6><button style="line-height: 0" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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

    $(".barcode").focus();

    $("#penerima").select2({
        placeholder: "Pilih penerima",
    });
    
    var keranjang = $(".table").DataTable({
        ajax        : "{{route('barang_keluar.show_data')}}",
        serverSide  : false,
        processing  : false,
        searching   : false,
        scrollY     : "200px",
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
                .column( 2, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            
            if(qtyTotal>0){
                document.getElementById("save").disabled=false;
            }else{
                document.getElementById("save").disabled=true;
            }
 
            // Update footer
            $( api.column( 2 ).footer() ).html(new Intl.NumberFormat().format(qtyTotal));
                     

        },
        columns     :
        [
            {data:"kode_barang"},
            {data:"nama_barang"},
            {data:"qty",className: 'dt-body-right'},
            {data:"kode_barang",
                mRender:function(data, type, full){
                    return'<a href="javascript:void(0)" data-kode_barang='+data+' class="btn btn-warning btn-sm edit">Edit</a> <a href="javascript:void(0)" data-kode_barang='+data+' class="btn btn-danger btn-sm delete">Delete</a>';
                }
            }
        ]
    });

    getQty();
    //mencari total qty
    function getQty(){
        var ref_pemakaian = $("#no_ref").val();
        $.ajax({
            url:"barang_keluar/"+ref_pemakaian+"/getQty",
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

    $(".daftar_barang").DataTable({
        ajax        :"{{route('daftar_barang.show_data')}}",
        serverSide  :false,
        order       :[[ 2, "desc" ]],
        processing  :false,
        ordering    :false,
        columns     :
        [
            {data:"kode_barang"},
            {data:"nama_barang"},
            {data:"stock"},
            {data:"kode_barang",
                mRender:function(data, type, full){
                    if(full['stock']<=0){
                        return'<button disabled data-kode_barang='+data+' class="btn btn-warning btn-sm pilih">Pilih</button>';
                    }else{
                        return'<button data-kode_barang='+data+' class="btn btn-warning btn-sm pilih">Pilih</button>';
                    }
                    
                }
            },
        ]
    });

    $("body").on("click", ".add", function(){
        document.getElementById("addTitle").innerHTML = "Cari Barang";
        document.getElementById("saveBtn").style.display = "inline-block";
        document.getElementById("updateBtn").style.display = "none";
        $(".daftar_barang").DataTable().ajax.reload();
        $("#formDaftarBarang").modal("show");
    });

    $("body").on("click", ".edit", function(){
        var kode_barang = $(this).data("kode_barang");
        var ref_pemakaian = $("#no_ref").val();
        console.log(kode_barang);
        console.log(ref_pemakaian);
        $("#ref_pemakaian").val(ref_pemakaian);
        $("#kode_barang").val(kode_barang);

        document.getElementById("addTitle").innerHTML = "Edit Barang";
        document.getElementById("saveBtn").style.display = "none";
        document.getElementById("updateBtn").style.display = "inline-block";
        $.ajax({
            url     :"barang_keluar/"+ref_pemakaian+"/"+kode_barang+"/edit",
            type    :"GET",
            dataType:"JSON",
            success:function(data){
                $("#kode_barang").val(data.kode_barang);
                $("#nama_barang").val(data.nama_barang);
                $("#qty").val(data.qty);
                $("#formSimpanBarang").trigger("reset");
                $("#formSimpanBarang").modal("show");
            }
        });
        
    });

    $("#updateBtn").click(function(e){
        e.preventDefault();
        
        $.ajax({
            url     :"{{route('barang_keluar.update')}}",
            type    :"POST",
            dataType:"JSON",
            data    :$("#myForm").serialize(),
            success :function(data){

                $(".table").DataTable().ajax.reload(null, false);
                $("#formSimpanBarang").modal("hide");
            }
        });
    });

    $("body").on("click",".pilih",function(){
        
        var kode_barang = $(this).data("kode_barang");
        var ref_pemakaian = $("#no_ref").val();
        console.log(ref_pemakaian);
        console.log($(this).data("kode_barang"));

        $.ajax({
            url     :"barang_keluar/"+ref_pemakaian+"/"+kode_barang+"/pilih",
            type    :"GET",
            dataType:"JSON",
            success :function(data){
                
                $(".table").DataTable().ajax.reload(null, false);
                $("#formDaftarBarang").modal("hide");
                document.getElementById("save").disabled=false;
            }
        });
        
    });

    $("body").on("change",".barcode",function(){
        
        var kode_barang = $(this).val();
        var ref_pemakaian = $("#no_ref").val();
        console.log(ref_pemakaian);
        console.log(kode_barang);

        $.ajax({
            url     :"barang_keluar/"+ref_pemakaian+"/"+kode_barang+"/pilih",
            type    :"GET",
            dataType:"JSON",
            success :function(data){
                if(data.ketemu==true){
                    console.log("ketemu "+data.ketemu);
                    $(".table").DataTable().ajax.reload(null, false);
                    
                    document.getElementById("save").disabled=false;
                }else{
                    alert("Barang tidak ditemukan");
                }

                $(".barcode").val("");
                $(".barcode").focus();
                
            }
        });
        
    });

    $("body").on("click",".save", function(){
        var id_penerima = $("#penerima").val();
        console.log("penerima "+id_penerima);
        if(id_penerima=="0"){
            alert("Error: Pilih nama penerima");
        }else{
            var ref_pemakaian = $("#no_ref").val();
            if(confirm("Alert: Pastikan semua data sudah benar.")){
                $.ajax({
                    url     :"barang_keluar/"+ref_pemakaian+"/save",
                    type    :"GET",
                    data    :{id_penerima:id_penerima},
                    dataType:"JSON",
                    success : function(data){
                        $("#no_ref").val(data.no_ref);
                        $(".table").DataTable().ajax.reload(null, false);
                        document.getElementById("save").disabled=true;
                        $("#penerima").val("");
                        window.open("barang_keluar/"+ref_pemakaian+"/print");
                    }
                });
            }
        }

    });

    $("body").on("click",".delete", function(){
        
        var kode_barang = $(this).data("kode_barang");
        var ref_pemakaian = $("#no_ref").val();
        console.log(kode_barang);
        console.log(ref_pemakaian);

        $.ajax({
            url     :"barang_keluar/"+ref_pemakaian+"/"+kode_barang+"/delete",
            type    :"GET",
            dataType:"JSON",
            success :function(data){
                console.log(data.count);
                if(data.count==0){
                    document.getElementById("save").disabled=true;
                    console.log("kosong");
                }

                $(".table").DataTable().ajax.reload(null, false);
               
            }
        });
    });

});
</script>
@endpush