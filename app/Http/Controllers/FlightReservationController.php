<?php

namespace App\Http\Controllers;

use App\Exceptions\FlightReservationException;
use App\Http\Requests\StoreFlightReservationRequest;
use App\Http\Resources\FlightReservationResource;
use App\Models\Flight;
use App\Models\FlightReservation;
use App\Services\FlightReservationService;
use Symfony\Component\HttpFoundation\Response;

class FlightReservationController extends Controller
{
    public function __construct(private readonly FlightReservationService $service)
    {
    }

    public function destroy(FlightReservation $reservation): Response
    {
        $this->service->cancelReservation($reservation);

        return response()->noContent();
    }

    public function store(Flight $flight, StoreFlightReservationRequest $request): FlightReservationResource|Response
    {
        try {
            $reservation = $this->service->createReservation($flight, $request->validated());
        } catch (FlightReservationException $e) {
            return response(['message' => $e->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return new FlightReservationResource($reservation);
    }
}
