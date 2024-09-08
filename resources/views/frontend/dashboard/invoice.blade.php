@extends('frontend.layouts.master')

@section('content')
    <section class="fp__breadcrumb" style="background: url(images/counter_bg.jpg);">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>Order Invoice</h1>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="#">Invoice</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="fp__dashboard mt_120 xs_mt_90 mb_100 xs_mb_70">
        <div class="container">
            <div class="fp__dashboard_area">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="fp_dashboard_body rounded bg-white p-5 shadow">
                            <h3 class="mb-4 text-center">Invoice for Order #{{ $order->id }}</h3>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <h5 class="text-primary">Order Information</h5>
                                    <p><strong>Date:</strong> {{ $order->created_at->format('F d, Y') }}</p>
                                    <p><strong>Status:</strong> <span>{{ ucfirst($order->status) }}</span></p>
                                    <p><strong>Subtotal:</strong> ${{ number_format($order->subtotal, 2) }}</p>

                                    @if ($order->discount)
                                        <p><strong>Discount:</strong> ${{ number_format($order->discount, 2) }}</p>
                                    @endif

                                    <p><strong>Total:</strong> ${{ number_format($order->total, 2) }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="text-primary">Customer Information</h5>
                                    <p><strong>Name:</strong> {{ auth()->user()->name }}</p>
                                    <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                                </div>
                            </div>

                            <h5 class="text-primary mb-3">Order Items</h5>
                            <table class="table-bordered table">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Item Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->items as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->qty }}</td>
                                            <td>${{ number_format($item->price, 2) }}</td>
                                            <td>${{ number_format($item->price * $item->qty, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3" class="text-right">Total</th>
                                        <th>${{ number_format($order->total, 2) }}</th>
                                    </tr>
                                </tfoot>
                            </table>

                            <div class="mt-4 text-center">
                                <a href="{{ route('dashboard') }}#v-pills-profile" class="common_btn">Back to
                                    Orders</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
