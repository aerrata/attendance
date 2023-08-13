@extends('layouts.app')

@section('content')
<div class="card card-md">
    <div class="card-body text-center">
        <div class="card-title fw-bold">Attendance</div>
        <div class="text-secondary">List of attendees.</div>
    </div>
    <div class="card-body">
        <div class="row g-3">
            @forelse ($attendances as $attendance)
            <div class="col-6">
                <div class="row g-3 align-items-center">
                    <a href="#" class="col-auto">
                        <span class="avatar">
                            <i class="ti ti-mood-smile icon"></i>
                        </span>
                    </a>
                    <div class="col text-truncate">
                        <div class="d-block text-truncate">{{ $attendance->user->name }}</div>
                        <div class="text-secondary text-truncate mt-n1">{{ $attendance->user->email }}</div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                Nothing found 🤷🏻‍♂️
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection