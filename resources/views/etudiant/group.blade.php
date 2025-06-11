@extends('layouts.etudiant')

@section('title', 'Your Group')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">{{ __('group.group') }}: <strong>{{ $group->name }}</strong></h1>

    <p class="lead">{{ __('group.students_count') }} <strong>{{ $group->etudiants->count() }}</strong>  {{ __('group.students_count2') }}.</p>

    @if($group->etudiants->isEmpty())
        <p class="alert alert-warning">No students in this group.</p>
    @else
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>{{ __('group.nr') }}</th>
                    <th>{{ __('group.name') }}</th>
                    <th>{{ __('group.email') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($group->etudiants as $student)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('etudiant.dashboard') }}" class="btn btn-secondary mt-4">
        <i class="fas fa-arrow-left"></i> {{ __('group.back') }}
    </a>
</div>
@endsection
