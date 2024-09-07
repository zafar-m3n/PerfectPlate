<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Traits\FileUploadTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ProductGalleryController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(string $productId): View
    {
        $images=  ProductGallery::where('product_id',$productId)->get();
        $product = Product::findOrFail(($productId));
        return view('admin.product.gallery.index', compact('productId','images','product'));
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
    public function store(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'image' => ['required', 'image', 'max:3000'],
                'product_id' => ['required', 'integer']
            ]);

            $imagePath = $this->uploadImage($request, 'image');

            $gallery = new ProductGallery();
            $gallery->product_id = $request->product_id;
            $gallery->image = $imagePath;
            $gallery->save();
            session()->flash('success', 'Image uploaded successfully!');
        } catch (\Exception $e) {
            // If there is an error during saving
            session()->flash('error', 'There was a problem uploading the image.');
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
    {
        try{
            $image = ProductGallery::findOrFail($id);
            $this->removeImage($image->image);
            $image->delete();
            return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
