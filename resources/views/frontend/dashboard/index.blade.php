@extends('frontend.layouts.master')
@section('content')
    <section class="fp__breadcrumb" style="background: url(images/counter_bg.jpg);">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>user dashboard</h1>
                    <ul>
                        <li><a href="index.html">home</a></li>
                        <li><a href="#">dashboard</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
                                       BREADCRUMB END
                                   ==============================-->

    <!--=========================
                                       DASHBOARD START
                                   ==========================-->
    <section class="fp__dashboard mt_120 xs_mt_90 mb_100 xs_mb_70">
        <div class="container">
            <div class="fp__dashboard_area">
                <div class="row">
                    <div class="col-xl-3 col-lg-4 wow fadeInUp" data-wow-duration="1s">
                        <div class="fp__dashboard_menu">
                            <div class="dasboard_header">
                                <div class="dasboard_header_img">
                                    <img src="{{ auth()->user()->avatar }}" alt="user" class="img-fluid w-100">
                                    <label for="upload"><i class="far fa-camera"></i></label>
                                    <form id="avatar_form">
                                        <input type="file" id="upload" hidden name="avatar">
                                    </form>
                                </div>
                                <h2>{{ auth()->user()->name }}</h2>
                            </div>
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-home" type="button" role="tab"
                                    aria-controls="v-pills-home" aria-selected="true"><span><i
                                            class="fas fa-user"></i></span> Personal Info</button>

                                <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-profile" type="button" role="tab"
                                    aria-controls="v-pills-profile" aria-selected="false"><span><i
                                            class="fas fa-bags-shopping"></i></span> Orders</button>

                                <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-settings" type="button" role="tab"
                                    aria-controls="v-pills-settings" aria-selected="false"><span><i
                                            class="fas fa-user-lock"></i></span> Change Password </button>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <button class="nav-link"onclick="event.preventDefault();
                                                                           this.closest('form').submit();"
                                        type="button"><span> <i class="fas fa-sign-out-alt"></i>
                                        </span> Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-8 wow fadeInUp" data-wow-duration="1s">
                        <div class="fp__dashboard_content">
                            <div class="tab-content" id="v-pills-tabContent">

                                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                                    aria-labelledby="v-pills-home-tab">
                                    <div class="fp_dashboard_body">
                                        <h3>Welcome to your Profile</h3>

                                        <div class="fp__dsahboard_overview">
                                            <div class="row">
                                                <div class="col-xl-4 col-sm-6 col-md-4">
                                                    <div class="fp__dsahboard_overview_item">
                                                        <span class="icon"><i class="far fa-shopping-basket"></i></span>
                                                        <h4>total order <span>(76)</span></h4>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-sm-6 col-md-4">
                                                    <div class="fp__dsahboard_overview_item green">
                                                        <span class="icon"><i class="far fa-shopping-basket"></i></span>
                                                        <h4>Completed <span>(71)</span></h4>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-sm-6 col-md-4">
                                                    <div class="fp__dsahboard_overview_item red">
                                                        <span class="icon"><i class="far fa-shopping-basket"></i></span>
                                                        <h4>cancel <span>(05)</span></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="fp_dash_personal_info">
                                            <h4>Personal Information
                                                <a class="dash_info_btn">
                                                    <span class="edit">edit</span>
                                                    <span class="cancel">cancel</span>
                                                </a>
                                            </h4>

                                            <div class="personal_info_text">
                                                <p><span>Name:</span>{{ auth()->user()->name }}</p>
                                                <p><span>Email:</span>{{ auth()->user()->email }} </p>
                                            </div>

                                            <div class="fp_dash_personal_info_edit comment_input p-0">
                                                <form method="POST" action="{{ route('profile.update') }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="fp__comment_imput_single">
                                                                <label>name</label>
                                                                <input type="text" placeholder="Name" name="name"
                                                                    value="{{ auth()->user()->name }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12 col-lg-12">
                                                            <div class="fp__comment_imput_single">
                                                                <label>email</label>
                                                                <input type="email" placeholder="Email"
                                                                    name="email"value="{{ auth()->user()->email }}">
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-12">

                                                            <button type="submit" class="common_btn">submit</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                    aria-labelledby="v-pills-profile-tab">
                                    <div class="fp_dashboard_body">
                                        <h3>Order List</h3>
                                        <div class="fp_dashboard_order">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tbody>
                                                        <tr class="t_header">
                                                            <th>Order</th>
                                                            <th>Date</th>
                                                            <th>Status</th>
                                                            <th>Amount</th>
                                                            <th>Action</th>
                                                        </tr>

                                                        <!-- Dynamically display the orders -->
                                                        @foreach ($orders as $order)
                                                            <tr>
                                                                <td>
                                                                    <h5>#{{ $order->id }}</h5>
                                                                </td>
                                                                <td>
                                                                    <p>{{ $order->created_at->format('F d, Y') }}</p>
                                                                </td>
                                                                <td>
                                                                    <span
                                                                        class="{{ $order->status == 'Completed' ? 'complete' : 'active' }}">
                                                                        {{ $order->status }}
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <h5>${{ number_format($order->total, 2) }}</h5>
                                                                </td>
                                                                <td><a href="{{ route('order.invoice', $order->id) }}"
                                                                        class="view_invoice">View Details</a></td>

                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                                @if ($orders->isEmpty())
                                                    <p>No orders found.</p>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Static Invoice Section -->
                                        <div class="fp__invoice">
                                            <a class="go_back"><i class="fas fa-long-arrow-alt-left"></i> go back</a>
                                            <div class="fp__track_order">
                                                <ul>
                                                    <li class="active">Order Pending</li>
                                                    <li class="active">Order Accept</li>
                                                    <li>Order Process</li>
                                                    <li>On The Way</li>
                                                    <li>Completed</li>
                                                </ul>
                                            </div>
                                            <div class="fp__invoice_header">
                                                <div class="header_address">
                                                    <p><b>Order ID:</b> <span> #4789546458</span></p>
                                                    <p><b>Date:</b> <span>10-11-2022</span></p>
                                                </div>
                                            </div>
                                            <div class="fp__invoice_body">
                                                <div class="table-responsive">
                                                    <table class="table-striped table">
                                                        <tbody>
                                                            <tr class="border_none">
                                                                <th class="sl_no">SL</th>
                                                                <th class="package">Item Description</th>
                                                                <th class="price">Price</th>
                                                                <th class="qnty">Quantity</th>
                                                                <th class="total">Total</th>
                                                            </tr>
                                                            <tr>
                                                                <td class="sl_no">01</td>
                                                                <td class="package">
                                                                    <p>Hyderabadi Biryani</p>
                                                                    <span class="size">small</span>
                                                                    <span class="coca_cola">coca-cola</span>
                                                                    <span class="coca_cola2">7up</span>
                                                                </td>
                                                                <td class="price">
                                                                    <b>$120</b>
                                                                </td>
                                                                <td class="qnty">
                                                                    <b>2</b>
                                                                </td>
                                                                <td class="total">
                                                                    <b>$240</b>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="sl_no">02</td>
                                                                <td class="package">
                                                                    <p>Daria Shevtsova</p>
                                                                    <span class="size">medium</span>
                                                                    <span class="coca_cola">coca-cola</span>
                                                                </td>
                                                                <td class="price">
                                                                    <b>$120</b>
                                                                </td>
                                                                <td class="qnty">
                                                                    <b>2</b>
                                                                </td>
                                                                <td class="total">
                                                                    <b>$240</b>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <td class="package" colspan="3">
                                                                    <b>Sub Total</b>
                                                                </td>
                                                                <td class="qnty">
                                                                    <b>12</b>
                                                                </td>
                                                                <td class="total">
                                                                    <b>$755</b>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="package coupon" colspan="3">
                                                                    <b>(-) Discount coupon</b>
                                                                </td>
                                                                <td class="qnty">
                                                                    <b></b>
                                                                </td>
                                                                <td class="total coupon">
                                                                    <b>$0.00</b>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="package coast" colspan="3">
                                                                    <b>(+) Shipping Cost</b>
                                                                </td>
                                                                <td class="qnty">
                                                                    <b></b>
                                                                </td>
                                                                <td class="total coast">
                                                                    <b>$10.00</b>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="package" colspan="3">
                                                                    <b>Total Paid</b>
                                                                </td>
                                                                <td class="qnty">
                                                                    <b></b>
                                                                </td>
                                                                <td class="total">
                                                                    <b>$765</b>
                                                                </td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @include('frontend.dashboard.change-password')

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CART POPUP START -->
    <div class="fp__cart_popup">
        <div class="modal fade" id="cartModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                class="fal fa-times"></i></button>
                        <div class="fp__cart_popup_img">
                            <img src="images/menu1.png" alt="menu" class="img-fluid w-100">
                        </div>
                        <div class="fp__cart_popup_text">
                            <a href="#" class="title">Mexican Pizza Test Better</a>
                            <p class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <i class="far fa-star"></i>
                                <span>(201)</span>
                            </p>
                            <h4 class="price">$320.00 <del>$350.00</del> </h4>

                            <div class="details_size">
                                <h5>Select Size</h5>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="large" checked>
                                    <label class="form-check-label" for="large">
                                        Large <span>+ $350</span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="medium">
                                    <label class="form-check-label" for="medium">
                                        Medium <span>+ $250</span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="small">
                                    <label class="form-check-label" for="small">
                                        Small <span>+ $150</span>
                                    </label>
                                </div>
                            </div>

                            <div class="details_quentity">
                                <h5>Select Quantity</h5>
                                <div class="quentity_btn_area d-flex flex-wrapa align-items-center">
                                    <div class="quentity_btn">
                                        <button class="btn btn-danger"><i class="fal fa-minus"></i></button>
                                        <input type="text" placeholder="1">
                                        <button class="btn btn-success"><i class="fal fa-plus"></i></button>
                                    </div>
                                    <h3>$320.00</h3>
                                </div>
                            </div>
                            <ul class="details_button_area d-flex flex-wrap">
                                <li><a class="common_btn" href="#">Add to Cart</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $("#upload").on('change', function() {
                let form = $('#avatar_form')[0];
                let formData = new FormData(form);

                $.ajax({
                    method: 'POST',
                    url: "{{ route('profile.avatar.update') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status === 'success') {
                            // Update the image source dynamically
                            $('.dasboard_header_img img').attr('src', response.avatar_url);
                        }
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            if (window.location.hash === '#v-pills-profile') {
                $('#v-pills-profile-tab').tab('show');
            }
        });
    </script>
@endpush
