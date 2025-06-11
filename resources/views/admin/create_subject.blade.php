@extends('layouts.app')
@section('title', 'Create Subject')

@section('content')

        <div class="container mt-4">
            <div class="form-container">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('admin.storeSubject') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('Subject.subject_name') }}</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                         <label for="coefficient" class="form-label">{{ __('Subject.coefficient') }}</label>
                         <input type="number" class="form-control" id="coefficient" name="coefficient" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">{{ __('Subject.create_button') }}</button>
                </form>
            </div>
        </div>

         <div class="container mt-5">
            <div class="form-container">
                <a href="{{ route('admin.subjects.index') }}" class="btn btn-primary w-20">{{ __('Subject.view_all_subjects') }}</a>
            </div>
         </div>

@endsection
