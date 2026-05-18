<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

require __DIR__.'/bpanel_auth.php';

Route::get('/', function () {

    if (Auth::check()) {
        return redirect()->route('bpanel.dashboard');
    }

    return redirect()->route('login');

})->name('bpanel.index');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('bpanel.dashboard');
    })->name('bpanel.dashboard');

});