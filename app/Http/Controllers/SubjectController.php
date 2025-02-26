<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectController extends Controller
{
    public function create()
    {
        return view('admin.create_subject');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:subjects|max:255',
            'coefficient' => 'required|numeric|between:0,10'

        ]);

        Subject::create([
            'name' => $request->name,
            'coefficient' => $request->coefficient
        ]);

        return redirect()->back()->with('success', 'Subject created successfully!');
    }
}


