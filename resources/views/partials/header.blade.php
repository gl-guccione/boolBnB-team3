<body>
  <div id="app">
      <nav class="navigation-bar navbar navbar-expand-md navbar-light bg-colorMain">
          <div class="container">
              <a class="navbar-brand" href="{{ url('/') }}">
                  <img class="logo-header" src="{{asset('img/logo.png')}}" alt="logo">
                  <span class="header__title">BoolBnB</span>
              </a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                  <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <!-- Left Side Of Navbar -->
                  <ul class="navbar-nav mr-auto">

                  </ul>

                  <!-- Right Side Of Navbar -->
                  <ul class="navbar-nav ml-auto">
                      <!-- Authentication Links -->
                      @guest

                        {{-- menu guest con login e register --}}
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-white medium_fs" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                              Area Host
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                {{-- link for login --}}
                                <a class="dropdown-item" href="{{ route('login') }}">{{ __('Login') }}</a>
                              @if (Route::has('register'))
                                {{-- link for register --}}
                                <a class="dropdown-item" href="{{ route('register') }}">{{ __('Register') }}</a>
                              @endif
                            </div>
                        </li>
                        {{-- /menu guest con login e register --}}

                      @else

                          {{-- menu for registered user --}}
                          <li class="nav-item">
                            <a href="{{ route('admin.messages.index') }}" class="nav-link medium_fs">
                              <div class="envelope_container">
                                <i class="fas fa-envelope color_white"></i>
                                <div id="notification_mark" class=""></div>
                              </div>
                            </a>
                          </li>
                          <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle color_white medium_fs" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                              {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                              {{-- link for admin.flats.create --}}
                              <a class="dropdown-item" href="{{ route('admin.flats.create') }}">Crea appartamento</a>

                                @if (count(Auth::user()->flats) > 0)

                                  {{-- link for admin.flats.index --}}
                                  <a class="dropdown-item" href="{{ route('admin.flats.index') }}">I miei appartamenti</a>

                                  {{-- link for admin.statistics.index --}}
                                  <a class="dropdown-item" href="{{ route('admin.statistics') }}">Le mie Statistiche</a>

                                  {{-- link for admin.sponsorships.index --}}
                                  <a class="dropdown-item" href="{{ route('admin.sponsorships.index') }}">Le mie sponsorizzazioni</a>

                                @endif

                              {{-- link for admin.user.show --}}
                              <a class="dropdown-item" href="{{ route('guest.users.show', Auth::id()) }}">Il mio profilo</a>

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                  document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                  @csrf
                                </form>

                              </div>
                          </li>
                          {{-- /menu for registered user --}}

                      @endguest
                  </ul>
              </div>
          </div>
      </nav>