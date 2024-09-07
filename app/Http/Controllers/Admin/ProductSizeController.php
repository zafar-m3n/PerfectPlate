<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\ProductSize;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ProductSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $productId) :View
    {
        $product = Product::findOrFail($productId);
        $sizes = ProductSize::where('product_id',$product->id)->get();
        $options = ProductOption::where('product_id',$product->id)->get();
        return view('admin.product.product-size.index',compact('product','sizes','options'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        try {
        $request->validate([
            'name' => ['required','max:255'],
            'price'=>['required','numeric'],
            'product_id' => ['required', 'integer']
        ]);

        $size = new ProductSize();
        $size->product_id = $request->product_id;
        $size->name = $request->name;
        $size->price = $request->price;
        $size->save();
        Session()->flash('success', 'Size created successfully!');
    } catch (\Exception $e) {
        // If there is an error during saving
        session()->flash('error', 'There was a problem creating the size.');
    }

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) : Response
    {  try{
        $size = ProductSize::findOrFail($id);
        $size->delete();
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    } catch (\Exception $e) {
        return response(['status' => 'error', 'message' => $e->getMessage()]);
    }
}
    }
