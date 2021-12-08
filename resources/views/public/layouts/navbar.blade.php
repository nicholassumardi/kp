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
                        <a class="nav-link {{request()->is('public') ? ' active' : ''}}" href="{{route('umum.index')}}">
                            <i class="ni ni-tv-2 text-primary"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{request()->is('profilePublic/' . Auth::id()) ? ' active' : ''}}" href={{route('profilePublic.show', Auth::id())}}>
                            <i class="ni ni-single-02 text-yellow"></i>
                            <span class="nav-link-text">Profile</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  {{request()->is('quota-show-public') ? ' active' : ''}}" href="{{route('quota-show-public.index')}}">
                            <i class="ni ni-calendar-grid-58 text-green"></i>
                            <span class="nav-link-text">Quota</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  {{request()->is('registerCoursesPublic') ? ' active' : ''}}" href="{{route('registerCoursesPublic.index')}}">
                            <i class="ni ni-ruler-pencil text-pink"></i>
                            <span class="nav-link-text">Register Course</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  {{request()->is('penerjemahan-public') ? ' active' : ''}}" href="{{route('penerjemahan-public.index')}}">
                            <i class="ni ni-sound-wave text-teal"></i>
                            <span class="nav-link-text">Penerjemahan</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>