<!doctype html>
<html lang="en" class="h-100">


<!-- Mirrored from maxartkiller.com/website/finwallapp2/HTML/splash.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 25 Sep 2022 09:02:18 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title>E-Modul</title>

    <!-- manifest meta -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="manifest" href="manifest.json" />

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="{{asset('asset/img/favicon180.png')}}" sizes="180x180">
    <link rel="icon" href="{{asset('asset/img/favicon32.png')}}" sizes="32x32" type="image/png">
    <link rel="icon" href="{{asset('asset/img/favicon16.png')}}" sizes="16x16" type="image/png">

    <!-- Google fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&amp;display=swap" rel="stylesheet">

    <!-- style css for this template -->
    <link href="{{asset('asset/css/style.css')}}" rel="stylesheet" id="style">
</head>

<body class="body-scroll d-flex flex-column h-100 " data-page="splash">

    <!-- loader section -->
    <div class="container-fluid loader-wrap">
        <div class="row h-100">
            <div class="col-10 col-md-6 col-lg-5 col-xl-3 mx-auto text-center align-self-center">
                <img width="30%" src="{{ asset('file/logo/') .'/' . $set->logo }}" alt="">

                <p class="mt-4"><span class="text-secondary">{{$set->nama}}</span><br><strong>Please
                        wait...</strong></p>
            </div>
        </div>
    </div>
    <!-- loader section ends -->

    <!-- Begin page content -->
    <main class="container-fluid h-100 bg-1">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  class="bg-1-splash" viewBox="0 0 160.46 151.813">
            <defs>
                <radialGradient id="radial-gradient" cx="0.668" cy="0.733" r="1.157"
                    gradientTransform="matrix(-0.118, -0.993, 0.597, -0.071, 0.31, 1.448)"
                    gradientUnits="objectBoundingBox">
                    <stop offset="0" stop-color="#09b2fd" />
                    <stop offset="1" stop-color="#6b00e5" />
                </radialGradient>
            </defs>
            <path id="splash1"
                d="M18.256,0h91.058a18.256,18.256,0,0,1,18.256,18.256l.006,25.107L92,98.166.021,38.43,0,18.256A18.256,18.256,0,0,1,18.256,0Z"
                transform="matrix(-0.839, 0.545, -0.545, -0.839, 160.46, 82.329)" fill="url(#radial-gradient)" />
        </svg>
        <img src="{{asset('asset/img/splash2.png')}}" alt="" class="bg-2-splash">

        <div class="row h-100">
            <div class="col-10 col-md-6 col-lg-4 text-left align-self-center mx-auto">
                <a href="landing.html" class="logo-splash">
                    <img width="30%" src="{{ asset('file/logo/') .'/' . $set->logo }}" alt="">
                   
                    <h1 class="mt-4 mb-2">
                        <span class="text-secondary fw-light">{{$set->nama}}</span><br>
                    </h1>
                    <p class="text-secondary">E Modul App</p>
                </a>
            </div>
        </div>
    </main>




    <!-- Required jquery and libraries -->
    <script src="{{asset('asset/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('asset/js/popper.min.js')}}"></script>
    <script src="{{asset('asset/vendor/bootstrap-5/js/bootstrap.bundle.min.js')}}"></script>

    <!-- page level custom script -->
    <script src="{{asset('asset/js/app.js')}}"></script>

    <!-- Customized jquery file  -->
    <script src="{{asset('asset/js/main.js')}}"></script>
    <script src="{{asset('asset/js/color-scheme.js')}}"></script>

    <!-- PWA app service registration and works -->
    <script src="{{asset('asset/js/pwa-services.js')}}"></script>

</body>


<!-- Mirrored from maxartkiller.com/website/finwallapp2/HTML/splash.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 25 Sep 2022 09:02:25 GMT -->
</html>