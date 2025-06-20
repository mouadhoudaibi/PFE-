<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('group.create_title') }}</title>
</head>
<body>

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ __('group.create_title') }}</h2>

    <form action="{{ route('admin.groups.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">{{ __('group.form.name_label') }}</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">{{ __('group.form.submit_button') }}</button>
    </form>
</div>
@endsection

    
</body>
</html>