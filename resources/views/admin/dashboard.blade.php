<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>

    <!-- Bootstrap & Font Awesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        /* Sidebar Styling */
        .sidebar {
            height: 100%;
            width: 20%;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #f8f9fa;
            padding-top: 20px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }

        .sidebar a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #000;
            margin-bottom: 15px;
            font-size: 18px;
            font-weight: bold;
        }

        .sidebar a:hover {
            background-color: #007bff;
            color: white;
        }

        /* Sidebar - Profile and Logout/Edit */
        .sidebar .user-info,
        .sidebar .logout-btn {
            font-size: 16px;
            color: #000;
            padding: 10px;
        }

        .sidebar .user-info:hover,
        .sidebar .logout-btn:hover {
            background-color: #007bff;
            color: white;
        }

        /* Main Content Area Adjustments */
        .content {
            margin-left: 20%;
            padding: 20px;
        }

        /* Navbar Styling */
        .navbar {
            background-color: #343a40;
            padding: 15px;
            color: white;
        }

        .navbar-brand {
            color: white;
            font-size: 22px;
            font-weight: bold;
        }

        .user-info {
            color: white;
            font-size: 16px;
            margin-left: 10px;
            cursor: pointer;
        }

        .user-info img {
            border-radius: 50%;
            width: 35px;
            height: 35px;
            margin-right: 10px;
        }

        .logout-btn {
            color: white;
            font-weight: bold;
            padding: 8px 12px;
            border-radius: 5px;
            background-color: #dc3545;
            transition: 0.3s ease-in-out;
            border: none;
        }

        .logout-btn:hover {
            background-color: #c82333;
        }

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

        /* Buttons */
        .btn-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 30px;
        }

        .btn {
            display: flex;
            align-items: center;
            gap: 8px;
        }

    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="{{ route('admin.edit-profile') }}">
            <i class="fas fa-edit"></i> Edit Profile
        </a>
        <a href="{{ route('admin.createProfForm') }}">
            <i class="fas fa-user-plus"></i> Create a Professor
        </a>
        <a href="{{ route('admin.create-etudiant') }}">
            <i class="fas fa-user-graduate"></i> Create a Student
        </a>
        <a href="{{ route('admin.groups.index') }}">
            <i class="fas fa-users"></i> Manage Groups
        </a>
        <a href="{{ route('admin.createSubject') }}">
            <i class="fas fa-book"></i> Create Subject
        </a>
        <a href="{{ route('admin.assignProf') }}">
            <i class="fas fa-user-tie"></i> Assign Professor
        </a>
        <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>

    <!-- Main Content -->
    <div class="content">
        <!-- Navbar -->
        <nav class="navbar d-flex justify-content-between">
            <span class="navbar-brand">Admin Dashboard</span>
            <div class="d-flex align-items-center">
                <div class="dropdown">
                    <span class="user-info" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i>
                        
                        {{ Auth::guard('admin')->user()->name }}</i>
                    </span>
                </div>
            </div>
        </nav>

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

    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
