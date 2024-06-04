@extends('layouts.header')

@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5 style="margin: 5px 5px 0px 5px;">Reports List</h5>
                </div>
                <div class="ibox-content">
                    <div class="wrapper wrapper-content animated fadeIn">
                        <div class="row">
                            <form method="GET" action="{{ url('/filter') }}">
                                @csrf
                                <div class="row mt-10 mb-10">
                                    <div class="col-md-offset-1 col-md-3">
                                        <div class="ibox-content ibox-report">
                                            <h1 class="no-margins">{{ $visitorTotal }}</h1>
                                            <div class="stat-percent font-bold"><i class="fa fa-users"></i></div>
                                            <medium>Total Visitor</medium>
                                        </div>
                                    </div>
                                    <div class="col-md-offset-1 col-md-3 mt-15">
                                        <label>Start Date:</label>
                                        <input type="date" class="form-control" name="start_date" value="{{ isset($start_date) ? $start_date->format('Y-m-d') : '' }}">
                                    </div>
                                    <div class="col-md-3 mt-15">
                                        <label>End Date:</label>
                                        <input type="date" class="form-control" name="end_date" value="{{ isset($end_date) ? $end_date->format('Y-m-d') : '' }}">
                                    </div>
                                    <div class="col-md-1" style="margin-top: 38px">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover table-responsive dataTables">
                                    <thead>
                                        <tr>
                                            <th>Visitor ID</th>
                                            <th>Image</th>
                                            <th>Visitor Name</th>
                                            <th>Tenant Name</th>
                                            <th>Purpose</th>
                                            <th>Date Entered</th>
                                            <th>Date Exited</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($visitors as $visitor)
                                            @if(auth()->user()->location == $visitor->building_location || auth()->user()->name == 'Admin')
                                            <tr>
                                                <td>{{ $visitor->visitor_id ? $visitor->visitor_id : 'N/A' }}</td>
                                                <td><img class="img-visitor" src="{{ $visitor->image }}"></td>
                                                <td>{{ $visitor->name }}</td>
                                                <td>{{ $visitor->tenant_name }}</td>
                                                <td>{{ $visitor->purpose }}</td>
                                                <td>{{ $visitor->created_at->format('m/d/Y h:i:s A') }}</td>
                                                <td>{{ $visitor->updated_at ? $visitor->updated_at->format('m/d/Y h:i:s A') : 'None' }}</td>
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

<style>
    .ibox-report {
        color: #fff;
        background-color: #1ab394;
        border-radius: 5px;
    }
    .mt-15 {
        margin-top: 15px;
    }
</style>
@endsection
