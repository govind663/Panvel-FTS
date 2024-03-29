@extends('adminlayouts.master')
@section('content')
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Users</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-primary" href="{{ url('index') }}">Home</a></li>
                                <li class="breadcrumb-item "><a >Users</a></li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        <a class="btn btn-primary" href="{{ route('users.create') }}" role="button">
                            <span class="micon ti ti-plus"></span>&nbsp;&nbsp;<span class="mtext">Add</span>
                        </a>

                    </div>
                </div>
            </div>


            <!-- Export Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">Users List</h4>
                </div>
                <div class="pb-20">
                    <table class="table hover multiple-select-row data-table-export nowrap">
                        <thead>
                            <tr>
                                <th>Sr No.</th>
                                <th>User Type</th>
                                <th>Name</th>
                                <th>Mobile No.</th>
                                <th>Email ID</th>
                                <th>Status</th>
                                <th>Department</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $file_type)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $file_type->user_type }}</td>
                                    <td>{{ $file_type->name }}</td>
                                    <td>{{ $file_type->mobile_no }}</td>
                                    <td>{{ $file_type->email }}</td>
                                    @if ($file_type->status == 'Active')
                                        <td>
                                            <span class="badge bg-success tips text-light" data-bs-toggle="popover" title="Active">
                                                Active
                                            </span>
                                        </td>
                                    @else()
                                        <td>
                                            <span class="badge bg-danger tips text-light" data-bs-toggle="popover" title="Inactive">
                                                Inactive
                                            </span>
                                        </td>
                                    @endif
                                    <td>{{ $file_type->department_name }}</td>
                                    <td>
                                        <a href="{{ route('users.edit', $file_type->id) }}" class="btn btn-info btn-sm">
                                            <i class="micon dw dw-pencil-1"></i>
                                        </a>
                                    </td>

                                    <td>
                                        <form action="{{ route('users.destroy', $file_type->id) }}" method="post">
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
