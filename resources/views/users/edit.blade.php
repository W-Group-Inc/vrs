@section('css')
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endsection
<div class="modal fade" id="edit_user{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form id="updateUserForm{{$user->id}}" action="{{url('update_user/'.$user->id)}}" method="POST">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Edit User</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-10">
                            <label>Name</label>
                            <input name="name" class="form-control @if($errors->first('name')) is-invalid @endif name" type="text" value="{{$user->name}}">
                        </div>
                        <div class="col-12 mb-10">
                            <label>Position</label>
                            <input name="position" class="form-control @if($errors->first('position')) is-invalid @endif position" type="text" value="{{$user->position}}">
                        </div>
                        <div class="col-12 mb-10">
                            <label>Email</label>
                            <input name="email" class="form-control @if($errors->first('email')) is-invalid @endif email" type="text" value="{{$user->email}}">
                        </div>
                        <div class="col-12 mb-10">
                            <label>Role</label>
                            <select name="role" class="form-control selectpicker @if($errors->first('role')) is-invalid @endif role" title="Select Position">
                                <option value="Admin"{{$user->role == 'Admin' ? ' selected' : ''}}>Admin</option>
                                <option value="Guard"{{$user->role == 'Guard' ? ' selected' : ''}}>Guard</option>
                                <option value="Tenant"{{$user->role == 'Tenant' ? ' selected' : ''}}>Tenant</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" onclick="updateForm({{$user->id}})">Save changes</button>
                </div>
            </div>
        </div>
    </form>
</div>
@section('footer')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@endsection