<?php

use App\Livewire\DashboardIndex;
use App\Livewire\Auth\LoginIndex;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

