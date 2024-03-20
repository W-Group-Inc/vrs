@extends('layouts.header')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>User List</h5>
                    <div class="ibox-tools">
                        <button class="btn btn-success" data-toggle="modal" data-target="#add_user"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add User</button>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="wrapper wrapper-content animated fadeIn">
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover table-responsive dataTables">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                        <tr>
                                            <td width="22%">{{$user->name}}</td>
                                            <td width="21%">{{$user->position}}</td>
                                            <td width="21%">{{$user->email}}</td>
                                            <td width="21%">{{$user->role}}</td>
                                            <td width="15%" align="center">
                                                <button type="button" class="btn btn-success btn-outline" data-toggle="modal" data-target="#edit_user{{ $user->id }}"><i class="fa fa fa-pencil"></i><a href="{{ url('update_user/' .$user->id) }}"></a></button>
                                                <a href="{{ route('user.delete', ['id' => $user->id]) }}">
                                                    <button type="button" class="btn btn-danger btn-outline" title="Delete User"><i class="fa fa fa-ban"></i></button>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@foreach($users as $user)
    @include('users.edit')
@endforeach
<div class="modal fade" id="add_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form id="addUserForm" method="POST" action="{{ url('new_user') }}" autocomplete="off">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Add User</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-10">
                            <label>Name</label>
                            <input name="name" id="name" class="form-control @if($errors->first('name')) is-invalid @endif" type="text" placeholder="Enter Name">
                        </div>
                        <div class="col-12 mb-10">
                            <label>Position</label>
                            <input name="position" id="position" class="form-control @if($errors->first('position')) is-invalid @endif" type="text" placeholder="Enter Position">
                        </div>
                        <div class="col-12 mb-10">
                            <label>Email Address</label>
                            <input name="email" id="email" class="form-control @if($errors->first('email')) is-invalid @endif" type="text" placeholder="Enter Email Address">
                        </div>
                        <div class="col-12 mb-10">
                            <label>Role</label>
                            <select name="role" id="role" class="form-control selectpicker @if($errors->first('role')) is-invalid @endif" title="Select Position">
                                <option value="Admin">Admin</option>
                                <option value="Guard">Guard</option>
                                <option value="Tenant">Tenant</option>
                            </select>
                        </div>
                        <div class="col-12 mb-10">
                            <label>Password</label>
                            <input name="password" id="password" class="form-control @if($errors->first('password')) is-invalid @endif" type="password" placeholder="Enter Password">
                        </div>
                    </div>  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" onclick="submitForm()">Save changes</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
