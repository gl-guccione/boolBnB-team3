@php

  $today = date('Y-m-d');

@endphp

@extends ('layouts.app')

@section('pageName', 'guest_home')

@section('content')

  {{-- jumbotron --}}
  <div class="container-fluid px-0 jumbo">
    <div class="row no-gutters">
      <div class="col-12 carousel">
        <img src={{ asset('img/img_home.jpg') }} alt="Free photo from pixabay.com">
      </div>
    </div>
    {{-- form --}}

      <div class="col-xl-4 col-sm-8 form form-home">
        <form action="{{ route("guest.homepage.search") }}" method="get">
        @method('GET')

        {{-- algolia input search --}}
        <div class="form-row">
          <div class="form-group col-12">

            <label for="city"><strong>Dove</strong></label>
            <input name="algolia" type="search" id="city" class="form-control" placeholder="Inserisci indirizzo" required>
            <input name="data-algolia" type="hidden" id="data-algolia" class="form-control" required>

          </div>
        </div>

        <!-- ospiti adulti e bambini -->
        <div class="form-row">
          <div class="form-group col-6">
            <label for="adults"><strong>Ospiti</strong></label>
            <input name="adults" type="number" class="form-control" id="adults" placeholder="Aggiungi adulti" min="1" required>
          </div>
          <div class="form-group col-6">
            <label for="children"><strong style="color: transparent">.</strong></label>
            <input name="children" type="number" class="form-control" id="children" placeholder="Aggiungi bambini" min="0">
          </div>
        </div>
        <!-- ospiti adulti e bambini -->

        <!-- check in e chech out -->
        <div class="form-row">
          <div class="form-group col-6">
            <label for="check_in"><strong>Check-in</strong></label>
            <input name="check_in" type="date" class="form-control" id="check_in" placeholder="Inserisci titolo" min="{{ $today }}" required>
          </div>
          <div class="form-group col-6">
            <label for="check_out"><strong>Check-out</strong></label>
            <input name="check_out" type="date" class="form-control" id="check_out" placeholder="Inserisci titolo" min="{{ $today }}" required>
          </div>
        </div>
        <!--/check in e chech out -->

        <!-- submit button -->

            <button type="submit" class="btn btn-primary submit">Cerca</button>

            {{-- /form --}}

        </form>
      </div>
      {{-- /jumbotron --}}

    </div>
    <div class="container">
      <!-- project description -->
      <div class="row project-description">

          <div class="col-sm-12 col-md-6 left">
            <h2>BoolBnB</h2>
            <p>Boolbnb è un portale online che mette in contatto persone in cerca di un alloggio o di una camera per brevi periodi, con persone che dispongono di uno spazio extra da affittare, generalmente privati. <br> Gli annunci includono sistemazioni quali stanze private, interi appartamenti, castelli e ville, ma anche barche, baite, case sugli alberi, igloo, isole private e qualsiasi altro tipo di alloggio. <br> Ad oggi il sito conta più di {{ $views }} visite!</p>
          </div>

          <div class="right col-sm-12 col-md-6">
            <h2>Tecnologie utilizzate</h2>
            <ul class="list-inline">
              <li class="list-inline-item"><i class="fab fa-html5"></i></li>
              <li class="list-inline-item"><i class="fab fa-css3-alt"></i></li>
              <li class="list-inline-item"><i class="fab fa-js"></i></li>
              <li class="list-inline-item"><i class="fab fa-php"></i></li>
              <li class="list-inline-item"><i class="fab fa-sass"></i></li>
              <li class="list-inline-item"><i class="fab fa-laravel"></i></li>
            </ul>
          </div>

      </div>
      <!-- project description -->
      <!-- sponsored flats -->
      <div id="sponsored-flats" class="row">
        @foreach ($flats as $flat)

          <div class="flat_box col-12 col-sm-12 offset-sm-2 col-md-6 col-lg-4 col-xl-3">

            <div class="flat__img">
              <img src="{{ asset('storage/'.$flat->images[0]->path) }}" alt="Free photo from pixabay.com">
            </div>

            <a href="{{ route("guest.flats.show", $flat->slug) }}"></a>

            <div class="overlay">
              <h4 class="overflow_two_rows">{{ $flat->title }}</h4>

              <span>

                @php
                  if ($flat->stars % 2 == 0) {
                    $star = $flat->stars / 2;
                    $half_star = 0;
                  } else {
                    $star = intval($flat->stars / 2);
                    $half_star = 1;
                  }
                @endphp

                @for ($i = 0; $i < $star; $i++)
                  <i class="fas fa-star"></i>
                @endfor
                @for ($i = 0; $i < $half_star; $i++)
                  <i class="fas fa-star-half"></i>
                @endfor

                ({{ $flat->stars / 2 }})

              </span>

              <p>{{ $flat->city }}</p>

            </div>

          </div>

        @endforeach

      </div>
      <!-- /sponsored flats -->

    <!-- end container -->
    </div>

    {{-- became an host --}}
    <div class="container-fluid container-dark">

      <div class="container">

        <div class="row became-host">

          <div class="col-lg-6 col-md-12 became-host__title">
            <h2>Unisciti a milioni <br> di host su BoolBnB</h2>
            @guest
              <a class="btn button" href="{{ route('register') }}">Registrati</a>
            @else
              <a class="btn button" href="{{ route('admin.flats.create') }}">Pubblica un appartamento</a>
            @endguest
          </div>

          <div class="col-lg-6 col-md-12 became-host__image">
            <img src="{{ asset('img/homepage/became_host.svg') }}" alt="became host">
          </div>

        </div>

      </div>

    </div>
    {{-- /became an host --}}

@endsection
