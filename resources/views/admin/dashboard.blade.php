@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

<style>
    body {
        background-color: #fff;
    }

    .stats-container {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 20px;
        margin: 40px auto;
        max-width: 1200px;
    }

    .stat-box {
        background-color: #f1f1f1;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 20px;
        border-radius: 12px;
        text-align: center;
        min-width: 250px;
        color: #333;
        font-weight: 600;
        box-shadow: 0px 6px 12px 3px rgba(11, 11, 11, 0.3);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .stat-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    }

    .stat-icon {
        font-size: 40px;
        margin-bottom: 10px;
        color: #007bff;
    }

    #statsChart {
        background: #fff;
        border-radius: 12px;
        padding: 20px;
        margin: 30px auto;
        width: 80%;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .recent-activities {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        margin-top: 40px;
    }

    .recent-activities h5 {
        font-size: 1.2rem;
        margin-bottom: 10px;
    }

    .recent-activities ul {
        list-style-type: none;
        padding-left: 0;
    }

    .recent-activities ul li {
        font-size: 1rem;
        margin-bottom: 8px;
    }

    .quick-actions {
        margin-top: 40px;
        display: flex;
        gap: 20px;
        justify-content: center;
    }

    .quick-actions a {
        padding: 10px 20px;
        font-size: 1rem;
        border-radius: 5px;
        text-align: center;
        color: white;
        background-color: #007bff;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .quick-actions a:hover {
        background-color: #0056b3;
    }

    .search-bar {
        margin-top: 40px;
        display: flex;
        justify-content: center;
        gap: 10px;
    }

    .search-bar input {
        width: 300px;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ddd;
    }

    .search-bar button {
        padding: 10px 15px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
    }

    @media screen and (max-width: 768px) {
        .stats-container {
            flex-direction: column;
            align-items: center;
        }

        .stat-box {
            width: 90%;
        }

        #statsChart {
            width: 90%;
        }

        .quick-actions {
            flex-direction: column;
        }
    }
</style>


<div class="container text-center mt-5">
    <h1 class="text-primary font-weight-bold">
        {{ __('dashboard.welcome', ['name' => Auth::guard('admin')->user()->name]) }}
    </h1>
    <p class="font-weight-bold">{{ __('dashboard.logged_in_as') }}</p>
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


<div class="stats-container">
    <div class="stat-box" onclick="window.location='{{ route('admin.professors') }}'">
        <i class="fas fa-chalkboard-teacher stat-icon"></i>
        <p>{{ __('dashboard.total_professors') }}: {{ $totalProfs }}</p>
    </div>
    <div class="stat-box" onclick="window.location='{{ route('admins.show') }}'">
        <i class="fas fa-user-shield stat-icon"></i>
        <p>{{ __('dashboard.total_admins') }}: {{ $totalAdmins }}</p>
    </div>
    <div class="stat-box" onclick="window.location='{{ route('admin.students.show') }}'">
        <i class="fas fa-user-graduate stat-icon"></i>
        <p>{{ __('dashboard.total_students') }}: {{ $totalEtudiants }}</p>
    </div>
    <div class="stat-box" onclick="window.location='{{ route('admin.groups.index') }}'">
        <i class="fas fa-users stat-icon"></i>
        <p>{{ __('dashboard.total_groups') }}: {{ $totalGroups }}</p>
    </div>
    <div class="stat-box" onclick="window.location='{{ route('admin.subjects.index') }}'">
        <i class="fas fa-book stat-icon"></i>
        <p>{{ __('dashboard.total_subjects') }}: {{ $totalSubjects }}</p>
    </div>
</div>



<canvas id="statsChart" width="400" height="200"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('statsChart').getContext('2d');
    var statsChart = new Chart(ctx, {
        type: 'line', 
        data: {
            labels: [
                '{{ __("dashboard.chart_students") }}',
                '{{ __("dashboard.chart_professors") }}',
                '{{ __("dashboard.chart_admins") }}',
                '{{ __("dashboard.chart_groups") }}',
                '{{ __("dashboard.chart_subjects") }}',
            ],
            datasets: [{
                label: '{{ __('dashboard.chart_label') }}',
                data: [{{ $totalEtudiants }}, {{ $totalProfs }}, {{ $totalAdmins }}, {{ $totalGroups }}, {{ $totalSubjects }}],
                backgroundColor: 'rgba(0, 123, 255, 0.2)', 
                borderColor: '#007bff',
                borderWidth: 2,
                fill: true,
                tension: 0.4, 
                pointBackgroundColor: '#007bff',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: '#007bff'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#333',
                    titleColor: '#fff',
                    bodyColor: '#fff'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#333',
                        font: { size: 14 }
                    },
                    grid: {
                        color: '#e4e4e4'
                    }
                },
                x: {
                    ticks: {
                        color: '#333',
                        font: { size: 14 }
                    },
                    grid: {
                        color: '#e4e4e4'
                    }
                }
            }
        }
    });
</script>

@endsection
