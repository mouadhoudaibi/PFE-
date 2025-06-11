@extends('layouts.app')

@section('content')

<style>
    .notification {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #28a745;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        display: none;
        z-index: 9999;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        animation: fadeIn 1s forwards;
    }

    @keyframes fadeIn {
        0% { opacity: 0; transform: translateY(20px); }
        100% { opacity: 1; transform: translateY(0); }
    }

    .cancel-btn {
        cursor: pointer;
        color: white;
        font-size: 16px;
        margin-right: 10px;
    }

    .cancel-btn:hover {
        color: #ffdddd;
    }
</style>

<div class="container">
    <h2>{{ __('listProf.list_title') }}</h2>
    <table class="table">
        <thead>
            <tr>
                <th>{{ __('listProf.nr') }}</th>
                <th>{{ __('listProf.name') }}</th>
                <th>{{ __('listProf.email') }}</th>
                <th>{{ __('listProf.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($professors as $professor)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $professor->name }}</td>
                    <td>{{ $professor->email }}</td>
                    <td>
                        <a href="{{ route('admin.professors.edit', $professor->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        
                        <form action="{{ route('admin.professors.destroy', $professor->id) }}" method="POST" style="display:inline;" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('{{ __('listProf.confirm_delete') }}')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div id="deleteNotification" class="notification">
    <span id="cancelBtn" class="cancel-btn"><i class="fas fa-times"></i> {{ __('listProf.cancel') }}</span>
    <p>{{ __('listProf.item_deleted') }}</p>
</div>

@endsection
