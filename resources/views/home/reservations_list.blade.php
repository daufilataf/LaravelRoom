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
                        <th></th>
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
                                <button class="btn btn-primary toggle-details"
                                    data-id="{{ $reservation->id }}">Details</button>
                            </td>
                        </tr>
                        <tr id="details-{{ $reservation->id }}" style="display: none;">
                            <td colspan="6">
                                <div class="reservation-details">
                                    <p><strong>Start Date:</strong> {{ $reservation->start_date->format('Y-m-d H:i') }}</p>
                                    <p><strong>End Date:</strong> {{ $reservation->end_date->format('Y-m-d H:i') }}</p>
                                    <p><strong>Status:</strong> {{ ucfirst($reservation->status) }}</p>
                                    <p><strong>Guest Emails:</strong></p>
                                    <ul>
                                        @foreach ($reservation->guest_list_emails as $email)
                                            <li>{{ $email }}</li>
                                        @endforeach
                                    </ul>
                                    <p><strong>Booked By:</strong> {{ $reservation->name }} ({{ $reservation->email }})
                                    </p>
                                    <p><strong>Phone:</strong> {{ $reservation->phone }}</p>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.toggle-details').forEach(function(button) {
                button.addEventListener('click', function() {
                    const detailsRow = document.getElementById(`details-${this.dataset.id}`);
                    if (detailsRow.style.display === 'none') {
                        detailsRow.style.display = 'table-row';
                    } else {
                        detailsRow.style.display = 'none';
                    }
                });
            });
        });
    </script>
@endsection
