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
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
                                            @if($notification->data['method'] === 'doctor_create' && 'schedule_create' &&  'schedule_update' && 'schedule_delete')
                                            <span class="avatar">
                                                <img alt="John Doe" src="{{ asset( $notification->data['doctor_profile']) }}" class="img-fluid">
                                            </span>
                                            @endif
                                            <div class="media-body">
                                                <p class="noti-details">
                                                    <span class="noti-title">
                                                        @switch($notification->data['method'])
                                                            @case('doctor_create')
                                                                <strong style="color: #3498db; font-weight: 400;"> Dr. {{ $notification->data['doctor_name']}}</strong> has added to our hospital!.
                                                                @break
                                                            @case('schedule_create')
                                                                <strong style="color: #3498db; font-weight: 400;"> {{ $notification->data['doctor_name']}}</strong> has scheduled an appointment for {{ $notification->data['scheduled_day']}}.
                                                                @break
                                                            @case('schedule_update')
                                                                <strong style="color: #3498db; font-weight: 400;"> {{ $notification->data['doctor_name']}}</strong> has updated their appointment schedule.
                                                                @break
                                                            @case('schedule_delete')
                                                                <strong style="color: #3498db; font-weight: 400;"> {{ $notification->data['doctor_name']}}</strong> has deleted his appointment schedule for {{ $notification->data['scheduled_day']}}.
                                                                @break
                                                            @case('appointment_create')
                                                                <strong style="color: #3498db; font-weight: 400;">New appointment alert:</strong> <span class="noti-title">{{ $notification->data['patient_name']}}</span> has booked the schedule for {{ $notification->data['appointment_time_interval']}}.
                                                                @break
                                                            @default
                                                                <strong style="color: #3498db; font-weight: 400;">Notice: </strong> <span class="noti-title"> No new notifications.</span>
                                                        @endswitch
                                                    </span>
                                                </p>
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
                        <a class="dropdown-item" href="{{ route('admin.setting')}}">Settings</a>
                        <a class="dropdown-item" href="{{ route('logout')}}">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
