<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::post('login', function (Request $request) {

    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Credenziali non valide'], 401);
    }

    // Genera il token
    $token = $user->createToken('token-name')->plainTextToken;

    return response()->json(['token' => $token]);
});

Route::post('register', [RegisterController::class, 'register']);

Route::middleware('auth:sanctum')->get('/profile', function (Request $request) {
    return response()->json([
        'user' => $request->user(),
    ]);
});


Route::middleware('auth:sanctum')->post('logout', function (Request $request) {

    $user = auth()->user();
    $user->tokens()->delete();

    return response()->json(['message' => 'Logged out successfully']);
});





