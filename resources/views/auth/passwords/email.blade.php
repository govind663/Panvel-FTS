<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>पनवेल महानगरपालिका || FTS-Reset Password Link </title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ url('/') }}/assets/vendors/images/pmc_favico.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ url('/') }}/assets/vendors/images/pmc_favico.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('/') }}/assets/vendors/images/pmc_favico.png">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/vendors/styles/core.css">
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/vendors/styles/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/vendors/styles/style.css">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

<body>
    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo">
                <a href="{{ route('login') }}">
                    <img src="{{ url('/') }}/assets/vendors/images/pmc-logo-with-name.png" alt="">
                </a>
            </div>
            <div class="login-menu">
              <ul>
                <li><a href="{{ route('login') }}">Login</a></li>
              </ul>
            </div>
        </div>
    </div>
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="{{ url('/') }}/assets/vendors/images/forgot-password.png" alt="">
                </div>
                <div class="col-md-6">
                    <div class="login-box bg-white box-shadow border-radius-10">

                        <div class="login-title">
                            <div class="login-menu col-md-12 pb-2" style="text-align:center;">
                                <a class="pmc-logo-with-name">
                                    <img src="{{ url('/') }}/assets/vendors/images/pmc-logo-with-name.png" alt="" >
                                </a>
                            </div>
                            <h4 class="text-center text-primary">Reset Password Link</h4>
                        </div>
                        <h6 class="mb-20 text-justify">Enter your email address to reset your password</h6>


                        <form method="POST" action="{{ url('forget-password') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label"><i class="dw dw-email-2"></i> &nbsp;{{ __('E-Mail id') }} <span class="text-danger">*</span></label>

                                <div class="col-sm-8">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <!--<div class="form-group row">-->
                            <!--    <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>-->
                            <!--    <div class="col-md-6">-->
                            <!--        <input id="email" type="email"-->
                            <!--            class="form-control @error('email') is-invalid @enderror" name="email"-->
                            <!--            value="{{ old('email') }}" autocomplete="email" autofocus>-->

                            <!--        @error('email')-->
                            <!--            <span class="invalid-feedback" role="alert">-->
                            <!--                <strong>{{ $message }}</strong>-->
                            <!--            </span>-->
                            <!--        @enderror-->
                            <!--    </div>-->
                            <!--</div>-->

                            <div class="row">
								<div class="col-sm-12">
									<div class="input-group mb-0">
										<!--
											use code for form submit
											<input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
										-->
										<button type="submit" class="btn btn-primary  btn-lg btn-block">
                                            <i class="dw dw-share"></i>&nbsp;{{ __('Send Password Reset Link') }}
                                        </button>
									</div>
									<!--<div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373">OR</div>-->
									<!--<div class="input-group mb-0">-->
									<!--	<a class="btn btn-outline-primary btn-lg btn-block" href="{{ route('register') }}">Register To Create Account</a>-->
									<!--</div>-->
								</div>
							</div>

                            <!--<div class="form-group row mb-0">-->
                            <!--    <div class="col-md-6 offset-md-4">-->
                            <!--        <button type="submit" class="btn btn-primary">-->
                            <!--            Send Password Reset Link-->
                            <!--        </button>-->
                            <!--    </div>-->
                            <!--</div>-->
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
