@extends('layouts.app')

@section('pageName', 'guest_user_show')


@section('content')

  {{-- page wrapper --}}
  <div class="container page_wrapper">

    {{-- user info --}}
    <div class="row">
    <div class="user_container">
        <div class="col-xl-3 col-lg-4 col-sm-12 col-md-4 avatar ">
          <img src="{{$user->avatar}}" alt="avatar utente">
        </div>

        <div class="col-xl-9 col-lg-8 col-sm-12 col-md-8 user_infos">
          <h3 class="inline_bl">{{$user->firstname}} {{$user->lastname}}</h3>
          <h4>{{$user->description}}</h4>
        </div>
      </div>
    </div>
    {{-- /user info --}}

    @if (count($user->flats) > 0)
      {{-- flats list--}}
    <div class="row">
      <div class="col-12">
        <h2>I miei appartamenti:</h2>
      </div>
    </div>

    <div class="row">
      <div class="flats_list">

        @foreach($user->flats as $flat)
          <div class="flat-box">
          {{-- flat --}}
            <div class="col-lg-4 col-md-6 flat-img ">
              <img src="{{ asset('storage/'.$flat->images[0]->path) }}" alt="foto appartamento">
            </div>

            <div class="col-lg-8 col-md-6 flat-info">
              <h3>{{$flat->title}}</h3>
              <p>{{$flat->description}}</p>

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
                  <i class="fas fa-star star"></i>
                @endfor
                @for ($i = 0; $i < $half_star; $i++)
                  <i class="fas fa-star-half star"></i>
                @endfor

                {{--({{ $flat->stars / 2 }})--}}

              </span>
            </div>
          {{-- /flat --}}
          </div>
        @endforeach
      {{-- /flats list--}}
    </div>
    @else

      <h2>Questo utente non ha pubblicato nessun appartamento</h2>

    @endif
    
  </div>
  {{-- /page wrapper --}}

@endsection