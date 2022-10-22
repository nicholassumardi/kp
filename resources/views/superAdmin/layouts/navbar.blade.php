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
                        <a class="nav-link {{request()->is('super-admin') ? ' active' : ''}}" href="/super-admin">
                            <i class="ni ni-tv-2 text-primary"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{request()->is('listAkunMahasiswa') ? ' active' : ''}}"
                            href="{{route('listAkunMahasiswa.index')}}">
                            <i class="ni bi-person text-green"></i>
                            <span class="nav-link-text">List Mahasiswa</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{request()->is('listAkunUmum') ? ' active' : ''}}"
                            href="{{route('listAkunUmum.index')}}">
                            <i class="ni bi-people text-green"></i>
                            <span class="nav-link-text">List Umum</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>