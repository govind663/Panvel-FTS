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
                            <h4>User Role & Permissions</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-primary" href="{{ url('index') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item "><a>User Role & Permissions</a></li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        <a class="btn btn-primary" href="{{ route('Authentication.create') }}" role="button">
                            <span class="micon ti ti-plus"></span>&nbsp;&nbsp;<span class="mtext">Add</span>
                        </a>

                    </div>
                </div>
            </div>


            <!-- Export Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">User Role & Permissions List</h4>
                </div>
                <div class="pb-20">
                    <table class="table hover multiple-select-row data-table-export nowrap" >
                        <thead>
                            <tr>
                                <th>Sr No.</th>
                                <th>Users</th>
                                <th>Dashboard</th>
                                <th>User</th>
                                <th>Authorization</th>
                                <th>Financial Year</th>
                                <th>Department</th>
                                <th>Status</th>
                                <th>Organization</th>
                                <th>Document Numbering</th>
                                <th>File Type</th>
                                <th>File Master</th>
                                <th>Inward</th>
                                <th>Forward</th>
                                <th>Close</th>
                                <th>MIS</th>
                                <th>MIS - Employee Wise</th>
                                <th>File Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $file_type)
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <a href="{{ route('Authentication.edit', $file_type->id) }}"
                                            class="btn btn-info btn-sm">
                                            <i class="micon dw dw-pencil-1"></i>
                                        </a>
                                    </td>

                                    <td>
                                        <form action="{{ route('Authentication.destroy', $file_type->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button type="submit" class="btn btn-danger btn-sm "
                                                onclick="return confirm('Are you sure to delete?')"><i
                                                    class="micon dw dw-trash"></i>
                                            </button>
                                        </form>

                                    </td>
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
