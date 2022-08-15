<div class="modal fade" id="formCategory" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <span id="addHeading"></span><button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="categoryForm" class="form-horizontal">
                    {{csrf_field()}} {{method_field('POST')}}
                    <input type="hidden" id="id_category" name="id_category" >
                    <div class="form-group required">
                        <label class="col-sm-6 control-label">Category name</label>
                        <div class="col-sm-12" >
                            <input type="text" class="form-control form-control-sm" id="category_name" name="category_name" >
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