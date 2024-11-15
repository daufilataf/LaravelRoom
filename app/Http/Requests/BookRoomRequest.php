<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRoomRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Change this to your authorization logic if needed
    }

    public function rules()
    {
        return [
            'room_id' => 'required|exists:rooms,id',
            'guests' => 'required|integer|min:1',
            'emails' => 'required|array',
            'emails.*' => 'required|email',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $room = \App\Models\Room::find($this->room_id);
            $guestCount = $this->guests;
            $emailCount = count($this->emails);

            if ($room) {
                if ($guestCount > $room->size) {
                    $validator->errors()->add('guests', 'The number of guests cannot exceed the room capacity.');
                }

                if ($emailCount > $room->size) {
                    $validator->errors()->add('emails', 'The number of emails cannot exceed the room capacity.');
                }
            }
        });
    }
}
