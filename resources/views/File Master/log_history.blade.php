@extends('adminlayouts.master')
@section('content')

    <style>
        .err {
            color: red;
        }

    </style>
    
    <div class="page-header">
        <div class="title">
            <h4 class="text-primary">All Transaction History</h4>
            @if (!empty($data->id) || 1 == 1)
                <span class="ml-10">File No.: <b>{{ $data->file_master_no  }}</b></span>
            @endif
        </div>
    </div>
    
    <!-- Export Datatable start -->
    <div class="card-box mb-30">
        <div class="pd-20">
            <h4 class="text-blue h4">All Transaction History </h4>
        </div>
        <div class="pb-20">
            <table class="table hover table-bordered table-responsive  nowrap p-3">
                <thead class="text-light" style="background:#0285D0;">
                    <tr>
                        <th rowspan="2">Date</th>
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
                    @foreach($dataclosed as $dataclose)
                    <tr>
                        <!--Last row Created record -->
                        <td>{{ $dataclose->inserted_dt }}</td>
                        <td>Closed / निकाली</td>
                        <td>{{ $dataclose->user_login }}</td>
                        <td>{{ $dataclose->name }}</td>
                        <td>{{ $dataclose->tableno_login }}</td>
                        <td>{{ $dataclose->user_login }}</td>
                        <td>{{ $dataclose->name }}</td>
                        <td>{{ $dataclose->tableno_login }}</td>
                        <td>By Hand </td>
                        <td>{{ $dataclose->tipani_page  }}</td>
                        @if (!empty($dataclose->pdf))
                           <td>
                               <a href="{{ $path.$dataclose->pdf }}" target="_blank" class="btn btn-danger btn-sm ml-3">
                                   <i class="micon fa fa-file-pdf-o"></i>
                               </a>
                            </td>
                        @else
                           <td width="10%">NULL</td>
                        @endif
                        
                        <td>{{ $dataclose->remark }}</td>
                    </tr>
                    @endforeach
                    @foreach($all_data_trx as $datafwd)
                        <tr>
                            <td >{{ $datafwd->inserted_dt }}</td>
                            @if ($datafwd->file_status == '14')
                                <td>Closed / निकाली</td>
                            @elseif($datafwd->file_status == '13')
                                <td>Accepted</td>
                            @elseif($datafwd->file_status == '12')
                                <td>In Transit</td>
                            @elseif($datafwd->file_status == '10')
                                <td>Created </td>
                            @else()
                                <td>Partially Completed</td>
                            @endif

                            <td>{{ $datafwd->from_emp  }}</td>
                            <td>{{ $datafwd->from_departmentname  }}</td>
                            <td>{{ $datafwd->from_tableno  }}</td>

                            <td>{{ $datafwd->for_usersname }}</td>
                            <td>{{ $datafwd->for_departmentname  }}</td>
                            <td> {{ $datafwd->for_tableno  }} </td>

                            <td>{{ $datafwd->method }}/ {{ $datafwd->user_details }}</td>
                            <td>{{ $datafwd->tipani_page  }}</td>
                            @if (!empty($datafwd->tipani_file))
                               <td>
                                    <a href="{{ $path.$datafwd->tipani_file }}" target="_blank" class="btn btn-danger btn-sm ml-3">
                                       <i class="micon fa fa-file-pdf-o"></i>
                                    </a>
                                </td>
                            @else
                               <td width="10%">NULL</td>
                            @endif
                            
                            <td>{{ $datafwd->remark }}</td>
                        </tr>
                    @endforeach

                    @foreach($datacreated as $data1)
                    <tr>
                     <!--Last row Created record -->
                        <td>{{ $data1->inserted_dt }}</td>
                        <td>Created</td>
                        <td>{{ $data1->created_by }}</td>
                        <td>{{ $data1->name }}</td>
                        <td>{{ $data1->table_no }}</td>

                        <td>{{ $data1->created_by }}</td>
                        <td>{{ $data1->name }}</td>
                        <td>{{ $data1->table_no }}</td>

                        <td>By Hand </td>
                        <td>{{ $data1->total_pages_of_tipani  }}</td> 
                        @if (!empty($data1->pdf))
                            <td>
                               <a href="{{ url('/') }}/myfinalimg/{{ $data1->pdf }}" target="_blank" class="btn btn-danger btn-sm ml-3">
                                   <i class="micon fa fa-file-pdf-o"></i>
                               </a>
                            </td>
                        @else
                           <td width="10%">NULL</td>
                        @endif
                        
                        <!--<td>{{ $data1->pdf }}</td>-->
                        <td>{{ $data1->file_detail }}</td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
    <!-- Export Datatable End -->
@endsection
