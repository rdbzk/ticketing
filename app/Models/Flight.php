<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Flight extends Model
{
    protected $table = 'flights';

    protected $fillable = [
        'departure_at',
        'arrival_at',
        'flight_number',
        'from_airport_id',
        'to_airport_id',
    ];

    public function arrival_airport(): BelongsTo
    {
        return $this->belongsTo(Airport::class, 'arrival_airport_id');
    }

    public function departure_airport(): BelongsTo
    {
        return $this->belongsTo(Airport::class, 'departure_airport_id');
    }
}
