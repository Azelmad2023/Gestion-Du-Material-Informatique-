<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\Etablissement;

class ForgotEtablissementPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    // public function sendResetLinkEmail(Request $request)
    // {
    //     $request->validate([
    //         'email' => ['required', 'email'],
    //     ]);
    //     $status = Password::sendResetLink(
    //         $request->only('email')
    //     );

    //     return $status == Password::RESET_LINK_SENT
    //         ? back()->with('status', __($status))
    //         : back()->withInput($request->only('email'))
    //         ->withErrors(['email' => __($status)]);
    // }
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withInput($request->only('email'))
            ->withErrors(['email' => __($status)]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8', // Add your password validation rules here
        ]);

        // Attempt to reset the user's password
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password)
                ])->save();
            }
        );

        // Redirect based on the password reset status
        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('etablissement_login_form')->with('status', __($status));
        } else {
            return back()->withErrors(['email' => [__($status)]]);
        }
    }
}
