@extends ('layouts.app')

@section('pageName', 'admin_flats_index')

@section('content')

{{-- container --}}
<div class="container flats-admin">

  <h2 class="col-lg-12">Ciao {{ $flats[0]->user->firstname }} {{ $flats[0]->user->lastname }}</h2>
  <h1 class="col-lg-12 title">Area Privata - I miei appartamenti</h1>

  {{-- flats --}}
  @foreach ($flats as $flat)

    {{-- row --}}
    <div class="row flats">

      {{-- column image --}}
      <div class="img-flats-hover col-lg-2 m-3">

        @if (count($flat->images) > 0)

            <img class="img-flats" src="{{ asset('storage/'.$flat->images[0]->path) }}">

        @endif

      </div>
      {{-- /column image --}}

      {{-- column info --}}
      <div class="card col-lg-6 pt-4 m-3">

        <h2 class="card__title">
          <a href="{{ route('guest.flats.show', $flat->slug) }}">{{ $flat->title }}</a>
        </h2>

        <p class="p__description">{{ $flat->description }}</p>

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
            <i class="star_color fas fa-star"></i>
          @endfor
          @for ($i = 0; $i < $half_star; $i++)
            <i class="star_color fas fa-star-half"></i>
          @endfor

          ({{ $flat->stars / 2 }})

        </span>

      </div>
      {{-- /column info --}}

      {{-- column actions --}}
      <div class="card__icons col-lg-3 pt-4">

        {{-- sponsor button --}}
        <div class="sponsorship m-2">
          {{-- TODO add route for sponsorship --}}
          <a href="#">
            <i class="fas fa-shopping-cart"></i>
          </a>
        </div>
        {{-- /sponsor button --}}

        {{-- edit button --}}
        <div class="edit m-2">
          <a href="{{ route('admin.flats.edit', $flat->slug) }}">
            <i class="fas fa-edit"></i>
          </a>
        </div>
        {{-- /edit button --}}

        {{-- delete button/form --}}
        <form class="delete m-2" action="{{ route('admin.flats.destroy', $flat->slug) }}" method="POST">

          @csrf
          @method('DELETE')

          <button class="delete" type="submit">
            <i class="fas fa-trash-alt"></i>
          </button>

        </form>
        {{-- /delete button/form --}}

        {{-- message button --}}
        {{-- <div class="message m-2"> --}}

          {{-- TODO add route to see all the message for the flat --}}
          {{-- <a href="#">
            <i class="fas fa-envelope"></i>
          </a> --}}

        {{-- </div> --}}
        {{-- /message button --}}

      </div>
      {{-- /column actions --}}

    </div>
    {{-- /row --}}

  @endforeach
  {{-- /flats --}}

</div>
{{-- /container --}}

@endsection
