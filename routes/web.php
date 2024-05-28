<?php

use App\Livewire\Dashboard;
use App\Livewire\Devices\DeviceEdit;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Devices\DeviceIndex;
use Illuminate\Support\Facades\Route;
use App\Livewire\Devices\DeviceDetail;
use App\Livewire\Logbooks\LogbookEdit;
use App\Livewire\Logbooks\LogbookIndex;
use App\Livewire\Devices\DeviceGenerate;
use App\Livewire\Hospitals\HospitalEdit;
use App\Livewire\Logbooks\LogbookCreate;
use App\Livewire\Hospitals\HospitalIndex;
use App\Livewire\Hospitals\HospitalCreate;
use App\Livewire\Inventories\InventoryEdit;
use App\Livewire\Inventories\InventoryIndex;
use App\Livewire\Devices\Name\DeviceNameEdit;
use App\Livewire\Inventories\InventoryCreate;
use App\Livewire\Inventories\InventoryDetail;
use App\Livewire\Devices\Name\DeviceNameIndex;
use App\Livewire\Devices\Name\DeviceNameCreate;
use App\Livewire\Hospitals\HospitalDetail;

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    // Inventories
    Route::get('inventories', InventoryIndex::class)->name('inventories.index');
    Route::get('inventories/create', InventoryCreate::class)->name('inventories.create');
    Route::get('inventories/edit/{inventoryId}', InventoryEdit::class)->name('inventories.edit');
    Route::get('inventories/detail/{inventoryId}', InventoryDetail::class)->name('inventories.detail');
    // Devices
    Route::get('devices', DeviceIndex::class)->name('devices.index');
    Route::get('devices/generate', DeviceGenerate::class)->name('devices.generate');
    Route::get('devices/edit/{deviceId}', DeviceEdit::class)->name('devices.edit');
    Route::get('devices/detail/{deviceId}', DeviceDetail::class)->name('devices.detail');
    // Device Name
    Route::get('device_name', DeviceNameIndex::class)->name('device_name.index');
    Route::get('device_name/create', DeviceNameCreate::class)->name('device_name.create');
    Route::get('device_name/edit/{nameId}', DeviceNameEdit::class)->name('device_name.edit');
    // Logbooks
    Route::get('logbooks', LogbookIndex::class)->name('logbooks.index');
    Route::get('logbooks/create', LogbookCreate::class)->name('logbooks.create');
    Route::get('logbooks/edit/{logId}', LogbookEdit::class)->name('logbooks.edit');
    // Hospitals
    Route::get('hospitals', HospitalIndex::class)->name('hospitals.index');
    Route::get('hospitals/create'. HospitalCreate::class)->name('hospitals.create');
    Route::get('hospitals/edit/{hospitalId}', HospitalEdit::class)->name('hospitals.edit');
    Route::get('hospitals/detail/{hospitalId}', HospitalDetail::class)->name('hospitals.detail');
});
