@extends('layouts.app')

@section('content')
<div class="container">
    <h1>My Reservations</h1>

    @if (session('message'))
    <div class="alert alert-info">
        {{ session('message') }}
    </div>
    @endif

    @if ($reservations->isEmpty())
    <p>You have no reservations.</p>
    @else
    <table class="table">
        <thead>
            <tr>
                <th>Room</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $reservation)
            <tr>
                <td>{{ $reservation->room->room_title }}</td>
                <td>{{ $reservation->start_date }}</td>
                <td>{{ $reservation->end_date }}</td>
                <td>{{ ucfirst($reservation->status) }}</td>
                <td>
                    @if (Carbon\Carbon::parse($reservation->start_date)->diffInDays(Carbon\Carbon::now()) >= 1)
                    <form action="{{ route('cancel_reservation', $reservation->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Cancel</button>
                    </form>
                    @else
                    <span class="text-muted">Cannot cancel</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection