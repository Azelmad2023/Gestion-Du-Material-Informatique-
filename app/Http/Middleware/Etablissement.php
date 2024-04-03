<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Etablissement
{

    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('etablissement')->check()) {
            return redirect()->route('etablissement_login_form')->with('error', 'plz login first');
        }
        return $next($request);
    }
}
