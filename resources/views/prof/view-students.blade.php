@extends('layouts.prof')

@section('title', 'Students in ' . $group->name)

@section('content')

<style>
    table thead tr:hover {
        background-color: black;
    }
    select option {
        background-color: black;
        color: white;
    }
    select option:hover{
        background-color: white;
        color: black;
    }
</style>
<div class="container mt-5">
    <h1 class="mb-4">Students in <strong>{{ $group->name }}</strong></h1>

    <p class="lead">Number of students in this group: <strong>{{ $group->etudiants->count() }}</strong></p>

    @if($group->etudiants->isEmpty())
        <p class="alert alert-warning">No students in this group.</p>
    @else
        <form action="{{ route('prof.saveGrades', $group->id) }}" method="POST">
            @csrf

            <!-- Subject Selection -->
            <div class="form-group mb-4">
                <label for="subject_id" class="form-label">Select Subject:</label>
                <select name="subject_id" class="form-control" required>
                    @foreach($group->subjects as $subject)
                        @if($subject->profs->contains(Auth::guard('prof')->user()))
                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <!-- Students Table -->
            <div class="table-responsive">
                <table class="table table-hover custom-table">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">NR</th>
                            <th scope="col">Name</th>
                            <th scope="col" >Email</th>
                            <th scope="col" >Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($group->etudiants as $student)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->email }}</td>
                                <td>
                                    <input type="number" name="grades[{{ $student->id }}]" class="form-control grade-input" min="0" max="20" step="0.5">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Save Button -->
            <div class="text-end">
                <button type="submit" class="btn btn-success btn-lg"><i class="fas fa-save"></i> Save Grades</button>
            </div>
        </form>
    @endif

    <!-- Back to Groups Button -->
    <div class="mt-4">
        <a href="{{ route('prof.groups') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back to Groups</a>
    </div>
</div>
@endsection
