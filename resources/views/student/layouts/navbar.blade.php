<!-- Sidenav -->
<nav class="sidenav navbar-collapse navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white"
    id="sidenav-main">
    <div class="scrollbar-inner">

        <!-- Brand -->
        <div class="sidenav-header  align-items-center">
            <a class="navbar-brand" href="javascript:void(0)">
                <img src="{{asset('images/logo2.png')}}" class="navbar-brand-img" alt="...">
            </a>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{request()->is('student') ? ' active' : ''}}" href="/student">
                            <i class="ni ni-tv-2 text-primary"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{request()->is('profile') ? ' active' : ''}}" href={{route('profileStudent.show', Auth::id())}}>
                            <i class="ni ni-single-02 text-yellow"></i>
                            <span class="nav-link-text">Profile</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  {{request()->is('schedules-show') ? ' active' : ''}}" href="{{route('schedules-show.index')}}">
                            <i class="ni ni-calendar-grid-58 text-green"></i>
                            <span class="nav-link-text">Schedules</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  {{request()->is('register_test') ? ' active' : ''}}" href="/registerCourses">
                            <i class="ni ni-ruler-pencil text-pink"></i>
                            <span class="nav-link-text">Register Course</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>