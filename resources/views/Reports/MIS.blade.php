@extends('adminlayouts.master')
@section('content')
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>MIS</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-primary" href="{{ url('index') }}">Home</a></li>
                                <li class="breadcrumb-item "><a>MIS</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>


            <!-- Export Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4"> MIS List</h4>
                </div>
                <div class="pb-20">
                    <table class="table hover multiple-select-row data-table-export nowrap">
                        <thead>
                            <tr>
                                <th  width="10%">Sr No.</th>
                                <th  width="60%">Department Name</th>
                                <th  width="10%">Created </th>
                                <th  width="10%">In Transit / Pending</th>
                                <th  width="10%">Closed</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $department)
                            <tr>
                                <td><strong>{{ $key+1 }}.</strong></td>
                                <td>
                                    <a href="{{url('mis_department_user_wise')}}/{{$department->id }}">
                                        <strong>{{ $department->name }}</strong>
                                    </a>
                                </td>

                                <td>{{ $department->totalfiles }}</td>
                                <td>{{ $department->transit }}</td>
                                <td>{{ $department->closed }}</td>

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
