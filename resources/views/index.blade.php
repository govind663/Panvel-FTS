@extends('adminlayouts.master')
@section('content')

    <div class="pd-ltr-20">
        <!--<div class="row">-->
        <!--    @if (Session::has('message'))-->
        <!--        <div class=" col-sm-12">-->
        <!--            <div class="alert alert-success alert-dismissible">-->
        <!--                <a href="#" class="close" data-dismiss="alert"-->
        <!--                    aria-label="close">&times;</a>-->
        <!--                <strong>Congratulation...!!</strong> {{ Session::get('message') }}.-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    @endif-->
        <!--</div>-->


        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Dashboard</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('index') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>

                </div>
            </div>
        </div>

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <div class="title pb-20">
                        <h3 class="h3 mb-0 text-justify">Department Wise Pending Files.</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row pb-10">
            @foreach ($data as $key => $file_type)
                @if(auth()->user()->department == $file_type->id)
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                        <div class="card-box height-100-p widget-style3">
                            <div class="d-flex flex-wrap" style="height:100%;">
                                <div class="widget-data">
                                    <div class="weight-700 font-24 text-dark">{{ $file_type->totalfiles }}</div>
                                    <div class="font-14  weight-600 text-justify text-primary">
                                        <a href="{{url('Department_Details')}}/{{$file_type->id }}"><strong class="text-dark">{{ $file_type->name }}</strong></a>
                                    </div>
                                </div>
                                <div class="widget-icon bg-danger">
                                    <div class="icon" data-color="#00eccf"><a href="{{url('Department_Details')}}/{{$file_type->id }}"> <i class="far fa-eye text-light"></i></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="footer-wrap pd-20 mb-20 card-box">
            Copyright ©<?php echo date('Y'); ?>. Designed And Developed By Core Ocean Solutions LLP. All rights reserved.
        </div>
    </div>
@endsection
