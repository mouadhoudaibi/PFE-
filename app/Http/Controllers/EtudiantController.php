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

        $allSubjects = $etudiant->group->subjects; 

        $sum = 0;
        $totalCoeff = 0;

        foreach ($allSubjects as $subject) {
            $grade = $grades->where('subject_id', $subject->id)->first();

            if ($grade) {
                // weighted average calculation same as your Total Grades page
                $finalGrade = (($grade->grade + $grade->grade2) * $subject->coefficient) / 2;
                $sum += $finalGrade;
                $totalCoeff += $subject->coefficient;
            }
        }

        $averageGrade = $totalCoeff > 0 ? ($sum / $totalCoeff) : 0;

        $moduleCount = $grades->pluck('subject_id')->unique()->count();

        return view('etudiant.dashboard', compact(
            'studentsInGroup',
            'averageGrade',
            'moduleCount'
        ));
    }



    public function grades()
    {
        $student = Auth::guard('etudiant')->user();
        $subjects = $student->group ? $student->group->subjects : collect(); // Ensure it's always a collection
        $grades = $student->grades;
        $studentsInGroup = Etudiant::where('group_id', $student->group_id)->count(); 
    
        return view('etudiant.grades', compact('subjects', 'grades' , 'studentsInGroup'));
    }
    

    public function logout()
    {
        Auth::guard('etudiant')->logout();  // Log out the professor
        return redirect()->route('etudiant.login');  // Redirect to the login page
    }

    public function assignments()
    {
        $etudiant = Auth::guard('etudiant')->user();
        $group = $etudiant->group;

        if (!$group) {
            return redirect()->route('etudiant.dashboard')->with('error', 'You are not assigned to a group.');
        }

        $subjects = $group->subjects()->with('profs')->get();

        return view('etudiant.assignments', compact('subjects'));
    }

    public function group()
    {
        $student = Auth::guard('etudiant')->user();
        $group = $student->group; // Assuming each student belongs to one group
    
        if (!$group) {
            return redirect()->route('etudiant.dashboard')->with('error', 'You are not assigned to any group.');
        }
    
        $group->etudiants = $group->etudiants->sortBy('name');
    
        return view('etudiant.group', compact('group'));
    }

    public function totalgrades()
    {
        $etudiant = Auth::user();
        $grades = $etudiant->grades;
        $studentsInGroup = Etudiant::where('group_id', $etudiant->group_id)->count(); 

        return view('etudiant.totalgrades', compact('studentsInGroup','grades'));
    }
    

}

