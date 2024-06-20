<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt
     *
     * For this proof of concept, we assume that the third-party API will
     * always return a successful response. We use the dummy test user provided
     * by Laravel.
     */
    public function authenticate(Request $request): JsonResponse
    {
        $user  = User::first();
        $token = $user->createToken($user->id)->plainTextToken;

        return response()->json([
            'access_token' => $token,
        ]);
    }
}
