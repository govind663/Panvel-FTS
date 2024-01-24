@extends('adminlayouts.master')
@section('content')
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            @foreach ($department as $key => $file_type)
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Department Wise Pending Files</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('index') }}">Home</a></li>
                                <li class="breadcrumb-item active">{{ $file_type->name }}</li>
                            </ol>
                        </nav>
                    </div>
                    <!--{{-- <div class="col-md-6 col-sm-12 text-right">-->
                    <!--    <a class="btn btn-primary" href="{{ route('department.create') }}" role="button">-->
                    <!--        <span class="micon ti ti-plus"></span>&nbsp;&nbsp;<span class="mtext">Add</span>-->
                    <!--    </a>-->

                    <!--</div> --}}-->
                </div>
            </div>
            @endforeach

            <!-- Export Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">Department Wise Pending Files</h4>
                </div>
                <div class="pb-20">
                    <table class="table hover multiple-select-row data-table-export">
                        <thead>
                            <tr>
                                <th>Sr No.</th>
                                <th>File No.</th>
                                <th>Subject</th>
                                <th>Status</th>
                                <th>Inward On</th>
                                <th>Pending Days</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $file_type)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td><strong>{{ $file_type->file_master_no }}</strong></td>
                                    <td>{{ $file_type->subject }}</td>
                                    <td>
                                        <span>
                                            @if ($file_type->status == '14')
                                                Closed / निकाली
                                            @elseif($file_type->status == '13')
                                                 Accepted
                                            @elseif($file_type->status == '12')
                                                In Transit
                                            @elseif($file_type->status == '10')
                                                Created
                                            @else()
                                                Partially Completed
                                            @endif
                                        </span>
                                    </td>
                                    @if($file_type->modify_dt != '')
                                       <td>{{date('d F, Y',strtotime($file_type->modify_dt)) }}</td>
                                    @else
                                       <td>{{date('d F, Y',strtotime($file_type->inserted_dt)) }}</td>
                                    @endif
                                    
                                    {{-- <td>{{ $file_type->modify_dt }} <br> {{ $file_type->name }}</td> --}}
                                    <td>{{ \Carbon\Carbon::parse($file_type->modify_dt)->diffForHumans() }}</td>
                                </tr>
                            @endforeach

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
