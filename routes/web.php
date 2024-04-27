<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin_Controller\LoginController;
use App\Http\Controllers\Admin_Controller\RegisterController;
use App\Http\Controllers\Admin_Controller\DashboardController;
use App\Http\Controllers\Admin_Controller\DoctorController;
use App\Http\Controllers\Admin_Controller\DepartmentController;
use App\Http\Controllers\Admin_Controller\AppointmentController;
use App\Http\Controllers\Admin_Controller\DoctorScheduleController;
use App\Http\Controllers\Admin_Controller\PatientController;
use App\Http\Controllers\Admin_Controller\NotificationController;
use App\Http\Controllers\Admin_Controller\AccountSettingController;
use App\Http\Controllers\Admin_Controller\RoleController;
use App\Http\Controllers\Admin_Controller\UserController;

use App\Http\Controllers\General_Controller\GeneralDashboardController;
use App\Http\Controllers\General_Controller\DoctorDashboardController;
use App\Http\Controllers\General_Controller\ProfileController;
use App\Http\Controllers\General_Controller\ScheduleController;
use App\Http\Controllers\General_Controller\PatientAppointmentController;


Route::get('/', function () {
    return view('welcome');
});

// Register-Signin Routing
// Route::middleware('guest')->group(function () {
    // Route::get('Healwave/login',[LoginController::class,'index'])->name('login.index');
    // Route::post('Healwave/login/authenticate',[LoginController::class,'authenticateUser'])->name('login.authenticate')->middleware('throttle:5,1');

    // Route::get('Healwave/register',[RegisterController::class,'index'])->name('register.index');
    // Route::get('Healwave/register/store',[RegisterController::class,'countries']);


    // Route::get('Healwave/user/forgot-password',[LoginController::class,'forgotPassword'])
    //     ->name('user.forgot_password');
    // Route::post('Healwave/user/forgot-password',[LoginController::class,'forgotPasswordPost'])
    //     ->name('user.forgot_password.create');
    // Route::get('Healwave/user/reset-password/{token}',[LoginController::class,'resetPassword'])
    //     ->name('user.resetPassword');
    // Route::post('Healwave/user/reset-password',[LoginController::class,'resetPasswordPost'])
    //     ->name('user.resetPassword.create');
// });

// Admin User Routing
Route::prefix('Healwave/admin')->group(function(){
    Route::get('/logout',[LoginController::class,'logoutUser'])->name('logout');

    Route::group(['middleware' => ['role_check']], function () {
        // Using Spatie Roles & Permissions Middleware
        // Route::group(['middleware' => ['role:Super Admin|Administrator']], function () {
            Route::controller(DashboardController::class)->group(function(){
                Route::get('dashboard','index')->name('admin.dashboard');
            });

            Route::resources([
                    'doctor' => DoctorController::class,
                    'department' => DepartmentController::class,
                    'schedule' => DoctorScheduleController::class,
                    'role' => RoleController::class,
                    'user' => UserController::class,
                ]);

            Route::get('/trash',[DoctorController::class,'doctorTrash'])->name('doctor.trash');
            Route::get('/trash/{doctor}',[DoctorController::class,'doctorRestore'])->name('doctor.restore');
            Route::DELETE('/trash/permanent-delete/{doctor}',[DoctorController::class,'permanentDelete'])->name('doctor.permanentDelete');
            Route::get('/trashDoctor/empty',[DoctorController::class,'emptyDoctor'])->name('trash.empty');

            Route::get('/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])
                    ->name('notifications.markAllAsRead');
            Route::get('/notifications/mark-as-read/{notificationId}', [NotificationController::class, 'markAsRead'])
                    ->name('notifications.markAsRead');
            Route::get('/notifications/unreadNotificationsCount', [NotificationController::class,'unreadNotificationsCount'])
                    ->name('notifications.countUnreadNotifications');


            Route::get('doctor/create/district/{provinceId}',[DoctorController::class,'getDistrictByProvince'])->name('province.add');
            Route::get('doctor/create/municipality/{districtId}',[DoctorController::class,'getMunicipalityByDistrict'])->name('district.add');

            Route::get('doctor/edit/district/{provinceId}',[DoctorController::class,'getDistrictByProvinceEdit'])->name('province.edit');
            Route::get('doctor/edit/municipality/{districtId}',[DoctorController::class,'getMunicipalityByDistrictEdit'])->name('district.edit');

            Route::get('patient',[PatientController::class,'index'])->name('patient.index');
            Route::view('patient/create','admin_Panel.patient.add-patient')->name('patient.create');
            Route::view('patient/edit','admin_Panel.patient.edit-patient')->name('patient.edit');

            Route::get('appointment',[AppointmentController::class,'index'])->name('appointment.index');
            Route::view('appointment/create','admin_Panel.appointment.add-appointment')->name('appointment.create');
            Route::view('appointment/edit','admin_Panel.appointment.edit-appointment')->name('appointment.edit');

            Route::get('settings',[AccountSettingController::class,'settings'])->name('admin.setting');
        // });
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
        Route::get('doctor/appointment/view/{appointment}',[PatientAppointmentController::class,'show'])->name('patient.appointment.view');

        Route::get('doctor/patients',[PatientAppointmentController::class,'patientsIndex'])->name('patient.dashboard');
    });
    Route::controller(GeneralDashboardController::class)->group(function ()
    {
        Route::get('dashboard','index')->name('general.dashboard');
        Route::get('dashboard/appointment-form/{schedule}/{interval}','appointment')->name('appointment.create');
        Route::post('dashboard/appointment-form/store/{scheduleId}','appointmentStore')->name('appointment.store');
    });
});



