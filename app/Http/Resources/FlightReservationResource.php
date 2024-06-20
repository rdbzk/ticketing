<?php

namespace App\Http\Resources;

use App\Models\FlightReservation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin FlightReservation
 */
class FlightReservationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                    => $this->id,
            'passenger_passport_id' => $this->passenger_passport_id,
            'seat'                  => $this->seat,
            'flight'                => new FlightResource($this->flight),
            'created_at'            => $this->created_at,
            'updated_at'            => $this->updated_at,
        ];
    }
}
