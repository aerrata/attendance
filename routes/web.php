<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', 'home');

Auth::routes(['register' => false, 'reset' => false, 'verify' => false]);

Route::get('home', function () {
    $attendances = App\Models\Attendance::query()
        ->where('session_id', 712872)
        ->with('user')
        ->get();

    return view('home', compact('attendances'));
})->name('home');

Route::view('scan', 'scan')->name('scan');

Route::view('generate', 'generate')->name('generate');
