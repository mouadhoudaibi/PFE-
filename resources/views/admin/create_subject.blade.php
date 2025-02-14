<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    @extends('layouts.app')

    @section('title', 'Create Subject')

    @section('content')
    <div class="container mt-5">
        <h2>Create a New Subject</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.storeSubject') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Subject Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <button type="submit" class="btn btn-primary">Create Subject</button>
        </form>
    </div>
    @endsection


    
</body>
</html>