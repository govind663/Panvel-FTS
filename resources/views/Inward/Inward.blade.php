@extends('adminlayouts.master')
@section('content')
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    @if (Session::has('flash_message'))
                        <div class=" col-sm-12">
                            <div class="alert alert-success alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Success!</strong> {{ Session::get('flash_message') }}.
                            </div>

                        </div>
                    @endif
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>File Inward</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-primary" href="{{ url('index') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">File Inward</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="pd-20 card-box mb-30">
                <h4 class="text-blue h4">File Inward</h4>
                <hr>
                <form method="GET" action="{{url('Inwardsearch')}}" class="form-horizontal" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group row mt-3">
                        <label class="col-sm-2">File Number&nbsp;&nbsp; : &nbsp;&nbsp;<span class="text-danger">*</span></label>
                        <div class="col-sm-4 col-md-4">
                            <input type="search" name="search" id="search" class="form-control" value=""
                                placeholder="Enter File No.">
                                <!--<input type="hidden" name="curr_user" id="curr_user" class="form-control " value="{{ Auth::user()->id }}">-->
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
        <div class="footer-wrap pd-20 mb-20 card-box">
            Copyright ©<?php echo date('Y'); ?>. Designed And Developed By Core Ocean Solutions LLP. All rights reserved.
        </div>
    </div>
@endsection
