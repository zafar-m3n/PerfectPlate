<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryCreateRequest;
use App\Http\Requests\Admin\CategoryUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\View\View;
use Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.product.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('admin.product.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryCreateRequest $request) : RedirectResponse
    {
        try {
        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->show_at_home = $request->show_at_home;
        $category->status = $request->status;
        $category->save();

        session()->flash('success', 'Category created successfully!');
        } catch (\Exception $e) {
            // If there is an error during saving
            session()->flash('error', 'There was a problem creating the category.');
        }

        // Redirect back to the create slider form
        return to_route('category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $category = Category::findOrFail($id);
        return view('admin.product.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, string $id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->name = $request->name;
            $category->slug = Str::slug($request->name);
            $category->show_at_home = $request->show_at_home;
            $category->status = $request->status;
            $category->save();

            session()->flash('success', 'Category updated successfully!');
            } catch (\Exception $e) {
                // If there is an error during saving
                session()->flash('error', 'There was a problem updating the category.');
            }

            // Redirect back to the create slider form
            return to_route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
        Category::findOrFail($id)->delete();

            return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => $e->getMessage()]);
        }

    }
}
