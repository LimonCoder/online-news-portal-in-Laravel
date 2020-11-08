<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="{{ route('web.index') }}"><img src="{{ asset('web/images/logo.png') }}" height="50"></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="about-us.php">About</a>
            </li>
                 <li class="nav-item">
              <a class="nav-link" href="index.php">News</a>
            </li>
             <li class="nav-item">
              <a class="nav-link" href="contact-us.php">Contact us</a>
            </li>
            @auth
            
            @else
            <li class="nav-item">
              <a class="nav-link" href="{{route('login')}}">Log in</a>
            </li>
            @endauth


          </ul>
        </div>
      </div>
    </nav>