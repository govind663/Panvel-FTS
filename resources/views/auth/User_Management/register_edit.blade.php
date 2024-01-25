@extends('adminlayouts.master')
@section('content')

    <style>
        .err {
            color: red;
        }
    </style>

    <div class="page-header">
        <div class="title">
            <h4 class="text-primary">Edit User</h4>
        </div>
    </div>
    <form method="post" action="{{ route('users.update', $data->id) }}" class="form-horizontal" enctype="multipart/form-data">
        @csrf

        @if (!empty($data->id) || 1 == 1)
            <input type="hidden" name="_method" value="PATCH">
        @endif

        <input type="hidden" id="id" name="id" value="{{ $data['id'] or '' }}">

        <div class="pd-20 card-box mb-30">
            <div class="form-group row mt-3">
                <label class="col-sm-2">Full Name : <span style="color:red;"> *</span></label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="name" id="name" class="form-control  @error('name') is-invalid @enderror"
                        value="{{$data->name}}" placeholder="Enter Full Name.">
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
                        <option value="{{$data->user_type}}"  selected>{{$data->user_type}}</option>
                        <optgroup label="User Type">
                            <option value="Admin">Admin</option>
                            <option value="User">User</option>
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
                    <input type="text" name="mobile_no" id="mobile_no" class="form-control form-control @error('mobile_no') is-invalid @enderror" value="{{$data->mobile_no}}" placeholder="Enter Mobile No.">
                    @if ($errors->has('mobile_no'))
                        <span class="err">
                            <strong>{{ $errors->first('mobile_no') }}.</strong>
                        </span>
                    @endif
                </div>

                <label class="col-sm-2">Email ID : <span style="color:red;"> *</span></label>
                <div class="col-sm-4 col-md-4">
                    <input type="email" name="email" id="email" class="form-control form-control @error('email') is-invalid @enderror" value="{{$data->email}}" placeholder="Enter Email Id.">
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
                            @foreach($audit_mst as $key=> $comps)
                                <option value="{{$key}}"
                                    @if($key == $data['department'])
                                    Selected
                                    @endif  >{{$comps}}
                                </option>
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
                    <input type="text" name="table_no" id="table_no" class="form-control form-control @error('table_no') is-invalid @enderror" value="{{$data->table_no}}" placeholder="Enter Table Number.">
                    @if ($errors->has('table_no'))
                        <span class="err">
                            <strong>{{ $errors->first('table_no') }}.</strong>
                        </span>
                    @endif
                </div>
            </div>

            <!--<div class="form-group row mt-3">-->
                <!--<label class="col-sm-2">Username : <span style="color:red;"> *</span></label>-->
                <!--<div class="col-sm-4 col-md-4">-->
                <!--    <input type="text" name="username" id="username" class="form-control form-control @error('username') is-invalid @enderror" value="{{$data->username}}" placeholder="Enter Username.">-->
                <!--    @if ($errors->has('username'))-->
                <!--        <span class="err">-->
                <!--            <strong>{{ $errors->first('username') }}.</strong>-->
                <!--        </span>-->
                <!--    @endif-->
                <!--</div>-->

            <!--    <label class="col-sm-2">Password : </label>-->
            <!--    <div class="col-sm-4 col-md-4">-->
            <!--        <input type="password" name="password" id="password" class="form-control form-control @error('password') is-invalid @enderror" value="{{$data->password}}" placeholder="Enter Password.">-->
            <!--        @if ($errors->has('password'))-->
            <!--            <span class="err">-->
            <!--                <strong>{{ $errors->first('password') }}.</strong>-->
            <!--            </span>-->
            <!--        @endif-->
            <!--    </div>-->

            <!--    <label class="col-sm-2">Password Confirmation: </label>-->
            <!--    <div class="col-sm-4 col-md-4">-->
            <!--        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control @error('password_confirmation') is-invalid @enderror" value="{{$data->password}}" placeholder="Enter Password Confirmation.">-->
            <!--        @if ($errors->has('password_confirmation'))-->
            <!--            <span class="err">-->
            <!--                <strong>{{ $errors->first('password_confirmation') }}.</strong>-->
            <!--            </span>-->
            <!--        @endif-->
            <!--    </div>-->
            <!--</div>-->

            <div class="form-group row mt-3">


                <label class="col-sm-2 pt-2">Status : <span style="color:red;"> *</span></label>
                <div class="col-sm-4 col-md-4">
                    <select class="custom-select2 form-control @error('status') is-invalid @enderror" name="status" id="status" style="width: 100%; height: 38px;">
                        <option value="{{$data->status}}" selected>{{$data->status}}</option>
                        <optgroup label="Status">
                            <option value="Active">Active </option>
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
                <label class="col-md-3"></label>
                <div class="col-md-9" style="display: flex; justify-content: flex-end;">
                    <a href="{{ route('users.index') }}" class="btn btn-danger">Cancel</a>&nbsp;&nbsp;
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>



        </div>

    </form>

@endsection
