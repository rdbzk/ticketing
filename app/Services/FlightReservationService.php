<?php

namespace App\Services;

use App\Contracts\FlightReservationRepositoryInterface;
use App\Enums\SeatSection;
use App\Exceptions\FlightReservationException;
use App\Models\Flight;
use App\Models\FlightReservation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

readonly class FlightReservationService
{
    /**
     * @var int Number of seat rows available per flight
     */
    const NB_SEAT_ROWS = 32;

    public function __construct(private FlightReservationRepositoryInterface $repository)
    {
    }

    public function cancelReservation(FlightReservation $reservation): bool
    {
        return $this->repository->delete($reservation->id);
    }

    /**
     * @param array{passenger_passport_id: string} $data
     *
     * @throws FlightReservationException The passenger already has a reservation or all seats are already taken
     */
    public function createReservation(Flight $flight, array $data): FlightReservation
    {
        if ($this->repository->passengerReservationExists($flight->id, $data['passenger_passport_id'])) {
            throw new FlightReservationException('A reservation already exists for this passenger');
        }

        $reservation = null;

        /**
         * Fetch an available seat preventing race conditions
         *
         * By using a database transaction when fetching locked reservations,
         * we ensure that multiple users won't get the same seat allocated when
         * performing multiple HTTP calls.
         */
        DB::transaction(function () use ($flight, $data, &$reservation) {
            $reservations = $this->repository->getLockedReservations($flight->id);

            if ($this->areAllReservationsTaken($reservations->count())) {
                throw new FlightReservationException('No available seats left on this flight');
            }

            $seat = $this->pickAvailableRandomSeat($reservations);

            $reservation = $this->repository->create([
                'flight_id'             => $flight->id,
                'passenger_passport_id' => $data['passenger_passport_id'],
                'seat'                  => $seat,
            ]);
        });

        return $reservation;
    }

    /**
     * Check if all the seats have already been reserved, based on the limit
     * provided in the specification
     */
    private function areAllReservationsTaken(int $nbReservations): bool
    {
        $nbSections = count(SeatSection::cases());

        return $nbReservations >= ($nbSections * self::NB_SEAT_ROWS);
    }

    /**
     * @param Collection<FlightReservation> $reservations
     */
    private function pickAvailableRandomSeat(Collection $reservations): string
    {
        $sections = collect(SeatSection::cases());

        /**
         * Generate all the possible seat combinations, so we can filter them
         * out when picking an available seat
         */
        $allSeats = $sections->crossJoin(range(1, self::NB_SEAT_ROWS))->map(function ($pair) {
            return $pair[0]->value . $pair[1];
        });

        $occupiedSeats = $reservations->pluck('seat');

        return $allSeats->except($occupiedSeats)->random();
    }
}
