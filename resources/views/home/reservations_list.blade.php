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
                            <td>{{ $reservation->start_date->format('Y-m-d H:i') }}</td>
                            <td>{{ $reservation->end_date->format('Y-m-d H:i') }}</td>
                            <td>{{ ucfirst($reservation->status) }}</td>
                            <td>
                                @if ($reservation->is_cancellable)
                                    <form action="{{ url('cancel_reservation', $reservation->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Cancel Reservation</button>
                                    </form>
                                @else
                                    <p style="color: red;">You cannot cancel this reservation (less than 24 hours remaining).
                                    </p>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('reservation.details', $reservation->id) }}"
                                    class="btn btn-primary">Details</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
