<!-- Header -->
<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Student</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="/public"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">@yield('path')</li>
                        </ol>
                    </nav>
      
                </div>
            </div>
          @include('public/layouts/flash-messages')
        </div>
    </div>
</div>

