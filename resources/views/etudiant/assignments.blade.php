@extends('layouts.etudiant')

@section('title', __('assignments.title'))

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">{{ __('assignments.header') }}</h1>

    @if($subjects->isEmpty())
        <p class="alert alert-warning">{{ __('assignments.no_subjects') }}</p>
    @else
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>{{ __('assignments.subject') }}</th>
                    <th>{{ __('assignments.professors') }}</th>
                    <th>{{ __('assignments.coefficient') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subjects as $subject)
                    <tr>
                        <td>{{ $subject->name }}</td>
                        <td>{{ $subject->profs->pluck('name')->unique()->join(', ') }}</td>
                        <td>{{ $subject->coefficient }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('etudiant.dashboard') }}" class="btn btn-secondary mt-4">
        {{ __('assignments.back') }}
    </a>
</div>
@endsection

