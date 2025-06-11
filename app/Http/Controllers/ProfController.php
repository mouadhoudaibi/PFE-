<?php


namespace App\Http\Controllers;

use App\Models\Group;
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

        $groups = $prof->groups()->withCount('etudiants')->get();

        $groupsWithStudentsCount = $groups->where('etudiants_count', '>', 0)->count();

        $totalStudents = $groups->sum('etudiants_count');

        return view('prof.dashboard', [
            'groups' => $groups,
            'subjects' => $subjects,
            'totalStudents' => $totalStudents,
            'pendingGrades' => $groupsWithStudentsCount, // reuse the old variable to avoid changing the Blade
        ]);
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
            'grade2' => 'required|integer|min:0|max:20',
        ],
        [
            'etudiant_id.required' => 'Veuillez renseigner l\'id de l\'etudiant',
            'subject_id.required' => 'Veuillez renseigner l\'id du sujet',
            'grade.required' => 'Veuillez renseigner le grade',
            'grade.min' => 'Le grade doit être compris entre 0 et 20',
            'grade.max' => 'Le grade doit être compris entre 0 et 20',
            'grade2.required' => 'Veuillez renseigner le grade2',
            'grade2.min' => 'Le grade2 doit être compris entre 0 et 20',
            'grade2.max' => 'Le grade2 doit être compris entre 0 et 20',
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
                'grade2' => $request->grade2,
            ]
        );

        return redirect()->back()->with('success', 'Grade assigned successfully');
    }

    public function viewGroups()
    {
        $prof = Auth::guard('prof')->user();
        $groups = $prof->groups()->with('etudiants')->get();
        return view('prof.groups', compact('groups'));
    }

    public function viewStudents($group_id)
{
    $group = Group::with('subjects')->findOrFail($group_id);

    return view('prof.view-students', compact('group'));
}





    public function saveGrades(Request $request, Group $group)
    {
        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'grades' => 'required|array',
            'grades2' => 'required|array',
            'grades.*' => 'nullable|numeric|min:0|max:20',
        ]);

        $prof = Auth::guard('prof')->user();

        foreach ($request->grades as $studentId => $gradeValue) {
            $grade2Value = $request->grades2[$studentId] ?? null;
            
            if ($gradeValue !== null && $grade2Value !== null) {
                Grade::updateOrCreate(
                    [
                        'etudiant_id' => $studentId,
                        'prof_id' => $prof->id,
                        'subject_id' => $request->subject_id
                    ],
                    [
                        'grade' => $gradeValue,
                        'grade2' => $grade2Value, 
                    ]
                );
            }
        }
        

        return redirect()->route('prof.groups')->with('success', 'Grades saved successfully.');
    }

    public function index()
    {
        $professors = Prof::all();
        return view('admin.professors.index', compact('professors'));
    }

    public function edit($id)
    {
        $professor = Prof::findOrFail($id);
        return view('admin.professors.edit', compact('professor'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:profs,email,' . $id,
        ]);

        $professor = Prof::findOrFail($id);
        $professor->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.professors')->with('success', 'Professor updated successfully!');
    }

    public function destroy($id)
    {
        $professor = Prof::findOrFail($id);
        $professor->delete();

        return redirect()->route('admin.professors')->with('success', 'Professor deleted successfully!');
    }



}

