<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ResetAdminPasswordController extends Controller
{

    public function showResetForm($token)
    {
        return view('admin.reset-password', ['token' => $token]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $credentials = $request->only(
            'email',
            'password',
            'password_confirmation',
            'token'
        );
        $response = Password::broker('admins')->reset($credentials, function ($user, $password) {
            $user->password = bcrypt($password);
            $user->save();
        });

        if ($response == Password::PASSWORD_RESET) {
            return redirect()->route('admin.login')->with('status', trans($response));
        } else {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => trans($response)]);
        }
    }
}
