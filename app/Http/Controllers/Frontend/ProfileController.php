<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ProfilePasswordUpdateRequest;
use App\Http\Requests\Frontend\ProfileUpdateRequest;
use App\Traits\FileUploadTrait;
use Illuminate\Contracts\View\View;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    use FileUploadTrait;
    function updateProfile(ProfileUpdateRequest $request) : RedirectResponse{

        $request->validate([

            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);
       $user = Auth::user();
       $user->name=$request->name;
       $user->email=$request->email;
       $user->save();

       toastr()->success('Profile Updated Successfully');

       return redirect()->back();
    }

   function updatePassword(ProfilePasswordUpdateRequest $request) : RedirectResponse{
    dd($request->all());
    $user = Auth::user();

    $user->password = bcrypt($request->password);
    $user->save();

    return redirect()->back()->with('success', 'Password updated successfully.');
    }

    public function updateAvatar(Request $request)
    {
        // Validate the request
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle the file upload
        $imagePath = $this->uploadImage($request, 'avatar');

        // Update the user's avatar in the database
        $user = Auth::user();
        $user->avatar = $imagePath;
        $user->save();

        // Return the new image path
        return response()->json(['status' => 'success', 'avatar_url' => asset($user->avatar)]);
    }

    private function uploadImage(Request $request, $key)
    {
        if ($request->hasFile($key)) {
            $file = $request->file($key);
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('avatars', $filename, 'public');
            return '/storage/' . $path;
        }
        return null;
    }
}

