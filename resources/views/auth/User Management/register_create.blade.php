@extends('adminlayouts.master')
@section('content')

    <style>
        .err {
            color: red;
        }

    </style>

    <div class="page-header">
        <div class="title">
            <h4 class="text-primary">Add Users</h4>
        </div>
    </div>

    <form method="post" action="{{ url('user') }}" class="form-horizontal" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="pd-20 card-box mb-30">
            <div class="form-group row mt-3">
                <label class="col-sm-2">Full Name : <span style="color:red;"> *</span></label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="name" id="name" class="form-control  @error('name') is-invalid @enderror"
                        value="{{ old('name') }}" placeholder="Enter Full Name.">
                    @if ($errors->has('name'))
                        <span class="err">
                            <strong>{{ $errors->first('name') }}.</strong>
                        </span>
                    @endif
                </div>

                <label class="col-sm-2 pt-2">User Type : <span style="color:red;"> *</span></label>
                <div class="col-sm-4 col-md-4">
                    <select class="custom-select2 form-control @error('user_type') is-invalid @enderror" name="user_type"
                        id="user_type" style="width: 100%; height: 38px;">
                        <option value="">Please Select User Type </option>
                        <optgroup label="User Type">
                            <option value="Admin" {{ old('user_type') == "Admin" ? 'selected' : '' }}>Admin</option>
                            <option value="User" {{ old('user_type') == "User" ? 'selected' : '' }}>User</option>
                            <!--<option value="Peon">Peon</option>-->
                            <option value="Department Head">Department Head</option>
                        </optgroup>
                    </select>
                    @if ($errors->has('user_type'))
                        <span class="err">
                            <strong>{{ $errors->first('user_type') }}.</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row mt-3">
                <label class="col-sm-2">Mobile No. : <span style="color:red;"> *</span></label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="mobile_no" id="mobile_no" class="form-control form-control @error('mobile_no') is-invalid @enderror" value="{{ old('mobile_no') }}" placeholder="Enter Mobile No.">
                    @if ($errors->has('mobile_no'))
                        <span class="err">
                            <strong>{{ $errors->first('mobile_no') }}.</strong>
                        </span>
                    @endif
                </div>
        
                <label class="col-sm-2">Email ID : <span style="color:red;"> *</span></label>
                <div class="col-sm-4 col-md-4">
                    <input type="email" name="email" id="email" class="form-control form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Enter Email Id.">
                    @if ($errors->has('email'))
                        <span class="err">
                            <strong>{{ $errors->first('email') }}.</strong>
                        </span>
                    @endif
                </div>
            </div> 
            
            <div class="form-group row mt-3">
                <label class="col-sm-2 pt-2">Department : <span style="color:red;"> *</span></label>
                <div class="col-sm-4 col-md-4">
                    <select class="custom-select2 form-control @error('department') is-invalid @enderror" name="department"
                        id="department" style="width: 100%; height: 38px;">
                        <option value="">Please Select Department </option>
                        <optgroup label="Department Name">
                            @foreach($department as $key=> $comps)
                                <option value="{{$key}}" {{ old('department') == "$key" ? 'selected' : '' }}>{{$comps}}</option>
                            @endforeach
                        </optgroup>
                    </select>
                    @if ($errors->has('department'))
                        <span class="err">
                            <strong>{{ $errors->first('department') }}.</strong>
                        </span>
                    @endif
                </div>
                
                <label class="col-sm-2">Table Number : <span style="color:red;"> *</span></label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="table_no" id="table_no" class="form-control form-control @error('table_no') is-invalid @enderror" value="{{ old('table_no') }}" placeholder="Enter Table Number.">
                    @if ($errors->has('table_no'))
                        <span class="err">
                            <strong>{{ $errors->first('table_no') }}.</strong>
                        </span>
                    @endif
                </div>
            </div>
            
            <div class="form-group row mt-3">
                <!--<label class="col-sm-2">Username : <span style="color:red;"> *</span></label>-->
                <!--<div class="col-sm-4 col-md-4">-->
                <!--    <input type="text" name="username" id="username" class="form-control form-control @error('username') is-invalid @enderror" value="" placeholder="Enter Username.">-->
                <!--    @if ($errors->has('username'))-->
                <!--        <span class="err">-->
                <!--            <strong>{{ $errors->first('username') }}.</strong>-->
                <!--        </span>-->
                <!--    @endif-->
                <!--</div>-->
        
                <label class="col-sm-2">Password : <span style="color:red;"> *</span></label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="password" id="password" class="form-control form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" placeholder="Enter Password.">
                    @if ($errors->has('password'))
                        <span class="err">
                            <strong>{{ $errors->first('password') }}.</strong>
                        </span>
                    @endif
                </div>
                
                <label class="col-sm-2">Password Confirmation: <span style="color:red;"> *</span></label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="password_confirmation" id="password_confirmation" class="form-control form-control @error('password_confirmation') is-invalid @enderror" value="{{ old('password_confirmation') }}" placeholder="Enter Password Confirmation.">
                    @if ($errors->has('password_confirmation'))
                        <span class="err">
                            <strong>{{ $errors->first('password_confirmation') }}.</strong>
                        </span>
                    @endif
                </div>
            </div>
            
            <div class="form-group row mt-3">
                
                
                <label class="col-sm-2 pt-2">Status : <span style="color:red;"> *</span></label>
                <div class="col-sm-4 col-md-4">
                    <select class="custom-select2 form-control @error('status') is-invalid @enderror" name="status"
                        id="status" style="width: 100%; height: 38px;">
                        <option value="">Please Select Status</option>
                        <optgroup label="">
                            <option value="Active" {{ old('status') == "Active" ? 'selected' : '' }}>Active </option>
                            <option value="Inactive" {{ old('status') == "Inactive" ? 'selected' : '' }}>Inactive</option>
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
                <label class="col-md-3"></label>
                <div class="col-md-9" style="display: flex; justify-content: flex-end;">
                    <a href="{{ url('user') }}" class="btn btn-danger">Cancel</a>&nbsp;&nbsp;
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
            
        </div>
        
    </form>
@endsection
