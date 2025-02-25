@extends('layouts.app')
@section('title', 'Create Professor')

@section('content')
<h2>Create Professor Account</h2>

<form action="{{ route('admin.createProf') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Enter professor name" required>
    </div>
    
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control" placeholder="Enter professor email" required>
    </div>
    
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" required>
    </div>
    
    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm password" required>
    </div>
    
    <button type="submit" class="btn btn-primary">Create Professor</button>
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
            confirmPassword.setCustomValidity('Passwords do not match.');
        } else {
            confirmPassword.setCustomValidity('');
        }
    }
</script>

@endsection
