<?php



namespace App\Http\Controllers;

use App\Models\ProfSubject;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Prof;
use App\Models\Etudiant;
use App\Models\Group;
use App\Models\Subject;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function showRegisterForm()
    {
        return view('admin.register');
    }

    public function register(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create admin
        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),  // Hash the password
        ]);

        // Log the admin in immediately
        Auth::guard('admin')->login($admin);

        // Redirect to the admin dashboard
        return redirect()->route('admin.dashboard');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function editProfile()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.edit-profile', compact('admin'));
    }

    public function updateProfile(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $admin->name = $request->name;
        $admin->email = $request->email;

        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return redirect()->route('admin.dashboard')->with('success', 'Profile updated successfully!');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }


    public function createProfForm()
    {
        return view('admin.createProf');  // Create the view for creating a professor
    }

    public function createProf(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:profs,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create the professor account
        $prof = Prof::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),  // Hash the password
        ]);

        // Optionally, you can log the professor in directly
        // Auth::guard('prof')->login($prof);

        // Redirect to the dashboard or a confirmation page
        return redirect()->route('admin.dashboard')->with('success', 'Professor account created!');
    }


    public function showCreateEtudiantForm()
    {
        $groups = Group::all(); // Fetch groups for dropdown
        return view('admin.create-etudiant', compact('groups'));
    }

    // Handle student creation
    public function createEtudiant(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:etudiants',
            'password' => 'required|min:6|confirmed',
            'group_id' => 'required|exists:groups,id'
        ]);

        Etudiant::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'group_id' => $request->group_id
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Student account created successfully!');
    }


    public function showAssignProfForm()
    {
        $profs = Prof::all();
        $subjects = Subject::all();
        $groups = Group::all();

        return view('admin.assign-prof', compact('profs', 'subjects', 'groups'));
    }

    public function storeAssignProf(Request $request)
    {
        $request->validate([
            'prof_id' => 'required|exists:profs,id',
            'subject_id' => 'required|exists:subjects,id',
            'group_id' => 'required|exists:groups,id',
        ]);

        // Insert into prof_subjects table
        ProfSubject::create([
            'prof_id' => $request->prof_id,
            'subject_id' => $request->subject_id,
            'group_id' => $request->group_id,
        ]);

        return redirect()->route('admin.assignProf')->with('success', 'Professor assigned successfully!');
    }

    public function viewProfessorsGroups()
    {
        $profs = Prof::with(['subjects.groups'])->get();

        return view('admin.professors-groups', compact('profs'));
    }
    public function viewStudents(Group $group)
    {
        $students = $group->etudiants; // Assuming a relationship exists in Group model
        return view('admin.groups.students', compact('group', 'students'));
    }
    // Show Edit Form
    public function editStudent($id)
    {
        $student = Etudiant::findOrFail($id);
        return view('admin.groups.editStudent', compact('student'));
    }

    // Update Student
    public function updateStudent(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:etudiants,email,'.$id,
        ]);

        $student = Etudiant::findOrFail($id);
        $student->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return Redirect::route('admin.groups.students', $student->group_id)->with('success', 'Student updated successfully!');
    }

    // Delete Student
    public function deleteStudent($id)
    {
        $student = Etudiant::findOrFail($id);
        $student->delete();

        return back()->with('success', 'Student deleted successfully!');
    }
    public function viewSubjects()
    {
        $subjects = Subject::all(); // Fetch all subjects
        return view('admin.subjects.index', compact('subjects'));
    }

    public function editSubject($id)
    {
        $subject = Subject::findOrFail($id);
        return view('admin.subjects.edit', compact('subject'));
    }
    
    public function updateSubject(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'coefficient' => 'required|numeric|between:0,10',
        ]);
    
        $subject = Subject::findOrFail($id);
        $subject->name = $request->name;
        $subject->coefficient = $request->coefficient;
        $subject->save();
    
        return redirect()->route('admin.subjects.index')->with('success', 'Subject updated successfully!');
    }
    
    public function deleteSubject($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();
    
        return redirect()->route('admin.subjects.index')->with('success', 'Subject deleted successfully!');
    }
    

    
}

