<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use App\Models\Admin;  // Import the Admin model

class AdminResetPasswordController extends Controller
{
    public function showResetForm(Request $request, $token = null)
    {
        return view('admin.auth.passwords.reset')->with([
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        // Retrieve the admin by email
        $admin = Admin::where('email', $request->email)->first();

        // Check if the admin exists and the token is valid
        if (!$admin || !Password::getRepository()->exists($admin, $request->token)) {
            return back()->withErrors(['email' => 'Invalid token or email.']);
        }

        // Reset the admin's password
        $admin->password = Hash::make($request->password);
        $admin->setRememberToken(Str::random(60));
        $admin->save();

        event(new PasswordReset($admin));

        // Manually login the admin (if needed, otherwise redirect to login)
        Auth::login($admin);  // or: Auth::guard('web')->login($admin); if using web guard

        return redirect()->route('admin.dashboard')->with('status', 'Password reset successful!');
    }
}
