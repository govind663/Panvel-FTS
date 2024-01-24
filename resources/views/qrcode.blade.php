<!doctype html>
<html lang="en">

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>UMC-File Tracking System</title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ url('/') }}/assets/vendors/images/png 20 x 20-01-01 (1).png">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ url('/') }}/assets/vendors/images/png 20 x 20-01-01 (1).png">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ url('/') }}/assets/vendors/images/png 20 x 20-01-01 (1).png">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/vendors/styles/core.css">
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/vendors/styles/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/vendors/styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://fonts.googleapis.com/css2?family=Muli:wght@200;300;400;500;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Barcode+39+Text&display=swap" rel="stylesheet">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>

</head>

<script type="text/javascript">
    $('.printMe').click(function() {
        window.print();
    });
</script>

<body>
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <a href="{{ route('login') }}">
                                <img src="{{ url('/') }}/assets/vendors/images/UMC-Logo.png" alt="" height="150px" width="200px">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        <button class="btn btn-primary" onclick="window.print()" role="button">
                            <span class="micon fa fa-print" aria-hidden="true"></span> Print 
                        </button>
                    </div>
                </div>
            </div>

            <div class="pd-20 card-box mb-30">
                @foreach ($data as $key => $file_type)
                    <div class="row justify-content-between">
                        <div class="col-sm-8  ">
                            <h2 class="p-3 text-justify"> उल्हासनगर महानगरपालिका  </h2>
                            <h3 class="p-3 text-justify">{{ $file_type->name }}</h3>
                            <h4 class="p-3 text-justify">
                                {{ $file_type->subject }}<br>
                                <br>
                                <span style="font-size:18px;" class="text-justify">By
                                    {{ $file_type->created_by }}, On
                                    {{ $file_type->date }}
                                </span>
                            </h4>
                            <p style="font-size:13px; font-weight:bold;" class="text-justify">
                                {{ $file_type->subject }}
                            </p>
                            <p style="font-size:13px; font-weight:bold;" class="text-justify">
                                Total pages of Tipani/Files ( एकूण पेजेस ) :
                                {{ $file_type->total_pages_of_tipani }}
                            </p>

                            <p style="font-size:13px; font-weight:bold;" class="text-justify">
                                Total pages of Docs/Letters ( डॉक्स / लेटर्स एकूण पेजेस ) :
                                {{ $file_type->total_pages_of_docs }}
                            </p>
                            <p style="font-size:18px; font-weight:bold;" class="text-justify">File No.:
                                <b>00{{ $file_type->file_master_no }}</b>
                            </p>
                        </div>
                        <div class="p-3 text-justify">
                            {!! QrCode::size(200)->generate(url('generate-qrcode/' . $file_type->id)) !!}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- js -->
    <script src="{{ url('/') }}/assets/vendors/scripts/core.js"></script>
    <script src="{{ url('/') }}/assets/vendors/scripts/script.min.js"></script>
    <script src="{{ url('/') }}/assets/vendors/scripts/process.js"></script>
    <script src="{{ url('/') }}/assets/vendors/scripts/layout-settings.js"></script>
    <script type="text/javascript" src="js/jquery.printPage.js"></script>
</body>

</html>
