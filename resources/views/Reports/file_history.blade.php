@extends('adminlayouts.master')
@section('content')
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>File History</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-primary" href="{{ url('index') }}">Home</a></li>
                                <li class="breadcrumb-item active">File History</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="pd-20 card-box mb-30">
                <h4 class="text-blue h4">File History</h4>
                <hr>
                <form method="POST" action="{{url('check_file_history_search')}}" class="form-horizontal" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row mt-3">
                        <label class="col-sm-3">File Master Number&nbsp;&nbsp; : &nbsp;&nbsp;<span class="text-danger">*</span></label>
                        <div class="col-sm-8 col-md-8">
                            <input type="search" name="search" id="search" class="form-control" value=""
                                placeholder="Enter File Master Number" required>
                        </div>
                        
                    </div>
                    
                    <div class="form-group row mt-4">
                        <label class="col-md-3"></label>
                        <div class="col-md-9" style="display: flex; justify-content: flex-end;">
                            <!--<a href="{{ url('department') }}" class="btn btn-danger">Cancel</a>&nbsp;&nbsp;-->
                            <button type="submit" class="btn btn-success">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
@endsection
