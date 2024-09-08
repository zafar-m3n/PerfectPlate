@extends('layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Orders</h1>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>All Orders</h4>
            </div>
            <div class="card-body">
                <table class="table-striped table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer Name</th>
                            <th>Status</th>
                            <th>Subtotal</th>
                            <th>Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ ucfirst($order->user->name) }}</td>
                                <td>{{ ucfirst($order->status) }}</td>
                                <td>${{ number_format($order->subtotal, 2) }}</td>
                                <td>${{ number_format($order->total, 2) }}</td>
                                <td>
                                    <a href="{{ route('order.show', $order->id) }}" class="btn btn-primary">View</a>
                                    <form action="{{ route('order.destroy', $order->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $orders->links() }}
            </div>
        </div>
    </section>
@endsection
