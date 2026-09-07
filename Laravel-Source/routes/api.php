<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V0\MachineApiController;


Route::post('/contact', function (Request $request) {

    /*
     * |--------------------------------------------------------------------------
     * | Laag 1 - Honeypot
     * |--------------------------------------------------------------------------
     * | Het veld 'website' staat verborgen in het formulier (.hp-field).
     * | Een mens ziet het nooit, een bot vult het bijna altijd in.
     * | Bij een treffer geven we een nep-succes terug, zodat de bot niet
     * | met een andere variant terugkomt.
     */

    if (filled($request->input('website'))) {
        return response()->json([
            'success' => true,
            'message' => 'Mail verzonden',
        ]);
    }

    /*
     * |--------------------------------------------------------------------------
     * | Laag 2 - Validatie
     * |--------------------------------------------------------------------------
     * | De teksten hieronder komen letterlijk in beeld bij de bezoeker,
     * | dus in het Nederlands en zonder technische termen.
     */

    $data = $request->validate([
        'naam'      => ['required', 'string', 'max:120'],
        'email'     => ['required', 'email', 'max:180'],
        'telefoon'  => ['nullable', 'string', 'max:80'],
        'bericht'   => ['required', 'string', 'min:10', 'max:5000'],
        'subject'   => ['nullable', 'string', 'max:200'],
        'form_name' => ['nullable', 'string', 'max:120'],
    ], [
        'naam.required'    => 'Vul uw naam in.',
        'naam.max'         => 'Uw naam is te lang.',
        'email.required'   => 'Vul uw e-mailadres in.',
        'email.email'      => 'Dit e-mailadres klopt niet.',
        'email.max'        => 'Uw e-mailadres is te lang.',
        'telefoon.max'     => 'Uw telefoonnummer is te lang.',
        'bericht.required' => 'Vul uw bericht in.',
        'bericht.min'      => 'Uw bericht is te kort. Schrijf minimaal 10 tekens.',
        'bericht.max'      => 'Uw bericht is te lang.',
    ]);

    $subject = $data['subject'] ?? null;

    if (!$subject) {
        $subject = 'Nieuw bericht via Mobatech contactformulier';
    }

    Mail::raw(
        "Formulier: " . ($data['form_name'] ?? '-') . "\n" .
        "Onderwerp: " . $subject . "\n" .
        "Naam: " . $data['naam'] . "\n" .
        "E-mail: " . $data['email'] . "\n" .
        "Telefoon: " . ($data['telefoon'] ?? '-') . "\n\n" .
        "Bericht:\n" . $data['bericht'],
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

/*
 * |--------------------------------------------------------------------------
 * | Laag 3 - Throttle
 * |--------------------------------------------------------------------------
 * | Max 3 berichten per uur per IP-adres. Strenger zetten kan door
 * | het eerste getal te verlagen, bijvoorbeeld throttle:1,60.
 */

})->middleware('throttle:3,60');

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
