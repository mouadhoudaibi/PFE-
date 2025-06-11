@extends('layouts.app')

@section('title', __('assignProf.title'))

@section('content')
<div class="container">
    <h2>{{ __('assignProf.heading') }}</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.storeAssignProf') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="prof_id" class="form-label">{{ __('assignProf.select_prof') }}</label>
            <select name="prof_id" id="prof_id" class="form-control" required>
                <option value="">{{ __('assignProf.choose_prof') }}</option>
                @foreach($profs as $prof)
                    <option value="{{ $prof->id }}">{{ $prof->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="subject_id" class="form-label">{{ __('assignProf.select_subject') }}</label>
            <select name="subject_id" id="subject_id" class="form-control" required>
                <option value="">{{ __('assignProf.choose_subject') }}</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="group_id" class="form-label">{{ __('assignProf.select_group') }}</label>
            <select name="group_id" id="group_id" class="form-control" required>
                <option value="">{{ __('assignProf.choose_group') }}</option>
                @foreach($groups as $group)
                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('assignProf.assign_button') }}</button>
    </form>
</div>
@endsection
