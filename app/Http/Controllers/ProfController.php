<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prof;
use App\Models\Etudiant;
use App\Models\Grade;
use App\Models\Subject;
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
        $prof = Auth::guard('prof')->user();
        $subjects = $prof->subjects;
        return view('prof.dashboard', compact('subjects'));
    }
    public function logout()
    {
        Auth::guard('prof')->logout();  // Log out the professor
        return redirect()->route('prof.login');  // Redirect to the login page
    }


    public function showStudents($subject_id)
{
    $subject = Subject::findOrFail($subject_id);

    $students = Etudiant::where('group_id', $subject->group_id)->get();

    return view('prof.students', compact('students', 'subject_id'));
}

    public function storeGrade(Request $request)
    {
        $request->validate([
            'etudiant_id' => 'required|exists:etudiants,id',
            'subject_id' => 'required|exists:subjects,id',
            'grade' => 'required|integer|min:0|max:20',
        ],
        [
            'etudiant_id.required' => 'Veuillez renseigner l\'id de l\'etudiant',
            'subject_id.required' => 'Veuillez renseigner l\'id du sujet',
            'grade.required' => 'Veuillez renseigner le grade',
            'grade.min' => 'Le grade doit être compris entre 0 et 20',
            'grade.max' => 'Le grade doit être compris entre 0 et 20',
        ]
    );

        Grade::updateOrCreate(
            [
                'etudiant_id' => $request->etudiant_id,
                'subject_id' => $request->subject_id,
            ],
            [
                'prof_id' => Auth::id(), // The logged-in professor
                'grade' => $request->grade,
            ]
        );

        return redirect()->back()->with('success', 'Grade assigned successfully');
    }

}

