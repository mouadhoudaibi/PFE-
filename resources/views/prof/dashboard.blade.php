<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Prof</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        /* General reset and layout settings */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        /* Main wrapper */
        .prof-dashboard-wrapper {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* Sidebar */
        .sidebar {
            background-color: #f8f9fa;
            color: black;
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
            color: #000;
            margin-bottom: 30px;
            font-size: 24px;
            font-weight: bold;
        }

        .sidebar .nav {
            list-style: none;
            padding-left: 0;
        }

        .sidebar .nav-item {
            margin-bottom: 15px;
        }

        .sidebar .nav-link {
            color: #000;
            text-decoration: none;
            padding: 10px 20px;
            display: block;
            font-size: 18px;
            font-weight: bold;
        }

        .sidebar .nav-link:hover {
            background-color: #dcdcdc;
            color: black;
        }

        .sidebar .nav-link i {
            margin-right: 10px;
        }

        .sidebar .logout-btn {
            background-color: #dc3545;
            color: white;
            padding: 10px 20px;
            border: none;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 30px;
        }

        .sidebar .logout-btn:hover {
            background-color: #c82333;
        }

        /* Main content area */
        .content {
            margin-left: 250px;
            padding: 30px;
            width: 100%;
        }

        /* Top Navbar */
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

        .navbar-right .user-info {
            font-size: 16px;
        }

        /* Buttons */
        .view-btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            font-size: 16px;
            border-radius: 5px;
            margin-bottom: 30px;
            cursor: pointer;
        }

        .view-btn:hover {
            background-color: #0056b3;
        }

        /* Subjects list */
        .subjects {
            list-style-type: none;
            padding: 0;
            font-size: 18px;
        }

        .subjects li {
            margin: 10px 0;
            display: flex;
            align-items: center;
        }

        .subjects li i {
            margin-right: 10px;
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
                <form action="{{ route('prof.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>

    <!-- Main Content Area -->
    <div class="content">
        <!-- Top Navbar -->
        <div class="navbar">
            <div class="navbar-left">
                <h4><i class="fas fa-chalkboard-teacher"></i> Professor Dashboard</h4>
            </div>
            <div class="navbar-right">
                <span class="user-info"><i class="fas fa-user"></i>{{ Auth::guard('prof')->user()->name }} </span>
            </div>
        </div>

        <!-- Main Content -->
        <div class="container-fluid">
            <h1>Welcome, {{ Auth::guard('prof')->user()->name }} 👨‍🏫</h1>

            <a href="{{ route('prof.groups') }}" class="view-btn">
                <i class="fas fa-users"></i> View Groups You Teach
            </a>

            @if(isset($subjects) && !$subjects->isEmpty())
                <p>Here are the subjects you teach:</p>
                <ul class="subjects">
                    @foreach($subjects->unique('name') as $subject) 
                        <li><i class="fas fa-book"></i> {{ $subject->name }}</li>
                    @endforeach
                </ul>
            @else
                <p>You have not been assigned any subjects yet.</p>
            @endif


        </div>
    </div>
</div>

</body>
</html>
