<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Prof</title>
</head>
<body>

@extends('layouts.app')

@section('title', 'Professor Dashboard')

@section('content')
    <h1>Welcome, {{ Auth::guard('prof')->user()->name }} 👨‍🏫</h1>
    <p>Here are the subjects you teach:</p>

    @if($subjects->isEmpty())
        <p>You have not been assigned any subjects yet.</p>
    @else
        <ul class="list-group">
            @foreach($subjects as $subject)
                <li class="list-group-item">
                    {{ $subject->name }}
                    <a href="{{ route('prof.students', $subject->id) }}" class="btn btn-sm btn-info float-end">View Students</a>
                </li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('prof.logout') }}" method="POST" class="mt-3">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
@endsection




    
</body>
</html>