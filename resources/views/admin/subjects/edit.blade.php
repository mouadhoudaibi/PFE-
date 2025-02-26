@extends('layouts.app')

@section('title', 'Edit Subject')

@section('content')
<div class="container mt-5">
    <h2>Edit Subject</h2>

    <form action="{{ route('admin.subjects.update', $subject->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Subject Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $subject->name }}" required>
        </div>
        <!-- coifficient -->
        <div class="mb-3">
            <label for="coifficient" class="form-label">Coifficient:</label>
            <input type="number" class="form-control" id="coefficient" name="coefficient" value="{{ $subject->coefficient }}" required>
        </div>


        <button type="submit" class="btn btn-success">Update Subject</button>
        <a href="{{ route('admin.subjects.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
