<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Client\ResponseSequence;
use Illuminate\Http\Request;
use Cart;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;
use View;



class CartController extends Controller
{
    function index()
    {
        return view('frontend.pages.cart-view');
    }
    //Add product into cart

    public function addToCart(Request $request)
    {
        // The rest of your code remains the same
        $product = Product::with(['productSizes', 'productOptions'])->findOrFail($request->product_id);
        if ($product->quantity < $request->quantity){
            throw ValidationException::withMessages(['Quantity is not available']);
        }
        try {

            $productSize = $product->productSizes->where('id', $request->product_size)->first();
            $productOptions = $product->productOptions->whereIn('id', $request->product_option);

            $options = [
                'product_size' => [],
                'product_options' => [],
                'product_info' => [
                    'image' => $product->thumb_image,
                    'slug' => $product->slug
                ]
            ];
            if($productSize != null){
                $options['product_size'] = [
                    'id' => $productSize?->id,
                    'name' => $productSize?->name,
                    'price' => $productSize?->price
                ];
            }

            foreach ($productOptions as $option) {
                $options['product_options'][] = [
                    'id' => $option->id,
                    'name' => $option->name,
                    'price' => $option->price
                ];
            }

            Cart::add([
                'id' => $product->id,
                'name' => $product->name,
                'qty' => $request->quantity,
                'price' => $product->offer_price > 0 ? $product->offer_price : $product->price,
                'weight' => 0,
                'options' => $options
            ]);

            return response(['status' => 'success', 'message' => 'Product added into cart!'], 200);
        } catch (\Exception $e) {
            logger($e);
            return response(['status' => 'error', 'message' => 'Something went wrong!'], 500);
        }

    }

    function getCartProduct()
    {
        return view('frontend.layouts.ajax-files.sidebar-cart-item')->render();
    }

    function cartProductRemove($rowId)
    {
        try {
            Cart::remove($rowId);
            return response(['status' => 'success',
                'message' => 'item removed from cart',
                'cart_total' => cartTotal(),
                'grand_cart_total' => grandCartTotal()
            ], 200);

        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => 'Something went wrong!'], 500);
        }
    }

    function cartQtyUpdate(Request $request) : Response {
        $cartItem = Cart::get($request->rowId);
        $product = Product::findOrFail($cartItem->id);

        if ($product->quantity < $request->qty) {
            return response(['status' => 'error', 'message' => 'Quantity is not available', 'qty' => $cartItem->qty]);
        }

        try {
            // Update the cart quantity
            Cart::update($request->rowId, $request->qty);

            // Calculate the updated product total
            $productTotal = productTotal($request->rowId);

            // Recalculate cart totals
            $cartTotal = cartTotal();
            $grandCartTotal = grandCartTotal();

            // Reapply coupon discount if coupon exists in session
            $coupon = session()->get('coupon');
            if ($coupon) {
                $discount = $coupon['discount'];
                $finalTotal = $grandCartTotal - $discount;
            } else {
                $finalTotal = $grandCartTotal;
            }

            return response([
                'status' => 'success',
                'product_total' => $productTotal,
                'qty' => $request->qty,
                'cart_total' => $cartTotal,
                'grand_cart_total' => $grandCartTotal,
                'final_total' => $finalTotal
            ], 200);

        } catch (\Exception $e) {
            logger($e);
            return response(['status' => 'error', 'message' => 'Something went wrong please reload the page.'], 500);
        }
    }

    function cartDestroy(){
        Cart::destroy();
        session()->forget('coupon');
        return redirect()->back();
    }
}
