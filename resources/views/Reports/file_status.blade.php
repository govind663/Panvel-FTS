@extends('adminlayouts.master')
@section('content')
<style>
    td{
        text-align:center;
    }
</style>
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>File Status</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('index') }}">Home</a></li>
                                <li class="breadcrumb-item active">File Status</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Export Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4"> File Status List</h4>
                </div>
                <div class="pb-20">
                    <table class="table table-bordered table-hover table-striped table-sm table-responsive p-3">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th class="align-top">Department</th>
                                <th class="align-top">Created</th>
                                <th class="align-top">Closed</th>
                                @foreach ($department as $key => $file_type1)
                                    <th class="align-top">{{ $file_type1->name }}</th>
                                @endforeach

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($department as $key => $file_type)
                                <tr>
                                    <th class="text-center">{{ $key + 1 }}</th>
                                    <th>{{ $file_type->name }}</a></th>
                                    <td class="text-center align-middle">{{ $file_type->totalfiles }}</td>
                                    <td class="text-center align-middle">{{ $file_type->closed }}</td>

                                    @foreach ($department as $key => $file_type1)

                                        <?php
                                            $data_child1 = DB::select("SELECT fmt.id as currfiles
                                                                        FROM file_master_tbl as fmt
                                                                        Left JOIN users as ust on ust.id = fmt.current_user_id
                                                                        where fmt.department = $file_type->id
                                                                        AND ust.department = $file_type1->id
                                                                        ");

                                        ?>
                                        <td class="js-btn-tooltip" data-toggle="tooltip tooltip-light" data-placement="right" data-custom-class="" data-html="true"
                                        title="<b>Total File: {{ count($data_child1) }}</b> <p><b>Created : </b>{{ $file_type->name }}</p> <p><b>Current : </b>{{ $file_type1->name }}</p>"
                                        >
                                        {{ count($data_child1) }}
                                    </td>
                                    @endforeach

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Export Datatable End -->
        </div>
        @include('adminlayouts.footer')
    </div>

<script>
    $(document).ready(function(){

  $('.js-btn-tooltip').tooltip();
  $('.js-btn-tooltip--custom').tooltip({
    customClass: 'tooltip-custom'
  });
  $('.js-btn-tooltip--custom-alt').tooltip({
    customClass: 'tooltip-custom-alt'
  });

  $('.js-btn-popover').popover();
  $('.js-btn-popover--custom').popover({
    customClass: 'popover-custom'
  });
  $('.js-btn-popover--custom-alt').popover({
    customClass: 'popover-custom-alt'
  });

});
</script>

@endsection
