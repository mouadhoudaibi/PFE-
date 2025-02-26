@extends('layouts.etudiant')

@section('title', 'Your Group')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Your Group: <strong>{{ $group->name }}</strong></h1>

    <p class="lead">Total Students in This Group: <strong>{{ $group->etudiants->count() }}</strong></p>

    @if($group->etudiants->isEmpty())
        <p class="alert alert-warning">No students in this group.</p>
    @else
        <!-- Table of Students -->
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Nr</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($group->etudiants as $student)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('etudiant.dashboard') }}" class="btn btn-secondary mt-4">
        <i class="fas fa-arrow-left"></i> Back to Dashboard
    </a>
</div>
@endsection
