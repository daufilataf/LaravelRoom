<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Room;

use App\Models\Booking;


class HomeController extends Controller
{
    public function room_details($id)
    {
        $room = Room::find($id);

        return view('home.room_details', compact('room'));
    }

    public function add_booking(Request $request, $id)
    {
        // Validate input fields
        $request->validate([
            'startDate' => 'required|date',
            'endDate' => 'date|after:startDate',
            'size' => 'required|integer|min:1',
            'guest' => 'required'
        ]);

        $room = Room::find($id);
        if (!$room) {
            return redirect()->back()->with('message', 'Room not found');
        }

        $guestEmails = array_map('trim', explode(',', $request->guest));
        $guestEmailCount = count($guestEmails);

        // Check if the number of guests exceeds room capacity
        if ($request->size > $room->size) {
            return redirect()->back()->with('message', 'The number of guests exceeds the room capacity.');
        }

        // Check if the number of guest emails exceeds room capacity
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

        // Check if the room is already booked for the specified dates
        $isBooked = Booking::where('room_id', $id)
            ->where('start_date', '<=', $request->endDate)
            ->where('end_date', '>=', $request->startDate)
            ->exists();

        if ($isBooked) {
            return redirect()->back()->with('message', 'Room is already booked, please try a different date');
        }

        $data->save();
        return redirect()->back()->with('message', 'Room Booked Successfully! You will be informed when your booking is accepted.');
    }

}
