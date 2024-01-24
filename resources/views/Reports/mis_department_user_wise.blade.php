@extends('adminlayouts.master')
@section('content')
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
             @foreach ($department as $key => $file_type)
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>MIS Employee Wise</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-primary" href="{{ url('index') }}">Home</a>
                                </li>
                                   <li class="breadcrumb-item active" >{{ $file_type->name }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Export Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4"> MIS Department Wise List</h4>
                </div>
                <div class="pb-20">
                    <table class="table hover multiple-select-row data-table-export nowrap">
                        <thead>
                            <tr>
                                <th>Sr No.</th>
                                <th>Employee Name</th>
                                <th>Created </th>
                                <th>In Transit / Pending</th>
                                <th>Closed</th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach ($data as $key => $emp_wise)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $emp_wise->created_by }}</td>
                                        <td>{{ $emp_wise->totalfiles }}</td>
                                        <td>{{ $emp_wise->transit }}</td>
                                        <td>{{ $emp_wise->closed }}</td>
                                    </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Export Datatable End -->
        </div>
        @include('adminlayouts.footer')
    </div>
@endsection
