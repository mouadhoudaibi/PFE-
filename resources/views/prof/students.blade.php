<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    @extends('layouts.app')

    @section('title', 'Students List')

    @section('content')
        <h2>Students in this Subject</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <ul class="list-group">
            @foreach($students as $student)
                <li class="list-group-item">
                    {{ $student->name }}
                    <form action="{{ route('prof.assignGrade') }}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="etudiant_id" value="{{ $student->id }}">
                        <input type="hidden" name="subject_id" value="{{ $subject_id }}">
                        <input type="number" name="grade" class="form-control d-inline w-25" placeholder="Enter grade" required>
                        <button type="submit" class="btn btn-sm btn-success">Assign</button>
                    </form>
                </li>
            @endforeach
        </ul>

        <a href="{{ route('prof.dashboard') }}" class="btn btn-secondary mt-3">Back</a>
    @endsection

    
</body>
</html>