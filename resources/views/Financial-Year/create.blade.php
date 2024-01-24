@extends('adminlayouts.master')
@section('content')

    <style>
        .err {
            color: red;
        }

    </style>

    <div class="page-header">
        <div class="title">
            <h4 class="text-primary">Add Financial Year List</h4>
        </div>
    </div>
    <div class="pd-20 card-box mb-30">
        <form method="post" action="{{ url('financial_year') }}" class="form-horizontal" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="form-group row mt-3">

                <label class="col-sm-2">Name :<span style="color:red;"> *</span></label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="name" id="name" class="form-control  @error('name') is-invalid @enderror" value="" placeholder="Enter name.">
                    @if ($errors->has('name'))
                        <span class="err">
                            <strong>{{ $errors->first('name') }}.</strong>
                        </span>
                    @endif
                </div>

                <label class="col-sm-2 pt-2">Status :<span style="color:red;"> *</span></label>
                <div class="col-sm-4 col-md-4">
                    <select class="custom-select2 form-control @error('status') is-invalid @enderror" name="status" id="status" style="width: 100%; height: 38px;">
                        <option value=" ">Please Select Financial Year Status</option>
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
            
            <div class="form-group row mt-3">
                <label class="col-sm-2">Start Date :<span style="color:red;"> *</span></label>
                <div class="col-sm-4 col-md-4">
                    <input type="date" name="start_date" id="start_date" class="form-control  @error('start_date') is-invalid @enderror" value="">
                    @if ($errors->has('start_date'))
                        <span class="err">
                            <strong>{{ $errors->first('start_date') }}.</strong>
                        </span>
                    @endif
                </div>
                
                <label class="col-sm-2">End Date :<span style="color:red;"> *</span></label>
                <div class="col-sm-4 col-md-4">
                    <input type="date" name="end_date" id="end_date" class="form-control @error('end_date') is-invalid @enderror" value="">
                    @if ($errors->has('end_date'))
                        <span class="err">
                            <strong>{{ $errors->first('end_date') }}.</strong>
                        </span>
                    @endif
                </div>
            </div>
            
            <div class="form-group row mt-4">
                <label class="col-md-3"></label>
                <div class="col-md-9" style="display: flex; justify-content: flex-end;">
                    <a href="{{ url('financial_year') }}" class="btn btn-danger">Cancel</a>&nbsp;&nbsp;
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>

        </form>

    </div>
@endsection
