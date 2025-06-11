@extends('layouts.app')

@section('title', __('editeSubject.edit_subject'))

@section('content')
<div class="container mt-5">
    <h2>{{ __('editeSubject.edit_subject') }}</h2>

    <form action="{{ route('admin.subjects.update', $subject->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">{{ __('editeSubject.subject_name') }}</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $subject->name }}" required>
        </div>

        <div class="mb-3">
            <label for="coefficient" class="form-label">{{ __('editeSubject.coefficient') }}</label>
            <input type="number" class="form-control" id="coefficient" name="coefficient" value="{{ $subject->coefficient }}" required>
        </div>

        <button type="submit" class="btn btn-success">{{ __('editeSubject.update_subject') }}</button>
        <a href="{{ route('admin.subjects.index') }}" class="btn btn-secondary">{{ __('editeSubject.cancel') }}</a>
    </form>
</div>
@endsection
