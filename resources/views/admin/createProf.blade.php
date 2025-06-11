@extends('layouts.app')
@section('title', __('createprofessor.title'))

@section('content')
<h2>{{ __('createprofessor.heading') }}</h2>

<form action="{{ route('admin.createProf') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">{{ __('createprofessor.name') }}</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('createprofessor.placeholder_name') }}" required>
    </div>
    
    <div class="mb-3">
        <label for="email" class="form-label">{{ __('createprofessor.email') }}</label>
        <input type="email" name="email" id="email" class="form-control" placeholder="{{ __('createprofessor.placeholder_email') }}" required>
    </div>
    
    <div class="mb-3">
        <label for="password" class="form-label">{{ __('createprofessor.password') }}</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('createprofessor.placeholder_password') }}" required>
    </div>
    
    <div class="mb-3">
        <label for="password_confirmation" class="form-label">{{ __('createprofessor.confirm_password') }}</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="{{ __('createprofessor.placeholder_confirm_password') }}" required>
    </div>
    
    <button type="submit" class="btn btn-primary">{{ __('createprofessor.submit') }}</button>
</form>

@if ($errors->any())
    <div class="alert alert-danger mt-3">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<script>
    document.getElementById('password').addEventListener('input', checkPassword);
    document.getElementById('password_confirmation').addEventListener('input', checkPassword);

    function checkPassword() {
        var password = document.getElementById('password');
        var confirmPassword = document.getElementById('password_confirmation');
        
        if (password.value !== confirmPassword.value) {
            confirmPassword.setCustomValidity('{{ __('createprofessor.error_mismatch') }}');
        } else {
            confirmPassword.setCustomValidity('');
        }
    }
</script>

@endsection
