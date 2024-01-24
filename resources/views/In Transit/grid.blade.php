@extends('adminlayouts.master')
@section('content')
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <!--@if (Session::has('file_master_msg'))-->
                    <!--    <div class=" col-sm-12">-->
                    <!--        <div class="alert alert-success alert-dismissible">-->
                    <!--            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
                    <!--            <strong>{{ Session::get('file_master_msg') }}</strong> .-->
                    <!--        </div>-->

                    <!--    </div>-->
                    <!--@endif-->
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>In Transit File Record</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-primary" href="{{ url('index') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item "><a>In Transit File Record</a></li>
                            </ol>
                        </nav>
                    </div>
                    <!--<div class="col-md-6 col-sm-12 text-right">-->
                    <!--    <a class="btn btn-primary" href="{{ route('file_master.create') }}" role="button">-->
                    <!--        <span class="micon ti ti-plus"></span>&nbsp;&nbsp;<span class="mtext">Add</span>-->
                    <!--    </a>-->

                    <!--</div>-->
                </div>
            </div>


            <!-- Export Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">In Transit File List</h4>
                </div>
                <div class="pb-20">
                    <table class="table hover multiple-select-row data-table-export nowrap">
                        <thead>
                            <tr>
                                <th>Sr No.</th>
                                <th>File No.</th>
                                <th>Created Date</th>
                                <th>File Type</th>
                                <th>Subject</th>
                                <th>Tipani</th>
                                <th>Docs</th>
                                <th>Status</th>
                                <th>Created by</th>
                                <th>Last Forwarded to</th>
                                <!--<th>Print Documentation</th>-->
                                <th>Edit</th>
                                <!--<th>Delete</th>-->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data6 as $key => $file_type)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $file_type->file_master_no }}</td>
                                    <td>{{date('d F, Y',strtotime($file_type->inserted_dt)) }}</td>
                                    <td>{{ $file_type->type }}</td>
                                    <td>{{ $file_type->subject }}</td>
                                    <td>{{ $file_type->total_pages_of_tipani }}</td>
                                    <td>{{ $file_type->total_pages_of_docs }}</td>

                                    @if ($file_type->status == '14')
                                        <td>Closed / निकाली</td>
                                    @elseif($file_type->status == '13')
                                        <td>Accepted</td>
                                    @elseif($file_type->status == '12')
                                        <td>In Transit</td>
                                    @elseif($file_type->status == '10')
                                        <td>Created </td>
                                    @else()
                                        <td>Partially Completed</td>
                                    @endif
                                        
                                    <td>{{ $file_type->created_by }}</td>
                                    <td>{{ $file_type->name }}</td>
                                    
                                    @if(!empty($file_type->from_persion == Auth::user()->id ))
                                    <td>
                                        <a href="{{ route('in_transit.edit', $file_type->forward_id) }}"
                                            class="btn btn-info btn-sm">
                                            <i class="micon dw dw-pencil-1"></i>
                                        </a>
                                    </td>
                                    @else
                                    <td>
                                        NULL
                                    </td>
                                    @endif
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

@section('scripts')
    <script type="text/javascript">
        function confirmation() {
            var result = confirm("Are you sure to delete?");
            if (result) {
                // Delete logic goes here
            }
        }
    </script>
@endsection('scripts')
