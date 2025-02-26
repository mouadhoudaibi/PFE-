@extends('layouts.app')
@section('title', 'Create Subject')

@section('content')



    
        <!-- Form Section -->
        <div class="container mt-4">
            <div class="form-container">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('admin.storeSubject') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Subject Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                         <label for="coefficient" class="form-label">Coefficient:</label>
                         <input type="number" class="form-control" id="coefficient" name="coefficient" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Create Subject</button>
                </form>
            </div>
        </div>
        <!-- Link for view all subject -->
         <div class="container mt-5">
            <div class="form-container">
                <a href="{{ route('admin.subjects.index') }}" class="btn btn-primary w-20">View All Subject</a>
            </div>
         </div>

@endsection
