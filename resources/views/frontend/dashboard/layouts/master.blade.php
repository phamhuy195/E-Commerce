<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <title>One Shop || e-Commerce HTML Template</title>
    <link rel="icon" type="image/png" href="{{ asset('theme/frontend-template/images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('theme/frontend-template/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/frontend-template/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/frontend-template/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/frontend-template/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/frontend-template/css/jquery.nice-number.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/frontend-template/css/jquery.calendar.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/frontend-template/css/add_row_custon.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/frontend-template/css/mobile_menu.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/frontend-template/css/jquery.exzoom.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/frontend-template/css/multiple-image-video.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/frontend-template/css/ranger_style.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/frontend-template/css/jquery.classycountdown.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/frontend-template/css/venobox.min.css') }}">

    <link rel="stylesheet" href="{{ asset('theme/frontend-template/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/frontend-template/css/responsive.css') }}">
    <!-- <link rel="stylesheet" href="css/rtl.css"> -->
</head>

<body>


    <!--=============================
    DASHBOARD MENU START
  ==============================-->
    <div class="wsus__dashboard_menu">
        <div class="wsusd__dashboard_user">
            <img src="{{ Auth::user()->image ?? asset('theme/frontend-template/images/ts-2.jpg') }}" style="object-fit: cover" alt="img"
                class="img-fluid">
            <p>{{ Auth::user()->name }}</p>
        </div>
    </div>
    <!--=============================
    DASHBOARD MENU END
  ==============================-->


    <!--=============================
    DASHBOARD START
  ==============================-->
    @yield('content')
    <!--=============================
    DASHBOARD START
  ==============================-->


    <!--============================
      SCROLL BUTTON START
    ==============================-->
    <div class="wsus__scroll_btn">
        <i class="fas fa-chevron-up"></i>
    </div>
    <!--============================
    SCROLL BUTTON  END
  ==============================-->


    <!--jquery library js-->
    <script src="{{ asset('theme/frontend-template/js/jquery-3.6.0.min.js') }}"></script>
    <!--bootstrap js-->
    <script src="{{ asset('theme/frontend-template/js/bootstrap.bundle.min.js') }}"></script>
    <!--font-awesome js-->
    <script src="{{ asset('theme/frontend-template/js/Font-Awesome.js') }}"></script>
    <!--select2 js-->
    <script src="{{ asset('theme/frontend-template/js/select2.min.js') }}"></script>
    <!--slick slider js-->
    <script src="{{ asset('theme/frontend-template/js/slick.min.js') }}"></script>
    <!--simplyCountdown js-->
    <script src="{{ asset('theme/frontend-template/js/simplyCountdown.js') }}"></script>
    <!--product zoomer js-->
    <script src="{{ asset('theme/frontend-template/js/jquery.exzoom.js') }}"></script>
    <!--nice-number js-->
    <script src="{{ asset('theme/frontend-template/js/jquery.nice-number.min.js') }}"></script>
    <!--counter js-->
    <script src="{{ asset('theme/frontend-template/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('theme/frontend-template/js/jquery.countup.min.js') }}"></script>
    <!--add row js-->
    <script src="{{ asset('theme/frontend-template/js/add_row_custon.js') }}"></script>
    <!--multiple-image-video js-->
    <script src="{{ asset('theme/frontend-template/js/multiple-image-video.js') }}"></script>
    <!--sticky sidebar js-->
    <script src="{{ asset('theme/frontend-template/js/sticky_sidebar.js') }}"></script>
    <!--price ranger js-->
    <script src="{{ asset('theme/frontend-template/js/ranger_jquery-ui.min.js') }}"></script>
    <script src="{{ asset('theme/frontend-template/js/ranger_slider.js') }}"></script>
    <!--isotope js-->
    <script src="{{ asset('theme/frontend-template/js/isotope.pkgd.min.js') }}"></script>
    <!--venobox js-->
    <script src="{{ asset('theme/frontend-template/js/venobox.min.js') }}"></script>
    <!--classycountdown js-->
    <script src="{{ asset('theme/frontend-template/js/jquery.classycountdown.js') }}"></script>

    <!--main/custom js-->
    <script src="{{ asset('theme/frontend-template/js/main.js') }}"></script>
    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                @php
                    toastr()->error($error);
                @endphp
            @endforeach
        @endif
    </script>
</body>

</html>
