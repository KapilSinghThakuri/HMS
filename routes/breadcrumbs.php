<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

/////////////////////////           ADMIN PANEL Breadcrumbs           /////////////////////////////////////
Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push('Dashboard', route('admin.dashboard'));
});

// Breadcrumbs For DEPARTMENTS
Breadcrumbs::for('department.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Departments', route('department.index'));
});
Breadcrumbs::for('department.create', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Departments', route('department.index'));
    $trail->push('Create Department', route('department.create'));
});
Breadcrumbs::for('department.edit', function ($trail, $department) {
    $trail->parent('admin.dashboard');
    $trail->push('Departments', route('department.index'));
    $trail->push('Edit Department', route('department.edit', $department));
});
Breadcrumbs::for('department.show', function ($trail, $department) {
    $trail->parent('admin.dashboard');
    $trail->push('Departments', route('department.index'));
    $trail->push('View Department', route('department.show', $department));
});

// Breadcrumbs For DOCTORS
Breadcrumbs::for('doctor.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Doctors', route('doctor.index'));
});
Breadcrumbs::for('doctor.create', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Doctors', route('doctor.index'));
    $trail->push('Create Doctor', route('doctor.create'));
});
Breadcrumbs::for('doctor.edit', function ($trail, $doctor) {
    $trail->parent('admin.dashboard');
    $trail->push('Doctors', route('doctor.index'));
    $trail->push('Edit Doctor', route('doctor.edit', $doctor));
});
Breadcrumbs::for('doctor.show', function ($trail, $doctor) {
    $trail->parent('admin.dashboard');
    $trail->push('Doctors', route('doctor.index'));
    $trail->push('View Doctor Profile', route('doctor.show', $doctor));
});
Breadcrumbs::for('doctor.trash', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Doctors', route('doctor.index'));
    $trail->push('Doctor Trash', route('doctor.trash'));
});

// Breadcrumbs For PATIENTS
Breadcrumbs::for('patient.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Patients', route('patient.index'));
});

// Breadcrumbs For APPOINTMENTS
Breadcrumbs::for('appointment.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Appointments', route('appointment.index'));
});

// Breadcrumbs For DOCTOR SCHEDULES
Breadcrumbs::for('schedule.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Doctor Schedules', route('schedule.index'));
});
Breadcrumbs::for('schedule.create', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Doctors Schedule', route('schedule.index'));
    $trail->push('Create Schedule', route('schedule.create'));
});
Breadcrumbs::for('schedule.edit', function ($trail, $schedule) {
    $trail->parent('admin.dashboard');
    $trail->push('Doctors Schedule', route('schedule.index'));
    $trail->push('Edit Schedule', route('schedule.edit', $schedule));
});

Breadcrumbs::for('admin.setting', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Profile Settings', route('admin.setting'));
});


/////////////////////////           GENERAL DASHBOARD Breadcrumbs           /////////////////////////////////////
Breadcrumbs::for('doctor.dashboard', function ($trail) {
    $trail->push('Dashboard', route('doctor.dashboard'));
});

// Breadcrumbs For DOCTOR PROFILE
Breadcrumbs::for('doctor.profile', function ($trail) {
    $trail->parent('doctor.dashboard');
    $trail->push('My Profile', route('doctor.profile'));
});
Breadcrumbs::for('profile.edit', function ($trail) {
    $trail->parent('doctor.dashboard');
    $trail->push('My Profile', route('doctor.profile'));
    $trail->push('Edit Profile', route('profile.edit'));
});

// Breadcrumbs For DOCTOR SCHEDULE
Breadcrumbs::for('my-schedule.index', function ($trail) {
    $trail->parent('doctor.dashboard');
    $trail->push('My Schedule', route('my-schedule.index'));
});
Breadcrumbs::for('my-schedule.create', function ($trail) {
    $trail->parent('doctor.dashboard');
    $trail->push('My Schedule', route('my-schedule.index'));
    $trail->push('Add Schedule', route('my-schedule.create'));
});
Breadcrumbs::for('my-schedule.edit', function ($trail, $schedule) {
    $trail->parent('doctor.dashboard');
    $trail->push('My Schedule', route('my-schedule.index'));
    $trail->push('Edit Schedule', route('my-schedule.edit', $schedule));
});

// Breadcrumbs For DOCTOR APPOINTMENT
Breadcrumbs::for('patient.appointment', function ($trail) {
    $trail->parent('doctor.dashboard');
    $trail->push('Appointments', route('patient.appointment'));
});
Breadcrumbs::for('patient.appointment.view', function ($trail, $appointment) {
    $trail->parent('doctor.dashboard');
    $trail->push('Appointments', route('patient.appointment'));
    $trail->push('View Appointment', route('patient.appointment.view',$appointment));
});

// Breadcrumbs For DOCTOR PATIENT
Breadcrumbs::for('patient.dashboard', function ($trail) {
    $trail->parent('doctor.dashboard');
    $trail->push('Patients', route('patient.dashboard'));
});




