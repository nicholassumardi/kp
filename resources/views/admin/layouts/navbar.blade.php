<!-- Sidenav -->
<nav class="sidenav navbar-collapse navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white"
    id="sidenav-main">
    <div class="scrollbar-inner sidebar-wrapper">

        <!-- Brand -->
        <div class="sidebar-header sidenav-header  align-items-center">
            <a class="navbar-brand" href="javascript:void(0)">
                <img src="{{asset('images/logo2.png')}}" class="navbar-brand-img" alt="...">
            </a>
        </div>
        <div class="navbar-inner sidebar-menu">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav menu">
                    <li class="nav-item">
                        <a class="nav-link {{request()->is('admin') ? ' active' : ''}}" href="/admin">
                            <i class="ni ni-tv-2 text-primary"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{request()->is('profileAdmin') ? ' active' : ''}}" href="{{route('profileAdmin.show', Auth::id())}}">
                            <i class="ni ni-single-02 text-yellow"></i>
                            <span class="nav-link-text">Profile</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  {{request()->is('addCourse') ? ' active' : ''}}" href="{{route('addCourse.index')}}">
                            <i class="ni ni-ruler-pencil text-pink"></i>
                            <span class="nav-link-text">Course</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  {{request()->is('schedules') ? ' active' : ''}}" href="{{route('schedules.index')}}">
                            <i class="ni ni-calendar-grid-58 text-green"></i>
                            <span class="nav-link-text">Schedules</span>
                        </a>
                    </li>
                   
                    <li class="nav-item">
                        <a class="nav-link  {{request()->is('addNews') ? ' active' : ''}}" href="{{route('addNews.index')}}">
                            <i class="bi bi-newspaper text-gray"></i>
                            <span class="nav-link-text">News</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link  {{request()->is('abstract-admin') ? ' active' : ''}}" href="{{route('abstract-admin.index')}}">
                            <i class="ni ni-sound-wave text-teal"></i>
                            <span class="nav-link-text">Abstract</span>
                        </a>
                    </li>
                </ul>
                
            </div>
        </div>
    </div>
</nav>