<!DOCTYPE html>
<html lang="{{ session('locale', 'en') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
       .sidebar {
           height: 100vh;
           width: 20%;
           position: fixed;
           top: 0;
           left: 0;
           background-color: #f8f9fa;
           padding-top: 20px;
           box-shadow: 2px 0 5px rgba(0,0,0,0.1);
           overflow-y: auto;
       }
       .sidebar::-webkit-scrollbar {
           width: 6px;
       }
       .sidebar::-webkit-scrollbar-thumb {
           background-color: rgba(0, 0, 0, 0.2);
           border-radius: 10px;
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
       .content {
           margin-left: 20%;
           padding: 20px;
       }
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
       .user-initial {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    background-color: #fff; 
    color: #000;
    border-radius: 50%;
    font-weight: bold;
    font-size: 18px;
    text-transform: uppercase;
    user-select: none;
}


       .dropdown-item.active {
           font-weight: bold;
           background-color: #007bff;
           color: white;
       }

       .dropdown-item:hover {
           background-color: #0056b3;
           color: white;
       }

       .fa-globe-americas {
           font-size: 0.85rem;
       }

       .logout-btn {
           background: none;
           border: none;
           color: #000;
           font-weight: bold;
           padding: 10px;
           width: 100%;
           text-align: left;
           cursor: pointer;
       }
       .logout-btn:hover {
           background-color: #dcdcdc;
       }
    </style>
</head>
<body>
<div class="sidebar">
    <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
        <i class="fas fa-tachometer-alt"></i> {{ __('navbar.dashboard') }}
    </a>
    <a href="{{ route('admin.profile') }}" class="nav-link {{ Request::is('admin/profile') ? 'active' : '' }}">
        <i class="fas fa-user-circle"></i> {{ __('navbar.view_profile') }}
    </a>
    <a href="{{ route('admin.edit-profile') }}" class="sidebar-link {{ Request::is('admin/edit-profile') ? 'active' : '' }}">
        <i class="fas fa-edit"></i> {{ __('navbar.edit_profile') }}
    </a>
    <a href="{{ route('admin.createProfForm') }}" class="sidebar-link {{ Request::is('admin/create-prof') ? 'active' : '' }}">
        <i class="fas fa-user-plus"></i> {{ __('navbar.create_professor') }}
    </a>
    <a href="{{ route('admin.create-etudiant') }}" class="sidebar-link {{ Request::is('admin/create-etudiant') ? 'active' : '' }}">
        <i class="fas fa-user-graduate"></i> {{ __('navbar.create_student') }}
    </a>
    <a href="{{ route('admin.groups.index') }}" class="sidebar-link {{ Request::is('admin/groups*') ? 'active' : '' }}">
        <i class="fas fa-users"></i> {{ __('navbar.manage_groups') }}
    </a>
    <a href="{{ route('admin.createSubject') }}" class="sidebar-link {{ Request::is('admin/subjects*') ? 'active' : '' }}">
        <i class="fas fa-book"></i> {{ __('navbar.create_subject') }}
    </a>
    <a href="{{ route('admin.assignProf') }}" class="sidebar-link {{ Request::is('admin/assign-prof') ? 'active' : '' }}">
        <i class="fas fa-user-tie"></i> {{ __('navbar.assign_professor') }}
    </a>
    <a href="{{ route('admin.professorsGroups') }}" class="sidebar-link {{ Request::is('admin/professors-groups') ? 'active' : '' }}">
        <i class="fas fa-chalkboard-teacher"></i> {{ __('navbar.professors_groups') }}
    </a>
    <a href="{{ route('admin.viewGrades') }}" class="sidebar-link {{ Request::is('admin/view-grades') ? 'active' : '' }}">
        <i class="fas fa-clipboard-list"></i> {{ __('navbar.view_grades') }}
    </a>



    <form action="{{ route('admin.logout') }}" method="POST">
        @csrf
        <button type="submit" class="logout-btn">
            <i class="fas fa-sign-out-alt"></i> {{ __('navbar.logout') }}
        </button>
    </form>
</div>

<div class="content">
    <nav class="navbar d-flex justify-content-between">
        <span class="navbar-brand">{{ __('navbar.admin_dashboard') }}</span>
        <div class="d-flex align-items-center">
<a href="{{ route('admin.profile') }}" class="user-info text-decoration-none text-white d-flex align-items-center">
    <span class="user-initial">{{ strtoupper(substr(Auth::guard('admin')->user()->name, 0, 1)) }}</span>
    <span class="ml-2">{{ Auth::guard('admin')->user()->name }}</span>
</a>


            <div class="ml-3">
                @php $locale = session('locale', 'en'); @endphp
                <div class="dropdown">
                    <button class="btn btn-outline-light btn-sm dropdown-toggle" type="button" id="languageDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Select Language">
                        {{ strtoupper($locale) }}
                        <i class="fas fa-globe-americas ml-1"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="languageDropdown">
                        <a class="dropdown-item {{ $locale == 'en' ? 'active' : '' }}" href="{{ route('lang.switch', 'en') }}">
                            {{ __('dashboard.language_en') }}
                        </a>
                        <a class="dropdown-item {{ $locale == 'fr' ? 'active' : '' }}" href="{{ route('lang.switch', 'fr') }}">
                            {{ __('dashboard.language_fr') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
