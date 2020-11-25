@include('partials.head')
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-colorMain shadow-sm">
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
                                  <a class="dropdown-item" href="{{ route('login') }}">{{ __('Login') }}</a>
                                @if (Route::has('register'))
                                  <a class="dropdown-item" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                              </div>
                          </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->firstname }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                  {{-- route che manda al form create --}}
                                  <a class="dropdown-item" href="{{ route('login') }}">Crea appartamenti</a>
                                    {{-- route che fa fare il logout --}}

                                    @if (Auth::user()->flats()->count() > 0)
                                      
                                      {{-- route che manda alla view degli appartamenti dell'utente --}}
                                      <a class="dropdown-item" href="{{ route('login') }}">I miei appartamenti</a>

                                      {{-- route che manda alle statistiche --}}
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
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
{{-- 
        @dd(Auth::user()->flats()->count()) --}}

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
