@extends('layouts.app')

@section('content')

  {{-- page wrapper --}}
  <div class="page_wrapper">

    {{-- user info --}}
    <div class="user_container">

      <div class="avatar">
        <img src={{$user->avatar}} alt="avatar utente">
      </div>

      <div class="user_infos">
        <h3 class="inline_bl">{{$user->firstname}} {{$user->lastname}}</h3>
        <h4>{{$user->description}}</h4>
      </div>

    </div>
    {{-- /user info --}}

    @if (count($user->flats) > 0)
      {{-- flats list--}}

      <h2>I miei appartamenti:</h2>

      <div class="flats_list">
        @foreach($user->flats as $flat)

          {{-- flat --}}
          <div>

            <div class="flat-img">
              <img src={{ asset('storage/'.$flat->images[0]->path) }} alt="foto appartamento">
            </div>

            <div class="flat-info">
              <h3>{{$flat->title}}</h3>
              <p>{{$flat->description}}</p>
              {{-- TODO transform number of stars in stars --}}
              <span>Valutazione:  {{$flat->stars}}</span>
            </div>

          </div>
          {{-- /flat --}}

        @endforeach
      </div>
      {{-- /flats list--}}

    @else

      <h2>Questo utente non ha pubblicato nessun appartamento</h2>

    @endif

  </div>
  {{-- /page wrapper --}}

@endsection