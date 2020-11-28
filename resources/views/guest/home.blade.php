@extends ('layouts.app')

@section('content')

  {{-- jumbotron --}}
  <div class="jumbo">
    <div class="opacity">
      <img id="first-img" class="photo-carousel first" src={{ asset('img/img1.jpeg') }} alt="carousel_img">
      <img id="second-img" class="photo-carousel" src={{ asset('img/img2.jpg') }} alt="carousel_img">
      <img id="third-img" class="photo-carousel" src={{ asset('img/img3.jpg') }} alt="carousel_img">
      <img id="fourth-img" class="photo-carousel" src={{ asset('img/img4.jpg') }} alt="carousel_img">

      {{-- form --}}
      <div class="search_container">

        <form class="form" action="{{ route("guest.homepage.search") }}" method="get">

          @method('GET')

          <div class="form-group">

            <label for="street_name"><strong>Dove</strong></label>
            <input name="algolia" type="search" id="street_name" class="form-control" placeholder="Inserisci indirizzo" required>
            {{-- TODO can we remove the <p> tag below? --}}
            <p>Selected: <strong id="address-value">none</strong></p>

          </div>

          <div class="form-group">

            <label for="adults"><strong>Ospiti</strong></label>
            <input name="adults" type="number" class="form-control" id="adults" placeholder="Aggiungi adulti" min="1" required>
            <input name="children" type="number" class="form-control" id="children" placeholder="Aggiungi bambini" min="0">

          </div>

          <div class="form-group">

            <label for="check_in"><strong>Check-in</strong></label>
            <input name="check_in" type="date" class="form-control" id="check_in" placeholder="Inserisci titolo" required>

          </div>

          <div class="form-group">

            <label for="check_out"><strong>Check-out</strong></label>
            <input name="check_out" type="date" class="form-control" id="check_out" placeholder="Inserisci titolo" required>

          </div>

            <button type="submit" class="btn btn-primary">Cerca</button>

        </form>

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
              {{-- TODO transform number of stars in stars --}}
              <span>valutazione: {{ $flat->stars }}</span>
            </div>
          </a>

        </div>

      @endforeach

    </div>
    {{-- /sponsored flats --}}

  </div>

@endsection
