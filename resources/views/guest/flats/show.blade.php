@extends('layouts.app')

@section('pageName', 'guest_flats_show')

@section('content')
  {{-- dont't touch --}}

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/leaflet/1/leaflet.css" />

  {{-- /dont't touch --}}

  {{-- carousel images --}}
  <div class="container-fluid px-0 jumbo">
    <div class="row no-gutters">
      <div class="col-12 opacity">
        @foreach($flat->images as $img)
          <img class="" src="{{ asset('storage/'.$img->path) }}" alt="foto appartamento">
        @endforeach
      </div>
    </div>
  {{-- TODO display images as carousel --}}


  {{-- /carousel images --}}

  {{-- flat info --}}
  <h2>{{ $flat->title }} - {{ $flat->user->firstname }} {{ $flat->user->lastname }} -
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
  - € {{ $flat->price }}</h2>
  {{-- /flat info --}}

  {{-- host info --}}
  <h3>{{ $flat->user->firstname }} {{ $flat->user->lastname }}</h3>

  <img src="{{ $flat->user->avatar }}" atl="avatar utente">

  @if ($flat->user->description)
    <p>{{ $flat->user->description }}</p>
  @endif
  {{-- /host info --}}

  {{-- flat description --}}
  <p>{{ $flat->description }}</p>
  {{-- /flat description --}}

  {{-- maps --}}

    {{-- TODO add maps --}}

    <span>{{ $flat->street_name }} - {{ $flat->zip_code }} - {{ $flat->city }}</span>

  {{-- /maps --}}

  {{-- options --}}
  <h3>Servizi</h3>

  <ul>
    @foreach($flat->options as $option)
      <li>{{ $option->name }}</li>
    @endforeach
  </ul>
  {{-- /options --}}


  {{-- info --}}
  <h3>Informazioni</h3>

  <ul>

    @if ($flat->number_of_rooms == 1)
      <li>Stanza: 1</li>
    @else
      <li>Stanze: {{ $flat->number_of_rooms }}</li>
    @endif

    @if ($flat->number_of_beds == 1)
    <li>Letto: 1</li>
    @else
    <li>Letti: {{ $flat->number_of_beds }}</li>
    @endif

    @if ($flat->number_of_bathrooms == 1)
      <li>Bagno: 1</li>
    @else
      <li>Bagni: {{ $flat->number_of_bathrooms }}</li>
    @endif

  </ul>
  {{-- /info --}}


  {{-- extra info --}}
  @if ($flat->extra_options != null)
    <h3>Servizi aggiuntivi</h3>

    @php
      $extra_options_arr = explode(', ', $flat->extra_options)
    @endphp

    <ul>
      @foreach($extra_options_arr as $extra_option)
        <li>{{ $extra_option }}</li>
      @endforeach
    </ul>
  @endif
  {{-- /extra info --}}

  {{-- algolia map --}}

  <div id="map-example-container"></div>

  <style>
    #map-example-container {height: 300px; width:500px};
  </style>

  {{-- /algolia map --}}

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

  <h2>Contatta l'host</h2>
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
@endsection
