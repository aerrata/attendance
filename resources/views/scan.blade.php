@extends('layouts.app')

@section('content')
<div class="card card-md overflow-hidden">
    <div class="card-body text-center">
        <div class="card-title fw-bold">Register Attendees</div>
        <div class="text-secondary">Please scan the attendee QR code.</div>
    </div>
    <qr-code-scanner></qr-code-scanner>
</div>
@endsection