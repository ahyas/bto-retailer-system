<div class="modal fade" id="formProduct" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <span id="addHeading"></span><button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="productForm" class="form-horizontal">
                    {{csrf_field()}}
                    <input type="hidden" id="id_product" name="id_product" >
                    <div class="form-group required">
                        <div class="col-sm-6" >
                            <label class="control-label">Barcode</label>
                            <input type="text" class="form-control form-control-sm" id="barcode" name="barcode" >
                        </div>
                    </div>
                    <div class="form-group required">
                        <div class="col-sm-12" >
                        <label class="control-label">Product name</label>
                            <input type="text" class="form-control form-control-sm" id="product_name" name="product_name" >
                        </div>
                    </div>
                    
                    <div class="form-group required">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-8">
                                    <label class="control-label required">Category</label>
                                    <select class="form-control form-control-sm" name="id_category" id="id_category">
                                        <option value="0">Choose category</option>
                                        @foreach($tb_category as $row)
                                        <option value="{{$row->id}}">{{$row->category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-6" >
                                    <label class="control-label">Selling price (Normal)</label>
                                    <input type="text" class="form-control form-control-sm text-sm-right" id="selling_price" name="selling_price">
                                </div>
                                <div class="col-sm-6" >
                                    <label class="control-label">Selling promo price</label>
                                    <input type="text" class="form-control form-control-sm text-sm-right" id="selling_promo_price" name="selling_promo_price">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-6" >
                                    <label class="control-label">Wholesale price (Normal)</label>
                                    <input type="text" class="form-control form-control-sm text-sm-right" id="wholesale_price" name="wholesale_price">
                                </div>
                                <div class="col-sm-6" >
                                    <label class="control-label">Wholesale promo price</label>
                                    <input type="text" class="form-control form-control-sm text-sm-right" id="wholesale_promo_price" name="wholesale_promo_price">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-6 control-label">Purchase price</label>
                        <div class="col-sm-6" >
                            <input type="text" class="form-control form-control-sm text-sm-right" id="purchase_price" name="purchase_price" readonly>
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-3" >
                                    <label class="control-label">Current stock</label>
                                    <input type="text" class="form-control form-control-sm text-sm-right" id="current_stock" name="current_stock" readonly>
                                </div>
                                <div class="col-sm-3" >
                                    <label class="control-label">Tax (%)</label>
                                    <input type="text" class="form-control form-control-sm text-sm-right" id="tax" name="tax">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-6 control-label">Notes</label>
                        <div class="col-sm-12" >
                            <textarea class="form-control" id="notes" name="notes" rows="2"></textarea>
                        </div>
                    </div>

                </form>
                <div class="modal-footer">
                    <button class="btn btn-sm" id="saveBtn">Save</button>
                    <button class="btn btn-sm" id="updateBtn">Update</button>
                    <button type="button" class="btn btn-sm" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>