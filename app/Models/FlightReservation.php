<?php

namespace App\Models;

use App\Enums\SeatSection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FlightReservation extends Model
{
    protected $table = 'flight_reservations';

    protected $casts = [
        'seat_section' => SeatSection::class,
    ];

    protected $fillable = [
        'flight_id',
        'passenger_passport_id',
        'seat',
    ];

    protected $with = [
        'flight',
        'flight.arrival_airport',
        'flight.departure_airport',
    ];

    public function flight(): BelongsTo
    {
        return $this->belongsTo(Flight::class, 'flight_id');
    }
}
