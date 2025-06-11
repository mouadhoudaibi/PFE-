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
            display: inline-block;
            background-color: #fff;
            color: #000;
            width: 32px;
            height: 32px;
            text-align: center;
            border-radius: 50%;
            line-height: 32px;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <a href="{{ route('etudiant.dashboard') }}" class="{{ Request::is('etudiant/dashboard') ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt"></i> {{ __('layoutetudiant.dashboard') }}
        </a>
        <a href="{{ route('etudiant.group') }}" class="{{ Request::is('etudiant/group') ? 'active' : '' }}">
            <i class="fas fa-users"></i> {{ __('layoutetudiant.your_group') }}
        </a>
        <a href="{{ route('etudiant.grades') }}" class="{{ Request::is('etudiant/grades*') ? 'active' : '' }}">
            <i class="fas fa-graduation-cap"></i> {{ __('layoutetudiant.your_grades') }}
        </a>
        <a href="{{ route('etudiant.assignments') }}" class="{{ Request::is('etudiant/assignments') ? 'active' : '' }}">
            <i class="fas fa-tasks"></i> {{ __('layoutetudiant.assignments') }}
        </a>
        <form action="{{ route('etudiant.logout') }}" method="POST">
            @csrf
            <button type="submit">
                <i class="fas fa-sign-out-alt"></i> {{ __('layoutetudiant.logout') }}
            </button>
        </form>
    </div>

    <div class="content">
        <nav class="navbar d-flex justify-content-between">
            <span class="navbar-brand">{{ __('layoutetudiant.dashboard_title') }}</span>
            <div class="d-flex align-items-center">
                <!-- Profile Initial -->
                <a href="#" class="user-info text-decoration-none text-white d-flex align-items-center">
                    <span class="user-initial">
                        {{ strtoupper(substr(Auth::guard('etudiant')->user()->name, 0, 1)) }}
                    </span>
                    <span class="ml-2">{{ Auth::guard('etudiant')->user()->name }}</span>
                </a>

                @php $locale = session('locale', 'en'); @endphp
                <div class="ml-3">
                    <div class="dropdown">
                        <button class="btn btn-outline-light btn-sm dropdown-toggle" type="button" id="languageDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ strtoupper($locale) }} <i class="fas fa-globe-americas ml-1"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="languageDropdown">
                            <a class="dropdown-item {{ $locale == 'en' ? 'active' : '' }}" href="{{ route('lang.switch', 'en') }}">{{ __('layoutetudiant.language_en') }}</a>
                            <a class="dropdown-item {{ $locale == 'fr' ? 'active' : '' }}" href="{{ route('lang.switch', 'fr') }}">{{ __('layoutetudiant.language_fr') }}</a>
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
