@extends('adminlayouts.master')
@section('content')
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    @if (Session::has('flash_message'))
                        <div class=" col-sm-12">
                            <div class="alert alert-success alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Success!</strong> {{ Session::get('flash_message') }}.
                            </div>

                        </div>
                    @endif
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>File Forward</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-primary" href="{{ url('index') }}">Home</a></li>
                                <li class="breadcrumb-item active">File Forward</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="pd-20 card-box mb-30">
                <h4 class="text-blue h4">File Forward</h4>
                <hr>
                <form method="GET" action="{{url('Forwardsearch')}}" class="form-horizontal" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group row mt-3">
                        <label class="col-sm-2">File Number&nbsp;&nbsp; : &nbsp;&nbsp;<span class="text-danger">*</span></label>
                        <div class="col-sm-4 col-md-4">
                            <input type="search" name="search" id="search" class="form-control" value=""
                                placeholder="Enter File No." required>
                        </div>
                        
                    </div>
                    
                    <div class="form-group row mt-4">
                        <label class="col-md-3"></label>
                        <div class="col-md-9" style="display: flex; justify-content: flex-end;">
                            <!--<a href="{{ url('department') }}" class="btn btn-danger">Cancel</a>&nbsp;&nbsp;-->
                            <button type="submit" class="btn btn-success">Search</button>
                        </div>
                    </div>
                </form>
            </div>
            
            

            <!-- Export Datatable start -->
            <div class="pd-20 card-box mb-30">
                <h4 class="text-blue h4">Forwarding History</h4>
                <hr>
                <div class="pd-20">
                    <table class="table hover table-bordered table-responsive  nowrap p-3">
                <thead class="text-light" style="background:#0285D0;">
                    <tr>
                        <th rowspan="2">Date</th>
                        <th rowspan="2">File Master No.</th>
                        <th rowspan="2">Status</th>
                        <th colspan="3" class="text-center">From</th>
                        <th colspan="3" class="text-center">To</th>
                        <th rowspan="2">Method</th>
                        <th rowspan="2">No. of Tipani Pages</th>
                        <th rowspan="2">Tipani File</th>
                        <th rowspan="2">Remark / Tipani</th>
                    </tr>
                    <tr>
                        <th>Employee</th>
                        <th>Department</th>
                        <th>Table</th>
                        <th>Employee</th>
                        <th>Department</th>
                        <th>Table</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach($all_data_trx as $datafwd)
                            <tr>
                                <td >{{ $datafwd->forword_file_date }}</td>
                                <td >{{ $datafwd->fdt_file_master_no }}</td>
                                @if ($datafwd->file_fwd_status == '14')
                                    <td>Closed / निकाली</td>
                                @elseif($datafwd->file_fwd_status == '13')
                                    <td>Accepted</td>
                                @elseif($datafwd->file_fwd_status == '12')
                                    <td>In Transit</td>
                                @elseif($datafwd->file_fwd_status == '10')
                                    <td>Created </td>
                                @else()
                                    <td>Partially Completed</td>
                                @endif
    
                                <td>{{ $datafwd->fdt_name_login  }}</td>
                                <td>{{ $datafwd->fdt_department_login  }}</td>
                                <td>{{ $datafwd->fdt_tableno_login  }}</td>
    
                                <td>{{ $datafwd->forword_to }}</td>
                                <td>{{ $datafwd->forword_dept_name  }}</td>
                                <td> {{ $datafwd->forword_table_no  }} </td>
    
                                <td>{{ $datafwd->forword_method }}/ {{ $datafwd->forword_peon }}</td>
                                <td>{{ $datafwd->forword_tipani_page  }}</td>
                                @if (!empty($datafwd->forword_pdf))
                                   <td><a href="{{ $path.$datafwd->forword_pdf }}" target="_blank" class="btn btn-primary btn-sm ml-3"><i class="micon fa fa-eye text-light"></i></a></td>
                                @else
                                   <td width="10%">NULL</td>
                                @endif
                                <td>{{ $datafwd->forword_remark }}</td>
                            </tr>
                        @endforeach
                    </tr>
                </tbody>

            </table>
                </div>
            </div>
            <!-- Export Datatable End -->

        </div>
        <div class="footer-wrap pd-20 mb-20 card-box">
            Copyright ©<?php echo date('Y'); ?>. Designed And Developed By Core Ocean Solutions LLP. All rights reserved.
        </div>
    </div>
@endsection
