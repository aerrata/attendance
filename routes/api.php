<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('generate', function () {
    $user = App\Models\User::find(request()->input('user_id'));

    $qrCode = SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')
        ->size(200)
        ->generate(json_encode([
            'user' => $user->only(['id', 'name', 'email']),
            'session_id' => 712872
        ]));

    $encodedQrCode = base64_encode($qrCode);

    $user->qr_code = "data:image/svg+xml;base64,$encodedQrCode";

    return [
        'status' => 'QR code generated successfully!',
        'user' => $user->only(['id', 'name', 'email', 'qr_code'])
    ];
});

Route::post('attendances', function () {
    request()->validate([
        'user.id' => ['required'],
        'session_id' => ['required'],
    ]);

    App\Models\Attendance::create([
        'session_id' => request()->input('session_id'),
        'user_id' => request()->input('user.id')
    ]);

    return [
        'status' => 'Approved!'
    ];
});
