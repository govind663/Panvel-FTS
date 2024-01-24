@extends('adminlayouts.master')
@section('content')
    <style>
        .err {
            color: red;
        }
.select2-container{
 width:100%!important;   
}
    </style>
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <!--@if (Session::has('flash_message'))-->
                    <!--    <div class=" col-sm-12">-->
                    <!--        <div class="alert alert-success alert-dismissible">-->
                    <!--            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
                    <!--            <strong>Success!</strong> {{ Session::get('flash_message') }}.-->
                    <!--        </div>-->

                    <!--    </div>-->
                    <!--@endif-->
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Edit File Forward</h4>
                        </div>
                        <!--<nav aria-label="breadcrumb" role="navigation">-->
                        <!--    <ol class="breadcrumb">-->
                        <!--        <li class="breadcrumb-item"><a class="text-primary" href="{{ url('index') }}">Home</a>-->
                        <!--        </li>-->
                        <!--        <li class="breadcrumb-item active">File Forward</li>-->
                        <!--    </ol>-->
                        <!--</nav>-->
                    </div>
                </div>
            </div>
            
            <!-- Export Datatable start -->
            <div class="pd-20 card-box mb-30">
                <div class="row p-2">
                            <!--@if (Session::has('flash_message'))-->
                            <!--    <div class=" col-sm-12">-->
                            <!--        <div class="alert alert-success alert-dismissible">-->
                            <!--            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
                            <!--            <strong>Success!</strong> {{ Session::get('flash_message') }}.-->
                            <!--        </div>-->
        
                            <!--    </div>-->
                            <!--@endif-->
                            <div class="col-lg-12">
                                
                                <form method="post" action="{{ route('in_transit.update', $data->id) }}" class="form-horizontal pt-3" enctype="multipart/form-data"  accept-charset="utf-8" autocomplete="off">
                                    {{ csrf_field() }}
                                    
                                    @if (!empty($data->id) || 1 == 1)
                                        <input type="hidden" name="_method" value="PATCH">
                                    @endif
                        
                                    <input type="hidden" id="id" name="id" value="{{ $data->id or '' }}">
                                    <input type="hidden" name="inserted_by" id="inserted_by" class="form-control " value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="user_login" id="user_login" class="form-control " value="{{ Auth::user()->name }}">
                                    <input type="hidden" name="dept_login" id="dept_login" class="form-control " value="{{ Auth::user()->department }}">
                                    <input type="hidden" name="tableno_login" id="tableno_login" class="form-control " value="{{ Auth::user()->table_no }}">
                                    
                                        <input type="hidden"  name="file_master_no" id="file_master_no" class="form-control " value="{{ $data->file_master_no }}">
                                    
                                    <div class="form-group row mt-3">
                                        <label class="col-sm-2 pt-2"><strong>Department&nbsp;&nbsp; : <span class="text-danger">*</span>&nbsp;&nbsp;</strong></label>
                                        <div class="col-sm-4 col-md-4">
                                            <select class="custom-select2 form-control @error('department_name') is-invalid @enderror" name="department_name" id="department_name" required >
                                                <option value=" ">&nbsp;&nbsp;Please Select Department</option>
                                                <optgroup label="">
                                                    @foreach ($department_name as $key => $comps)
                                                        <option value="{{ $key }}">{{ $comps }}</option>
                                                    @endforeach
                                                </optgroup>
                                            </select>
                                            @if ($errors->has('department_name'))
                                                <span class="err">
                                                    <strong>{{ $errors->first('department_name') }}.</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <label class="col-sm-2 pt-2"><strong>Forward To&nbsp;&nbsp; : <span class="text-danger">*</span>&nbsp;&nbsp;</strong></label>
                                        <div class="col-sm-4 col-md-4">
                                            <select class="custom-select2 form-control @error('forward_to') is-invalid @enderror" name="forward_to" id="forward_to" required >
                                                
                                            </select>
                                            @if ($errors->has('forward_to'))
                                                <span class="err">
                                                    <strong>{{ $errors->first('forward_to') }}.</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row mt-3">
                                        <label class="col-sm-2"><strong>Pending File (if any) &nbsp;&nbsp; : &nbsp;</strong></label>
                                        <div class="col-sm-4 col-md-4">
                                            <input type="file" name="pdf" id="pdf" class="form-control  @error('pdf') is-invalid @enderror" value="" >
                                            @if ($errors->has('pdf'))
                                                <span class="err">
                                                    <strong>{{ $errors->first('pdf') }}.</strong>
                                                </span>
                                            @endif
                                        </div>
                                        
                                        <label class="col-sm-2"><strong>Page Count of Uploaded File &nbsp;&nbsp; :  
                                                &nbsp;</strong></label>
                                        <div class="col-sm-4 col-md-4">
                                            <input type="text" name="tipani_page" id="tipani_page" class="form-control  @error('tipani_page') is-invalid @enderror" value="" placeholder="Enter Number of Tipani Pages." >
                                            @if ($errors->has('tipani_page'))
                                                <span class="err">
                                                    <strong>{{ $errors->first('tipani_page') }}.</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row mt-3">
                                        <label class="col-sm-2"><strong>Table No. &nbsp;&nbsp; : <span class="text-danger">*</span>&nbsp;</strong></label>
                                        <div class="col-sm-4 col-md-4">
                                            <select class="custom-select2 form-control @error('fowto_table_no') is-invalid @enderror" name="fowto_table_no" id="fowto_table_no" required >
                                                
                                            </select>
                                            @if ($errors->has('fowto_table_no'))
                                                <span class="err">
                                                    <strong>{{ $errors->first('fowto_table_no') }}.</strong>
                                                </span>
                                            @endif
                                        </div>
                                        
                                        <label class="col-sm-2 pt-2"><strong>Forward File Status&nbsp;&nbsp; : <span class="text-danger">*</span>&nbsp;&nbsp;</strong></label>
                                        <div class="col-sm-4 col-md-4">
                                            <select class="custom-select2 form-control @error('file_status') is-invalid @enderror" name="file_status" id="file_status" >
                                                <option value=" ">&nbsp;&nbsp;Please Select File Status</option>
                                                <optgroup label="">
                                                    <option value="12">In Transit</option>
                                                    @foreach ($status as $key => $comps)
                                                        
                                                    @endforeach
                                                </optgroup>
                                            </select>
                                            @if ($errors->has('file_status'))
                                                <span class="err">
                                                    <strong>{{ $errors->first('file_status') }}.</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row mt-3">
                                        <label class="col-sm-2 pt-2"><strong>Method&nbsp;&nbsp; : <span class="text-danger">*</span>&nbsp;&nbsp;</strong></label>
                                        <div class="col-sm-4 col-md-4">
                                            <select class="custom-select2 form-control @error('method') is-invalid @enderror"
                                                name="method" id="method" >
                                                <option value=" ">&nbsp;&nbsp;Please Select Method</option>
                                                <optgroup label="">
                                                    <option value="By Hand">By Hand</option>
                                                    <option value="Peon">Peon</option>
                                                </optgroup>
                                            </select>
                                            @if ($errors->has('method'))
                                                <span class="err">
                                                    <strong>{{ $errors->first('method') }}.</strong>
                                                </span>
                                            @endif
                                        </div>
                                        
                                        <?php
                                            $data = DB::select('SELECT
                                                                    users.id,
                                                                    users.user_type,
                                                                    users.name
                                                                FROM
                                                                    `users`
                                                                WHERE
                                                                    users.user_type = "Peon"
                                                                ORDER BY
                                                                    `id` ASC
                                                               ');
                                        ?>
                                        <div class="col-sm-6 col-md-6 Peon box" style="display: none;">
                                            <input type="text" name="Peon" id="Peon" class="form-control  @error('Peon') is-invalid @enderror" value="" placeholder="Enter Peone Name" >
                                            @if ($errors->has('Peon'))
                                                <span class="err">
                                                    <strong>{{ $errors->first('Peon') }}.</strong>
                                                </span>
                                            @endif
                                            <!--<select class="custom-select2 form-control" name="Peon" id="Peon">-->
                                            <!--    <option value=" ">&nbsp;&nbsp;Please Select Peon</option>-->
                                            <!--    <optgroup label="">-->
                                            <!--        @foreach($data as $key=> $comps)-->
                                            <!--            <option value="{{ $comps->id }}">{{$comps->name}}</option>-->
                                            <!--        @endforeach-->
                                            <!--    </optgroup>-->
                                            <!--</select>-->
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row mt-3">
                                        
                                        <label class="col-sm-2"><strong>Remark / Tipani&nbsp;&nbsp; : <span class="text-danger">*</span>&nbsp;</strong></label>
                                        <div class="col-sm-12 col-md-12">
                                            <textarea type="text" name="remark" class="form-control @error('remark') is-invalid @enderror" placeholder="Enter Remark / Tipani here" id="remark" cols="20" rows="10" ></textarea>
                                            @if ($errors->has('remark'))
                                                <span class="err">
                                                    <strong>{{ $errors->first('remark') }}.</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row mt-4">
                                        <label class="col-md-3"></label>
                                        <div class="col-md-9" style="display: flex; justify-content: flex-end;">
                                            <a href="{{ url('in_transit') }}" class="btn btn-danger">Cancel</a>&nbsp;&nbsp;
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
            </div>
            
        </div>
        <div class="footer-wrap pd-20 mb-20 card-box">
            Copyright ©<?php echo date('Y'); ?>. Designed And Developed By Core Ocean Solutions LLP. All rights reserved.
        </div>
    </div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        
        $('#department_name').on('change', function () {
            var idCountry = this.value;
            $("#forward_to").html('');
            $.ajax({
                url: "{{url('api/department-user')}}",
                type: "POST",
                data: {
                    "department_name": idCountry,
                    "_token": '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#forward_to').html('<option value="">Please Select User</option>');
                    $.each(result.user_department, function (key, value) {
                        $("#forward_to").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                    // $('#city-dd').html('<option value="">Select City</option>');
                }
            });
        });
        
        $('#forward_to').on('change', function () {
            var idState = this.value;
            $("#fowto_table_no").html('');
            $.ajax({
                url: "{{url('department-table-no')}}",
                type: "POST",
                data: {
                    "forward_to": idState,
                    "_token": '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (res) {
                    $('#fowto_table_no').html('<option value="">Select Table Number</option>');
                    $.each(res.department_table_no, function (key, value) {
                        $("#fowto_table_no").append('<option value="' + value
                            .table_no + '">' + value.table_no + '</option>');
                    });
                }
            });
        });
    });
</script>
<script>
$(document).ready(function(){
    $("select").change(function(){
        $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("value");
            if(optionValue){
                $(".box").not("." + optionValue).hide();
                $("." + optionValue).show();
            } else{
                $(".box").hide();
            }
        });
    }).change();
});
</script>