<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
@extends('layouts.app')

@section('title', 'Assign Professor to Subject')

@section('content')
    <h2>Assign Professor to Subject</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.storeProfSubject') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="prof_id" class="form-label">Select Professor</label>
            <select name="prof_id" id="prof_id" class="form-control" required>
                @foreach($profs as $prof)
                    <option value="{{ $prof->id }}">{{ $prof->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="subject_id" class="form-label">Select Subject</label>
            <select name="subject_id" id="subject_id" class="form-control" required>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Assign</button>
    </form>
@endsection


</body>
</html>