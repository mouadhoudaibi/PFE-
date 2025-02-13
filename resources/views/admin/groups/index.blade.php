<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create G>oups</title>

</head>
<body>

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Manage Groups</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.groups.create') }}" class="btn btn-primary">Create New Group</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Group Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($groups as $group)
            <tr>
                <td>{{ $group->id }}</td>
                <td>{{ $group->name }}</td>
                <td>
                    <form action="{{ route('admin.groups.destroy', $group->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

    
</body>
</html>