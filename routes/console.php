<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');
Artisan::command('users', function () {
    $this->comment(\App\User::all());
})->describe('Display users');
Artisan::command('user:find {user_id}', function ($user_id) {
    $this->comment(\App\User::find($user_id));
})->describe('Display user');
