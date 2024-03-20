@extends('layouts.header')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Visitors</h5>
                </div>
                <div class="ibox-content">
                    <div class="wrapper wrapper-content animated fadeIn">
                        <div class="row">
                            <div class="tabs-container">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#tab-1">Active</a></li>
                                    <li class=""><a data-toggle="tab" href="#tab-2">Inactive</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="tab-1" class="tab-pane active">
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover table-responsive dataTables-example">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Nickname</th>
                                                            <th>Supplier Code</th>
                                                            <th>Contact Person</th>
                                                            <th>Address</th>
                                                            <th>Tel No.</th>
                                                            <th>Fax No.</th>
                                                            <th>Mobile No.</th>
                                                            <th>Email Address</th>
                                                            <th>Terms</th>
                                                            <th>Accreditation Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tab-2" class="tab-pane">
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover table-responsive dataTables-example">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Nickname</th>
                                                            <th>Supplier Code</th>
                                                            <th>Contact Person</th>
                                                            <th>Address</th>
                                                            <th>Tel No.</th>
                                                            <th>Fax No.</th>
                                                            <th>Mobile No.</th>
                                                            <th>Email Address</th>
                                                            <th>Terms</th>
                                                            <th>Accreditation Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
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
            </div>
        </div>
    </div>
</div>
@endsection