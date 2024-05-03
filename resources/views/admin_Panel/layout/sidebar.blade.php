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
                    <a href="{{ route('user.index')}}"><i class="fa fa-users" aria-hidden="true"></i><span>Users</span></a>
                </li>
                @role('Super Admin')
                <li class="{{ request()->routeIs('role.*') ? 'active' : '' }} ">
                    <a href="{{ route('role.index') }}"><i class="fa fa-key" aria-hidden="true"></i> <span>Roles & Permissions</span></a>
                </li>
                @endrole
                <li class="{{ request()->routeIs('menu.*') ? 'active' : '' }} ">
                    <a href="{{ route('menu.index')}}"><i class="fa fa-bars" aria-hidden="true"></i><span>Menu</span></a>
                </li>

                <li class="dropdown {{ request()->routeIs('page.*') || request()->routeIs('faq.*') || request()->routeIs('album.*') || request()->routeIs('gallery.*') || request()->routeIs('feedback.*') || request()->routeIs('banner.*') ? 'active' : '' }}">
                    <a href="#" class="dropdown-toggle" data-toggle="collapse" data-target="#pages-dropdown">
                        <i class="fa fa-list-alt" aria-hidden="true"></i><span>Pages</span>
                    </a>
                    <ul id="pages-dropdown" class="collapse">
                        <li class="{{ request()->routeIs('page.*') ? 'active' : '' }} ">
                            <a href="{{ route('page.index')}}"> <i class="fa fa-file-o" aria-hidden="true"></i> <span> Pages </span></a>
                        </li>
                        <li class="{{ request()->routeIs('faq.*') ? 'active' : '' }} ">
                            <a href="{{ route('faq.index')}}"><i class="fa fa-question-circle-o" aria-hidden="true"></i><span> FAQ </span></a>
                        </li>
                        <li class="{{ request()->routeIs('album.*') ? 'active' : '' }}">
                            <a href="{{ route('album.index')}}"><i class="fa fa-file-image-o" aria-hidden="true"></i> <span> Gallery </span></a>
                        </li>
                        <li class="{{ request()->routeIs('feedback.*') ? 'active' : '' }} ">
                            <a href="{{ route('feedback.index')}}"><i class="fa fa-comments" aria-hidden="true"></i><span> Feedback </span></a>
                        </li>
                        <li class="{{ request()->routeIs('banner.*') ? 'active' : '' }}">
                            <a href="{{ route('banner.index')}}"><i class="fa fa-picture-o" aria-hidden="true"></i> <span>Banner</span></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>