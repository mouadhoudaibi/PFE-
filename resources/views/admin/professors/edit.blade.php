@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ __('editeProf.edit_title') }}</h2>
    <form action="{{ route('admin.professors.update', $professor->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>{{ __('editeProf.name') }}</label>
            <input type="text" name="name" class="form-control" value="{{ $professor->name }}">
        </div>
        <div class="mb-3">
            <label>{{ __('editeProf.email') }}</label>
            <input type="email" name="email" class="form-control" value="{{ $professor->email }}">
        </div>
        <div class="mb-3">
            <label>{{ __('editeProf.password') }}</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="mb-3">
            <label>{{ __('editeProf.confirm_password') }}</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">{{ __('editeProf.update_button') }}</button>
    </form>
</div>
@endsection
