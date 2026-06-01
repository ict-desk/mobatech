<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V0\MachineApiController;


Route::post('/contact', function (Request $request) {

    $subject = $request->input('subject');

    if (!$subject) {
        $subject = 'Nieuw bericht via Mobatech contactformulier';
    }

    Mail::raw(
        "Formulier: " . $request->input('form_name') . "\n" .
        "Onderwerp: " . $subject . "\n" .
        "Naam: " . $request->input('naam') . "\n" .
        "E-mail: " . $request->input('email') . "\n" .
        "Telefoon: " . $request->input('telefoon') . "\n\n" .
        "Bericht:\n" . $request->input('bericht'),
        function ($message) use ($subject) {

            $message->to('info@mobatech.nl')
              ->cc('john.van.de.weerd@mobatechholland.nl') // extra copie aan john
            //  ->bcc('eric.zoons@gmail.com')
                ->subject($subject);
        }
    );

    return response()->json([
        'success' => true,
        'message' => 'Mail verzonden',
    ]);
});

/*
|--------------------------------------------------------------------------
| API V0
|--------------------------------------------------------------------------
*/

Route::prefix('v0')->group(function () {

    /*
     * |----------------------------------------------------------------------
     * | Machines
     * |----------------------------------------------------------------------
     */
    Route::get('/machine-categories', [
        MachineApiController::class, 
        'categories']);

    Route::get('/machines', [
        MachineApiController::class,
        'index'
    ]);

    Route::get('/machines/{machine}', [
        MachineApiController::class,
        'show'
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
