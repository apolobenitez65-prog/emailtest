<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;

Route::get('/mail', [MailController::class, 'formulario'])
    ->name('mail.formulario');
    
Route::post('/mail/enviar', [MailController::class, 'enviar'])
    ->name('mail.enviar');
