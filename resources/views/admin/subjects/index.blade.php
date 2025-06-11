@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="">
        <div class="col-md-8">
        <h2>{{ __('listSubject.all_subjects') }}</h2>
        <a href="{{ route('admin.createSubject') }}" class="btn btn-primary">{{ __('listSubject.create_subject') }}</a>
        </div>
        
    </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>{{ __('listSubject.nr') }}</th>
                    <th>{{ __('listSubject.name') }}</th>
                    <th>{{ __('listSubject.coefficient') }}                </th>
                    <th>{{ __('listSubject.edit') }}</th>
                    <th>{{ __('listSubject.delete') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subjects as $subject)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $subject->name }}</td>
                    <td>{{ $subject->coefficient }}</td>
                    <td>
                        <!-- Modifier (Edit) Button -->
                        <a href="{{ route('admin.subjects.edit', $subject->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> {{ __('listSubject.edit') }}
                        </a>
                    </td>
                    <td>

                        <!-- Supprimer (Delete) Button -->
                        <form action="{{ route('admin.subjects.delete', $subject->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">
                                <i class="fas fa-trash"></i> {{ __('listSubject.delete') }}
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    @endsection
