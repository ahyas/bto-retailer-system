<head>
    <link rel = "icon" href ="{{asset('public/logo/image2.png')}}" type = "image/x-icon">
    <link rel="stylesheet" href="{{asset('public/style/table.css')}}">
</head>
<body>
    <?php $number = 1; ?>
<div class="header">
    <div class="logo">
        <img src="{{asset('public/logo/image2.png')}}"/>
    </div>
    <h2>Warehouse Inventory List</h2>
    <h5>Powered by Back to Office CRUD Management System</h5>
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