<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'room_id',
        'name',
        'email',
        'phone',
        'guest_list_emails',
        'start_date',
        'end_date',
        'size',

    ];

    public function room()
    {
        return $this->hasOne('App\Models\Room', 'id', 'room_id');
        return $this->belongsTo(Room::class, 'room_id');


    }




}
