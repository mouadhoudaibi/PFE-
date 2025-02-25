@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Modifier Étudiant</h2>
    
    <form action="{{ route('admin.updateStudent', $student->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $student->name }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $student->email }}" required>
        </div>

         <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" onchange="checkPassword()" class="form-control" id="password" name="password" required>
         </div>

         <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
            <input type="password" onchange="checkPassword()" class="form-control" id="password_confirmation" name="password_confirmation" required>
         </div>

        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Enregistrer</button>
        <a href="{{ route('admin.groups.students', $student->group_id) }}" class="btn btn-secondary">Annuler</a>
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
</div>
@endsection
