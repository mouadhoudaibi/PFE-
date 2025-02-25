@extends('layouts.app')

@section('title', 'Students in ' . $group->name)

@section('content')

    <!-- Main Content -->


        <div class="container mt-4">
            <div class="card shadow-lg">
                <div class="card-header bg-white text-dark d-flex justify-content-between">
                    <h4 class="mb-0">List of Students</h4>
                    <a href="{{ route('admin.groups.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Groups
                    </a>
                </div>

                <div class="card-body">
                    @if($students->isEmpty())
                        <div class="alert alert-warning text-center">No students assigned to this group.</div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th>Nr</th>
                                        <th>Nom</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($students as $student)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $student->name }}</td>
                                        <td>{{ $student->email }}</td>
                                        <td>
                                            <!-- Modifier Button -->
                                            <a href="{{ route('admin.editStudent', $student->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i> Modifier
                                            </a>

                                            <!-- Supprimer Button -->
                                            <form action="{{ route('admin.deleteStudent', $student->id) }}" method="POST" class="d-inline">
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
                    @endif
                </div>
            </div>
        </div>



@endsection