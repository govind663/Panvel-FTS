@extends('adminlayouts.master')
@section('content')
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
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
                                <li class="breadcrumb-item "><a>MIS Employee Wise</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            
            <div class="pd-20 card-box mb-30">
                <form method="POST" action="{{ Url('search/user/list') }}" class="form-horizontal"  enctype="multipart/form-data" >
                    {{ csrf_field() }}
        
                    <div class="form-group row mt-3">
                        <label class="col-sm-2"><strong>From Date :<span style="color:red;"> *</span></strong></label>
                        <div class="col-sm-4 col-md-4">
                            <input type="date" name="from_date" id="from_date" class="form-control @error('from_date') is-invalid @enderror" required value="" placeholder="Enter From Date.">
                            @if ($errors->has('from_date'))
                                <span class="err">
                                    <strong>{{ $errors->first('from_date') }}.</strong>
                                </span>
                            @endif
                        </div>
                        
                        <label class="col-sm-2"><strong>To Date :<span style="color:red;"> *</span></strong></label>
                        <div class="col-sm-4 col-md-4">
                            <input type="date" name="to_date" id="to_date" class="form-control @error('to_date') is-invalid @enderror" required value="" placeholder="Enter To Date.">
                            @if ($errors->has('to_date'))
                                <span class="err">
                                    <strong>{{ $errors->first('to_date') }}.</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mt-3">
                        <label class="col-sm-2 pt-2"><strong> Employee : <span style="color:red;"> *</span></strong></label>
                        <div class="col-sm-4 col-md-4">
                            <select class="custom-select2 form-control @error('user') is-invalid @enderror" required name="user" id="user" style="width: 100%; height: 38px;">
                                <option value="">Please Select Employee </option>
                                <optgroup label="Employee">
                                    @foreach($employee_name as $key=> $comps)
                                        <option value="{{$key}}" {{ old('user') == "$key" ? 'selected' : '' }}>{{$comps}}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                            @if ($errors->has('user'))
                                <span class="err">
                                    <strong>{{ $errors->first('user') }}.</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mt-4">
                        <label class="col-md-3"></label>
                        <div class="col-md-9" style="display: flex; justify-content: flex-end;">
                            <button type="submit" class="btn btn-success ">Submit</button>
                        </div>
                    </div>
        
                </form>
            </div>
            <!-- Export Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4"> MIS Employee Wise List</h4>
                </div>
                
                <div class="pb-20">
                    <table class="table hover multiple-select-row data-table-export nowrap">
                        <thead>
                            <tr>
                                <th>Sr No.</th>
                                <th>File No.</th>
                                <th>Subject</th>
                                <th>Status</th>
                                <th>Created On</th>
                                <th>Closed On</th>
                                <th>Pending Days</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $emp_wise)

                            <tr>
                                <td width="10%">{{ $key+1 }}</td>
                                <td width="10%">{{ $emp_wise->emp_file_no }}</td>
                                <td width="40%">{{ $emp_wise->emp_subject }}</td>
                                <td width="10%">
                                    <span>
                                        @if ($emp_wise->emp_file_status == '14')
                                            Closed / निकाली
                                        @elseif($emp_wise->emp_file_status == '13')
                                            Accepted
                                        @elseif($emp_wise->emp_file_status == '12')
                                            In Transit
                                        @elseif($emp_wise->emp_file_status == '10')
                                            Created
                                        @else()
                                            Partially Completed
                                        @endif
                                    </span>
                                </td>
                                
                                
                                @if (!empty($emp_wise->emp_inserted_date ))
                                <td width="10%">{{ $emp_wise->emp_inserted_date }}</td>
                                @else
                                   <td width="10%">NULL</td>
                                @endif
                                
                                
                                @if (!empty($emp_wise->emp_close_dt))
                                <td width="10%">{{ $emp_wise->emp_close_dt }}</td>
                                @else
                                   <td width="10%">NULL</td>
                                @endif
                                
                                @if (!empty($emp_wise->total_days))
                                <td width="10%">{{ $emp_wise->total_days }}</td>
                                @else
                                @php
                                $diff = now()->diffInDays($emp_wise->emp_inserted_date);
                                @endphp
                                   <td width="10%">{{ $diff }}</td>
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
