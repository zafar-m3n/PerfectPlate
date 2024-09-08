@extends('layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Order Details</h1>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Order #{{ $order->id }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Customer Details</h5>
                        <p><strong>Name:</strong> {{ $order->user->name }}</p>
                        <p><strong>Email:</strong> {{ $order->user->email }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Order Summary</h5>
                        <p><strong>Subtotal:</strong> ${{ number_format($order->subtotal, 2) }}</p>
                        <p><strong>Total:</strong> ${{ number_format($order->total, 2) }}</p>
                    </div>
                </div>

                <h5>Order Items</h5>
                <table class="table-bordered table">
                    <thead>
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
                </table>

                <form action="{{ route('order.update', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="status">Order Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="accepted" {{ $order->status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed
                            </option>
                            <option value="rejected" {{ $order->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Status</button>
                </form>
            </div>
        </div>
    </section>
@endsection
