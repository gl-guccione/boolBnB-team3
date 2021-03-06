@extends ('layouts.app')

@section('pageName', 'admin_flats_index')

@section('content')

{{-- container --}}
<div class="container py-4">

  <div class="hero py-6">
    <img class="hero__image pt-4" src="{{ asset('img/flats/flat.svg') }}" alt="flat image">
    <h1 class="hero__title py-4 mb-5">
      Buongiorno,
        @php
          $firstname = App\User::where('id', Auth::id())->first()->firstname;
        @endphp
        <span class="hero__name">
          {{ $firstname }} !
        <span class="underline"></span>
      </span>
      <br>
      Benvenuto nella tua area privata.
    </h1>
  </div>

  @if (count($flats))

    {{-- flats --}}
    @foreach ($flats as $flat)

      <hr class="end_flat">

      {{-- row --}}
      <div class="row">

        {{-- first col --}}
        <div class="col-lg-8 col-12 flat__first">

          <div class="flat__textimage d_flex">

            @if (count($flat->images) > 0)
              <img class="flat__image @if($flat->active == 0) inactive @endif" src="{{ asset('storage/'.$flat->images[0]->path) }}" alt="Free photo from pixabay.com">
            @endif

            <div class="flat__text">

              <h2 class="flat__title overflow_row">
                <a class="flat__link" href="{{ route('guest.flats.show', $flat->slug) }}">{{ $flat->title }}</a>
              </h2>

              <p class="flat__description overflow_two_rows">
                {{ $flat->description }}
              </p>

              <p class="flat__address overflow_row">
                <i class="fas fa-map-marker-alt"></i>
                {{ $flat->street_name }} -
                {{ $flat->city }}
              </p>

              <span class="flat__stars">

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
                  <i class="star_color fas fa-star"></i>
                @endfor
                @for ($i = 0; $i < $half_star; $i++)
                  <i class="star_color fas fa-star-half"></i>
                @endfor

                ({{ $flat->stars / 2 }})

              </span>

            </div>

          </div>

          <div class="flat__info d_flex">

            <div data-toggle="tooltip" data-placement="top" title="numero di stanze">
              <i class="fas fa-door-open"></i>
              {{ $flat->number_of_rooms }}
            </div>

            <div data-toggle="tooltip" data-placement="top" title="numero di letti">
              <i class="fas fa-bed"></i>
              {{ $flat->number_of_beds }}
            </div>

            <div data-toggle="tooltip" data-placement="top" title="numero di bagni">
              <i class="fas fa-restroom"></i>
              {{ $flat->number_of_bathrooms }}
            </div>

            <div data-toggle="tooltip" data-placement="top" title="superficie in m²">
              <i class="fas fa-border-style"></i>
              {{ $flat->mq }}m²
            </div>

            <div data-toggle="tooltip" data-placement="top" title="prezzo a notte">
              <i class="fas fa-euro-sign"></i>
              {{ $flat->price }}€
            </div>

            <div data-toggle="tooltip" data-placement="top" title="visibilità">
              @if ($flat->active == true)
              <i class="far fa-eye"></i>
              visibile
              @else
              <i class="fas fa-eye-slash"></i>
              non visibile
              @endif
            </div>

          </div>

        </div>
        {{-- /first col --}}

        {{-- second col --}}
        <div class="col-lg-2 col-sm-6 col-12 my-4 my-sm-0 flat__second d_flex_vertical center">

          <div class="flat__sponsored">
            <span>
              <i class="fas fa-receipt"></i> <br>
              @if ($flat->sponsored == false)
                Non in evidenza
              @else
                In evidenza fino al {{ substr($flat->sponsored, 0, 16) }}
              @endif
            </span>
          </div>
          <hr>
          <div class="flat__sponsor">

            <form action="{{ route("admin.sponsorships.create") }}" method="get">
              @method('GET')

              <input name="flat_id" type="hidden" id="flat_id" required value="{{$flat->id}}">

              <button type="submit" class="btn button submit">
                <i class="fas fa-credit-card"></i>
                Promuovi
              </button>

            </form>

            <a class="btn button mt-3" href="{{ route('admin.statistics.show', $flat->slug) }}"><i class="fas fa-chart-area"></i> Statistiche</a>

          </div>
        </div>
        {{-- /second col --}}

        {{-- third col --}}
        <div class="col-lg-2 col-sm-6 col-12 flat__third my-4 my-lg-0 my center d_flex_vertical">

          <div class="flat_actions">

            {{-- pause button/form --}}
            <form class="" action="{{ route('admin.flats.update_status', $flat->slug) }}" method="POST">

              @csrf
              @method('PUT')

              <button type="submit" class="btn button">
                @if ($flat->active == 1)
                  <i class="fas fa-pause"></i>
                  Disattiva
                @else
                  <i class="fas fa-play"></i>
                  Attiva
                @endif
              </button>

            </form>
            {{-- /pause button/form --}}

            {{-- edit button --}}
            <div class="my-3">
              <a class="btn button edit" href="{{ route('admin.flats.edit', $flat->slug) }}">
                <i class="fas fa-edit"></i>
                Modifica
              </a>
            </div>
            {{-- /edit button --}}

            {{-- delete button/form --}}
            <form class="" action="{{ route('admin.flats.destroy', $flat->slug) }}" method="POST">

              @csrf
              @method('DELETE')

              <button class="btn button delete" type="submit">
                <i class="fas fa-trash-alt"></i>
                Elimina
              </button>

            </form>
            {{-- /delete button/form --}}

          </div>

        </div>
        {{-- /third col --}}

      </div>
      {{-- /row --}}

    @endforeach
    {{-- /flats --}}
  @else
    <h2 class=" my-5">Non hai ancora pubblicato appartamenti.</h2>
  @endif

</div>
{{-- /container --}}

@endsection
