<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('admin_Assets/img/favicon.ico')}}">
    <title>Healwave - Medical & Hospital</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_Assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_Assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_Assets/css/style.css')}}">
    <!--[if lt IE 9]>
        <script src="assets/js/html5shiv.min.js"></script>
        <script src="assets/js/respond.min.js"></script>
    <![endif]-->

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('general_Assets/css/index-style.css')}}">
    <!-- CKeditor CDN -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
    <!-- X-CSRF Tokens -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- Nepali Date Picker -->
    <link href="https://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/css/nepali.datepicker.v4.0.1.min.css" rel="stylesheet" type="text/css"/>
    <!-- Include Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- toastr -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>
    <div class="main-wrapper">
        <div class="header">
            <div class="header-left">
                <a href="{{ route('doctor.dashboard')}}" class="logo">
                    <img src="{{ asset('admin_Assets/img/logo.png')}}" width="35" height="35" alt=""> <span>Healwave</span>
                </a>
            </div>
            <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
            <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
            <ul class="nav user-menu float-right">
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img">
                            <img class="rounded-circle" src="{{ asset('admin_Assets/img/user.jpg') }}" width="24" alt="Admin">
                            <span class="status online"></span>
                        </span>
                        @if (Auth::check())
                            @php
                                $fullName = Auth::user()->username;
                                $parts = explode(" ", $fullName);
                                $firstName = $parts[0];
                            @endphp
                            Hello, <span>{{ $firstName }}</span>!
                        @else
                            Please Signin!
                        @endif
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="">My Profile</a>
                        <a class="dropdown-item" href="">Edit Profile</a>
                        <a class="dropdown-item" href="">Settings</a>
                        <a class="dropdown-item" href="{{ route('doctor.logout')}}">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">Doctor</li>
                        <li class="{{ request()->routeIs('doctor.dashboard') ? 'active' : '' }}" >
                            <a href="{{ route('doctor.dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                        </li>
                        <li class="{{ request()->routeIs('doctor.profile') ||  request()->routeIs('profile.edit') ? 'active' : '' }}">
                            <a href="{{ route('doctor.profile')}}"> <i class="fa fa-user" aria-hidden="true"></i> <span>My Profile</span></a>
                        </li>
                        <li class="{{ request()->routeIs('my-schedule.index') || request()->routeIs('my-schedule.create') || request()->routeIs('my-schedule.edit') ? 'active' : '' }} ">
                            <a href="{{ route('my-schedule.index') }}"><i class="fa fa-calendar-check-o"></i> <span>My Schedule</span></a>
                        </li>
                        <li class="{{ request()->routeIs('patient.appointment') || request()->routeIs('appointment.create') ? 'active' : '' }}">
                            <a href="{{ route('patient.appointment') }}"><i class="fa fa-calendar"></i> <span>Appointments</span></a>
                        </li>
                        <li class=" {{ request()->routeIs('patient.index') || request()->routeIs('patient.create') || request()->routeIs('patient.edit') ? 'active' : '' }} ">
                            <a href="#"><i class="fa fa-wheelchair"></i> <span>Patients</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>