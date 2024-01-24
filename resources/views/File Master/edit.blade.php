@extends('adminlayouts.master')
@section('content')

    <style>
        .err {
            color: red;
        }

    </style>

    <div class="page-header">
        <div class="title">
            <h4 class="text-primary">Edit File List</h4>
            @if (!empty($data->id) || 1 == 1)
                <span class="ml-10">File No.: <b>{{ $data->file_master_no  }}</b></span>
            @endif
        </div>
    </div>
    <div class="pd-20 card-box mb-30">
        <form method="POST" action="{{ route('file_master.update', $data->id) }}" class="form-horizontal"
            enctype="multipart/form-data">
            {{ csrf_field() }}

            @if (!empty($data->id) || 1 == 1)
                <input type="hidden" name="_method" value="PATCH">
            @endif

            <input type="hidden" id="id" name="id" value="{{ $data->id or '' }}">

            <div class="form-group row mt-3">
                <label class="col-sm-2 pt-2"><strong>File Type :<span style="color:red;"> *</span></strong></label>
                <div class="col-sm-4 col-md-4">
                    <select class="custom-select2 form-control @error('file_type') is-invalid @enderror" name="file_type" id="file_type" style="width: 100%; height: 38px;">
                        <optgroup label="File Type">
                            @foreach ($file_type as $key => $comps)
                                <option value="{{$key}}"
                                    @if($key == $data['file_type'])
                                    Selected
                                    @endif >{{$comps}}
                                </option>
                            @endforeach
                        </optgroup>
                    </select>
                    @if ($errors->has('file_type'))
                        <span class="err">
                            <strong>{{ $errors->first('file_type') }}.</strong>
                        </span>
                    @endif
                </div>

                <label class="col-sm-2 pt-2"><strong>Status :<span style="color:red;"> *</span></strong></label>
                <div class="col-sm-4 col-md-4">
                    <select class="custom-select2 form-control @error('status') is-invalid @enderror" name="status" id="status" style="width: 100%; height: 38px;">
                        <optgroup label="Status">
                            @foreach ($status as $key => $comps)
                                <option value="{{$key}}"
                                    @if($key == $data['name'])
                                    Selected
                                    @endif >{{$comps}}
                                </option>
                            @endforeach
                        </optgroup>
                    </select>
                    @if ($errors->has('status'))
                        <span class="err">
                            <strong>{{ $errors->first('status') }}.</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row mt-3">
                <label class="col-sm-2"><strong>Total pages of Tipani / Files :<span style="color:red;"> *</span></strong></label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="total_pages_of_tipani" id="total_pages_of_tipani" class="form-control @error('total_pages_of_tipani') is-invalid @enderror" value="{{ $data->total_pages_of_tipani }}" placeholder="Enter Total pages of Tipani / Files.">
                    @if ($errors->has('total_pages_of_tipani'))
                        <span class="err">
                            <strong>{{ $errors->first('total_pages_of_tipani') }}.</strong>
                        </span>
                    @endif
                </div>

                <label class="col-sm-2"><strong>Total pages of Docs / Letters :<span style="color:red;"> *</span></strong></label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="total_pages_of_docs" id="total_pages_of_docs" class="form-control  @error('total_pages_of_docs') is-invalid @enderror" value="{{ $data->total_pages_of_docs }}"  placeholder="Enter Total pages of Docs / Letters.">
                    @if ($errors->has('total_pages_of_docs'))
                        <span class="err">
                            <strong>{{ $errors->first('total_pages_of_docs') }}.</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row mt-3">
                <label class="col-sm-2"><strong>Subject :<span style="color:red;"> *</span></strong></label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="subject" id="subject" class="form-control @error('subject') is-invalid @enderror" value="{{ $data->subject }}" placeholder="Enter Subject.">
                    @if ($errors->has('subject'))
                        <span class="err">
                            <strong>{{ $errors->first('subject') }}.</strong>
                        </span>
                    @endif
                </div>

                <label class="col-sm-2"><strong>File Detail / Tipani :<span style="color:red;"> *</span></strong></label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="file_detail" id="file_detail" class="form-control @error('file_detail') is-invalid @enderror" value="{{ $data->file_detail }}" placeholder="Enter File Detail / Tipani.">
                    @if ($errors->has('file_detail'))
                        <span class="err">
                            <strong>{{ $errors->first('file_detail') }}.</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row mt-3">
                
                <label class="col-sm-2"><strong>Tipani File : </strong></label>
                <div class="col-sm-4 col-md-4">
                    <!--<input type="file" class="form-control-file form-control height-auto" name="image">-->
                    <div class="custom-file">
                        <input type="file" class="form-control-file form-control height-auto height-auto @error('pdf') is-invalid @enderror" name="pdf" id="pdf"
                            value="{{ $data->pdf }}">
                        <!--<iframe src="{{ $path . $data->pdf }}" type="application/pdf" frameBorder="0" scrolling="auto"-->
                        <!--    height="200px" width="100%"></iframe>-->
                    </div>
                    @if ($errors->has('pdf'))
                        <span class="err">
                            <strong>{{ $errors->first('pdf') }}.</strong>
                        </span>
                    @endif
                </div>

                <label class="col-sm-2"><strong>Reference : </strong></label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="reference" id="reference" class="form-control @error('reference') is-invalid @enderror" value="{{ $data->reference }}" placeholder="Enter Reference">
                    @if ($errors->has('reference'))
                        <span class="err">
                            <strong>{{ $errors->first('reference') }}.</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row mt-3">
                <label class="col-sm-2"><strong>Reference Number : </strong></label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="reference_no" id="reference_no" class="form-control @error('reference_no') is-invalid @enderror" value="{{ $data->reference_no }}" placeholder="Enter Reference Number.">
                    @if ($errors->has('reference_no'))
                        <span class="err">
                            <strong>{{ $errors->first('reference_no') }}.</strong>
                        </span>
                    @endif
                </div>

                <label class="col-sm-2"><strong>Reference Date : </strong></label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="reference_date" id="reference_date" class="form-control date-picker  date-picker @error('reference_date') is-invalid @enderror" value="{{ $data->reference_date }}" placeholder="Enter Reference Date.">
                    @if ($errors->has('reference_date'))
                        <span class="err">
                            <strong>{{ $errors->first('reference_date') }}.</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row mt-3">
                <label class="col-sm-2"><strong>Created by : </strong></label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="created_by" id="created_by" class="form-control @error('created_by') is-invalid @enderror" value="{{ $data->created_by }}" placeholder="Enter Created by." readonly>
                    @if ($errors->has('created_by'))
                        <span class="err">
                            <strong>{{ $errors->first('created_by') }}.</strong>
                        </span>
                    @endif
                </div>
           
                <?php
                    $auth_user = DB::select('SELECT
                                                users.id AS user_id,
                                                users.name AS user_name,
                                                department_tbl.id AS user_department_id,
                                                department_tbl.name AS user_department,
                                                users.table_no AS user_table_no
                                            FROM
                                                `users`
                                            JOIN department_tbl ON users.department = department_tbl.id
                                            WHERE
                                                users.deleted_at IS NULL
                                            ORDER BY
                                                `user_id`
                                            ASC');
                ?>
                <label class="col-sm-2"><strong>Department Name : </strong></label>
                <div class="col-sm-4 col-md-4">
                    <!--<input type="text" name="department" id="department" class="form-control  @error('department') is-invalid @enderror"  value="{{ Auth::user()->department }}" placeholder="Enter Department Name.">-->
                    
                    <select class="custom-select2 form-control @error('department') is-invalid @enderror" name="department" id="department" style="width: 100%; height: 38px;" readonly>
                        <!--<option value="">Please Select File Type </option>-->
                        <optgroup label="">
                            @foreach ($auth_user as $key => $file_type)
                                @if (!empty($file_type->user_department_id == Auth::user()->department) && ($file_type->user_name == Auth::user()->name))
                                    <option value="{{ $file_type->user_department_id }}" selected>{{ $file_type->user_department }}</option>
                                @endif
                            @endforeach
                        </optgroup>
                    </select>
                    @if ($errors->has('department'))
                        <span class="err">
                            <strong>{{ $errors->first('department') }}.</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row mt-3">
                <label class="col-sm-2"><strong>Table Number : </strong></label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="table_no" id="table_no" class="form-control  @error('table_no') is-invalid @enderror" value="{{ $data->table_no }}" placeholder="Enter Table Number."readonly>
                    @if ($errors->has('table_no'))
                        <span class="err">
                            <strong>{{ $errors->first('table_no') }}.</strong>
                        </span>
                    @endif
                </div>
                <input hidden name="file_master_no" id="file_master_no" class="form-control  @error('Next_Doc_No') is-invalid @enderror" value="{{$data['file_master_no']}}" placeholder="">
                
                <label class="col-sm-2"><strong>Financial Year : <span class="text-danger">*</span></strong></label>
                <div class="col-sm-4 col-md-4">
                    <!--<input type="text" name="department" id="department" class="form-control  @error('department') is-invalid @enderror"  value="{{ Auth::user()->department }}" placeholder="Enter Department Name.">-->
                    
                    <select class="custom-select2 form-control @error('financial_year') is-invalid @enderror" name="financial_year" id="financial_year" >
                        
                        <optgroup label="Financial Year">
                            @foreach ($financial_year as $key => $comps)
                                <option value="{{$key}}"
                                    @if($key == $data['financial_year'])
                                    Selected
                                    @endif >{{$comps}}
                                </option>
                            @endforeach
                        </optgroup>
                    </select>
                    @if ($errors->has('financial_year'))
                        <span class="err">
                            <strong>{{ $errors->first('financial_year') }}.</strong>
                        </span>
                    @endif
                </div>
            </div>

            <!--<div class="form-group row mt-4">-->
            <!--    &nbsp;&nbsp;&nbsp;&nbsp;-->
            <!--    <div class="custom-control custom-checkbox">-->
            <!--        <input type="checkbox" class="custom-control-input " name="reminder" id="customCheck2-1" value="{{ $data->reminder }}" {{ old('reminder') ? 'checked' : '' }}>-->
            <!--       <label class="custom-control-label" for="customCheck2-1"><strong>Reminder</strong></label>-->
            <!--    </div>-->
            <!--   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
            <!--    <div class="col-sm-4 col-md-4">-->
            <!--        <input type="text" name="date" id="date" class="form-control date-picker @error('date') is-invalid @enderror" value="{{ $data->date }}" placeholder="Enter Date">-->
            <!--        @if ($errors->has('date'))-->
            <!--            <span class="err">-->
            <!--                <strong>{{ $errors->first('date') }}.</strong>-->
            <!--            </span>-->
            <!--        @endif-->
            <!--    </div>-->
            <!--</div>-->

            <div class="form-group row mt-4">
                <label class="col-md-3"></label>
                <div class="col-md-9" style="display: flex; justify-content: flex-end;">
                    <a href="{{ url('file_master') }}" class="btn btn-danger">Cancel</a>&nbsp;&nbsp;
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>

        </form>

    </div>

    <!-- Export Datatable start -->
    <!--<div class="card-box mb-30">-->
    <!--    <div class="pd-20">-->
    <!--        <h4 class="text-blue h4">Forwarding History</h4>-->
    <!--    </div>-->
    <!--    <div class="pb-20">-->
    <!--        <table class="table hover table-bordered table-responsive  nowrap p-3">-->
    <!--            <thead class="text-light" style="background:#0285D0;">-->
    <!--                <tr>-->
    <!--                    <th rowspan="2">Date</th>-->
    <!--                    <th rowspan="2">Status</th>-->
    <!--                    <th colspan="3" class="text-center">From</th>-->
    <!--                    <th colspan="3" class="text-center">To</th>-->
    <!--                    <th rowspan="2">Method</th>-->
    <!--                    <th rowspan="2">No. of Tipani Pages</th>-->
    <!--                    <th rowspan="2">Tipani File</th>-->
    <!--                    <th rowspan="2">Remark / Tipani</th>-->
    <!--                </tr>-->
    <!--                <tr>-->
    <!--                    <th>Employee</th>-->
    <!--                    <th>Department</th>-->
    <!--                    <th>Table</th>-->
    <!--                    <th>Employee</th>-->
    <!--                    <th>Department</th>-->
    <!--                    <th>Table</th>-->
    <!--                </tr>-->
    <!--            </thead>-->
    <!--            <tbody>-->
    <!--                @foreach($dataclosed as $dataclose)-->
    <!--                <tr>-->
                        <!--Last row Created record -->
    <!--                    <td>{{ $dataclose->inserted_dt }}</td>-->
    <!--                    <td>Closed / निकाली</td>-->
    <!--                    <td>{{ $dataclose->user_login }}</td>-->
    <!--                    <td>{{ $dataclose->name }}</td>-->
    <!--                    <td>{{ $dataclose->tableno_login }}</td>-->
    <!--                    <td>{{ $dataclose->user_login }}</td>-->
    <!--                    <td>{{ $dataclose->name }}</td>-->
    <!--                    <td>{{ $dataclose->tableno_login }}</td>-->
    <!--                    <td>By Hand </td>-->
    <!--                    <td>{{ $dataclose->tipani_page  }}</td>-->
    <!--                    @if (!empty($dataclose->pdf))-->
    <!--                       <td><a href="{{ $path.$dataclose->pdf }}" target="_blank" class="btn btn-primary btn-sm ml-3"><i class="micon fa fa-eye text-light"></i></a></td>-->
    <!--                    @else-->
    <!--                       <td width="10%">NULL</td>-->
    <!--                    @endif-->
                        
    <!--                    <td>{{ $dataclose->remark }}</td>-->
    <!--                </tr>-->
    <!--                @endforeach-->
    <!--                @foreach($all_data_trx as $datafwd)-->
    <!--                    <tr>-->
    <!--                        <td >{{ $datafwd->inserted_dt }}</td>-->
    <!--                        @if ($datafwd->file_status == '14')-->
    <!--                            <td>Closed / निकाली</td>-->
    <!--                        @elseif($datafwd->file_status == '13')-->
    <!--                            <td>Accepted</td>-->
    <!--                        @elseif($datafwd->file_status == '12')-->
    <!--                            <td>In Transit</td>-->
    <!--                        @elseif($datafwd->file_status == '10')-->
    <!--                            <td>Created </td>-->
    <!--                        @else()-->
    <!--                            <td>Partially Completed</td>-->
    <!--                        @endif-->

    <!--                        <td>{{ $datafwd->from_emp  }}</td>-->
    <!--                        <td>{{ $datafwd->from_departmentname  }}</td>-->
    <!--                        <td>{{ $datafwd->from_tableno  }}</td>-->

    <!--                        <td>{{ $datafwd->for_usersname }}</td>-->
    <!--                        <td>{{ $datafwd->for_departmentname  }}</td>-->
    <!--                        <td> {{ $datafwd->for_tableno  }} </td>-->

    <!--                        <td>{{ $datafwd->method }}/ {{ $datafwd->user_details }}</td>-->
    <!--                        <td>{{ $datafwd->tipani_page  }}</td>-->
    <!--                        @if (!empty($datafwd->tipani_file))-->
    <!--                           <td><a href="{{ $path.$datafwd->tipani_file }}" target="_blank" class="btn btn-primary btn-sm ml-3"><i class="micon fa fa-eye text-light"></i></a></td>-->
    <!--                        @else-->
    <!--                           <td width="10%">NULL</td>-->
    <!--                        @endif-->
                            
    <!--                        <td>{{ $datafwd->remark }}</td>-->
    <!--                    </tr>-->
    <!--                @endforeach-->

    <!--                @foreach($datacreated as $data1)-->
    <!--                <tr>-->
                     <!--Last row Created record -->
    <!--                    <td>{{ $data1->inserted_dt }}</td>-->
    <!--                    <td>Created</td>-->
    <!--                    <td>{{ $data1->created_by }}</td>-->
    <!--                    <td>{{ $data1->name }}</td>-->
    <!--                    <td>{{ $data1->table_no }}</td>-->

    <!--                    <td>{{ $data1->created_by }}</td>-->
    <!--                    <td>{{ $data1->name }}</td>-->
    <!--                    <td>{{ $data1->table_no }}</td>-->

    <!--                    <td>By Hand </td>-->
    <!--                    <td>{{ $data1->total_pages_of_tipani  }}</td> -->
    <!--                    @if (!empty($data1->pdf))-->
    <!--                       <td><a href="{{ $path.$data1->pdf }}" target="_blank" class="btn btn-primary btn-sm ml-3"><i class="micon fa fa-eye text-light"></i></a></td>-->
    <!--                    @else-->
    <!--                       <td width="10%">NULL</td>-->
    <!--                    @endif-->
                        
                        <!--<td>{{ $data1->pdf }}</td>-->
    <!--                    <td>{{ $data1->file_detail }}</td>-->
    <!--                </tr>-->
    <!--                @endforeach-->
    <!--            </tbody>-->

    <!--        </table>-->
    <!--    </div>-->
    <!--</div>-->
    <!-- Export Datatable End -->
@endsection
