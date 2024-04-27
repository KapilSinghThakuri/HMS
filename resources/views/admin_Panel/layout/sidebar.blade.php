<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">{{ auth()->user()->getRoleNames()->first() }}</li>
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
                <li class="{{ request()->routeIs('user.*') ? 'active' : '' }} ">
                    <a href="{{ route('user.index')}}"><i class="fa fa-user-plus" aria-hidden="true"></i><span>Users</span></a>
                </li>
                @role('Super Admin')
                <li class="{{ request()->routeIs('role.*') ? 'active' : '' }} ">
                    <a href="{{ route('role.index') }}"><i class="fa fa-users" aria-hidden="true"></i> <span>Roles</span></a>
                </li>
                @endrole
            </ul>
        </div>
    </div>
</div>