@extends('layouts.app')

@section('title', __('allAdmins.page_title'))

@section('content')
<div class="container">
    <h1>{{ __('allAdmins.heading') }}</h1>
    <table class="table">
        <thead>
            <tr>
                <th>{{ __('allAdmins.nr') }}</th>
                <th>{{ __('allAdmins.name') }}</th>
                <th>{{ __('allAdmins.email') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($admins as $admin)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
