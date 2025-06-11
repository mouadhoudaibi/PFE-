@extends('layouts.app')

@section('title', __('groupSelectionForView.page_title'))

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">{{ __('groupSelectionForView.header') }}</h2>
    </div>

    @if ($groups->count())
        <div class="row g-4">
            @foreach ($groups as $group)
                <div class="col-sm-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100 group-card transition" style="border-radius: 12px;">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title fw-semibold text-primary">{{ $group->name }}</h5>
                            <p class="text-muted small mb-3">{{ __('groupSelectionForView.description') }}</p>
                            <a href="{{ route('admin.viewGrades.subjects', ['group' => $group->id]) }}" class="btn btn-outline-primary mt-auto w-100">
                                {{ __('groupSelectionForView.view_subjects_button') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info text-center mt-5">
            {{ __('groupSelectionForView.no_groups') }}
        </div>
    @endif
</div>

<style>
    .group-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }
</style>
@endsection
