@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="">
        <div class="col-md-8">
        <h2>All Subjects</h2>
        <a href="{{ route('admin.createSubject') }}" class="btn btn-primary">Create New Subject</a>
        </div>
        
    </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Nr</th>
                    <th>Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subjects as $subject)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $subject->name }}</td>
                    <td>
                        <!-- Modifier (Edit) Button -->
                        <a href="{{ route('admin.subjects.edit', $subject->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Modifier
                        </a>
                    </td>
                    <td>

                        <!-- Supprimer (Delete) Button -->
                        <form action="{{ route('admin.subjects.delete', $subject->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">
                                <i class="fas fa-trash"></i> Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    @endsection
