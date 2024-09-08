@extends('frontend.layouts.master')

@section('content')
    <!--=============================
                                                BREADCRUMB START
                                            ==============================-->
    <section class="fp__breadcrumb" style="background: url({{ asset('frontend/images/counter_bg.jpg') }});">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>checkout</h1>
                    <ul>
                        <li><a href="{{ url('/') }}">home</a></li>
                        <li><a href="javascript:;">checkout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
                                                BREADCRUMB END
                                            ==============================-->

    <!--============================
                                                CHECK OUT PAGE START
                                            ==============================-->

    <section class="fp__cart_view mt_125 xs_mt_95 mb_100 xs_mb_70">
        <div class="container">
            <div class="row justify-content-center">
                <h2>Place Your Order</h2>
                <div class="col-lg-4 wow fadeInUp" data-wow-duration="1s">
                    <div id="sticky_sidebar" class="fp__cart_list_footer_button">
                        <h6>total cart</h6>
                        <p>subtotal: <span>{{ currencyPosition(cartTotal()) }}</span></p>
                        @if (session()->has('coupon'))
                            <p>discount: <span>{{ currencyPosition(session()->get('coupon')['discount']) }}</span></p>
                        @else
                            <p>discount: <span>{{ currencyPosition(0) }}</span></p>
                        @endif
                        <p class="total"><span>total:</span> <span>{{ currencyPosition(grandCartTotal()) }}</span></p>

                        <form id="checkout_form" action="{{ route('checkout.redirect') }}" method="POST">
                            @csrf
                            <!-- Pass additional data if needed -->
                            <input type="hidden" name="id" value="1"> <!-- Example hidden field -->

                            <!-- Hidden submit button -->
                            <button type="submit" style="display:none;"></button>
                        </form>

                        <a class="common_btn" href="#"
                            onclick="document.getElementById('checkout_form').submit(); return false;">Place Order</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
                                                CHECK OUT PAGE END
                                            ==============================-->
@endsection
