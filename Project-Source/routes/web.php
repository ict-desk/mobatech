<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;






/*
|--------------------------------------------------------------------------
| React Frontend Fallback
| this need to be last in routes because it will catch all routes and return the index.html file
| All routes above this will be ignored if this is placed before them, so make sure to place this at the end of the file
| this the basic react site will be served for all routes that are not defined in the api.php file, this is because the react app will handle the routing on the client side, so we need to return the index.html file for all routes that are not defined in the api.php file
|--------------------------------------------------------------------------
*/


Route::get('/{any}', function () {
    return file_get_contents(public_path('index.html'));
})->where('any', '.*');