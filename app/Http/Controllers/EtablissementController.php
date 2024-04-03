<?php

namespace App\Http\Controllers;

use App\Models\Etablissement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EtablissementController extends Controller
{
    public function index()
    {
        return view('etablissement.etablissement_login');
    }
    public function dashboard()
    {
        return view('etablissement.index');
    }
    public function Etablissementlogin(Request $request)
    {
        $check = $request->all();
        if (Auth::guard('etablissement')->attempt(['email' => $check['email'], 'password' => $check['password']])) {
            $etablissement = Auth::guard('etablissement')->user();
            $etablissementWithMateriel = Etablissement::with('materielInformatiques')->find($etablissement->id);
            return view('etablissement.index', ['etablissementWithMateriel' => $etablissementWithMateriel]);
            // return redirect()->route('etablissement.dashboard')->with('error', "etablissement LogedIn seccessfully");
        } else {
            return back()->with('error', 'Invalid Email or Password');
        };
    }

    public function Etablissementlogout()
    {
        Auth::guard('etablissement')->logout();
        // return redirect()->route('etablissement_login_form')->with('error', "Etablissement LogedOut seccessfully");
        return redirect()->route('home')->with('error', "Admin LogedOut seccessfully");
    }
    public function EtablissementRegister()
    {
        return view('etablissement.etablissement_register');
    }
    public function EtablissementRegisterCreate(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:admins|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create a new admin using the validated data
        $etablissement = Etablissement::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'codeCommune' => '1',
            'password' => bcrypt($validatedData['password']),
        ]);
        return redirect()->route('etablissement_login_form')->with('error', 'Registration successful. Please log in.');
    }
}
