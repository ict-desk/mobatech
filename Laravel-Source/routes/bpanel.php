<?php

use App\Http\Controllers\Bpanel\MachineController;
use App\Http\Controllers\Bpanel\GeneralOptionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/bpanel_auth.php';

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

    /*
     * |--------------------------------------------------------------------------
     * | General Options
     * |--------------------------------------------------------------------------
     */

    Route::get('/general-options/{option_name}', [GeneralOptionController::class, 'index'])
        ->name('general-options.index');

    Route::get('/general-options/{option_name}/create', [GeneralOptionController::class, 'create'])
        ->name('general-options.create');

    Route::post('/general-options/{option_name}/store', [GeneralOptionController::class, 'store'])
        ->name('general-options.store');

    Route::get('/general-options/{option_name}/{generalOption}/edit', [GeneralOptionController::class, 'edit'])
        ->name('general-options.edit');

    Route::post('/general-options/{option_name}/{generalOption}/update', [GeneralOptionController::class, 'update'])
        ->name('general-options.update');

    Route::get('/general-options/{option_name}/{generalOption}/delete', [GeneralOptionController::class, 'delete'])
        ->name('general-options.delete');

    /*
     * |--------------------------------------------------------------------------
     * | Machines
     * |--------------------------------------------------------------------------
     */

    Route::get('/machines/{machine}/copy', [MachineController::class, 'copy'])
        ->name('machines.copy');

    Route::get('/machines/{machine}/delete', [MachineController::class, 'delete'])
        ->name('machines.delete');

    Route::post('/machines/{machine}/files/upload', [MachineController::class, 'uploadFile'])
        ->name('machines.files.upload');

    Route::get('/machines/{machine}/files/rename', [MachineController::class, 'renameFile'])
        ->name('machines.files.rename.get');

    Route::get('/machines/{machine}/files/delete', [MachineController::class, 'deleteFile'])
        ->name('machines.files.delete.get');

    Route::get('/machines/{machine}/files/setmainimage', [MachineController::class, 'setmainimage'])
        ->name('machines.files.setmainimage.get');

    // basic resource routes
    Route::resource('machines', MachineController::class);
});
