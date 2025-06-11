@extends('layouts.app')

@section('title', __('group.students_in', ['group' => $group->name]))

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-white text-dark d-flex justify-content-between">
            <h4 class="mb-0">{{ __('group.student_list') }} {{ $group->name }}  </h4>
            <a href="{{ route('admin.groups.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> {{ __('group.back_to_groups') }}
            </a>
        </div>

        <div class="card-body">
            @if($students->isEmpty())
                <div class="alert alert-warning text-center">
                    {{ __('group.no_students') }} 

                
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>{{ __('group.nr') }}</th>
                                <th>{{ __('group.name') }}</th>
                                <th>{{ __('group.email') }}</th>
                                <th>{{ __('group.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->email }}</td>
                                <td>
                                    <!-- Edit Button -->
                                    <a href="{{ route('admin.editStudent', $student->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> {{ __('group.edit') }}
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.deleteStudent', $student->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('group.confirm_delete_account') }}');">
                                            <i class="fas fa-trash"></i> {{ __('group.delete_account') }}
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
