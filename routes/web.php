<?php

use App\Livewire\Dashboard;
use App\Livewire\Roles\RoleEdit;
use App\Livewire\Users\UserEdit;
use App\Livewire\Roles\RoleIndex;
use App\Livewire\Users\UserIndex;
use App\Livewire\Roles\RoleCreate;
use App\Livewire\Users\UserCreate;
use App\Livewire\Users\UserImport;
use App\Livewire\Devices\DeviceEdit;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Devices\DeviceIndex;
use Illuminate\Support\Facades\Route;
use App\Livewire\Devices\DeviceDetail;
use App\Livewire\Logbooks\LogbookIndex;
use App\Livewire\Devices\DeviceGenerate;
use App\Livewire\Hospitals\HospitalEdit;
use App\Livewire\Hospitals\HospitalIndex;
use App\Livewire\Hospitals\HospitalCreate;
use App\Livewire\Hospitals\HospitalDetail;
use App\Http\Controllers\PrintQRController;
use App\Http\Controllers\ProfileController;
use App\Livewire\Inventories\InventoryEdit;
use App\Livewire\Inventories\InventoryIndex;
use App\Livewire\Devices\Name\DeviceNameEdit;
use App\Livewire\Inventories\InventoryCreate;
use App\Livewire\Inventories\InventoryDetail;
use App\Livewire\Devices\Name\DeviceNameIndex;
use App\Livewire\Devices\Name\DeviceNameCreate;
use App\Livewire\Inventories\Logs\InventoryAddLog;
use App\Livewire\Inventories\Logs\InventoryEditLog;
use App\Livewire\Hospitals\Devices\HospitalAddDevice;
use App\Livewire\MyProfile;
use App\Livewire\ResetSuperadmin;

Route::middleware('guest')->group(function(){
    Route::get('/', function () {
        return view('auth.login');
    });
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('dashboard', Dashboard::class)->name('dashboard');
    // Users
    Route::get('users', UserIndex::class)->name('users.index');
    Route::get('users/create', UserCreate::class)->name('users.create');
    Route::get('users/edit/{userId}', UserEdit::class)->name('users.edit');
    Route::get('users/import', UserImport::class)->name('users.import');
    // Roles
    Route::get('roles', RoleIndex::class)->name('roles.index');
    Route::get('roles/create', RoleCreate::class)->name('roles.create');
    Route::get('roles/edit/{roleId}', RoleEdit::class)->name('roles.edit');
    // Profile
    // Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    // Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('my-profile', MyProfile::class)->name('profiles.show');
    // Inventories
    Route::get('inventories', InventoryIndex::class)->name('inventories.index');
    // Route::get('inventories/create', InventoryCreate::class)->name('inventories.create');
    Route::get('inventories/edit/{inventoryId}', InventoryEdit::class)->name('inventories.edit');
    Route::get('inventories/detail/{inventoryId}', InventoryDetail::class)->name('inventories.detail');
    Route::get('inventories/detail/{inventoryId}/add-log', InventoryAddLog::class)->name('inventories.add_log');
    Route::get('inventories/detail/{inventoryId}/edit-log/{logId}', InventoryEditLog::class)->name('inventories.edit_log');
    // Devices
    Route::get('devices', DeviceIndex::class)->name('devices.index');
    Route::get('devices/generate', DeviceGenerate::class)->name('devices.generate');
    Route::get('devices/edit/{deviceId}', DeviceEdit::class)->name('devices.edit');
    Route::get('devices/detail/{deviceId}', DeviceDetail::class)->name('devices.detail');
    Route::get('devices/print/{deviceId}', DeviceIndex::class)->name('devices.print');
    Route::get('devices/print-all', [PrintQRController::class, 'printAll'])->name('devices.printAll');
    Route::get('devices/view/{deviceId}', DeviceIndex::class)->name('devices.viewSertif');
    // Device Name
    Route::get('device_name', DeviceNameIndex::class)->name('device_name.index');
    Route::get('device_name/create', DeviceNameCreate::class)->name('device_name.create');
    Route::get('device_name/edit/{nameId}', DeviceNameEdit::class)->name('device_name.edit');
    // Logbooks
    Route::get('logbooks', LogbookIndex::class)->name('logbooks.index');
    // Hospitals
    Route::get('hospitals', HospitalIndex::class)->name('hospitals.index');
    Route::get('hospitals/create', HospitalCreate::class)->name('hospitals.create');
    Route::get('hospitals/edit/{hospitalId}', HospitalEdit::class)->name('hospitals.edit');
    Route::get('hospitals/detail/{hospitalId}', HospitalDetail::class)->name('hospitals.detail');
    Route::get('hospitals/detail/{hospitalId}/add-device', HospitalAddDevice::class)->name('hospitals.add_device');
});
