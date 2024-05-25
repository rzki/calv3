<?php

use App\Livewire\Dashboard;
use App\Livewire\Devices\DeviceEdit;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Devices\DeviceIndex;
use Illuminate\Support\Facades\Route;
use App\Livewire\Devices\DeviceDetail;
use App\Livewire\Devices\DeviceGenerate;
use App\Livewire\Inventory\InventoryIndex;
use App\Livewire\Devices\Name\DeviceNameEdit;
use App\Livewire\Devices\Name\DeviceNameIndex;
use App\Livewire\Devices\Name\DeviceNameCreate;

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    Route::get('inventory', InventoryIndex::class)->name('inventory.index');
    Route::get('devices', DeviceIndex::class)->name('devices.index');
    Route::get('devices/generate', DeviceGenerate::class)->name('devices.generate');
    Route::get('devices/edit/{deviceId}', DeviceEdit::class)->name('devices.edit');
    Route::get('devices/detail/{deviceId}', DeviceDetail::class)->name('devices.detail');
    Route::get('device_name', DeviceNameIndex::class)->name('device_name.index');
    Route::get('device_name/create', DeviceNameCreate::class)->name('device_name.create');
    Route::get('device_name/edit/{nameId}', DeviceNameEdit::class)->name('device_name.edit');

});
