<?php

namespace App\Contracts;

use App\Models\FlightReservation;
use Illuminate\Database\Eloquent\Collection;

interface FlightReservationRepositoryInterface
{
    public function create(array $attributes): FlightReservation;

    public function delete(int $id): bool;

    /**
     * Get all the reservations for the given flight as locked for update, to
     * prevent race conditions when used within a transaction
     *
     * @return Collection<FlightReservation>
     */
    public function getLockedReservations(int $flightId): Collection;

    /**
     * Check if there is already a reservation for the given passenger on the
     * given flight
     */
    public function passengerReservationExists(int $flightId, string $passengerPassportId): bool;
}
