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
    <!-- Custom Style Link -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_Assets/css/custom-style.css')}}">
    <!--[if lt IE 9]>
        <script src="assets/js/html5shiv.min.js"></script>
        <script src="assets/js/respond.min.js"></script>
    <![endif]-->

    <!-- CKeditor CDN -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- Nepali Date Picker -->
    <link href="https://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/css/nepali.datepicker.v4.0.1.min.css" rel="stylesheet" type="text/css"/>
    <!-- Include Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- toastr Session Message -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- Boxicons CDN -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="main-wrapper">
        <div class="header">
            <div class="header-left">
                <a href="{{ route('admin.dashboard')}}" class="logo">
                    <img src="{{ asset('admin_Assets/img/logo.png')}}" width="35" height="35" alt=""> <span>Healwave</span>
                </a>
            </div>
            <a id="toggle_btn" href="javascript:void(0);" title="Hide Sidebar" data-toggle="tooltip"><i class="fa fa-bars"></i></a>
            <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar" title="Hide Sidebar" data-toggle="tooltip"><i class="fa fa-bars"></i></a>
            <ul class="nav user-menu float-right">

                <!-- Notifications - Message Box -->
                <li class="nav-item dropdown d-none d-sm-block">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" title="Notifications"><i class="fa fa-bell-o"></i> <span class="badge badge-pill bg-danger float-right">{{ $adminNotifications->count() }}</span></a>
                    <div class="dropdown-menu notifications">
                        <div class="topnav-dropdown-header">
                            <span>Notifications</span>
                        </div>
                        <div class="drop-scroll">
                            <ul class="notification-list">
                                @foreach($adminNotifications as $notification)
                                <li class="notification-message">
                                    <a href="#">
                                        <div class="media">
                                            <div class="checkbox-container">
                                                <input type="checkbox" name="notification_id" value="{{ $notification->id }}"  class="notification-checkbox" data-notification-id="{{ $notification->id }}" title="Mark as Read" data-toggle="tooltip">
                                            </div>
                                            <span class="avatar">
                                                <img alt="John Doe" src="{{ asset( $notification->data['doctor_profile']) }}" class="img-fluid">
                                            </span>
                                            <div class="media-body">
                                                <p class="noti-details"><span class="noti-title">{{ $notification->data['doctor_name']}}</span> <span class="noti-title">{{ $notification->data['message']}}</span></p>
                                                <p class="noti-time"><span class="notification-time">{{ $notification->created_at->diffForHumans() }}</span></p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @if(count($adminNotifications) >= 1)
                            <div class="topnav-dropdown-footer">
                                <a href="#" id="mark-all-read">Mark as Read All</a>
                            </div>
                        @endif
                    </div>
                </li>
                <li class="nav-item dropdown d-none d-sm-block">
                    <a href="javascript:void(0);" id="open_msg_box" class="hasnotifications nav-link" title="Message" data-toggle="tooltip"><i class="fa fa-comment-o"></i> <span class="badge badge-pill bg-danger float-right">8</span></a>
                </li>


                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" title="Profile" data-toggle="dropdown">
                        <span class="user-img">
                            <img class="rounded-circle" src="{{ asset('admin_Assets/img/user.jpg') }}" width="24" alt="Admin">
                            <span class="status online"></span>
                        </span>
                        <span>Admin</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="profile.html">My Profile</a>
                        <a class="dropdown-item" href="edit-profile.html">Edit Profile</a>
                        <a class="dropdown-item" href="settings.html">Settings</a>
                        <a class="dropdown-item" href="{{ route('logout')}}">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">Main</li>
                        <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" >
                            <a href="{{ route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                        </li>
                        <li class="{{ request()->routeIs('department.index') ||  request()->routeIs('department.create') || request()->routeIs('department.edit') || request()->routeIs('department.show') ? 'active' : '' }}">
                            <a href="{{ route('department.index') }}"><i class="fa fa-hospital-o"></i> <span>Departments</span></a>
                        </li>
                        <li class="{{ request()->routeIs('doctor.*') ? 'active' : '' }}">
                            <a href="{{ route('doctor.index') }}"><i class="fa fa-user-md"></i> <span>Doctors</span></a>
                        </li>
                        <li class=" {{ request()->routeIs('patient.index') || request()->routeIs('patient.create') || request()->routeIs('patient.edit') ? 'active' : '' }} ">
                            <a href="{{ route('patient.index') }}"><i class="fa fa-wheelchair"></i> <span>Patients</span></a>
                        </li>
                        <li class="{{ request()->routeIs('appointment.index') || request()->routeIs('appointment.create') || request()->routeIs('appointment.edit') ? 'active' : '' }}">
                            <a href="{{ route('appointment.index')}}"><i class="fa fa-calendar"></i> <span>Appointments</span></a>
                        </li>
                        <li class="{{ request()->routeIs('schedule.index') || request()->routeIs('schedule.create') || request()->routeIs('schedule.edit') ? 'active' : '' }} ">
                            <a href="{{ route('schedule.index') }}"><i class="fa fa-calendar-check-o"></i> <span>Doctor Schedule</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>