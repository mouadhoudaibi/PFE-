@extends('layouts.prof')
@section('title', 'Groups')

@section('content')

<style>
    a.back-btn {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        display: inline-block;
        margin-top: 20px;
    }
    a.back-btn:hover {
        background-color: #3e8e41;
        color: white;
    }
    a.btn-info {
        background-color:rgb(43, 162, 178);
        color: white;
        height: 35px;
        width: 170px;
        text-align: center;
        align-items: center;
        justify-content: center;
        border-radius: 5px;
        text-decoration: none;
        display: inline-block;
    }
</style>

<!-- Main Content Area -->

        <!-- Main Content -->
        <div class="container-fluid">
            <h1 class="mb-4">Groups You Teach</h1>
            
            @if($groups->isEmpty())
                <p>You are not assigned to any groups.</p>
            @else
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Group Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($groups->unique('id') as $group)
                            <tr>
                                <td>{{ $group->name }}</td>
                                <td>
                                    <a href="{{ route('prof.viewStudents', $group->id) }}" class="btn-info">
                                        <i class="fas fa-users"></i> View Students
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            <a href="{{ route('prof.dashboard') }}" class="back-btn">Back to Dashboard</a>
        </div>


@endsection