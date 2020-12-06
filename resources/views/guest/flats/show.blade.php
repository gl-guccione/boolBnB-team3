@extends('layouts.app')

@section('pageName', 'guest_flats_show')

@section('content')
  {{-- dont't touch --}}

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/leaflet/1/leaflet.css" />

  {{-- /dont't touch --}}

  {{-- carousel images --}}
  <div class="container-fluid px-0 jumbo">
    <div class="row no-gutters">
      <div class="col-12 px-0 opacity">
        <div class="left"><a href="#"><i class="fas fa-angle-left"></i></a></div>
        <div class="right"><a href=""><i class="fas fa-angle-right"></i></a></div>
        @foreach($flat->images as $img)
          <img class="" src="{{ asset('storage/'.$img->path) }}" alt="foto appartamento">
        @endforeach
      </div>
      {{-- /carousel images --}}
    </div>

    {{-- flat info --}}

      <div class="row">
        <div class="col-12 main-infos-flat">

          <!-- riepilogo su una riga delle info principali -->
          <h2 class="main-infos-flat">{{ $flat->title }}
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
         € {{ $flat->price }}</h2>
        <!-- riepilogo su una riga delle info principali -->

        </div>
      </div>
  </div>
  <div class="container mt-5">

    <!-- user avatar & flat description -->
    <div class="row">
      {{-- host info --}}
      <div class="col-4 user_avatar">

        <img src="{{ $flat->user->avatar }}" atl="avatar utente">
        <h3>{{ $flat->user->firstname }} {{ $flat->user->lastname }}</h3>
        <a href="{{ route("guest.users.show", $flat->user->id) }}"></a>

        @if ($flat->user->description)
          <p>{{ $flat->user->description }}</p>
        @endif

      </div>
      {{-- /host info --}}

      {{-- flat description --}}
      <div class="col-8 flat_description">

        <p>{{ $flat->description }}</p>

      </div>
      {{-- /flat description --}}
    </div>
    <!--/user avatar & flat description -->

    <!-- map -->
    <div data-aos="fade-right" class="row my-5">
      <div class="col-12 flat_map">

          {{-- TODO add maps --}}
          <h2>Trascina il muose e scopri dove si trova l'appartamento..</h2>
          <span>{{ $flat->street_name }} - {{ $flat->zip_code }} - {{ $flat->city }}</span>

        <div id="map-example-container"></div>
      </div>
    </div>
    <!--/map -->

      <!-- informazioni appartamento -->
      <div data-aos="fade-left"class="row my-5">
        <div class="col-12 offset-lg-4 col-lg-8">
          <h2>..e quali servizi offre!</h2>
          <div class="row flat_infos">
            <div class="col-12 col-sm-4">

              {{-- options --}}
              <h3>Servizi</h3>

              <ul class="flat_infos_list">
                @foreach($flat->options as $option)
                  <li><i class="far fa-check-circle"></i> {{ $option->name }}</li>
                @endforeach
              </ul>
              {{-- /options --}}
            </div>
            <div class="col-12 col-sm-4">
              {{-- info --}}
              <h3>Informazioni</h3>

              <ul class="flat_infos_list">

                @if ($flat->number_of_rooms == 1)
                  <li><i class="fas fa-door-closed"></i> Stanza: 1</li>
                @else
                  <li><i class="fas fa-door-closed"></i> Stanze: {{ $flat->number_of_rooms }}</li>
                @endif

                @if ($flat->number_of_beds == 1)
                <li><i class="fas fa-bed"></i> Letto: 1</li>
                @else
                <li><i class="fas fa-bed"></i> Letti: {{ $flat->number_of_beds }}</li>
                @endif

                @if ($flat->number_of_bathrooms == 1)
                  <li><i class="fas fa-sink"></i> Bagno: 1</li>
                @else
                  <li><i class="fas fa-sink"></i> Bagni: {{ $flat->number_of_bathrooms }}</li>
                @endif

              </ul>
              {{-- /info --}}
            </div>
            <div class="col-12 col-sm-4">
              @if ($flat->extra_options != null)


                <h3>Extra</h3>

                @php
                  $extra_options_arr = explode(', ', $flat->extra_options)
                @endphp

                <ul class="flat_infos_list">
                  @foreach($extra_options_arr as $extra_option)
                    <li><i class="fas fa-plus"></i> {{ $extra_option }}</li>
                  @endforeach
                </ul>
              @endif
              {{-- /extra info --}}
            </div>

          </div>
        </div>
      </div>
      <!--/informazioni appartamento -->

    <!-- form per contattare il proprietario -->
    <div data-aos="fade-right" class="row my-5 flat_message">
      <div class="col-12 col-lg-6">
        {{-- form - send message --}}

        @auth
          @php

            $user = Auth::user();
            $user_name = $user->firstname.' '.$user->lastname;
            $user_email = $user->email;

          @endphp
        @else
          @php

          $user_name = '';
          $user_email = '';

          @endphp
        @endauth

        <h2>Infine, contatta l'host per saperne direttamente la disponibilità.</h2>
        <form action="{{ route("guest.messages.store") }}" method="post">

          @csrf
          @method('POST')

          <input type="hidden" name="flat_id" required value="{{ $flat->id }}">

          {{-- name --}}
          <div class="form-group">
            <label for="name">Nome*</label>
            <input name="name" type="text" class="form-control" id="name" placeholder="Inserisci il tuo nome" min="3" max="50" required value="{{ old("name") ?? $user_name }}">
          </div>
          {{-- /name --}}

          {{-- email --}}
          <div class="form-group">
            <label for="email">Email*</label>
            <input name="email" type="text" class="form-control" id="email" placeholder="Inserisci la tua email" min="3" max="255" required value="{{ old("email") ?? $user_email }}">
          </div>
          {{-- /email --}}

          {{-- message --}}
          <div class="form-group">
            <label for="message">Messaggio*</label>
            <textarea name="message" class="form-control" id="message" placeholder="Inserisci il messaggio" rows="5" cols="10" min="3" max="10000" required>{{old("message")}}</textarea>
          </div>
          {{-- /message --}}

          {{-- button submit --}}
          <button type="submit" class="btn btn-primary">Invia Messaggio</button>
          {{-- /button submit --}}

        </form>
        {{-- /form - send message --}}
      </div>
    </div>
    <!-- form per contattare il proprietario -->

  </div>
  {{-- /flat info --}}



  {{-- show errors --}}
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  {{-- show errors --}}


  {{--  function that show map for flats --}}
  <script src="https://cdn.jsdelivr.net/leaflet/1/leaflet.js"></script>
  <script>

    (function() {

      var map = L.map('map-example-container', {
        scrollWheelZoom: false,
        zoomControl: true
      });

      var osmLayer = new L.TileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          minZoom: 0.2,
          maxZoom: 10,
        }
      );

      var markers = [];

      map.setView(new L.LatLng(0, 0), 1);
      map.addLayer(osmLayer);

      function addMarker() {
        var marker = L.marker({lat:{{$flat->lat}},lng:{{$flat->lng}}}, {opacity: .4});
        marker.addTo(map);
        markers.push(marker);
      }

      function findBestZoom() {
        var featureGroup = L.featureGroup(markers);
        map.fitBounds(featureGroup.getBounds().pad(0.5), {animate: false});
      }


      addMarker();
      findBestZoom();

    })();
  </script>

  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
@endsection
