<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="content">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title Start -->
    <title>पनवेल महानगरपालिका || FTS-Home</title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ url('/') }}/assets/vendors/images/pmc_favico.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ url('/') }}/assets/vendors/images/pmc_favico.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('/') }}/assets/vendors/images/pmc_favico.png">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/vendors/styles/core.css">
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/vendors/styles/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/src/plugins/datatables/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/src/plugins/datatables/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/vendors/styles/style.css">
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/src/plugins/sweetalert2/sweetalert2.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"/>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-119386393-1');

    </script>

    <style>
        .user-notification .dropdown-menu {
            width: 320px;
            padding: 11px 10px;
        }
    </style>
</head>

<body>

    <div class="header">
        <div class="header-left">
            <div class="menu-icon dw dw-menu"></div>
        </div>
        <div class="header-right">
            <div class="dashboard-setting user-notification">
                <div class="dropdown">
                    <a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
                        <i class="dw dw-settings2"></i>
                    </a>
                </div>
            </div>
            <div class="user-notification">
                <div class="dropdown">
                    <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
                        <i class="icon-copy dw dw-notification"></i>
                        <span class="badge notification-active p-1"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" style="background:#F1F3F4 ;">
                        <div class="notification-list mx-h-350 customscroll">
                            <ul>
                                @php
                                    $users_logs = DB::table('users')
                                                    ->select(
                                                        'users.id AS user_id',
                                                        'users.name AS user_name',
                                                        'users.user_type AS user_role',
                                                        'users.created_at AS user_joining_date',
                                                        'logs.log_date AS user_login_time',
                                                        'logs.log_type AS user_type'
                                                    )
                                                    ->join('logs', 'users.id', '=', 'logs.user_id')
                                                    ->where('logs.user_id', Auth::user()->id)
                                                    ->orderBy('logs.log_date', 'desc')
                                                    ->get();
                                    // return $users_logs;
                                @endphp
                                @foreach($users_logs as $value)
                                <li>
                                    <a href="#">
                                        <img src="{{ url('/') }}/assets/vendors/images/pmc_favico.png" alt="">
                                        <p><strong>User Name : </strong> {{ $value->user_name }}</p>
                                        <p><strong>User Role : </strong>{{ $value->user_role }}</p>
                                        <p><strong>Join Date : </strong><small>{{date('d F, Y',strtotime($value->user_joining_date)) }}</small></p>
                                        @if ($value->user_type == 'login')
                                        <p><strong>Login Time : </strong><small class="badge bg-success text-light ">{{ \Carbon\Carbon::parse($value->user_login_time)->diffForHumans() }}</small></p>
                                        @elseif ($value->user_type == 'logout')
                                        <p><strong>Logout Time : </strong><small class="badge bg-danger text-light ">{{ \Carbon\Carbon::parse($value->user_login_time)->diffForHumans() }}</small></p>
                                        @endif
                                    </a>
                                </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @php
            $usertype = Auth::user()->user_type;
            @endphp
            <div class="user-info-dropdown">
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        <span class="user-icon">
                            <img src="{{ url('/') }}/assets/vendors/images/pmc_favico.png" alt="">
                        </span>
                        <span class="user-name"><strong class="text-info">Welcome , {{ Auth::user()->name }}</strong></span>
                    </a>

                    <div class="dropdown dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                        <a class="dropdown-item no-arrow" href="javascript:;" data-toggle="right-sidebar"><i class="micon dw dw-settings2"></i>{{ __('Setting') }}</a>
                        <!--<a class="dropdown-item" href="{{ route('logout') }}"><i class="micon dw dw-padlock1"></i>{{ __('Lock Screen') }}</a>-->
                        <a class="dropdown-item" href="{{ route('dept_logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><i class="micon dw dw-logout"></i>
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('dept_logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="right-sidebar">
        <div class="sidebar-title">
            <h3 class="weight-600 font-16 text-blue">
                Layout Settings
                <span class="btn-block font-weight-400 font-12">User Interface Settings</span>
            </h3>
            <div class="close-sidebar" data-toggle="right-sidebar-close">
                <i class="icon-copy ion-close-round"></i>
            </div>
        </div>
        <div class="right-sidebar-body customscroll">
            <div class="right-sidebar-body-content">
                <h4 class="weight-600 font-18 pb-10">Header Background</h4>
                <div class="sidebar-btn-group pb-30 mb-10">
                    <a href="javascript:void(0);" class="btn btn-outline-primary header-white active">White</a>
                    <a href="javascript:void(0);" class="btn btn-outline-primary header-dark">Dark</a>
                </div>

                <h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
                <div class="sidebar-btn-group pb-30 mb-10">
                    <a href="javascript:void(0);" class="btn btn-outline-primary sidebar-light ">White</a>
                    <a href="javascript:void(0);" class="btn btn-outline-primary sidebar-dark active">Dark</a>
                </div>

                <div class="reset-options pt-30 text-center">
                    <button class="btn btn-danger" id="reset-settings">Reset Settings</button>
                </div>
            </div>
        </div>
    </div>

    <div class="left-side-bar">
        <div class="brand-logo">
            <a href="{{ url('index') }}">
                <img src="{{ url('/') }}/assets/vendors/images/pmc-logo-white.png" alt="" class="dark-logo">
                <img src="{{ url('/') }}/assets/vendors/images/pmc_logo.png" alt="" class="light-logo">
            </a>
            <div class="close-sidebar" data-toggle="left-sidebar-close">
                <i class="ion-close-round"></i>
            </div>
        </div>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
        <div class="menu-block customscroll">
            <div class="sidebar-menu">

                <ul id="accordion-menu">
                    <?php

                       $user_type =  Auth::user()->user_type ;

                       if($user_type == 'Admin'){

                       ?>
                    <li class="dropdown">
                    <li>
                        <a href="{{ url('index') }}" class="dropdown-toggle no-arrow">
                            <span class="micon dw dw-house"></span><span class="mtext">Dashboard </span>
                        </a>
                    </li>

                    </li>

                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon dw dw-settings"></span><span class="mtext">Setup</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="{{ route('users.index') }}">User</a></li>
                            <!--<li><a href="{{ url('Authentication') }}">Authorization</a></li>-->
                            <li><a href="{{ url('financial_year') }}">Financial Year</a></li>
                            <li><a href="{{ url('department') }}">Department</a></li>
                            <li><a href="{{ url('status') }}">Status</a></li>
                            <!--<li><a href="{{ url('organization') }}">Organization</a></li>-->
                            <!--<li><a href="{{ url('document_numbering') }}">Document Numbering</a></li>-->
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon dw dw-padlock"></span><span class="mtext">Master</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="{{ url('file_type') }}">File Type</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon dw dw-file"></span><span class="mtext">File Management</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="{{ url('file_master') }}">File Master</a></li>
                            <li><a href="{{ url('Forward')}}">Forward</a></li>
                            <li><a href="{{ url('Inward') }}">Inward</a></li>
                            <li><a href="{{ url('in_transit') }}">In Transit</a></li>
                            <li><a href="{{ url('Close') }}">Close</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon dw dw-share"></span><span class="mtext">Report</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="{{ url('MIS') }}">MIS</a></li>
                            <li><a href="{{ url('mis_user_wise') }}">MIS-Employee Wise</a></li>
                            <li><a href="{{ url('file_status') }}">File Status</a></li>
                            <li><a href="{{ url('check_file_history') }}">Check File History</a></li>
                        </ul>
                    </li>
                    <?php } ?>

                    <?php



                       if($user_type == 'User'){

                       ?>
                    <li class="dropdown">
                    <li>
                        <a href="{{ url('index') }}" class="dropdown-toggle no-arrow">
                            <span class="micon dw dw-house"></span><span class="mtext">Dashboard </span>
                        </a>
                    </li>

                    </li>

                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon dw dw-padlock"></span><span class="mtext">Master</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="{{ url('file_type') }}">File Type</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon dw dw-file"></span><span class="mtext">File Management</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="{{ url('file_master') }}">File Master</a></li>
                            <li><a href="{{ url('Forward')}}">Forward</a></li>
                            <li><a href="{{ url('Inward') }}">Inward</a></li>
                            <li><a href="{{ url('in_transit') }}">In Transit</a></li>
                            <li><a href="{{ url('Close') }}">Close</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon dw dw-share"></span><span class="mtext">Report</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="{{ url('MIS') }}">MIS</a></li>
                            <li><a href="{{ url('mis_user_wise') }}">MIS-Employee Wise</a></li>
                            <li><a href="{{ url('file_status') }}">File Status</a></li>
                            <li><a href="{{ url('check_file_history') }}">Check File History</a></li>
                        </ul>
                    </li>



                    <?php } ?>

                    <?php
                       if($user_type == 'Department Head'){

                       ?>
                    <li class="dropdown">
                    <li>
                        <a href="{{ url('index') }}" class="dropdown-toggle no-arrow">
                            <span class="micon dw dw-house"></span><span class="mtext">Dashboard </span>
                        </a>
                    </li>

                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon dw dw-settings"></span><span class="mtext">Setup</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="{{ url('user') }}">User</a></li>
                            <!--<li><a href="{{ url('Authentication') }}">Authorization</a></li>-->
                            <li><a href="{{ url('financial_year') }}">Financial Year</a></li>
                            <li><a href="{{ url('department') }}">Department</a></li>
                            <li><a href="{{ url('status') }}">Status</a></li>
                            <!--<li><a href="{{ url('organization') }}">Organization</a></li>-->
                            <!--<li><a href="{{ url('document_numbering') }}">Document Numbering</a></li>-->
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon dw dw-padlock"></span><span class="mtext">Master</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="{{ url('file_type') }}">File Type</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon dw dw-file"></span><span class="mtext">File Management</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="{{ url('file_master') }}">File Master</a></li>
                            <li><a href="{{ url('Forward')}}">Forward</a></li>
                            <li><a href="{{ url('Inward') }}">Inward</a></li>
                            <li><a href="{{ url('in_transit') }}">In Transit</a></li>
                            <li><a href="{{ url('Close') }}">Close</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon dw dw-share"></span><span class="mtext">Report</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="{{ url('MIS') }}">MIS</a></li>
                            <li><a href="{{ url('mis_user_wise') }}">MIS-Employee Wise</a></li>
                            <li><a href="{{ url('file_status') }}">File Status</a></li>
                            <li><a href="{{ url('check_file_history') }}">Check File History</a></li>
                        </ul>
                    </li>



                    <?php } ?>


                    <?php
                       if($user_type == 'Peon'){

                       ?>
                    <li class="dropdown">
                    <li>
                        <a href="{{ url('index') }}" class="dropdown-toggle no-arrow">
                            <span class="micon dw dw-house"></span><span class="mtext">Dashboard </span>
                        </a>
                    </li>

                    </li>

                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon dw dw-padlock"></span><span class="mtext">Master</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="{{ url('file_type') }}">File Type</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon dw dw-file"></span><span class="mtext">File Management</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="{{ url('file_master') }}">File Master</a></li>
                            <li><a href="{{ url('Forward')}}">Forward</a></li>
                            <li><a href="{{ url('Inward') }}">Inward</a></li>
                            <li><a href="{{ url('in_transit') }}">In Transit</a></li>
                            <li><a href="{{ url('Close') }}">Close</a></li>

                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon dw dw-share"></span><span class="mtext">Report</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="{{ url('MIS') }}">MIS</a></li>
                            <li><a href="{{ url('mis_user_wise') }}">MIS-Employee Wise</a></li>
                            <li><a href="{{ url('file_status') }}">File Status</a></li>
                        </ul>
                    </li>



                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>

    <div class="mobile-menu-overlay"> Welcome </div>

    <div class="main-container">
        @yield('content')
    </div>

    <!-- js -->
    <script src="{{ url('/') }}/assets/vendors/scripts/core.js"></script>
    <script src="{{ url('/') }}/assets/vendors/scripts/script.min.js"></script>
    <script src="{{ url('/') }}/assets/vendors/scripts/process.js"></script>
    <script src="{{ url('/') }}/assets/vendors/scripts/layout-settings.js"></script>

    <script src="{{ url('/') }}/assets/src/plugins/datatables/js/jquery.dataTables.min.js"></script>
    <script src="{{ url('/') }}/assets/src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ url('/') }}/assets/src/plugins/datatables/js/dataTables.responsive.min.js"></script>
    <script src="{{ url('/') }}/assets/src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>

    <!-- buttons for Export datatable -->
    <script src="{{ url('/') }}/assets/src/plugins/datatables/js/dataTables.buttons.min.js"></script>
    <script src="{{ url('/') }}/assets/src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ url('/') }}/assets/src/plugins/datatables/js/buttons.print.min.js"></script>
    <script src="{{ url('/') }}/assets/src/plugins/datatables/js/buttons.html5.min.js"></script>
    <script src="{{ url('/') }}/assets/src/plugins/datatables/js/buttons.flash.min.js"></script>
    <script src="{{ url('/') }}/assets/src/plugins/datatables/js/pdfmake.min.js"></script>
    <script src="{{ url('/') }}/assets/src/plugins/datatables/js/vfs_fonts.js"></script>


    <!-- Datatable Setting js -->
    <script src="{{ url('/') }}/assets/vendors/scripts/datatable-setting.js"></script>

    <!-- add sweet alert js & css in footer -->
    <script src="{{ url('/') }}/assets/src/plugins/sweetalert2/sweetalert2.all.js"></script>
    <script src="{{ url('/') }}/assets/src/plugins/sweetalert2/sweet-alert.init.js"></script>

    <script>
        @if(Session::has('message'))
        toastr.options = {
            "closeButton": true
            , "progressBar": true
            ,   "allowHtml" : true
            ,  "timeOut": 25000, "enableHtml": true
        }
        toastr.success("{{ session('message') }}");
        @endif

        @if(Session::has('error'))
        toastr.options = {
            "closeButton": true
            , "progressBar": true
            ,   "allowHtml" : true
            ,  "timeOut": 4000, "enableHtml": true
        }
        toastr.error("{{ session('error') }}");
        @endif

        @if(Session::has('info'))
        toastr.options = {
            "closeButton": true
            , "progressBar": true
            ,   "allowHtml" : true, "enableHtml": true
        }
        toastr.info("{{ session('info') }}");
        @endif

        @if(Session::has('warning'))
        toastr.options = {
            "closeButton": true
            , "progressBar": true
            ,   "allowHtml" : true, "enableHtml": true
        }
        toastr.warning("{{ session('warning') }}");
        @endif

    </script>

    @yield('scripts')


</body>

</html>
