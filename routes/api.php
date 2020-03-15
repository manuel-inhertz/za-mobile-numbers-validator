<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\MobileNumber;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Get all numbers
Route::middleware('api')->get('/numbers', function (){
    $numbers = MobileNumber::get();
    if ($numbers !== null) return response()->json($numbers);
    // Return error if none
    return response()->json(['success' => 0, 'error_message' => 'No number has been found!']);
});

// Get all numbers
Route::middleware('api')->get('/numbers/verify/{number}', function ($number) {

    $isCorrect = MobileNumber::isCorrect($number);

    if (!$isCorrect) {
        $validator = MobileNumber::validateNumber($number);
        return response()->json(($validator));
    } else {
        return response()->json(['number' => $number, 'is_correct' => true, 'notes' => 'The number is correct']);
    }

});
