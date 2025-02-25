@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="container">
    <h1>My Profile</h1>
    <p>Name: {{ $etudiant->name }}</p>
    <p>Email: {{ $etudiant->email }}</p>
    <!-- Add more profile details here -->
</div>
@endsection
