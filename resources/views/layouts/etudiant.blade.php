<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Bootstrap & Font Awesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
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

        .sidebar a, .sidebar button {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #000;
            margin-bottom: 15px;
            font-size: 18px;
            font-weight: bold;
            background: none;
            border: none;
            width: 100%;
            text-align: left;
        }

        .sidebar a:hover, .sidebar button:hover {
            background-color: #dcdcdc;
            color: #000;
        }
        .sidebar .active {
            background-color: #dcdcdc;
            color: #000;
        }

        /* Content styles */
        .content {
            margin-left: 20%;
            padding: 20px;
        }

        /* Navbar styles */
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
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="{{ route('etudiant.dashboard') }}" class="sidebar-link {{ Request::is('etudiant/dashboard') ? 'active' : '' }} "><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="#"><i class="fas fa-book"></i> Your Courses</a>
        <!-- Your Group view all student in the same group -->
         <a href="{{ route('etudiant.group') }}" class="sidebar-link {{ Request::is('etudiant/group') ? 'active' : '' }} "><i class="fas fa-users"></i> Your Group</a>
        <a href="{{ route('student.grades') }}" class="sidebar-link {{ Request::is('etudiant/grades') ? 'active' : '' }}"><i class="fas fa-graduation-cap"></i> Your Grades</a>
        <a href="{{ route('etudiant.assignments') }}" class="sidebar-link {{ Request::is('etudiant/assignments') ? 'active' : '' }}"><i class="fas fa-tasks"></i> Assignments</a>

        <form action="{{ route('etudiant.logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>

    <!-- Main Content -->
    <div class="content">
        <nav class="navbar d-flex justify-content-between">
            <span class="navbar-brand">Etudiant Dashboard</span>
            <div class="d-flex align-items-center">
                <span class="user-info">
                    <i class="fas fa-user"></i> {{ Auth::guard('etudiant')->user()->name }}
                </span>
            </div>
        </nav>

        <div class="container mt-4">
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
