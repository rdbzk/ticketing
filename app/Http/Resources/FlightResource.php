<?php

namespace App\Http\Resources;

use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Flight
 */
class FlightResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'               => $this->id,
            'departure_at'     => $this->departure_at,
            'arrival_at'       => $this->arrival_at,
            'departure_aiport' => $this->departure_airport->readable_name,
            'arrival_airport'  => $this->arrival_airport->readable_name,
        ];
    }
}
