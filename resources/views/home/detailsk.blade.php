@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Reservation Details</h1>

        <div class="card">
            <div class="card-header">
                <h2>Room: {{ $reservation->room->room_title }}</h2>
            </div>
            <div class="card-body">
                <p><strong>Start Date:</strong> {{ $reservation->start_date->format('Y-m-d H:i') }}</p>
                <p><strong>End Date:</strong> {{ $reservation->end_date->format('Y-m-d H:i') }}</p>
                <p><strong>Status:</strong> {{ ucfirst($reservation->status) }}</p>
                <p><strong>Guest Emails:</strong></p>
                <ul>
                    @foreach ($reservation->guest_list_emails as $email)
                        <li>{{ $email }}</li>
                    @endforeach
                </ul>
                <p><strong>Booked By:</strong> {{ $reservation->name }} ({{ $reservation->email }})</p>
                <p><strong>Phone:</strong> {{ $reservation->phone }}</p>

                <a href="{{ route('my_reservations') }}" class="btn btn-secondary">Back to My Reservations</a>
            </div>
        </div>
    </div>
@endsection
