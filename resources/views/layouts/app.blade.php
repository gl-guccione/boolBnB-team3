{{-- head --}}
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css">

    <!-- Extra style/script -->
    @yield('extraHead')

</head>
{{-- /head --}}



{{-- including header --}}
@include('partials.header')



    {{-- main --}}
    <main id="@yield('pageName')" class="py-6">
      @yield('content')
    </main>
    {{-- /main --}}



    {{-- footer --}}
    <footer>

      {{-- container --}}
      <div class="container">
        {{-- row --}}
        <div class="row">

          {{-- first column --}}
          <div class="col-4 pt-4">

            <div class="logo-footer">
              <img class="logo-footer" src="{{asset('img/logo.png')}}" alt="logo-footer">
            </div>

            <div class="description-footer mt-2">
              <p>BoolBnB è un progetto nato dalla collaborazione di 5 developers che si sono messi alla prova per ricreare il noto sito di prenotazioni online "Airbnb".</p>
            </div>

            <div class="description-site">
              <p>© 2020 boolbnb, Inc. All rights reserved</p>
            </div>

          </div>
          {{-- /first column --}}

          {{-- second column --}}
          <div class="col-4 pt-4">

            <div class="profile-info">

              <h5>Contatti</h5>

              <ul class="nav flex-column">

                @php

                  $devs = [
                    'Giuseppe Luca Guccione' => 'https://github.com/gl-guccione',
                    'Giuseppe Falco' => 'https://github.com/peppe965',
                    'Alessandro Boscato' => 'https://github.com/alessandroboscato',
                    'Marco De Crema' => 'https://github.com/mdecrema',
                    'Domenico Garofalo' => 'https://github.com/domg87'
                  ];

                  function shuffle_assoc($list) {
                    if (!is_array($list)) return $list;

                    $keys = array_keys($list);
                    shuffle($keys);
                    $random = array();
                    foreach ($keys as $key)
                      $random[$key] = $list[$key];

                    return $random;
                  }

                  $devs = shuffle_assoc($devs);

                @endphp

                @foreach ($devs as $key => $dev)

                  <li class="nav-item">
                    <a class="nav-link color_link" href="{{ $dev }}"><i class="fab fa-github icon-footer p-1"></i>{{ $key }}</a>
                  </li>

                @endforeach

              </ul>

            </div>

          </div>
          {{-- /second column --}}

          {{-- third column --}}
          <div class="col-3 pt-4">

            <div class="social-footer">

              <h5>Social</h5>

              <ul class="nav">

                <li class="nav-item">
                  <a class="nav-link color_link" href="https://it-it.facebook.com/"><i class="fab fa-facebook-square icon-footer"></i></a>
                </li>

                <li class="nav-item">
                  <a class="nav-link color_link" href="https://www.instagram.com/"><i class="fab fa-instagram-square icon-footer"></i></a>
                </li>

                <li class="nav-item">
                  <a class="nav-link color_link" href="https://www.linkedin.com/"><i class="fab fa-linkedin icon-footer"></i></a>
                </li>

                <li class="nav-item">
                  <a class="nav-link color_link" href="https://twitter.com/login?lang=it"><i class="fab fa-twitter-square icon-footer"></i></a>
                </li>

                <li class="nav-item">
                  <a class="nav-link color_link" href="https://www.youtube.com/"><i class="fab fa-youtube icon-footer"></i></a>
                </li>

              </ul>

            </div>

          </div>
          {{-- /third column --}}

        </div>
        {{-- row --}}
      </div>
      {{-- container --}}

    </footer>
    {{-- /footer --}}

  </div>
  {{-- /div #app --}}



  <!-- Extra script -->
  @yield('footerScript')

  {{-- toast --}}
  @if (Session::has('record_added'))

    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="6000" style="position: fixed; top: 105px; right: 30px; background-color: #4cbb60; border-radius: 10px">
      <div class="toast-body">
        <span style="color: #fff">{!!Session::get('record_added')!!}</span>
      </div>
    </div>

  @endif
  {{-- /toast --}}

  @auth

    <script>

      // function that check if there are new messages for the user
      function newMessages(userId){

        let user_id = {{ Auth::id() }};

        let link = "http://localhost:8000/api/newmessages?user_id=" + user_id;
        let xmlHttp = new XMLHttpRequest();

        xmlHttp.onreadystatechange = function() {

          if (xmlHttp.readyState === 4 && xmlHttp.status === 200) {

            let results = JSON.parse(xmlHttp.responseText);

            if (results === true) {
              let mark = document.getElementById("notification_mark");
              mark.classList.add('active');
            }

          }

        }
        xmlHttp.open("GET", link);
        xmlHttp.send();

      }

      newMessages( {{ Auth::id() }} );

    </script>

  @endauth



</body>
</html>
