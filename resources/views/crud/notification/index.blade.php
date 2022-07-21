<div class="modal fade" id="alertOK" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" data-tor="show(p):{scale.from(75) fade.in} quad">
            <div class="modal-header bg-info text-white">
                <p id="alertHeading">Notification</p><button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class='container2'>
                    <div>
                        <img src="{{asset('public/logo/checked.png')}}" class='iconDetails'/>
                    </div>
                    <div style="margin-left:50px;"> 
                        <span id="alertMsg"></span>
                    </div>
                </div>
                <br>
                <div class="modal-footer">
                    <button class="btn btn-sm" data-dismiss="modal" style="margin-left:auto; margin-right:auto;">OK</button>
                </div>
            </div>
        </div>
    </div>
</div>