<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>पनवेल महानगरपालिका || FTS-Login </title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ url('/') }}/assets/vendors/images/pmc_favico.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ url('/') }}/assets/vendors/images/pmc_favico.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('/') }}/assets/vendors/images/pmc_favico.png">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/vendors/styles/core.css">
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/vendors/styles/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/vendors/styles/style.css">
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
</head>

<body class="login-page">
    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo">
                <a href="{{ route('login') }}">
                    <img src="{{ url('/') }}/assets/vendors/images/pmc-logo-with-name.png" alt="">
                </a>
            </div>
            <!--<div class="login-menu">-->
            <!--    <ul>-->
            <!--        <li><a href="{{ route('register') }}">Register</a></li>-->
            <!--    </ul>-->
            <!--</div>-->
        </div>
    </div>
    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">

            <div class="login-menu">

            </div>
        </div>
    </div>
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    <img src="{{ url('/') }}/assets/vendors/images/login-page-img.png" alt="">
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="login-title">
                            <div class="login-menu col-md-12 pb-2" style="text-align:center;">
                                <a class="pmc-logo-with-name">
                                    <img src="{{ url('/') }}/assets/vendors/images/pmc-logo-with-name.png" alt="" >
                                </a>
                            </div>
                            <h4 class="text-center text-primary">Login </h4>
                        </div>

                        <form method="POST" action="{{ route('login.store') }}" content="{{ csrf_token() }}"  enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label"><i class="dw dw-email-2"></i>
                                    &nbsp;{{ __('E-Mail id') }} <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-sm-4 col-form-label"><i class="dw dw-padlock1"></i>
                                    &nbsp;{{ __('Password') }} <span class="text-danger">*</span></label>
                                <div class="col-sm-8">

                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="password" autofocus>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row pb-30">
								<div class="col-6">
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" name="remember_token" id="customCheck1" {{ old('remember_token') ? 'checked' : '' }}>
										<label class="custom-control-label" for="customCheck1">{{ __('Remember Me') }}</label>
									</div>
								</div>
								<div class="col-6">
									<div class="forgot-password"><a href="{{ url('forget-password') }}">{{ __('Forgot Password?') }}</a></div>
								</div>

							</div>


                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group mb-0">
                                        <!--
                                           use code for form submit
                                           <input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
                                          -->
                                        <button type="submit" class="btn btn-primary  btn-lg btn-block">
                                            <i class="dw dw-share"></i>&nbsp;{{ __('Login') }}
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- js -->
    <script src="{{ url('/') }}/assets/vendors/scripts/core.js"></script>
    <script src="{{ url('/') }}/assets/vendors/scripts/script.min.js"></script>
    <script src="{{ url('/') }}/assets/vendors/scripts/process.js"></script>
    <script src="{{ url('/') }}/assets/vendors/scripts/layout-settings.js"></script>

    <script>
        @if(Session::has('message'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.success("{{ session('message') }}");
        @endif

        @if(Session::has('error'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.error("{{ session('error') }}");
        @endif

        @if(Session::has('info'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.info("{{ session('info') }}");
        @endif

        @if(Session::has('warning'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.warning("{{ session('warning') }}");
        @endif
    </script>
</body>

</html>
