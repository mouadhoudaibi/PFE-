@extends('layouts.app')

@section('title', __('viewGradesForSubject.page_title'))

@section('content')
<div class="container py-4">
    <h2 class="mb-4">
        {{ __('viewGradesForSubject.heading', ['subject' => $subject->name, 'group' => $group->name]) }}
    </h2>

    @if ($students->count())
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>{{ __('viewGradesForSubject.student_name') }}</th>
                        <th>{{ __('viewGradesForSubject.grade_1') }}</th>
                        <th>{{ __('viewGradesForSubject.grade_2') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $student->name }}</td>
                            <td>{{ $grades[$student->id]->grade ?? __('viewGradesForSubject.not_graded') }}</td>
                            <td>{{ $grades[$student->id]->grade2 ?? __('viewGradesForSubject.not_graded') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info mt-4">
            {{ __('viewGradesForSubject.no_students') }}
        </div>
    @endif
</div>
@endsection
