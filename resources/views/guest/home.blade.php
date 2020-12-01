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
      <div class="col-4">
        <form class="form-home" action="{{ route("guest.homepage.search") }}" method="get">

          @method('GET')
          {{-- algolia input search --}}
          <div class="form-group">

            <label for="city"><strong>Dove</strong></label>
            <input name="algolia" type="search" id="city" class="form-control" placeholder="Inserisci indirizzo" required>
            <input name="data-algolia" type="hidden" id="data-algolia" class="form-control" required>

          </div>

          <div class="form-group">

            <label for="adults"><strong>Ospiti</strong></label>
            <input name="adults" type="number" class="form-control" id="adults" placeholder="Aggiungi adulti" min="1" required>
            <input name="children" type="number" class="form-control" id="children" placeholder="Aggiungi bambini" min="0">

          </div>

          <div class="form-group">

            <label for="check_in"><strong>Check-in</strong></label>
            <input name="check_in" type="date" class="form-control" id="check_in" placeholder="Inserisci titolo" min="{{ $today }}" required>

          </div>

          <div class="form-group">

            <label for="check_out"><strong>Check-out</strong></label>
            {{-- TODO set min date = value of check-in date --}}
            <input name="check_out" type="date" class="form-control" id="check_out" placeholder="Inserisci titolo" min="{{ $today }}" required>

          </div>

            <button type="submit" class="btn btn-primary">Cerca</button>

        </form>
      </div>

    </div>

      <div class="search_container">



      </div>
      {{-- /form --}}

    </div>

  </div>
  {{-- /jumbotron --}}

  <div class="container">

    {{-- project description --}}
    <div class="project-description row">

      <section class="left col-6">
        <h2>Qui ci andrà la descrizione del progetto</h2>
          {{-- ??? --}}
          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor distinctio dignissimos reprehenderit illo aliquam ab non vel repellat recusandae voluptatibus unde, ullam iste, iusto eveniet accusamus quia soluta minus dolores.
          Lorem ipsum dolor sit amet, consectetur adipisicing elit.
      </section>

      <section class="right col-6">
        <p>
          Posizionato tra i primi 10 siti di prenotazioni
        </p>
      </section>

    </div>
    {{-- /project description --}}

    {{-- sponsored flats --}}
    <div id="sponsored-flats" class="row">

      @foreach ($flats as $flat)

        <div class="flat_box col-2">

          <a href="{{ route("guest.users.show", $flat->user->id) }}">
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
          </a>

        </div>

      @endforeach

    </div>
    {{-- /sponsored flats --}}

  </div>
</div>


@endsection
