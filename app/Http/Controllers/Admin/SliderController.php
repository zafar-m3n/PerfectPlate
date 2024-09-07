<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SliderDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SliderCreateRequest;
use App\Http\Requests\Admin\SliderUpdateRequest;
use App\Models\Slider;
use App\Traits\FileUploadTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class SliderController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(SliderDataTable $dataTable)
    {
        return $dataTable->render('admin.slider.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderCreateRequest $request)
    {
        try {
            // Handle the image upload
            $imagePath = $this->uploadImage($request, 'image');

            // Create a new Slider instance
            $slider = new Slider();
            $slider->image = $imagePath;
            $slider->offer = $request->offer;
            $slider->title = $request->title;
            $slider->sub_title = $request->sub_title;
            $slider->short_description = $request->short_description;
            $slider->button_link = $request->button_link;
            $slider->status = $request->status;

            // Save the slider
            $slider->save();

            // If successful
            session()->flash('success', 'Slider created successfully!');
        } catch (\Exception $e) {
            // If there is an error during saving
            session()->flash('error', 'There was a problem creating the slider.');
        }

        // Redirect back to the create slider form
        return to_route('slider.index');
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
    public function edit(string $id): View
    {
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SliderUpdateRequest $request, string $id): RedirectResponse
    {
        try {
            $slider = Slider::findOrFail($id);
            //handle image update
            $imagePath = $this->uploadImage($request, 'image', $slider->image);

            $slider->image = !empty($imagePath) ? $imagePath : $slider->image;
            $slider->offer = $request->offer;
            $slider->title = $request->title;
            $slider->sub_title = $request->sub_title;
            $slider->short_description = $request->short_description;
            $slider->button_link = $request->button_link;
            $slider->status = $request->status;
            // Save the slider
            $slider->save();
            // If successful
            session()->flash('success', 'Slider Updated successfully!');
        } catch (\Exception $e) {
            // If there is an error during saving
            session()->flash('error', 'There was a problem creating the slider.');
        }

        // Redirect back to the create slider form
        return to_route('slider.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $slider = Slider::findOrFail($id);
            $this->removeImage($slider->image);
            $slider->delete();
            return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
