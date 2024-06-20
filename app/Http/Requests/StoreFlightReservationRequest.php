<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFlightReservationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'passenger_passport_id' => ['required', 'string', 'min:7', 'max:9'],
        ];
    }
}
