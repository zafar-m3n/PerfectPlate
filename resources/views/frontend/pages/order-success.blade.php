@extends('frontend.layouts.master')

@section('content')
    <!--=============================
                                                                                BREADCRUMB START
                                                                            ==============================-->
    <section class="fp__breadcrumb" style="background: url({{ asset('frontend/images/counter_bg.jpg') }});">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>Order Success</h1>
                    <h6 style="color: white; text-align:center;">Your order has been successfully placed. Check your orders
                        page for updates on
                        the order.</h6>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
                                                                                BREADCRUMB END
                                                                            ==============================-->
@endsection
