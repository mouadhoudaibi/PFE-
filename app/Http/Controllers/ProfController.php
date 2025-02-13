<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prof;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfController extends Controller
{
    public function showLoginForm()
    {
        return view('prof.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ],
    [
            'email.required' => 'Veuillez renseigner votre adresse email',
            'email.email' => 'Veuillez renseigner une adresse email valide',
            'password.required' => 'Veuillez renseigner votre mot de passe',
            'password.min' => 'Votre mot de passe doit contenir au moins 8 caractères',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('prof')->attempt($credentials)) {
            return redirect()->route('prof.dashboard');  // Redirect to the professor dashboard
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    public function dashboard()
    {
        return view('prof.dashboard');
    }
    public function logout()
    {
        Auth::guard('prof')->logout();  // Log out the professor
        return redirect()->route('prof.login');  // Redirect to the login page
    }
}

