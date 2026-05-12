<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;


Route::post('/contact', function (Request $request) {

    Mail::raw(
        "Formulier: " . $request->input('form_name') . "\n" .
        "Naam: " . $request->input('naam') . "\n" .
        "E-mail: " . $request->input('email') . "\n" .
        "Telefoon: " . $request->input('telefoon') . "\n\n" .
        "Bericht:\n" . $request->input('bericht'),
        function ($message) {
            $message->to('info@mobatech.nl')
           //   $message->to('eric.zoons@gmail.com')
                ->subject('Nieuw bericht via Mobatech contactformulier');
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
