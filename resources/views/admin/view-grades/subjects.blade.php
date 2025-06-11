@extends('layouts.app')

@section('title', __('selectSubjectsForGroup.page_title'))

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">    {!! __('selectSubjectsForGroup.header', ['group' => '<span class="text-primary">' . $group->name . '</span>']) !!}</h2>
    </div>

    @if ($subjects->count())
        <div class="row g-4">
            @foreach ($subjects as $subject)
                <div class="col-sm-6 col-lg-4 mb-4">
                    <div class="card border-0 shadow-sm h-100 subject-card transition" style="border-radius: 12px;">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title fw-semibold text-dark">{{ $subject->name }}</h5>
                            <p class="text-muted small mb-3">{{ __('selectSubjectsForGroup.description') }}</p>
                            <a href="{{ route('admin.viewGrades.grades', ['group' => $group->id, 'subject' => $subject->id]) }}" class="btn btn-outline-primary mt-auto w-100">
                                {{ __('selectSubjectsForGroup.view_grades_button') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    @else
        <div class="alert alert-info text-center mt-5">
            {{ __('selectSubjectsForGroup.no_subjects') }}
        </div>
    @endif
</div>

<style>
    
    .subject-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }
</style>
@endsection
