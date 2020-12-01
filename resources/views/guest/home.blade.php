@php

  $today = date('Y-m-d');

@endphp

@extends ('layouts.app')

@section('content')

<div class="home-page">
  <!-- div che serve per app.js -->
  <div id="HomePage"></div>

  {{-- jumbotron --}}
  <div class="container-fluid px-0 jumbo">
    <div class="row no-gutters">
      <div class="col-12 opacity">
        <img id="first-img" class="photo-carousel first" src={{ asset('img/img1.jpeg') }} alt="carousel_img">
        <img id="second-img" class="photo-carousel" src={{ asset('img/img2.jpg') }} alt="carousel_img">
        <img id="third-img" class="photo-carousel" src={{ asset('img/img3.jpg') }} alt="carousel_img">
        <img id="fourth-img" class="photo-carousel" src={{ asset('img/img4.jpg') }} alt="carousel_img">
      </div>
    </div>
    {{-- form --}}

    <div class="row">
      <div class="col-xl-4 col-sm-8 form form-home">
        <form action="{{ route("guest.homepage.search") }}" method="get">
          <div class="form-row">
            @method('GET')
            {{-- algolia input search --}}
            <div class="form-group">

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
            <label for="adults"><strong>Ospiti</strong></label>
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
            {{-- TODO set min date = value of check-in date --}}
            <input name="check_out" type="date" class="form-control" id="check_out" placeholder="Inserisci titolo" min="{{ $today }}" required>
          </div>
        </div>
        <!--/check in e chech out -->

        <!-- submit button -->

            <button type="submit" class="btn btn-primary submit">Cerca</button>

            {{-- /form --}}

        </form>
      </div>
    </div>

      <!-- <div class="search_container">



      </div> -->
      {{-- /jumbotron --}}

    </div>

    <div class="container">
      <!-- project description -->
      <div class="row project-description">

          <div class="col-sm-12 col-md-6">
            <h2>BoolBnB</h2>
            <p>BoolBnB è un progetto nato dalla collaborazione di 5 developers che si sono messi alla prova per ricreare il noto sito di prenotazioni online "Airbnb".</p>

          </div>

          <div class="right col-sm-12 col-md-6">
            <p>
              Posizionato tra i primi 10 siti di prenotazioni
            </p>
          </div>

      </div>
      <!-- project description -->

      <!-- sponsored flats -->
      <div id="sponsored-flats" class="row">

        @foreach ($flats as $flat)

          <div class="flat_box col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
            <img src="{{ asset('storage/'.$flat->images[0]->path) }}" alt="#">
            <a href="{{ route("guest.users.show", $flat->user->id) }}"></a>
            <div class="overlay">
              <h3>{{ $flat->title }}</h3>
              <p>{{ $flat->city }}</p>

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
            </div>

          </div>

        @endforeach

      </div>
      <!-- /sponsored flats -->

    <!-- end container -->
    </div>
  <!-- end home-page wrapper -->
  </div>

@endsection
