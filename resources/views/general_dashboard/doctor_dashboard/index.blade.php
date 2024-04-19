@extends('general_dashboard.doctor_dashboard.layout.main')

@section('Main-container')
<div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="dash-widget">
                        <span class="dash-widget-bg4"><i class="fa fa-heartbeat" aria-hidden="true"></i></span>
                        <div class="dash-widget-info text-right">
                            <h3>618</h3>
                            <span class="widget-title4">Pending<i class="fa fa-check" aria-hidden="true"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="dash-widget">
                        <span class="dash-widget-bg2"><i class="fa fa-user-o"></i></span>
                        <div class="dash-widget-info text-right">
                            <h3>1072</h3>
                            <span class="widget-title2">Patients <i class="fa fa-check" aria-hidden="true"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="dash-widget">
                        <span class="dash-widget-bg1"><i class="fa fa-stethoscope" aria-hidden="true"></i></span>
                        <div class="dash-widget-info text-right">
                            <h3>69</h3>
                            <span class="widget-title1">Doctors <i class="fa fa-check" aria-hidden="true"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="dash-widget">
                        <span class="dash-widget-bg3"><i class="fa fa-user-md" aria-hidden="true"></i></span>
                        <div class="dash-widget-info text-right">
                            <h3>72</h3>
                            <span class="widget-title3">Attend <i class="fa fa-check" aria-hidden="true"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 col-lg-8 col-xl-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title d-inline-block">Appointments Overview</h4> <a href="appointments.html" class="btn btn-primary float-right">View all</a>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="d-none">
                                        <tr>
                                            <th>Patient Name</th>
                                            <th>Date</th>
                                            <th>Timing</th>
                                            <th class="text-right">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($appointments as $appointment)
                                        <tr>
                                            <td style="min-width: 200px;">
                                                <a class="avatar" href="#">P</a>
                                                <h2><a href="profile.html">{{ $appointment->patient->fullname }} <span>{{ $appointment->patient->permanent_address }}</span></a></h2>
                                            </td>
                                            <td>
                                                <h5 class="time-title p-0">Date</h5>
                                                <p>{{ $appointment->schedule->in }}</p>
                                            </td>
                                            <td>
                                                <h5 class="time-title p-0">Timing</h5>
                                                <p>{{ $appointment->time_interval }}</p>
                                            </td>
                                            <td class="text-right">
                                                @if($appointment->status == 'pending')
                                                <div class="dropdown">
                                                    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="approvalDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="approvalDropdown">
                                                        <form action="{{ route('doctor.appointment-approve',['appointment'=>$appointment->id ])}}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="dropdown-item">Approved</button>
                                                        </form>
                                                        <form action="{{ route('doctor.appointment-cancel',['appointment'=>$appointment->id ])}}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="dropdown-item">Cancel</button>
                                                        </form>
                                                    </div>
                                                </div>
                                                @elseif($appointment->status == 'approved')
                                                <span class="custom-badge status-green">Approved</span>
                                                @else
                                                <span class="custom-badge status-red">Cancelled</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 col-xl-4">
                    <div class="card member-panel">
                        <div class="card-header bg-white">
                            <h4 class="card-title mb-0">Doctors</h4>
                        </div>
                        <div class="card-body">
                            <ul class="contact-list">
                                <li>
                                    <div class="contact-cont">
                                        <div class="float-left user-img m-r-10">
                                            <a href="profile.html" title="John Doe"><img src="assets/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status online"></span></a>
                                        </div>
                                        <div class="contact-info">
                                            <span class="contact-name text-ellipsis">John Doe</span>
                                            <span class="contact-date">MBBS, MD</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="contact-cont">
                                        <div class="float-left user-img m-r-10">
                                            <a href="profile.html" title="Richard Miles"><img src="assets/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status offline"></span></a>
                                        </div>
                                        <div class="contact-info">
                                            <span class="contact-name text-ellipsis">Richard Miles</span>
                                            <span class="contact-date">MD</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="contact-cont">
                                        <div class="float-left user-img m-r-10">
                                            <a href="profile.html" title="John Doe"><img src="assets/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status away"></span></a>
                                        </div>
                                        <div class="contact-info">
                                            <span class="contact-name text-ellipsis">John Doe</span>
                                            <span class="contact-date">BMBS</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="contact-cont">
                                        <div class="float-left user-img m-r-10">
                                            <a href="profile.html" title="Richard Miles"><img src="assets/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status online"></span></a>
                                        </div>
                                        <div class="contact-info">
                                            <span class="contact-name text-ellipsis">Richard Miles</span>
                                            <span class="contact-date">MS, MD</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="contact-cont">
                                        <div class="float-left user-img m-r-10">
                                            <a href="profile.html" title="John Doe"><img src="assets/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status offline"></span></a>
                                        </div>
                                        <div class="contact-info">
                                            <span class="contact-name text-ellipsis">John Doe</span>
                                            <span class="contact-date">MBBS</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="contact-cont">
                                        <div class="float-left user-img m-r-10">
                                            <a href="profile.html" title="Richard Miles"><img src="assets/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status away"></span></a>
                                        </div>
                                        <div class="contact-info">
                                            <span class="contact-name text-ellipsis">Richard Miles</span>
                                            <span class="contact-date">MBBS, MD</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer text-center bg-white">
                            <a href="doctors.html" class="text-muted">View all Doctors</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 col-lg-8 col-xl-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title d-inline-block">New Patients </h4> <a href="patients.html" class="btn btn-primary float-right">View all</a>
                        </div>
                        <div class="card-block">
                            <div class="table-responsive">
                                <table class="table mb-0 new-patient-table">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <img width="28" height="28" class="rounded-circle" src="assets/img/user.jpg" alt="">
                                                <h2>John Doe</h2>
                                            </td>
                                            <td>Johndoe21@gmail.com</td>
                                            <td>+1-202-555-0125</td>
                                            <td><button class="btn btn-primary btn-primary-one float-right">Fever</button></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img width="28" height="28" class="rounded-circle" src="assets/img/user.jpg" alt="">
                                                <h2>Richard</h2>
                                            </td>
                                            <td>Richard123@yahoo.com</td>
                                            <td>202-555-0127</td>
                                            <td><button class="btn btn-primary btn-primary-two float-right">Cancer</button></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img width="28" height="28" class="rounded-circle" src="assets/img/user.jpg" alt="">
                                                <h2>Villiam</h2>
                                            </td>
                                            <td>Richard123@yahoo.com</td>
                                            <td>+1-202-555-0106</td>
                                            <td><button class="btn btn-primary btn-primary-three float-right">Eye</button></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img width="28" height="28" class="rounded-circle" src="assets/img/user.jpg" alt="">
                                                <h2>Martin</h2>
                                            </td>
                                            <td>Richard123@yahoo.com</td>
                                            <td>776-2323 89562015</td>
                                            <td><button class="btn btn-primary btn-primary-four float-right">Fever</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection