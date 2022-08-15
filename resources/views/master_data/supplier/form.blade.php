<div class="modal fade" id="formSupplier" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <span id="addHeading"></span><button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="supplierForm" class="form-horizontal" method="POST">
                    {{csrf_field()}}
                    <input type="hidden" id="id_supplier" name="id_supplier" >
                    <div class="form-group required">
                        <div class="col-sm-12">
                            <label class="control-label">Name</label>
                            <input type="text" class="form-control form-control-sm" id="supplier_name" name="supplier_name" >
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="col-sm-12">
                            <label class="control-label">Email</label>
                            <input type="text" class="form-control form-control-sm" id="email" name="email" >
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="col-sm-12">
                            <label class="control-label">Address</label>
                            <input type="text" class="form-control form-control-sm" id="address" name="address" >
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="col-sm-12">
                            <label class="control-label">City</label>
                            <input type="text" class="form-control form-control-sm" id="city" name="city" >
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="col-sm-12">
                            <label class="control-label">State</label>
                            <input type="text" class="form-control form-control-sm" id="state" name="state" >
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="col-sm-12">
                            <label class="control-label">Country</label>
                            <input type="text" class="form-control form-control-sm" id="country" name="country" >
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="col-sm-12">
                            <label class="control-label">Postal</label>
                            <input type="text" class="form-control form-control-sm" id="postal" name="postal" >
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="col-sm-12">
                            <label class="control-label">Phone</label>
                            <input type="text" class="form-control form-control-sm" id="phone" name="phone" >
                        </div>
                    </div>

                    <div class="form-group required">
                        <div class="col-sm-12">
                            <label class="control-label">Fax</label>
                            <input type="text" class="form-control form-control-sm" id="fax" name="fax" >
                        </div>
                    </div>
                    
                </form>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm" id="saveBtn">Save</button>
                    <button type="submit" class="btn btn-sm" id="updateBtn">Update</button>
                    <button type="button" class="btn btn-sm" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>