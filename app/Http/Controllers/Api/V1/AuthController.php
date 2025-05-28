<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        $user = User::firstWhere('email', $request->email);

        if (! $user) {
            return response()->json([
                'token' => null,
                'message' => 'El correo electrónico proporcionado no está registrado.',
            ], 401);
        }

        if (! Hash::check($request->password, $user->password)) {
            return response()->json([
                'token' => null,
                'message' => 'La contraseña proporcionada es incorrecta.',
            ], 401);
        }

        return response()->json([
            'token' => $user->createToken($request->email)->plainTextToken,
            'message' => 'Inicio de sesión exitoso.',
        ], 200);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Sesión cerrada exitosamente.',
        ]);
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'token' => $user->createToken($request->email)->plainTextToken,
            'message' => 'Registro exitoso.',
        ]);
    }
}
