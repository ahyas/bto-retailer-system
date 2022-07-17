<link rel="stylesheet" href="{{asset('public/style/table.css')}}">
<body>
    <?php $number = 1; ?>
<div class="header">
    <div class="logo">
        <img src="{{asset('public/logo/image.png')}}"/>
    </div>
    <h2>Warehouse Inventory List</h2>
    <h5>Back to Office CRUD Panel System</h5>
    <h5><?php echo date("Y-m-d"); ?></h5>
</div>
<table>
    <tr>
        <th>No.</th>
        <th>Barcode</th>
        <th>Item</th>
        <th width="200px">Category</th>
        <th>Sub category</th>
        <th>Stock</th>
        <th>Unit</th>
    </tr>
    @foreach($table as $row)
    <tr>
        <td align="right">{{$number}}</td>
        <td>{{$row->barcode}}</td>
        <td>{{$row->item}}</td>
        <td>{{$row->category_name}}</td>
        <td>{{$row->sub_category_name}}</td>
        <td align="right">{{$row->stock}}</td>
        <td>{{$row->unit}}</td>
    </tr>
    <?php echo $number++; ?>
    @endforeach
    
</table>
</body>