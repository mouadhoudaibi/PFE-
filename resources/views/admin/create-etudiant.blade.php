@extends('layouts.app')
@section('title', __('createstudent.title'))

@section('content')
<div class="container">
    <h2>{{ __('createstudent.heading') }}</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ __('createstudent.success') }}
        </div>
    @endif

    <form action="{{ route('admin.create-etudiant') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">{{ __('createstudent.name') }}</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">{{ __('createstudent.email') }}</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">{{ __('createstudent.password') }}</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">{{ __('createstudent.confirm_password') }}</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="group_id" class="form-label">{{ __('createstudent.select_group') }}</label>
            <select name="group_id" class="form-control" required>
                @foreach($groups as $group)
                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="bac_file" class="form-label">{{ __('createstudent.bac_file') }}</label>
            <input type="file" name="bac_file" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
        </div>

        <div class="mb-3">
            <label for="releve_file" class="form-label">{{ __('createstudent.releve_file') }}</label>
            <input type="file" name="releve_file" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
        </div>

        <button type="submit" class="btn btn-primary">{{ __('createstudent.submit') }}</button>
    </form>
</div>
@endsection
