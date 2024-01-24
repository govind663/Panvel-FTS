@extends('adminlayouts.master')
@section('content')

    <style>
        .err {
            color: red;
        }

    </style>

    <div class="page-header">
        <div class="title">
            <h4 class="text-primary">Add File Type List</h4>
        </div>
    </div>
    <div class="pd-20 card-box mb-30">
        <form method="post" action="{{ url('file_type') }}" class="form-horizontal" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="form-group row mt-3">

                <label class="col-sm-2">File Type :<span style="color:red;"> *</span></label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="type" id="type" class="form-control  @error('type') is-invalid @enderror" value="" placeholder="Enter file type.">
                    @if ($errors->has('type'))
                        <span class="err">
                            <strong>{{ $errors->first('type') }}.</strong>
                        </span>
                    @endif
                </div>

                <label class="col-sm-2 pt-2">Status :<span style="color:red;"> *</span></label>
                <div class="col-sm-4 col-md-4">
                    <select class="custom-select2 form-control @error('status') is-invalid @enderror" name="status" id="status" style="width: 100%; height: 38px;">
                        <option value="selected">Please Select File Type</option>
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
                    <a href="{{ url('file_type') }}" class="btn btn-danger">Cancel</a>&nbsp;&nbsp;
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>

        </form>

    </div>
@endsection
