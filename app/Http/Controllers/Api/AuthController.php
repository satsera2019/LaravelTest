<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private string $email = 'admin@example.com';
    private string $password = 'adminPassword123';
    private string $token = 'abc123token';

    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string']
        ]);

        if ($request->email === $this->email  && $request->password === $this->password) {
            return response()->json([
                'token' => $this->token
            ]);
        }

        return response()->json(['Unauthorized'], 401);
    }

    public function getUser(): JsonResponse
    {
        return response()->json([
            "name" => "Admin",
            "email" => $this->email,
        ]);
    }
}
