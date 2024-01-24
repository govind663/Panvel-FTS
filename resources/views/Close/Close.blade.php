@extends('adminlayouts.master')
@section('content')
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>File Close</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-primary" href="{{ url('index') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">File Close</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="pd-20 card-box mb-30">
                <h4 class="text-blue h4">File Close</h4>
                <hr>
                <form method="GET" action="{{ url('Closefilesearch') }}" class="form-horizontal"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group row mt-3">
                        <label class="col-sm-2">File Number&nbsp;&nbsp; : &nbsp;&nbsp;<span
                                class="text-danger">*</span></label>
                        <div class="col-sm-4 col-md-4">
                            <input type="search" name="search" id="search" class="form-control" value="" placeholder="Enter File No." required>
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
            
            <!--<div class="pd-20 card-box mb-30">-->
            <!--    <form method="post" action="{{ url('#') }}" class="form-horizontal" enctype="multipart/form-data">-->
            <!--        {{ csrf_field() }}-->

            <!--        <div class="form-group row mt-3">-->
            <!--            <label class="col-sm-2"><strong>Upload Tipani &nbsp;&nbsp; : &nbsp;<span class="text-danger">*</span></strong></label>-->
            <!--            <div class="col-sm-4 col-md-4">-->
            <!--                <input type="file" name="pdf" id="pdf" class="form-control  @error('pdf') is-invalid @enderror" value="">-->
            <!--                @if ($errors->has('pdf'))-->
            <!--                    <span class="err">-->
            <!--                        <strong>{{ $errors->first('pdf') }}.</strong>-->
            <!--                    </span>-->
            <!--                @endif-->
            <!--            </div>-->
                        
            <!--            <label class="col-sm-2"><strong>Number of Tipani Pages &nbsp;&nbsp; : &nbsp;<span class="text-danger">*</span></strong></label>-->
            <!--            <div class="col-sm-4 col-md-4">-->
            <!--                <input type="text" name="name" id="name" class="form-control  @error('name') is-invalid @enderror" value="" placeholder="Enter Number of Tipani Pages.">-->
            <!--                @if ($errors->has('name'))-->
            <!--                    <span class="err">-->
            <!--                        <strong>{{ $errors->first('name') }}.</strong>-->
            <!--                    </span>-->
            <!--                @endif-->
            <!--            </div>-->
            <!--        </div>-->

            <!--        <div class="form-group row mt-3">-->
            <!--            <label class="col-sm-2"><strong>Remark / Tipani&nbsp;&nbsp; : &nbsp;<span class="text-danger">*</span></strong></label>-->
            <!--            <div class="col-sm-12 col-md-12">-->
            <!--                <textarea type="text" name="remark" class="form-control @error('remark') is-invalid @enderror" placeholder="Enter Remark / Tipani here" id="remark" cols="20" rows="10"></textarea>-->
            <!--                @if ($errors->has('remark'))-->
            <!--                    <span class="err">-->
            <!--                        <strong>{{ $errors->first('remark') }}.</strong>-->
            <!--                    </span>-->
            <!--                @endif-->
            <!--            </div>-->
            <!--        </div>-->

            <!--        <div class="form-group row mt-4">-->
            <!--            <label class="col-md-3"></label>-->
            <!--            <div class="col-md-9" style="display: flex; justify-content: flex-end;">-->
                            <!--<a href="{{ url('department') }}" class="btn btn-danger">Cancel</a>&nbsp;&nbsp;-->
            <!--                <button type="submit" class="btn btn-success">Submit</button>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </form>-->
            <!--</div>-->

            <!-- Export Datatable start -->
            <!--<div class="pd-20 card-box mb-30">-->
            <!--    <h4 class="text-blue h4">File Details</h4>-->
            <!--        <hr>-->
            <!--        <div class="card-body file-detail">-->
            <!--            <div class="row">-->
            <!--                <div class="col-lg-3 p-2">-->
            <!--                    <strong>File Number : &nbsp;&nbsp;</strong><span>0041</span>-->
            <!--                </div>-->
            <!--                <div class="col-lg-3 p-2">-->
            <!--                    <strong>File Type : &nbsp;&nbsp;</strong><span>File D</span>-->
            <!--                </div>-->
            <!--                <div class="col-lg-3 p-2">-->
            <!--                    <strong>Total pages of <br>Tipani/Files : &nbsp;&nbsp;</strong><span>1</span>-->
            <!--                </div>-->
            <!--                <div class="col-lg-3 p-2">-->
            <!--                    <strong>Total pages of Docs/Letters : &nbsp;&nbsp;</strong><span>16</span>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--            <div class="row">-->
            <!--                <div class="col-lg-3 p-2">-->
            <!--                    <strong>Created by : &nbsp;&nbsp;</strong><span>संतोष साठे</span>-->
            <!--                </div>-->
            <!--                <div class="col-lg-3 p-2">-->
            <!--                    <strong>Department : &nbsp;&nbsp;</strong><span>लेखा विभाग</span>-->
            <!--                </div>-->
            <!--                <div class="col-lg-3 p-2">-->
            <!--                    <strong>Table : &nbsp;&nbsp;</strong><span>1</span>-->
            <!--                </div>-->
            <!--                <div class="col-lg-3 p-2">-->
            <!--                    <strong>Status : &nbsp;&nbsp;</strong><span>Closed / निकाली</span>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--            <div class="row">-->
            <!--                <div class="col-lg-4 p-2">-->
            <!--                    <strong>Subject : &nbsp;&nbsp;</strong><span>covid 19 orange hospital</span>-->
            <!--                </div>-->
            <!--                <div class="col-lg-4 p-2">-->
            <!--                    <strong>File Detail / Tipani : </strong><span>covid 19 orange-->
            <!--                        hospital</span>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--</div>-->
            
            <!--<div class="pd-20 card-box mb-30">-->
            <!--    <div class="title">-->
            <!--        <h4 class="text-primary">Forwarding History : </h4>-->
            <!--    </div>-->
            <!--    <hr>-->
            <!--    <div class="pd-20">-->
            <!--        <table class="table hover  table-responsive  nowrap p-3">-->
            <!--            <thead class="text-light table-bordered" style="background:#0285D0;">-->
            <!--                <tr>-->
            <!--                    <th rowspan="2">Date</th>-->
            <!--                    <th rowspan="2">Status</th>-->
            <!--                    <th colspan="3" class="text-center">From</th>-->
            <!--                    <th colspan="3" class="text-center">To</th>-->
            <!--                    <th rowspan="2">Method</th>-->
            <!--                    <th rowspan="2">No. of Tipani Pages</th>-->
            <!--                    <th rowspan="2">Tipani File</th>-->
            <!--                    <th rowspan="2">Remark / Tipani</th>-->
                                <!--th width="50px">#</th-->
            <!--                </tr>-->
            <!--                <tr>-->
            <!--                    <th>Employee</th>-->
            <!--                    <th>Department</th>-->
            <!--                    <th>Table</th>-->
            <!--                    <th>Employee</th>-->
            <!--                    <th>Department</th>-->
            <!--                    <th>Table</th>-->
            <!--                </tr>-->
            <!--            </thead>-->
            <!--            <tbody class="table-bordered" style="background:#E5E5E5;">-->
            <!--                <tr>-->
            <!--                    <td>23-06-2021 15:15 PM</td>-->
            <!--                    <td>Closed / निकाली</td>-->
            <!--                    <td>संतोष साठे</td>-->
            <!--                    <td>लेखा विभाग</td>-->
            <!--                    <td>1</td>-->
            <!--                    <td>संतोष साठे</td>-->
            <!--                    <td>लेखा विभाग</td>-->
            <!--                    <td>1</td>-->
            <!--                    <td>By Hand </td>-->
            <!--                    <td>1</td>-->
            <!--                    <td> - </td>-->
            <!--                    <td>निकाली </td>-->
                                <!--td>&nbsp;</td-->
            <!--                </tr>-->
            <!--                <tr>-->
            <!--                    <td>19-05-2021 14:21 PM</td>-->
            <!--                    <td>Created</td>-->
            <!--                    <td>संतोष साठे</td>-->
            <!--                    <td>लेखा विभाग</td>-->
            <!--                    <td>1</td>-->
            <!--                    <td>संतोष साठे</td>-->
            <!--                    <td>लेखा विभाग</td>-->
            <!--                    <td>1</td>-->
            <!--                    <td>By Hand </td>-->
            <!--                    <td>1</td>-->
            <!--                    <td> - </td>-->
            <!--                    <td>covid 19 orange hospital</td>-->
                                <!--td>&nbsp;</td-->
            <!--                </tr>-->
            <!--            </tbody>-->
            <!--        </table>-->
            <!--    </div>-->
            <!--</div>-->
            <!-- Export Datatable End -->

        </div>
        <div class="footer-wrap pd-20 mb-20 card-box">
            Copyright ©<?php echo date('Y'); ?>. Designed And Developed By Core Ocean Solutions LLP. All rights reserved.
        </div>
    </div>
@endsection
