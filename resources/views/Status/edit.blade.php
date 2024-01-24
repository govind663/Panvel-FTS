@extends('adminlayouts.master')
@section('content')

    <style>
        .err {
            color: red;
        }
    </style>

    <div class="page-header">
        <div class="title">
            <h4 class="text-primary">Edit Status List</h4>
        </div>
    </div>
    <div class="pd-20 card-box mb-30">
        <form method="post" action="{{ route('status.update', $data->id) }}" class="form-horizontal" enctype="multipart/form-data">
            {{ csrf_field() }}

            @if (!empty($data->id) || 1 == 1)
                <input type="hidden" name="_method" value="PATCH">
            @endif

            <input type="hidden" id="id" name="id" value="{{ $data['id'] or '' }}">

            <div class="form-group row mt-3">
                <label class="col-sm-2">Name :<span style="color:red;"> *</span></label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="name" id="name" class="form-control" value="{{ $data->name }}">
                </div>

                <!--<label class="col-sm-2 pt-2">Follow Up :<span style="color:red;"> *</span></label>-->
                <!--<div class="col-sm-4 col-md-4">-->
                <!--    <select class="custom-select2 form-control" name="follow_up" id="follow_up"  style="width: 100%; height: 38px;">-->
                <!--        <option value="{{ $data->follow_up }}">{{ $data->follow_up}}</option>-->
                <!--        <optgroup label="Follow Up">-->
                <!--            <option value="Yes">Yes</option>-->
                <!--            <option value="No">No</option>-->
                <!--        </optgroup>-->
                <!--    </select>-->
                <!--</div>-->
                
                <label class="col-sm-2 pt-2">Status :<span style="color:red;"> *</span></label>
                <div class="col-sm-4 col-md-4">
                    <select class="custom-select2 form-control" name="status" id="status"  style="width: 100%; height: 38px;">
                        <option value="{{ $data->status }}">{{ $data->status }}</option>
                        <optgroup label="Status">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </optgroup>
                    </select>
                </div>
            </div>
            
            
            
            <div class="form-group row mt-4">
                <label class="col-md-3"></label>
                <div class="col-md-9" style="display: flex; justify-content: flex-end;">
                    <a href="{{ url('status') }}" class="btn btn-danger">Cancel</a>&nbsp;&nbsp;
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>

        </form>

    </div>
@endsection
