<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Commune;
use App\Models\Etablissement;
use App\Models\MaterielInformatique;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin/admin_login');
    }
    public function dashboard()
    {
        $communes = Commune::with('etablissements')->get();
        $etablissements = Etablissement::with('materielInformatiques')->get();
        $materielInformatiques = MaterielInformatique::all();

        return view('admin.index', compact('communes', 'etablissements', 'materielInformatiques'));
    }
    public function login(Request $request)
    {
        $check = $request->all();
        if (Auth::guard('admin')->attempt(['email' => $check['email'], 'password' => $check['password']])) {
            return redirect()->route('admin.dashboard')->with('error', "Admin LogedIn seccessfully");
        } else {
            return back()->with('error', 'Invalid Email or Password');
        };
    }
    public function AdminLogout()
    {
        Auth::guard('admin')->logout();
        // return redirect()->route('login_form')->with('error', "Admin LogedOut seccessfully");
        return redirect()->route('home')->with('error', "Admin LogedOut seccessfully");
    }
    public function AdminRegister()
    {
        return view('admin.admin_register');
    }
    public function AdminRegisterCreate(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:admins|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create a new admin using the validated data
        $admin = Admin::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        // Redirect to the login form with a success message
        return redirect()->route('login_form')->with('success', 'Registration successful. Please log in.');
    }










    public function fetchEtablissements($communeId)
    {
        $etablissements = Etablissement::where('codeCommune', $communeId)->get();
        return view('admin.etablissement_dropdown', compact('etablissements'));
    }

    public function fetchMaterielInformatique($etablissementId)
    {
        $materielInformatiques = MaterielInformatique::where('codeGresa', $etablissementId)->get();
        return view('admin.material_informatique_table', compact('materielInformatiques', 'etablissementId'));
    }
}
