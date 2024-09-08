<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class DashboardController extends Controller
{
    // Display the user dashboard with their orders
    public function index(): View {
        $orders = Order::where('user_id', Auth::id())->with('items')->get();
        return view('frontend.dashboard.index', compact('orders'));
    }

    // Display a specific order invoice
    public function showOrderInvoice($id): View {
        $order = Order::with('items')->findOrFail($id);
        return view('frontend.dashboard.invoice', compact('order'));
    }
}
