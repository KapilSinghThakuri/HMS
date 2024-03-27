<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin_Controller\DashboardController;
use App\Http\Controllers\Admin_Controller\DoctorController;
use App\Http\Controllers\Admin_Controller\DepartmentController;


Route::get('/', function () {
    return view('welcome');
});

Route::prefix('Healwave/admin')->group(function(){

    Route::controller(DashboardController::class)->group(function(){
        Route::get('dashboard','index')->name('admin.dashboard');
    });

    Route::resources([
            'doctor' => DoctorController::class,
            'department' => DepartmentController::class,
        ]);

    Route::view('patient','admin_Panel.patient.patients')->name('patient.index');
    Route::view('patient/create','admin_Panel.patient.add-patient')->name('patient.create');
    Route::view('patient/edit','admin_Panel.patient.edit-patient')->name('patient.edit');
});


