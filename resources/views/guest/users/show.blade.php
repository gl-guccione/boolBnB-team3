@extends('layouts.app')

@section('pageName', 'guest_user_show')


@section('content')

  {{-- page wrapper --}}
  <div class="container page_wrapper">

    {{-- user info --}}
    <div class="row user_container">

        <div class="col-xl-3 col-lg-4 col-sm-5 col-md-4 col-xs-12 avatar">
          <img src="{{$user->avatar}}" alt="avatar utente">
        </div>

        <div class="col-xl-9 col-lg-8 col-sm-7 col-md-8 col-xs-12 user_infos">
          <h3 class="inline_bl">{{$user->firstname}} {{$user->lastname}}</h3>
          <h4>{{$user->description}}</h4>
        </div>

    </div>
    {{-- /user info --}}

    @if (count($user->flats) > 0)
      {{-- flats list--}}
    <div class="row title">
      <div class="col-12">
        <h2>I miei appartamenti:</h2>
      </div>
    </div>

    <div class="">
      <div class="flats_list">

        @foreach($user->flats as $flat)

        <hr class="end_flat">

        {{-- row --}}
        <div class="row">

          {{-- first col --}}
          <div class="col-12 flat__first">

            <div class="flat__textimage d_flex">

              @if (count($flat->images) > 0)
                <img class="flat__image @if($flat->active == 0) inactive @endif" src="{{ asset('storage/'.$flat->images[0]->path) }}" alt="flat image">
              @endif

              <div class="flat__text">

                <h2 class="flat__title overflow_two_rows">
                  <a class="flat__link" href="{{ route('guest.flats.show', $flat->slug) }}">{{ $flat->title }}</a>
                </h2>

                <p class="flat__description overflow_four_rows">
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

        </div>
        {{-- /row --}}

        @endforeach
      {{-- /flats list--}}
    </div>
    @else

      <h2>Questo utente non ha ancora pubblicato nessun appartamento</h2>

    @endif

  </div>
  {{-- /page wrapper --}}
  </div>
@endsection