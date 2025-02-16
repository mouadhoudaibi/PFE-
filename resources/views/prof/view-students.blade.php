<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students in {{ $group->name }}</title>
    <!-- Link to Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

@extends('layouts.app')

@section('title', 'Students in ' . $group->name)

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Students in <strong>{{ $group->name }}</strong></h1>

    <!-- <h3 class="mb-3">Subjects you teach in this Group:</h3>
    <ul class="list-group mb-4">
        @foreach($group->subjects as $subject)
            @if($subject->profs->contains(Auth::guard('prof')->user()))
                <li class="list-group-item">{{ $subject->name }}</li>
            @endif
        @endforeach
    </ul> -->

    <!-- Display number of students in the group -->
    <p class="lead">Number of students in this group: <strong>{{ $group->etudiants->count() }}</strong></p>

    @if($group->etudiants->isEmpty())
        <p class="alert alert-warning">No students in this group.</p>
    @else
    <form action="{{ route('prof.saveGrades', $group->id) }}" method="POST">
    @csrf

    <label for="subject_id">Select Subject:</label>
    <select name="subject_id" class="form-control mb-3" required>
        @foreach($group->subjects as $subject)
            @if($subject->profs->contains(Auth::guard('prof')->user()))
                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
            @endif
        @endforeach
    </select>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Grade</th>
            </tr>
        </thead>
        <tbody>
            @foreach($group->etudiants as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>
                        <input type="number" name="grades[{{ $student->id }}]" class="form-control" min="0" max="20" step="0.5">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-success btn-lg">Save Grades</button>
    </div>
</form>

    @endif

    <a href="{{ route('prof.groups') }}" class="btn btn-secondary mt-4">Back to Groups</a>
</div>

<!-- Link to Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
