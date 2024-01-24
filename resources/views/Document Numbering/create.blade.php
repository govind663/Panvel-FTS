@extends('adminlayouts.master')
@section('content')

    <style>
        .err {
            color: red;
        }

    </style>

    <div class="page-header">
        <div class="title">
            <h4 class="text-primary">Add Document Numbering </h4>
        </div>
    </div>

    <form method="post" action="{{ url('document_numbering') }}" class="form-horizontal" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="pd-20 card-box mb-30 ">
            
            <div class="form-group row mt-3">
                <label class="col-sm-2">Name :<span style="color:red;"> *</span></label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="name" id="name" class="form-control  @error('name') is-invalid @enderror"
                        value="" placeholder="Enter Name.">
                    @if ($errors->has('name'))
                        <span class="err">
                            <strong>{{ $errors->first('name') }}.</strong>
                        </span>
                    @endif
                </div>

                <label class="col-sm-2 pt-2">Company Name :<span style="color:red;"> *</span></label>
                <div class="col-sm-4 col-md-4">
                    <select class="custom-select2 form-control @error('company') is-invalid @enderror" name="company"
                        id="company" style="width: 100%; height: 38px;">
                        <option value="">Please Select Company </option>
                        <optgroup label="">
                            @foreach($organization as $key => $comps)
                               <option value="{{ $key }}">{{ $comps }}</option>
                            @endforeach
                        </optgroup>
                    </select>
                    @if ($errors->has('company'))
                        <span class="err">
                            <strong>{{ $errors->first('company') }}.</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row mt-3">
                <label class="col-sm-2 pt-2">Document Type :<span style="color:red;"> *</span></label>
                <div class="col-sm-4 col-md-4">
                    <select class="custom-select2 form-control @error('document_type') is-invalid @enderror" name="document_type"
                        id="document_type" style="width: 100%; height: 38px;">
                        <option value="">Please Select Document Type </option>
                        <optgroup label="">
                            <option value="File">File</option>
                            <option value="QR-Code">QR-Code</option>
                        </optgroup>
                    </select>
                    @if ($errors->has('document_type'))
                        <span class="err">
                            <strong>{{ $errors->first('document_type') }}.</strong>
                        </span>
                    @endif
                </div>
                
                <label class="col-sm-2 pt-2">Financial Year :<span style="color:red;"> *</span></label>
                <div class="col-sm-4 col-md-4">
                    <select class="custom-select2 form-control @error('financial_year') is-invalid @enderror" name="financial_year"
                        id="financial_year" style="width: 100%; height: 38px;">
                        <option value="">Please Select Financial Year </option>
                        <optgroup label="">
                            @foreach($financial_year as $key => $comps)
                               <option value="{{ $key }}">{{ $comps }}</option>
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
            
            <div class="form-group row mt-3">
                <label class="col-sm-2">Prefix :</label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="prefix" id="prefix"
                        class="form-control  @error('prefix') is-invalid @enderror" value=""
                        placeholder="Enter Prefix.">
                    @if ($errors->has('prefix'))
                        <span class="err">
                            <strong>{{ $errors->first('prefix') }}.</strong>
                        </span>
                    @endif
                </div>

                <label class="col-sm-2">Suffix :</label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="suffix" id="suffix" class="form-control  @error('suffix') is-invalid @enderror"
                        value="" placeholder="Enter Suffix.">
                    @if ($errors->has('suffix'))
                        <span class="err">
                            <strong>{{ $errors->first('suffix') }}.</strong>
                        </span>
                    @endif
                </div>
            </div>
            
            <div class="form-group row mt-3">
                <label class="col-sm-2">Start Doc. No. :</label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="Start_Doc_No" id="Start_Doc_No" class="form-control  @error('Start_Doc_No') is-invalid @enderror" value="" placeholder="Enter Starting Document Number.">
                    @if ($errors->has('Start_Doc_No'))
                        <span class="err">
                            <strong>{{ $errors->first('Start_Doc_No') }}.</strong>
                        </span>
                    @endif
                </div>

                <label class="col-sm-2">End Doc. No. :</label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="End_Doc_No" id="End_Doc_No" class="form-control  @error('End_Doc_No') is-invalid @enderror" value="" placeholder="Enter Ending Document Number.">
                    @if ($errors->has('End_Doc_No'))
                        <span class="err">
                            <strong>{{ $errors->first('End_Doc_No') }}.</strong>
                        </span>
                    @endif
                </div>
            </div>
            
            <div class="form-group row mt-3">
                <label class="col-sm-2 pt-2">Document Numbering Status :<span style="color:red;"> *</span></label>
                <div class="col-sm-4 col-md-4">
                    <select class="custom-select2 form-control @error('status') is-invalid @enderror" name="status"
                        id="status" style="width: 100%; height: 38px;">
                        <option value="">Please Select Document Status </option>
                        <optgroup label="">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </optgroup>
                    </select>
                    @if ($errors->has('status'))
                        <span class="err">
                            <strong>{{ $errors->first('status') }}.</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group row mt-4">
                <label class="col-md-3"></label>
                <div class="col-md-9" style="display: flex; justify-content: flex-end;">
                    <a href="{{ url('document_numbering') }}" class="btn btn-danger">Cancel</a>&nbsp;&nbsp;
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </div>
    </form>
@endsection
