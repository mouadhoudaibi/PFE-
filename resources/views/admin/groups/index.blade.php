<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Groups</title>

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
                <th>Nr</th>
                <th>Group Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($groups as $group)
            <tr>
                <td>{{ $loop-> iteration }}</td>
                <td>{{ $group->name }}</td>
                <td>
                    <a href="{{ route('admin.groups.students', $group->id) }}" class="btn btn-info">
                        <i class="fas fa-users"></i> View Students
                    </a>
                    
                    <form action="{{ route('admin.groups.destroy', $group->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this group?');">
                            Delete
                        </button>
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