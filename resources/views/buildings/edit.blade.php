<div class="modal fade" id="edit_building{{$building->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="{{url('update_building/'.$building->id)}}" method="POST">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Edit Building</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px; color: red; font-size: 25px">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-10">
                            <label>Name</label>
                            <input name="name" class="form-control" type="text" value="{{$building->name}}">
                        </div>
                        <div class="col-12 mb-10">
                            <label>Address</label>
                            <input name="address" class="form-control" type="text" value="{{$building->address}}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="type" class="btn btn-success">Save changes</button>
                </div>
            </div>
        </div>
    </form>
</div>