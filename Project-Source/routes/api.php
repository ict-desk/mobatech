<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::post('/contact', function (Request $request) {

    Mail::raw(
        "Naam: " . $request->input('name') . "\n" .
        "E-mail: " . $request->input('email') . "\n" .
        "Telefoon: " . $request->input('phone') . "\n" .
        "Bedrijf: " . $request->input('company') . "\n" .
        "Onderwerp: " . $request->input('subject') . "\n\n" .
        "Bericht:\n" . $request->input('message'),
        function ($message) {
            $message->to('eric.zoons@gmail.com')
                ->subject('Nieuw bericht via contactformulier');
        }
    );

    return response()->json([
        'success' => true,
        'message' => 'Mail verzonden',
    ]);

});

/*
|--------------------------------------------------------------------------
| onlyy for testing purposes, 
| this route will return the authenticated user, 
| but we are not using authentication in this project, 
| so this route is commented out, 
| but you can uncomment it if you want to test authentication in the future
|--------------------------------------------------------------------------
*/

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
