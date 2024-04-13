<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin_Controller\LoginController;
use App\Http\Controllers\Admin_Controller\RegisterController;
use App\Http\Controllers\Admin_Controller\DashboardController;
use App\Http\Controllers\Admin_Controller\DoctorController;
use App\Http\Controllers\Admin_Controller\DepartmentController;
use App\Http\Controllers\General_Controller\GeneralDashboardController;
use App\Http\Controllers\General_Controller\DoctorDashboardController;
use App\Http\Controllers\General_Controller\ProfileController;
use App\Http\Controllers\General_Controller\ScheduleController;
use App\Http\Controllers\General_Controller\PatientAppointmentController;


Route::get('/', function () {
    return view('welcome');
});

// Register-Signin Routing
Route::middleware(['guest','throttle:5,1'])->group(function () {
    Route::get('Healwave/login',[LoginController::class,'index'])->name('login.index');
    Route::post('Healwave/login/authenticate',[LoginController::class,'authenticateUser'])->name('login.authenticate');

    Route::get('Healwave/register',[RegisterController::class,'index'])->name('register.index');
    Route::get('Healwave/register/store',[RegisterController::class,'countries']);
});

// Admin User Routing
Route::prefix('Healwave/admin')->group(function(){
    Route::get('/logout',[LoginController::class,'logoutUser'])->name('logout');

    Route::middleware(['auth','role_check'])->group(function () {

        Route::controller(DashboardController::class)->group(function(){
            Route::get('dashboard','index')->name('admin.dashboard');
        });

        Route::resources([
                'doctor' => DoctorController::class,
                'department' => DepartmentController::class,
            ]);
        Route::get('doctor/create/district/{provinceId}',[DoctorController::class,'getDistrictByProvince'])->name('province.add');
        Route::get('doctor/create/municipality/{districtId}',[DoctorController::class,'getMunicipalityByDistrict'])->name('district.add');

        Route::get('doctor/edit/district/{provinceId}',[DoctorController::class,'getDistrictByProvinceEdit'])->name('province.edit');
        Route::get('doctor/edit/municipality/{districtId}',[DoctorController::class,'getMunicipalityByDistrictEdit'])->name('district.edit');

        Route::view('patient','admin_Panel.patient.patients')->name('patient.index');
        Route::view('patient/create','admin_Panel.patient.add-patient')->name('patient.create');
        Route::view('patient/edit','admin_Panel.patient.edit-patient')->name('patient.edit');

        Route::view('schedule','admin_Panel.doctor_schedule.schedule')->name('schedule.index');
        Route::view('schedule/create','admin_Panel.doctor_schedule.add-schedule')->name('schedule.create');
        Route::view('schedule/edit','admin_Panel.doctor_schedule.edit-schedule')->name('schedule.edit');

        Route::view('appointment','admin_Panel.appointment.appointments')->name('appointment.index');
        Route::view('appointment/create','admin_Panel.appointment.add-appointment')->name('appointment.create');
        Route::view('appointment/edit','admin_Panel.appointment.edit-appointment')->name('appointment.edit');
    });
});

// General User Routing
Route::prefix('Healwave')->group(function(){
    Route::get('doctor/logout',[LoginController::class,'logoutUser'])->name('doctor.logout');
    Route::middleware('auth')->group(function(){
        Route::GET('/doctor/dashboard',[DoctorDashboardController::class,'index'])->name('doctor.dashboard');
        Route::PATCH('/doctor/dashboard/approve-appointment/{appointment}',[DoctorDashboardController::class,'approveAppointment'])->name('doctor.appointment-approve');
        Route::PATCH('/doctor/dashboard/cancel-appointment/{appointment}',[DoctorDashboardController::class,'cancelAppointment'])->name('doctor.appointment-cancel');

        Route::controller(ProfileController::class)->group(function (){
            Route::GET('doctor/profile','index')->name('doctor.profile');
            Route::GET('doctor/profile/edit','edit')->name('profile.edit');
            Route::PUT('doctor/profile/update','update')->name('profile.update');

            Route::get('doctor/profile/edit/district/{provinceId}','getDistrictByProvinceEdit');
            Route::get('doctor/profile/edit/municipality/{districtId}','getMunicipalityByDistrictEdit');
        });

        Route::resource('doctor/my-schedule',ScheduleController::class);

        Route::get('doctor/appointment',[PatientAppointmentController::class,'index'])->name('patient.appointment');
    });
    Route::controller(GeneralDashboardController::class)->group(function ()
    {
        Route::get('dashboard','index')->name('general.dashboard');
        Route::get('dashboard/get-doctors/{department}','getDoctorsByDepartment');
        Route::get('dashboard/get-schedules/{doctor}','getSchedulesByDoctor');
        Route::get('dashboard/appointment-form/{schedule}/{doctor}','appointment')->name('appointment.create');
        Route::post('dashboard/appointment-form/store/{doctorId}/{scheduleId}','appointmentStore')->name('appointment.store');
    });
});



