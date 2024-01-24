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
                            <h4>File History</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-primary" href="{{ url('index') }}">Home</a>
                                </li>
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

            @if ($posts->isNotEmpty())
                @foreach ($posts_files as $key => $file_type)
                    <!-- Export Datatable start -->
                    <div class="pd-20 card-box mb-30">
                        <h4 class="text-blue h4">File Details</h4>
                        <hr>
                        <div class="card-body file-detail">
                            <div class="row">
                                <div class="col-lg-3 p-2">
                                    <strong>File Number : &nbsp;&nbsp;</strong><span>{{ $file_type->file_master_no }}</span>
                                </div>

                                <div class="col-lg-3 p-2">
                                    <strong>File Type : &nbsp;&nbsp;</strong><span>{{ $file_type->type }}</span>
                                </div>
                                <div class="col-lg-3 p-2">
                                    <strong>Total pages of <br>Tipani/Files :
                                        &nbsp;&nbsp;</strong><span>{{ $file_type->total_pages_of_tipani }}</span>
                                </div>
                                <div class="col-lg-3 p-2">
                                    <strong>Total pages of Docs/Letters :
                                        &nbsp;&nbsp;</strong><span>{{ $file_type->total_pages_of_docs }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 p-2">
                                    <strong>Created by : &nbsp;&nbsp;</strong><span>{{ $file_type->created_by }}</span>
                                </div>

                                <div class="col-lg-3 p-2">
                                    <strong>Department : &nbsp;&nbsp;</strong><span>{{ $file_type->department_name }}</span>
                                </div>
                                <div class="col-lg-3 p-2">
                                    <strong>Table : &nbsp;&nbsp;</strong><span>{{ $file_type->table_no }}</span>
                                </div>
                                <div class="col-lg-3 p-2">
                                    <strong>Status : &nbsp;&nbsp;</strong>
                                    <span>
                                    @if ($file_type->status == '14')
                                        Closed / निकाली
                                    @elseif($file_type->status == '13')
                                        Accepted
                                    @elseif($file_type->status == '12')
                                        <span class="badge bg-dark tips text-light" data-bs-toggle="popover" title="Active">
                                            In Transit
                                        </span>
                                    @elseif($file_type->status == '10')
                                        Created
                                    @else()
                                        Partially Completed
                                    @endif
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 p-2">
                                    <strong>Subject : &nbsp;&nbsp;</strong><br><span
                                        class="text-justify">{{ $file_type->subject }}</span>
                                </div>
                                <div class="col-lg-4 p-2">
                                    <strong>File Detail / Tipani : </strong><br><span
                                        class="text-justify">{{ $file_type->file_detail }}</span>
                                </div>

                                <div class="col-lg-4 p-2">
                                    <strong>View File History : </strong>
                                    <a href="{{ url('file_master_log_history') }}/{{ $file_type->id }}" class="btn btn-info btn-lg">
                                        <i class="micon dw dw-file"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        @include('adminlayouts.footer')
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
