<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin_Controller\LoginController;
use App\Http\Controllers\Admin_Controller\RegisterController;
use App\Http\Controllers\Admin_Controller\DashboardController;
use App\Http\Controllers\Admin_Controller\DoctorController;
use App\Http\Controllers\Admin_Controller\DepartmentController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('Healwave/admin')->group(function(){

    Route::middleware('guest')->group(function () {
        Route::get('login',[LoginController::class,'index'])->name('login.index');
        Route::post('/login/authenticate',[LoginController::class,'authenticateUser'])->name('login.authenticate');

        Route::get('register',[RegisterController::class,'index'])->name('register.index');
        Route::get('register/store',[RegisterController::class,'countries']);
    });

    Route::middleware('auth')->group(function () {
        Route::get('/logout',[LoginController::class,'logoutUser'])->name('logout');

        Route::controller(DashboardController::class)->group(function(){
            Route::get('dashboard','index')->name('admin.dashboard');
        });

        Route::resources([
                'doctor' => DoctorController::class,
                'department' => DepartmentController::class,
            ]);
        Route::get('doctor/create/district/{provinceId}',[DoctorController::class,'getDistrictByProvince'])->name('province');
        Route::get('doctor/create/municipality/{districtId}',[DoctorController::class,'getMunicipalityByDistrict'])->name('district');

        Route::view('patient','admin_Panel.patient.patients')->name('patient.index');
        Route::view('patient/create','admin_Panel.patient.add-patient')->name('patient.create');
        Route::view('patient/edit','admin_Panel.patient.edit-patient')->name('patient.edit');
    });
});


