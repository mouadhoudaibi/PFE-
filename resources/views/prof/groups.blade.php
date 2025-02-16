<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Groups You Teach</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* General reset and layout settings */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .prof-dashboard-wrapper {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* Sidebar */
        .sidebar {
            background-color: #f8f9fa;
            color: #000 !important  ;
            width: 250px;
            padding-top: 30px;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar h4 {
            text-align: center;
            color: #000 ;
            margin-bottom: 30px;
            font-size: 24px;
        }

        .sidebar .nav {
            list-style: none;
            padding-left: 0;
        }

        .sidebar .nav-item {
            margin-bottom: 15px;
        }

        .sidebar .nav-link {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #000;
            margin-bottom: 15px;
            font-size: 18px;
            font-weight: bold;
        }

        .sidebar .nav-link:hover {
            background-color: #007bff;
            color: white;
        }

        .sidebar .nav-link i {
            margin-right: 10px;
        }

        /* Main content area */
        .content {
            margin-left: 250px;
            padding: 30px;
            width: 100%;
        }

        /* Navbar */
        .navbar {
            display: flex;
            justify-content: space-between;
            background-color: #343a40;
            padding: 15px 30px;
            color: white;
        }

        .navbar-left {
            font-size: 20px;
        }

        .navbar-left a{
            text-decoration: none;
            color: white;
        }

        .navbar-left a:hover{
            color: white;
        }

        .navbar-right .user-info {
            font-size: 16px;
        }

        /* Table */
        .table {
            margin-top: 20px;
        }

        .table th, .table td {
            text-align: center;
        }

        .table td a {
            font-size: 16px;
            text-decoration: none;
            color: white;
        }

        .table td a:hover {
            background-color: #007bff;
        }

        /* Button Styles */
        .btn-info {
            background-color: #007bff;
            border-color: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn-info:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .back-btn {
            margin-top: 20px;
            background-color: #6c757d;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .back-btn:hover {
            background-color: #5a6268;
        }
        

    </style>
</head>
<body>

<!-- Full-width wrapper to override layout constraints -->
<div class="prof-dashboard-wrapper">
    <!-- Sidebar -->
    <div class="sidebar">
        <ul class="nav">
            <li class="nav-item">
                <a href="{{ route('prof.dashboard') }}" class="nav-link">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('prof.groups') }}" class="nav-link">
                    <i class="fas fa-users"></i> View Groups
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('prof.logout') }}" class="nav-link">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content Area -->
    <div class="content">
        <!-- Top Navbar -->
        <div class="navbar">
            <div class="navbar-left">
                <a href="#" class="navbar-brand">
                    <i class="fas fa-chalkboard-teacher"></i> Professor Dashboard
                </a>
            </div>
            <div class="navbar-right">
                <span class="user-info"><i class="fas fa-user"></i> {{ Auth::guard('prof')->user()->name }} </span>
            </div>
        </div>

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
    </div>
</div>

</body>
</html>
