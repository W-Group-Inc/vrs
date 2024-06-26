@extends('layouts.header')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Tenant List</h5>
                    <div class="ibox-tools">
                        <button class="btn btn-success" data-toggle="modal" data-target="#add_tenant"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add Tenant</button>
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
                                            <th>Building Name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($tenants as $tenant)
                                            @if(auth()->user()->location == null || auth()->user()->location == $tenant->building_id)
                                            <tr>
                                                <td width="30%">{{ $tenant->name }}</td>
                                                <td width="40%">{{ optional($tenant->building)->name }}</td>
                                                <td width="10%" align="center">
                                                    <button type="button" class="btn btn-success btn-outline" data-toggle="modal" data-target="#edit_tenant{{ $tenant->id }}"><i class="fa fa fa-pencil"></i><a href="{{ url('update_tenant/' .$tenant->id) }}"></a></button>
                                                    <a href="{{ route('tenant.delete', ['id' => $tenant->id]) }}">
                                                        <button type="button" class="btn btn-danger btn-outline" title="Delete User"><i class="fa fa fa-ban"></i></button>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endif
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
@foreach($tenants as $tenant)
    @include('tenants.edit')
@endforeach
<div class="modal fade" id="add_tenant" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form id="addTenantForm" method="POST" action="{{ url('new_tenant') }}" autocomplete="off">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Add Tenant</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px; color: red; font-size: 25px">
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
                            <label>Building Name</label>
                            <select name="building_id" id="building_id" class="form-control selectpicker @if($errors->first('building_id')) is-invalid @endif" title="Select Building Name">
                                @foreach($buildings as $building)
                                    @if(auth()->user()->location == $building->id)
                                        <option value="{{ $building->id }}"> {{ $building->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" onclick="submitTenant()">Save changes</button>
                </div>
            </div>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@endsection
