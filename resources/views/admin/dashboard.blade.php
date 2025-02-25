@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')

    <style>
        /* Stats Section */
        .stats-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            margin: 40px auto;
            max-width: 900px;
        }

        .stat-box {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            min-width: 250px;
            color: white;
            font-weight: bold;
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.1);
        }

        /* Unique Colors */
        .professor { background-color: #007bff; }
        .admin { background-color: #28a745; }
        .student { background-color: #ff5733; }
        .groups { background-color: #6c757d; }
        .Subjects { background-color: #ffc107; }

        /* Icons */
        .stat-icon {
            font-size: 40px;
            margin-bottom: 10px;
        }
    </style>

    <!-- Welcome Message -->
    <div class="container text-center mt-5">
        <h1 class="text-primary font-weight-bold">Welcome, {{ Auth::guard('admin')->user()->name }}!</h1>
        <p class="font-weight-bold">You are logged in as an admin.</p>
    </div>

    @php
        use App\Models\Prof;
        use App\Models\Admin;
        use App\Models\Etudiant;
        use App\Models\Group;
        use App\Models\Subject;

        $totalProfs = Prof::count();
        $totalAdmins = Admin::count();
        $totalEtudiants = Etudiant::count();
        $totalGroups = Group::count();
        $totalSubjects = Subject::count();
    @endphp

    <!-- Stats Section -->
    <div class="stats-container d-flex justify-content-between mt-5">
        <div class="stat-box professor">
            <i class="fas fa-chalkboard-teacher stat-icon"></i>
            <p>Total Professors: {{ $totalProfs }}</p>
        </div>
        <div class="stat-box admin">
            <i class="fas fa-user-shield stat-icon"></i>
            <p>Total Admins: {{ $totalAdmins }}</p>
        </div>
        <div class="stat-box student">
            <i class="fas fa-user-graduate stat-icon"></i>
            <p>Total Students: {{ $totalEtudiants }}</p>
        </div>
        <div class="stat-box groups">
            <i class="fas fa-users stat-icon"></i>
            <p>Total Groups: {{ $totalGroups }}</p>
        </div>
        <div class="stat-box Subjects">
            <i class="fas fa-book stat-icon"></i>
            <p>Total Subjects: {{ $totalSubjects }}</p>
        </div>
    </div>

@endsection
