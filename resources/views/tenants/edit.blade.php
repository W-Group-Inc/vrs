<div class="modal fade" id="edit_tenant{{$tenant->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="{{url('update_tenant/'.$tenant->id)}}" method="POST">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Edit Tenant</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px; color: red; font-size: 25px">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-10">
                            <label>Name</label>
                            <input name="name" class="form-control" type="text" value="{{$tenant->name}}">
                        </div>
                        <div class="col-12 mb-10">
                            <label>Building Name</label>
                            <select name="building_id" id="building_id" class="form-control selectpicker" title="Select Building Name"> 
                                @foreach($buildings as $building)
                                    <option value="{{ $building->id }}" {{ ($tenant->building_id == $building->id) ? 'selected' : '' }}>
                                        {{ $building->name }}
                                    </option>
                                @endforeach 
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save changes</button>
                </div>
            </div>
        </div>
    </form>
</div>