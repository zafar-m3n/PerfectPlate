<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Cart;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('frontend.pages.checkout');
    }

    public function checkoutRedirect(Request $request)
    {
        $cartItems = Cart::content();

        $userId = auth()->id();

        $subtotal = Cart::subtotal();
        $total = Cart::total();

        $discount = session()->has('coupon') ? session()->get('coupon')['discount'] : 0;

        $order = Order::create([
            'user_id' => $userId,
            'subtotal' => $subtotal,
            'total' => $total,
            'discount' => $discount,
            'status' => 'pending',
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'name' => $item->name,
                'qty' => $item->qty,
                'price' => $item->price,
                'options' => json_encode($item->options),
            ]);
        }

        Cart::destroy();

        return redirect()->route('order.success')->with('message', 'Order placed successfully!');
    }
}
