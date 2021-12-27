<nav class="navbar navbar-expand-lg navbar-light bg-white shadow" data-aos="fade-down" data-aos-duration="1500" style="width:100vw; height:auto;">
  <div class="container">
    <a class="navbar-brand" href="/"><img src="{{asset('images/logo.png')}}" alt="ILC" class="logo" data-aos="zoom-in"
        data-aos-duration="2000" data-aos-delay="200"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
      aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
      <div class="navbar-nav" data-aos="zoom-in" data-aos-duration="2000" data-aos-delay="200">
        <a class="nav-link {{request()->is('/') ? ' active' : ''}}" aria-current="page" href="{{route('/')}}">About</a>
        <a class="nav-link {{request()->is('news') || request()->is('news-show') ? 'active' : ''}}"
          href="{{route('news.index')}}">News</a>
        <a class="nav-link" href="{{route('register.create')}}">Register</a>
        <a class="nav-link" href="{{route('login.form')}}">Sign In</a>
      </div>
    </div>
  </div>
</nav>