<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index(): View
    {
        $orders = Order::where('user_id', auth()->id())->get();
        return view('frontend.dashboard.index', compact('orders'));
    }
}
