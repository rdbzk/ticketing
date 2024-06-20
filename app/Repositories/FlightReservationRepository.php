<?php

namespace App\Repositories;

use App\Contracts\FlightReservationRepositoryInterface;
use App\Models\FlightReservation;
use Illuminate\Database\Eloquent\Collection;

class FlightReservationRepository implements FlightReservationRepositoryInterface
{
    public function create(array $attributes): FlightReservation
    {
        return FlightReservation::create($attributes);
    }

    public function delete(int $id): bool
    {
        return (bool) FlightReservation::destroy($id);
    }

    public function getLockedReservations(int $flightId): Collection
    {
        return FlightReservation::where('flight_id', $flightId)
            ->lockForUpdate()
            ->get();
    }

    public function passengerReservationExists(int $flightId, string $passengerPassportId): bool
    {
        $where = [
            'flight_id'             => $flightId,
            'passenger_passport_id' => $passengerPassportId,
        ];

        return FlightReservation::where($where)->exists();
    }
}
