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

/////////////////////////           GENERAL DASHBOARD Breadcrumbs           /////////////////////////////////////
