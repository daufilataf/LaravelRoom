<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Booking extends Model
{
    public function getIsCancellableAttribute()
    {
        $currentTime = Carbon::now('UTC');
        $startTime = Carbon::parse($this->start_date, 'UTC');

        $hoursDifference = $currentTime->diffInHours($startTime, false);

        return $hoursDifference >= 24;
    }

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

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'guest_list_emails' => 'array',
    ];


    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}