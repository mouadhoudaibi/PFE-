@extends('layouts.app')
@section('title', __('profGroups.title'))

@section('content')

<style>
    .avatar-circle {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        background-color: #000;
        color: #fff;
        font-weight: bold;
        border-radius: 50%;
        width: 35px;
        height: 35px;
        text-transform: uppercase;
        margin-right: 10px;
        font-size: 16px;
    }
</style>

<div class="container mt-4">
    <div class="row">
        @foreach($profs as $professor)
            <div class="col-md-6">
                <div class="card shadow-sm mb-3">
                    <div class="card-body">
                        <h5 class="card-title d-flex justify-content-between align-items-center">
                            <span>
                                <span class="avatar-circle">{{ strtoupper(substr($professor->name, 0, 1)) }}</span>
                                {{ $professor->name }}
                            </span>
                            <button class="btn btn-sm btn-outline-primary toggle-groups" data-target="#groups{{ $professor->id }}">
                                <i class="fas fa-chevron-down"></i>
                            </button>
                        </h5>
                        <div id="groups{{ $professor->id }}" class="groups-list" style="display: none;">
                            @if($professor->groups->isEmpty())
                                <p class="text-warning"><i class="fas fa-exclamation-triangle"></i> {{ __('profGroups.no_groups') }}</p>
                            @else
                                @foreach($professor->groups as $group)
                                    <div class="mt-2 border rounded p-3 bg-light">
                                        <h6 class="d-flex justify-content-between align-items-center">
                                            <span><i class="fas fa-users"></i> {{ $group->name }}</span>
                                            <button class="btn btn-sm btn-outline-secondary toggle-subjects" data-target="#subjects{{ $professor->id }}-{{ $group->id }}">
                                                <i class="fas fa-chevron-down"></i>
                                            </button>
                                        </h6>
                                        <ul id="subjects{{ $professor->id }}-{{ $group->id }}" class="subjects-list mt-2 list-group" style="display: none;">
                                            @php
                                                $professorSubjects = $professor->subjects->pluck('id')->toArray();
                                            @endphp
                                            @foreach($group->subjects as $subject)
                                                @if(in_array($subject->id, $professorSubjects))
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        <span><i class="fas fa-book text-primary"></i> {{ $subject->name }}</span>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".toggle-groups").forEach(button => {
        button.addEventListener("click", function() {
            let target = document.querySelector(this.getAttribute("data-target"));
            if (target) {
                target.style.display = target.style.display === "none" ? "block" : "none";
                let icon = this.querySelector("i");
                icon.classList.toggle("fa-chevron-down");
                icon.classList.toggle("fa-chevron-up");
            }
        });
    });

    document.querySelectorAll(".toggle-subjects").forEach(button => {
        button.addEventListener("click", function() {
            let target = document.querySelector(this.getAttribute("data-target"));
            if (target) {
                target.style.display = target.style.display === "none" ? "block" : "none";
                let icon = this.querySelector("i");
                icon.classList.toggle("fa-chevron-down");
                icon.classList.toggle("fa-chevron-up");
            }
        });
    });
});
</script>

@endsection
