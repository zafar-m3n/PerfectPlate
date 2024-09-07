<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductCreateRequest;
use App\Http\Requests\Admin\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Product;
use App\Traits\FileUploadTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Str;

class ProductController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $dataTable) : View|JsonResponse
    {
        return $dataTable->render('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        $categories = Category::all();
        return view('admin.product.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductCreateRequest $request) : RedirectResponse
    {
        try {
        //handle image file
        $imagePath = $this->uploadImage($request, 'image');
        $product = new Product();
        $product->thumb_image = $imagePath;
        $product->name= $request->name;
        $product->slug= generateUniqueSlug('Product',$request->name);
        $product->category_id = $request->category;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price ?? 0;
        $product->quantity = $request->quantity;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->sku = $request->sku;
        $product->seo_title = $request->seo_title;
        $product->seo_description = $request->seo_description;
        $product->show_at_home = $request->show_at_home;
        $product->status = $request->status;
        $product->save();

        session()->flash('success', 'Product Created successfully!');
    } catch (\Exception $e) {
        // If there is an error during saving
        session()->flash('error', 'There was a problem creating the product.');
    }

        return to_route('product.index');

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
    public function edit(string $id) : View
    {
        $categories = Category::all();
        $product = Product::findOrFail($id);
        return view('admin.product.edit',compact('categories','product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, string $id) : RedirectResponse
    {
        try {
            //handle image file
            $product = Product::findOrFail(($id));
            $imagePath = $this->uploadImage($request, 'image', $product->thumb_image);
            $product->thumb_image = !empty($imagePath) ? $imagePath : $product->thumb_image;
            $product->name= $request->name;
            $product->category_id = $request->category;
            $product->price = $request->price;
            $product->offer_price = $request->offer_price ?? 0;
            $product->quantity = $request->quantity;
            $product->short_description = $request->short_description;
            $product->long_description = $request->long_description;
            $product->sku = $request->sku;
            $product->seo_title = $request->seo_title;
            $product->seo_description = $request->seo_description;
            $product->show_at_home = $request->show_at_home;
            $product->status = $request->status;
            $product->save();

            session()->flash('success', 'Product Updated successfully!');
        } catch (\Exception $e) {
            // If there is an error during saving
            session()->flash('error', 'There was a problem updating the product.');
        }

            return to_route('product.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) : Response
    {
        try{
            $product = Product::findOrFail(($id));
            $this->removeImage($product->thumb_image);
            $product->delete();
            return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
