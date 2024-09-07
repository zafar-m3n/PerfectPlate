<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>FoodPark || Restaurant Template</title>
    <link rel="icon" type="image/png" href="images/favicon.png">
    <link rel="stylesheet" href="{{ asset('FrontendAsset/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('FrontendAsset/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('FrontendAsset/css/spacing.css') }}">
    <link rel="stylesheet" href="{{ asset('FrontendAsset/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('FrontendAsset/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('FrontendAsset/css/venobox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('FrontendAsset/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('FrontendAsset/css/jquery.exzoom.css') }}">
    <link rel="stylesheet" href="{{ asset('FrontendAsset/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('FrontendAsset/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('FrontendAsset/css/responsive.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('FrontendAsset/css/rtl.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('FrontendAsset/css/custom.css') }}">
</head>

<body>

<div class="overlay-container d-none">
    <div class="overlay">
        <span class="loader"></span>
    </div>
</div>

<!--=============================
        CART POPUP MODAL
    ==============================-->

<div class="fp__cart_popup">
    <div class="modal fade" id="cartModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body load_product_modal_body">

                </div>
            </div>
        </div>
    </div>
</div>

<!--=============================
        CART POPUP MODAL
    ==============================-->


    <!--=============================
        TOPBAR START
    ==============================-->
    <section class="fp__topbar">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-md-8">
                    <ul class="fp__topbar_info d-flex flex-wrap">
                        <li><a href="mailto:example@gmail.com"><i class="fas fa-envelope"></i> Unifood@gmail.com</a>
                        </li>
                        <li><a href="callto:123456789"><i class="fas fa-phone-alt"></i> +96487452145214</a></li>
                    </ul>
                </div>
                <div class="col-xl-6 col-md-4 d-none d-md-block">
                    <ul class="topbar_icon d-flex flex-wrap">
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a> </li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a> </li>
                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a> </li>
                        <li><a href="#"><i class="fab fa-behance"></i></a> </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
        TOPBAR END
    ==============================-->


    <!--=============================
        MENU START
    ==============================-->
    @include('frontend.layouts.menu')
    <!--=============================
        MENU END
    ==============================-->


    <!--=============================
        BANNER START
    ==============================-->
    @yield('content')


    <!--=============================
        FOOTER START
    ==============================-->
    @include('frontend.layouts.footer')
    <!--=============================
        FOOTER END
    ==============================-->


    <!--=============================
        SCROLL BUTTON START
    ==============================-->
    <div class="fp__scroll_btn">
        go to top
    </div>
    <!--=============================
        SCROLL BUTTON END
    ==============================-->


    <!--jquery library js-->
    <script src="{{ asset('FrontendAsset/js/jquery-3.6.0.min.js') }}"></script>
    <!--bootstrap js-->
    <script src="{{ asset('FrontendAsset/js/bootstrap.bundle.min.js') }}"></script>
    <!--font-awesome js-->
    <script src="{{ asset('FrontendAsset/js/Font-Awesome.js') }}"></script>
    <!-- slick slider -->
    <script src="{{ asset('FrontendAsset/js/slick.min.js') }}"></script>
    <!-- isotop js -->
    <script src="{{ asset('FrontendAsset/js/isotope.pkgd.min.js') }}"></script>
    <!-- simplyCountdownjs -->
    <script src="{{ asset('FrontendAsset/js/simplyCountdown.js') }}"></script>
    <!-- counter up js -->
    <script src="{{ asset('FrontendAsset/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('FrontendAsset/js/jquery.countup.min.js') }}"></script>
    <!-- nice select js -->
    <script src="{{ asset('FrontendAsset/js/jquery.nice-select.min.js') }}"></script>
    <!-- venobox js -->
    <script src="{{ asset('FrontendAsset/js/venobox.min.js') }}"></script>
    <!-- sticky sidebar js -->
    <script src="{{ asset('FrontendAsset/js/sticky_sidebar.js') }}"></script>
    <!-- wow js -->
    <script src="{{ asset('FrontendAsset/js/wow.min.js') }}"></script>
    <!-- ex zoom js -->
    <script src="{{ asset('FrontendAsset/js/jquery.exzoom.js') }}"></script>

    <script src="{{ asset('FrontendAsset/js/toastr.min.js') }}"></script>
    <!--main/custom js-->
    <script src="{{ asset('FrontendAsset/js/main.js') }}"></script>


    <script>

        toastr.options.progressBar = true;
        @if ($errors->any())
            console.log({{ json_encode($errors->all()) }});
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
    @endif
    //set csrf at ajax header
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
{{--  Load gloabal js  --}}
    @include('frontend.layouts.global-scripts')

    @stack('scripts')
</body>

</html>
