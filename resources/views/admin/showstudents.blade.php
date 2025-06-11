@extends('layouts.app')

@section('title', __('allStudents.page_title'))

@section('content')

<div class="container mt-4">
    <h1 class="text-primary text-center mb-4">{{ __('allStudents.heading') }}</h1>
    
    <div class="table-responsive">
        <table class="table table-hover shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>{{ __('allStudents.name') }}</th>
                    <th>{{ __('allStudents.group') }}</th>
                    <th>{{ __('allStudents.email') }}</th>
                    <th>{{ __('allStudents.registered') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->group->name ?? __('allStudents.no_group') }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->created_at->format('d M Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
