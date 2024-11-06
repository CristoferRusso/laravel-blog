<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::post('login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    $user = User::where('email', $credentials['email'])->first();

    if ($user && Hash::check($credentials['password'], $user->password)) {

        $token = $user->createToken('YourAppToken')->accessToken;

        return response()->json([
            'token' => $token['token'],
        ]);
    }

    return response()->json(['message' => 'Invalid credentials'], 401);
});

Route::post('register', [RegisterController::class, 'register']);

Route::get('/profile', function (Request $request) {
    return response()->json([
        'message' => 'Accesso senza autenticazione',
        'headers' => $request->headers->all(),
        'authorization' => $request->header('Authorization')
    ]);
});




Route::middleware('auth:api')->post('logout', function (Request $request) {
    $request->user()->token()->revoke();

    return response()->json(['message' => 'Logged out successfully']);
});





