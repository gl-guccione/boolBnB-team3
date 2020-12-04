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

                <li class="nav-item">
                  <a class="nav-link color_link" href="https://github.com/alessandroboscato"><i class="fab fa-github icon-footer p-1"></i>Alessandro Boscato</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link color_link" href="https://github.com/mdecrema"><i class="fab fa-github icon-footer p-1"></i>Marco De Crema</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link color_link" href="https://github.com/peppe965"><i class="fab fa-github icon-footer p-1"></i>Giuseppe Falco</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link color_link" href="https://github.com/gl-guccione"><i class="fab fa-github icon-footer p-1"></i>Luca Guccione</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link color_link" href="https://github.com/domg87"><i class="fab fa-github icon-footer p-1"></i>Domenico Garofalo</a>
                </li>

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

  </div>

  {{-- toast --}}
  @if (Session::has('record_added'))

    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000" style="position: absolute; top: 75px; right: 15px; background-color: #4cbb60; border-radius: 10px">
      <div class="toast-body" style="">
        <span style="color: #fff">{!!Session::get('record_added')!!}</span>
      </div>
    </div>

  @endif

  {{-- /toast --}}

</body>
</html>
