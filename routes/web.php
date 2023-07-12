<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/', [Controller::class,'welcomePage'])->name('welcome');
Route::get('/welcome', [Controller::class,'welcomePage'])->name('welcome');
Route::get('/welcome/{url}', [Controller::class, 'welcomeSearch'])->name('welcome/');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/profile', [Controller::class, 'profilePage'])->name('profile');
});


Route::get('/profile/{name}', [Controller::class, 'profileSearch'])->name('profile/');

Route::get('/delete/{id}', [Controller::class, 'deletePost'])->name('delete/');



Route::post('/get-location', function (Request $request) {
    function calculateDistance($latitude1, $longitude1, $latitude2, $longitude2)
    {
        // Convert latitude and longitude from degrees to radians
        $latFrom = deg2rad($latitude1);
        $lonFrom = deg2rad($longitude1);
        $latTo = deg2rad($latitude2);
        $lonTo = deg2rad($longitude2);

        // Earth's radius (in kilometers)
        $earthRadius = 6371;

        // Haversine formula
        $deltaLat = $latTo - $latFrom;
        $deltaLon = $lonTo - $lonFrom;
        $angle = 2 * asin(sqrt(pow(sin($deltaLat / 2), 2) +
        cos($latFrom) * cos($latTo) * pow(sin($deltaLon / 2), 2)));

        // Calculate the distance
        $distance = $angle * $earthRadius;

        return $distance;
    }

    $latitude = $request->input('latitude');
    $longitude = $request->input('longitude');

    $postLatitude = $request->input('postLatitude');
    $postLongitude = $request->input('postLongitude');


    $distance = calculateDistance($postLatitude, $postLongitude, $latitude, $longitude);

    if ($distance >= 15) {
        return response()->json(['distance' => $distance,'success' => false]);
    } else {
        return response()->json(['distance' => $distance,'success' => true]);
        // return response()->json(['latitude' => $latitude, 'longitude' => $longitude,'success' => true,'postLatitude' => $postLatitude,'postLongitude' => $postLongitude]);
    }

});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/createpost', function () {
        return view('createpost');
    })->name('createpost');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/chats', function () {
        return view('chats');
    })->name('chats');
});
