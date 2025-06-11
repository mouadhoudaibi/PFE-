@extends('layouts.app')

@section('title', 'Admin Profile')

@section('content')
<div class="container mt-5">
    <h2 class="text-center">{{ __('Profile.title') }}</h2>

    <div class="card p-4 shadow text-center">
        <div class="admin-initial mb-3 mx-auto">
            {{ strtoupper(substr($admin->name, 0, 1)) }}
        </div>

        <table class="table">
            <tr>
                <th>{{ __('Profile.name') }}:</th>
                <td>{{ $admin->name }}</td>
            </tr>
            <tr>
                <th>{{ __('Profile.email') }}:</th>
                <td>{{ $admin->email }}</td>
            </tr>
            <tr>
                <th>{{ __('Profile.joined_at') }}:</th>
                <td>{{ $admin->created_at->format('d M Y') }}</td>
            </tr>
        </table>

        <div class="text-center mt-3">
            <a href="{{ route('admin.edit-profile') }}" class="btn btn-primary">{{ __('Profile.edit_button') }}</a>
        </div>
    </div>
</div>

<style>
.admin-initial {
    width: 64px;
    height: 64px;
    line-height: 64px;
    background-color: #fff;
    color: #000;
    font-weight: 700;
    font-size: 32px;
    border-radius: 50%;
    user-select: none;
    border: 2px solid #000;
    display: inline-block;
    text-align: center;
}
</style>
@endsection
