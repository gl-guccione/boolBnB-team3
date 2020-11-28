<body>
  <div id="app">
      <nav class="navigation-bar navbar navbar-expand-md navbar-light bg-colorMain shadow-sm">
          <div class="container">
              <a class="navbar-brand" href="{{ url('/') }}">
                  <img class="logo-header" src="{{asset('img/logo.png')}}" alt="">
                  {{ config('app.name', 'boolbnb') }}
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
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
                            {{-- TODO fix route messages --}}
                            <a href="{{ route('admin.messages.index') }}" class="nav-link">
                              <i class="fas fa-envelope"></i>
                            </a>
                          </li>
                          <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                              {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                              {{-- link for admin.flats.create --}}
                              <a class="dropdown-item" href="{{ route('admin.flats.create') }}">Crea appartamento</a>

                                @if (count(Auth::user()->flats) > 0)

                                  {{-- link for admin.flats.index --}}
                                  <a class="dropdown-item" href="{{ route('admin.flats.index') }}">I miei appartamenti</a>

                                  {{-- link for admin.statistics.index --}}
                                  {{-- TODO add correct route --}}
                                  <a class="dropdown-item" href="{{ route('login') }}">Statistiche</a>

                                @endif

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