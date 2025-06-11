<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('group.manage_title') }}</title>

</head>
<body>

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ __('group.manage_title') }}</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.groups.create') }}" class="btn btn-primary">{{ __('group.create_button') }}</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>{{ __('group.table.number') }}</th>
                <th>{{ __('group.table.name') }}</th>
                <th>{{ __('group.table.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($groups as $group)
            <tr>
                <td>{{ $loop-> iteration }}</td>
                <td>{{ $group->name }}</td>
                <td>
                    <a href="{{ route('admin.groups.students', $group->id) }}" class="btn btn-info">
                        <i class="fas fa-users"></i> {{ __('group.view_students') }}
                    </a>
                    
                    <form action="{{ route('admin.groups.destroy', $group->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('{{ __('group.confirm_delete') }}');">
                            <i class="fas fa-trash-alt"></i> {{ __('group.delete') }}
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection


    
</body>
</html>