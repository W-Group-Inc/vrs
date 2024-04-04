@extends('layouts.header')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Building List</h5>
                    <div class="ibox-tools">
                        <button class="btn btn-success" data-toggle="modal" data-target="#add_building"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add Building</button>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="wrapper wrapper-content animated fadeIn">
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover table-responsive dataTables">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($buildings as $building)
                                            <tr>
                                                <td width="5%">{{$building->id}}</td>
                                                <td width="40%">{{$building->name}}</td>
                                                <td width="43%">{{$building->address}}</td>
                                                <td width="12%" align="center">
                                                    <button type="button" class="btn btn-success btn-outline" data-toggle="modal" data-target="#edit_building{{ $building->id }}"><i class="fa fa fa-pencil"></i><a href="{{ url('update_building/' .$building->id) }}"></a></button>
                                                    <a href="{{ route('building.delete', ['id' => $building->id]) }}">
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
@foreach($buildings as $building)
    @include('buildings.edit')
@endforeach
<div class="modal fade" id="add_building" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="POST" action="{{ url('new_building') }}" autocomplete="off">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Add Building</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-10">
                            <label>Name</label>
                            <input name="name" id="name" class="form-control" type="text" placeholder="Enter Name" required>
                        </div>
                        <div class="col-12 mb-10">
                            <label>Address</label>
                            <input name="address" id="address" class="form-control" type="text" placeholder="Enter Address">
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
@endsection
