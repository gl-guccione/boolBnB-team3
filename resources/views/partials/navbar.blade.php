
{{-- NAVBAR DI LARAVEL DA MODIFICARE --}}
<nav class="navbar navbar-expand-md navbar-light shadow-sm">
    <div class="container">

        <!-- logo e link che riporta alla home -->
        <a class="navbar-brand logo" href="{{ url('/') }}">
            <img class="img-logo" src="{{asset('img/logo.png')}}">
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
                    <li class="nav-item">
                        <button class=" btn btn-outline-light my-2 my-sm-0" type="button">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </button>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <button class="btn btn-outline-light my-2 my-sm-0" type="button">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </button>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
