<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etudiant;
use App\Models\Grade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EtudiantController extends Controller
{
    public function showLoginForm()
    {
        return view('etudiant.login');
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

        if (Auth::guard('etudiant')->attempt($credentials)) {
            return redirect()->route('etudiant.dashboard');  // Redirect to the professor dashboard
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    public function dashboard()
    {
        $etudiant = Auth::user();
        $grades = $etudiant->grades;
        $studentsInGroup = Etudiant::where('group_id', $etudiant->group_id)->count(); 

        return view('etudiant.dashboard', compact('studentsInGroup','grades'));
    }
    public function logout()
    {
        Auth::guard('etudiant')->logout();  // Log out the professor
        return redirect()->route('etudiant.login');  // Redirect to the login page
    }
}

