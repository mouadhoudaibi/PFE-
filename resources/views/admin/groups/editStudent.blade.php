@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ __('EditeStudent.update_student') }}</h2>
    
    <form action="{{ route('admin.updateStudent', $student->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">{{ __('EditeStudent.name') }}</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $student->name }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">{{ __('EditeStudent.email') }}</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $student->email }}" required>
        </div>

        <div class="mb-3">
            <label for="group_id" class="form-label">{{ __('EditeStudent.group') }}</label>
            <select name="group_id" id="group_id" class="form-control" required>
                @foreach($groups as $group)
                    <option value="{{ $group->id }}" {{ $student->group_id == $group->id ? 'selected' : '' }}>
                        {{ $group->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('EditeStudent.current_bac_file') }}</label><br>
            @if($student->bac_file)
                <a href="{{ asset('storage/' . $student->bac_file) }}" target="_blank" class="btn btn-outline-primary btn-sm">{{ __('EditeStudent.view_current_file') }}</a>
            @else
                <span class="text-muted">{{ __('EditeStudent.no_file') }}</span>
            @endif
        </div>

        <div class="mb-3">
            <label for="bac_file" class="form-label">{{ __('EditeStudent.change_bac_file') }}</label>
            <input type="file" class="form-control" id="bac_file" name="bac_file" accept=".pdf,.jpg,.jpeg,.png">
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('EditeStudent.current_releve_file') }}</label><br>
            @if($student->releve_file)
                <a href="{{ asset('storage/' . $student->releve_file) }}" target="_blank" class="btn btn-outline-primary btn-sm">{{ __('EditeStudent.view_current_file') }}</a>
            @else
                <span class="text-muted">{{ __('EditeStudent.no_file') }}</span>
            @endif
        </div>

        <div class="mb-3">
            <label for="releve_file" class="form-label">{{ __('EditeStudent.change_releve_file') }}</label>
            <input type="file" class="form-control" id="releve_file" name="releve_file" accept=".pdf,.jpg,.jpeg,.png">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">{{ __('EditeStudent.password_optional') }}</label>
            <input type="password" onchange="checkPassword()" class="form-control" id="password" name="password">
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">{{ __('EditeStudent.confirm_password') }}</label>
            <input type="password" onchange="checkPassword()" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>

        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> {{ __('EditeStudent.save') }}</button>
        <a href="{{ route('admin.groups.students', $student->group_id) }}" class="btn btn-secondary">{{ __('EditeStudent.cancel') }}</a>
    </form>

    <script>
        function checkPassword() {
            var password = document.getElementById("password");
            var confirmPassword = document.getElementById("password_confirmation");

            if (password.value !== confirmPassword.value && password.value !== "") {
                password.style.border = "2px solid red";
                confirmPassword.style.border = "2px solid red";
            } else {
                password.style.borderColor = "green";
                confirmPassword.style.borderColor = "green";
            }
        }
    </script>
</div>
@endsection
