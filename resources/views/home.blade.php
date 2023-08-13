@extends('layouts.app')

@section('content')
<div class="card card-md">
    <div class="card-body">
        <div class="card-title fw-bold text-center">Home</div>
    </div>

    <div class="card-body">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif

        {{ __('You are logged in!') }}
    </div>
</div>
@endsection