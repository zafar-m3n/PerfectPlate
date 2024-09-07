<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use Faker\Provider\Address;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    function index()
    {

        return view('frontend.pages.checkout');
    }

    function checkoutRedirect(Request $request){
        $request->validate([

        ]);
        return response (['redirect_url' => route('checkout.index')]);

    }
}
