@extends('adminlayouts.master')
@section('content')

    <style>
        .err {
            color: red;
        }

    </style>

    <div class="page-header">
        <div class="title">
            <h4 class="text-primary">Add File List</h4>
        </div>
    </div>
    <div class="pd-20 card-box mb-30">
        <form method="post" action="{{ url('file_master') }}" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
            {{ csrf_field() }}

            @foreach ($document_numbering as $key => $file_doctype)
                <input hidden readonly name="file_master_no" id="file_master_no" class="form-control  @error('Next_Doc_No') is-invalid @enderror" value="{{$file_doctype->Next_Doc_No}}" placeholder="">
                <input hidden readonly name="Doc_Id" id="Doc_Id" class="form-control  @error('Doc_Id') is-invalid @enderror" value="{{$file_doctype->Doc_Id}}" placeholder="">
            @endforeach
            <div class="form-group row mt-3">
                <label class="col-sm-2 pt-2"><strong>File Type :<span style="color:red;"> *</span></strong></label>
                <div class="col-sm-4 col-md-4">
                    <select class="custom-select2 form-control @error('file_type') is-invalid @enderror" name="file_type" id="file_type" style="width: 100%; height: 38px;">
                        <option value="">Please Select File Type </option>
                        <optgroup label="">
                            @foreach($file_type as $key=> $comps)
                                <option value="{{$key}}" {{ old('file_type') == "$key" ? 'selected' : '' }}>{{$comps}}</option>
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
                        <option value="" selected>Please selecte Status</option>
                        <optgroup label="Status">
                            <option value="10" selected>Created</option>
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
                <label class="col-sm-2"><strong>Total pages of Tipani / Files : <span style="color:red;"> *</span></strong></label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="total_pages_of_tipani" id="total_pages_of_tipani" class="form-control  @error('total_pages_of_tipani') is-invalid @enderror" value="{{ old('total_pages_of_tipani') }}" placeholder="Enter Total pages of Tipani / Files.">
                    @if ($errors->has('total_pages_of_tipani'))
                        <span class="err">
                            <strong>{{ $errors->first('total_pages_of_tipani') }}.</strong>
                        </span>
                    @endif
                </div>

                <label class="col-sm-2"><strong>Total pages of Docs / Letters :<span style="color:red;"> *</span></strong></label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="total_pages_of_docs" id="total_pages_of_docs" class="form-control  @error('total_pages_of_docs') is-invalid @enderror" value="{{ old('total_pages_of_docs') }}" placeholder="Enter Total pages of Docs / Letters.">
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
                    <input type="text" name="subject" id="subject" class="form-control  @error('subject') is-invalid @enderror" value="{{ old('subject') }}" placeholder="Enter Subject.">
                    @if ($errors->has('subject'))
                        <span class="err">
                            <strong>{{ $errors->first('subject') }}.</strong>
                        </span>
                    @endif
                </div>

                <label class="col-sm-2"><strong>File Detail / Tipani :<span style="color:red;"> *</span></strong></label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="file_detail" id="file_detail" class="form-control  @error('file_detail') is-invalid @enderror" value="{{ old('file_detail') }}" placeholder="Enter File Detail / Tipani.">
                    @if ($errors->has('file_detail'))
                        <span class="err">
                            <strong>{{ $errors->first('file_detail') }}.</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row mt-3">
                <label class="col-sm-2"><strong>Tipani File :</strong></label>
                <div class="col-sm-4 col-md-4">
                    <!--<input type="file" class="form-control-file form-control height-auto" name="image">-->
                    <div class="custom-file">
                        <input type="file" class="form-control-file form-control height-auto @error('pdf') is-invalid @enderror" name="pdf" id="pdf" value="{{ old('pdf') }}">

                    </div>

                    @if ($errors->has('pdf'))
                        <span class="err">
                            <strong>{{ $errors->first('pdf') }}.</strong>
                        </span>
                    @endif
                </div>

                <label class="col-sm-2"><strong>Reference   :</strong></label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="reference" id="reference" class="form-control  @error('reference') is-invalid @enderror" value="{{ old('reference') }}" placeholder="Enter Reference">
                    @if ($errors->has('reference'))
                        <span class="err">
                            <strong>{{ $errors->first('reference') }}.</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row mt-3">
                <label class="col-sm-2"><strong>Reference Number :</strong></label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="reference_no" id="reference_no" class="form-control  @error('reference_no') is-invalid @enderror" value="{{ old('reference_no') }}" placeholder="Enter Reference Number">
                    @if ($errors->has('reference_no'))
                        <span class="err">
                            <strong>{{ $errors->first('reference_no') }}.</strong>
                        </span>
                    @endif
                </div>

                <label class="col-sm-2"><strong>Reference Date : </span></strong></label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="reference_date" id="reference_date" class="form-control date-picker @error('reference_date') is-invalid @enderror" value="{{ old('reference_date') }}" placeholder="Enter Reference Date">
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
                    <input type="text" name="created_by" id="created_by" class="form-control  @error('created_by') is-invalid @enderror" readonly value="{{ Auth::user()->name }}" placeholder="Enter Created by.">
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
                <label class="col-sm-2"><strong>Table Number :</strong></label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="table_no" id="table_no" class="form-control  @error('table_no') is-invalid @enderror" readonly value="{{ Auth::user()->table_no }}" placeholder="Enter Table Number." readonly>

                    @if ($errors->has('table_no'))
                        <span class="err">
                            <strong>{{ $errors->first('table_no') }}.</strong>
                        </span>
                    @endif
                </div>
                
                <label class="col-sm-2"><strong>Financial Year : <span class="text-danger">*</span></strong></label>
                <div class="col-sm-4 col-md-4">
                    <!--<input type="text" name="department" id="department" class="form-control  @error('department') is-invalid @enderror"  value="{{ Auth::user()->department }}" placeholder="Enter Department Name.">-->
                    
                    <select class="custom-select2 form-control @error('financial_year') is-invalid @enderror" name="financial_year" id="financial_year" >
                        <option value="">Please Select Financial Year </option>
                        <optgroup label="Financial Year">
                            @foreach ($financial_year as $key => $file_type)
                                <option value="{{ $key }}" {{ old('financial_year') == "$key" ? 'selected' : '' }}>{{ $file_type }}</option>
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
            <div class="form-group row mt-4">
    <!--            &nbsp;&nbsp;&nbsp;&nbsp;-->
    <!--            <div class="custom-control custom-checkbox">-->
				<!--	<input type="checkbox"  class="custom-control-input " name="reminder" id="customCheck2-1" value="Yes">-->
				<!--	<label class="custom-control-label" for="customCheck2-1"><strong>Reminder</strong></label>-->
				<!--</div>-->
				<!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
    <!--            <div class="col-sm-4 col-md-4">-->
    <!--                <input type="text" name="date" id="date" class="form-control date-picker @error('date') is-invalid @enderror" value="{{\Carbon\Carbon::now("Asia/Tokyo")->format('d-m-Y')}}" placeholder="Enter Date">-->
    <!--                @if ($errors->has('date'))-->
    <!--                    <span class="err">-->
    <!--                        <strong>{{ $errors->first('date') }}.</strong>-->
    <!--                    </span>-->
    <!--                @endif-->
    <!--            </div>-->
            </div>

            <div class="form-group row mt-4">
                <label class="col-md-3"></label>
                <div class="col-md-9" style="display: flex; justify-content: flex-end;">
                    <a href="{{ url('file_master') }}" class="btn btn-danger">Cancel</a>&nbsp;&nbsp;
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </form>

    </div>
@endsection
