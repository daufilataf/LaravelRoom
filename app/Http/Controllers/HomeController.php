<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;


use Carbon\Carbon;



class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function room_details($id)
    {
        $room = Room::find($id);

        return view('home.room_details', compact('room'));
    }

    public function add_booking(Request $request, $id)
    {
        $request->validate([
            'startDate' => 'required|date_format:Y-m-d\TH:i',
            'endDate' => 'required|date_format:Y-m-d\TH:i|after:startDate',
            'size' => 'required|integer|min:1',
            'guest' => 'required'
        ]);

        $room = Room::find($id);
        if (!$room) {
            return redirect()->back()->with('message', 'Room not found');
        }

        $guestEmails = array_map('trim', explode(',', $request->guest));
        $guestEmailCount = count($guestEmails);

        if ($request->size > $room->size) {
            return redirect()->back()->with('message', 'The number of guests exceeds the room capacity.');
        }

        if ($guestEmailCount > $room->size) {
            return redirect()->back()->with('message', 'The number of guest emails exceeds the room capacity.');
        }

        $data = new Booking;
        $data->room_id = $id;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->guest_list_emails = json_encode($guestEmails);
        $data->size = $request->size;
        $data->start_date = $request->startDate;
        $data->end_date = $request->endDate;

        $isBooked = Booking::where('room_id', $id)
            ->where('start_date', '<=', $request->endDate)
            ->where('end_date', '>=', $request->startDate)
            ->exists();

        if ($isBooked) {
            return redirect()->back()->with('message', 'Room is already booked, please try a different date');
        }

        $data->save();
        return redirect()->back()->with('message', 'Room Booked Successfully! You will see the status \'Approved\' when your booking is accepted.');
    }

    public function myReservations()
    {
        $reservations = Booking::where('email', Auth::user()->email)->get();

        return view('home.my_reservations', compact('reservations'));
    }

    public function cancelReservation(Request $request, $id)
    {
        $booking = Booking::find($id);

        if (!$booking) {
            return redirect()->back()->with('message', 'Reservation not found.');
        }

        if ($booking->email !== Auth::user()->email) {
            return redirect()->back()->with('message', 'You are not authorized to cancel this reservation.');
        }

        $currentDate = Carbon::now();
        $startDate = Carbon::parse($booking->start_date);

        if ($startDate->diffInDays($currentDate) < 1) {
            return redirect()->back()->with('message', 'You cannot cancel a reservation with less than 1 day remaining.');
        }

        $booking->delete();

        return redirect()->back()->with('message', 'Reservation canceled successfully.');
    }

}

