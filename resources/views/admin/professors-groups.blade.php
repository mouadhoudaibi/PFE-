@extends('layouts.app')
@section('title', 'Professors & Groups')

@section('content')
<!-- Main Content -->


    <div class="container mt-4">
        <table class="table table-bordered mt-3">
            <thead class="table-dark">
                <tr>
                    <th><i class="fas fa-user"></i> Professor</th>
                    <th><i class="fas fa-users"></i> Groups & Subjects</th>
                </tr>
            </thead>
            <tbody>
                @foreach($profs as $professor)
                <tr>
                    <td><strong><i class="fas fa-user-tie"></i> {{ $professor->name }}</strong></td>
                    <td>
                        @if($professor->groups->isEmpty())
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle"></i> No Groups Assigned
                            </div>
                        @else
                            <ul>
                                @foreach($professor->groups as $group)
                                <li>
                                    <strong><i class="fas fa-users"></i> {{ $group->name }}</strong>
                                    <ul>
                                        @php
                                            $professorSubjects = $professor->subjects->pluck('id')->toArray();
                                        @endphp
                                        @foreach($group->subjects as $subject)
                                            @if(in_array($subject->id, $professorSubjects))
                                                <li><i class="fas fa-book"></i> {{ $subject->name }}</li>
                                            @endif
                                        @endforeach

                                        @if($group->subjects->whereIn('id', $professorSubjects)->isEmpty())
                                            <li class="text-danger">
                                                <i class="fas fa-exclamation-circle"></i> No Assigned Subjects
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                                @endforeach
                            </ul>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


@endsection
