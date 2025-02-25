

@extends('layouts.etudiant')

@section('title', 'Your Assignments')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Your Subjects & Professors</h1>

    @if($subjects->isEmpty())
        <p class="alert alert-warning">You are not assigned to any subjects yet.</p>
    @else
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Subject</th>
                    <th>Professor(s)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subjects as $subject)
                    <tr>
                        <td>{{ $subject->name }}</td>
                        <td>{{ $subject->profs->pluck('name')->unique()->join(', ') }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('etudiant.dashboard') }}" class="btn btn-secondary mt-4">Back to Dashboard</a>
</div>
@endsection

    
