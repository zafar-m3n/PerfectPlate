<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfilePasswordUpdateRequest;
use App\Http\Requests\Admin\ProfileUpdateRequest;
use App\Traits\FileUploadTrait;
use Illuminate\Contracts\View\View;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    use FileUploadTrait;
    function index() : View{
        return view('admin.profile.index');
    }

    function updateProfile(ProfileUpdateRequest $request) : RedirectResponse{

        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);


        $user = Auth::user();

        $imagePath = $this->uploadImage($request,'avatar');



        $user->name = $request->name;
        $user->email = $request->email;
        $user->avatar =isset($imagePath) ? $imagePath :$user->avatar;
        $user->save();



        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    function updatePassword(ProfilePasswordUpdateRequest $request) : RedirectResponse {
        $user = Auth::user();

        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Password updated successfully.');
        }
}
