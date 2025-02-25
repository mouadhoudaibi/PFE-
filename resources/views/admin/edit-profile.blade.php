@extends('layouts.app')
@section('title', 'Edit Profile')

@section('content')
<style>
    input[type="password"] {
        outline: none;
        transition: border-color 0.3s ease;
    }
</style>

<form action="{{ route('admin.update-profile') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $admin->name) }}" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $admin->email) }}" required>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">New Password (optional)</label>
        <input type="password" id="password" onchange="checkPassword()" name="password" class="form-control">
    </div>

    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirm New Password</label>
        <input type="password" id="password_confirmation" onchange="checkPassword()" name="password_confirmation" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Update Profile</button>
</form>

<script>
    function checkPassword() {
        var password = document.getElementById("password");
        var confirmPassword = document.getElementById("password_confirmation");

        if (password.value !== confirmPassword.value && password.value !== "") {
            password.style.border = " 2px solid red";
            confirmPassword.style.border = " 2px solid red";
        } else {
            password.style.borderColor = "green";
            confirmPassword.style.borderColor = "green";
        }
    }
</script>

@endsection
