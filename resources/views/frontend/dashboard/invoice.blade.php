@extends('frontend.layouts.master')
@section('content')
    <section class="fp__dashboard mt_120 xs_mt_90 mb_100 xs_mb_70">
        <div class="container">
            <div class="fp__dashboard_area">
                <div class="row">
                    <div class="col-xl-9 col-lg-8 offset-xl-3 offset-lg-4">
                        <h3>Order Invoice</h3>

                        <!-- Invoice Header -->
                        <div class="fp__invoice_header">
                            <div class="header_address">
                                <h4>Invoice to:</h4>
                                <p>{{ auth()->user()->name }}</p>
                                <p>{{ auth()->user()->email }}</p>
                                <p>Phone: +1-234-567-890</p>
                            </div>
                            <div class="header_address">
                                <p><b>Invoice No:</b> {{ $order->id }}</p>
                                <p><b>Order ID:</b> {{ $order->id }}</p>
                                <p><b>Date:</b> {{ $order->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>

                        <!-- Order Items -->
                        <div class="fp__invoice_body">
                            <table class="table-striped table">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Item</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->items as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>${{ number_format($item->price, 2) }}</td>
                                            <td>{{ $item->qty }}</td>
                                            <td>${{ number_format($item->price * $item->qty, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4" class="text-right"><b>Subtotal:</b></td>
                                        <td><b>${{ number_format($order->subtotal, 2) }}</b></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-right"><b>Discount:</b></td>
                                        <td><b>${{ number_format($order->discount, 2) }}</b></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-right"><b>Total Paid:</b></td>
                                        <td><b>${{ number_format($order->total, 2) }}</b></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <!-- Order Status Progress -->
                        <div class="fp__track_order">
                            <ul>
                                <li class="{{ $order->status === 'pending' ? 'active' : '' }}">Order Pending</li>
                                <li class="{{ $order->status === 'accepted' ? 'active' : '' }}">Order Accepted</li>
                                <li class="{{ $order->status === 'completed' ? 'active' : '' }}">Completed</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
