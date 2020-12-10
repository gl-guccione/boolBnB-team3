@extends('layouts.app')

@section('pageName', 'guest_flats_show')

@section('content')
  {{-- dont't touch --}}

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/leaflet/1/leaflet.css" />

  {{-- /dont't touch --}}

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

  <div class="container">

    <div class="header">
      <h1>{{ $flat->title}}</h1>
      <h4 data-toggle="tooltip" data-placement="left" title="tipologia">{{ $flat->type}}</h4>
      <p data-toggle="tooltip" data-placement="left" title="città"><i class="fas fa-map-marker-alt"></i> {{ $flat->city }}</p>
    </div>

    <hr>


    {{-- slider images --}}
    <section class="carousel">
      <div class="slideshow-container">

        @php
          $i = 1;
        @endphp
        @foreach ($flat->images as $img)
          <div class="mySlides">
            <div class="numbertext"> {{ $i }} / {{ count($flat->images) }}</div>
            <img src="{{ asset('storage/'.$img->path) }}">
          </div>

          @php
            $i = $i + 1;
          @endphp
        @endforeach

        {{-- prev img --}}
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        {{-- next img --}}
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
      </div>

      <!-- The dots/circles -->
      <div style="text-align:center">

        @for ($i = 1; $i < count($flat->images) + 1; $i++)
          <span class="dot" onclick="currentSlide({{ $i }})"></span>
        @endfor

      </div>

    </section>
    {{-- /slider images --}}

    <div class="info">
      <h2>Informazioni generali</h2>


      {{-- options --}}
      <ul class="flat_infos_list">

        <li data-toggle="tooltip" data-placement="top" title="Superficie m²"><i class="fas fa-border-style"></i> {{ $flat->mq}} m² </li>

        @if ($flat->number_of_rooms == 1)
          <li data-toggle="tooltip" data-placement="top" title="numero di stanze"><i class="fas fa-door-open"></i> Stanza: 1</li>
        @else
          <li data-toggle="tooltip" data-placement="top" title="numero di stanze"><i class="fas fa-door-open"></i> Stanze: {{ $flat->number_of_rooms }}</li>
        @endif

        @if ($flat->number_of_beds == 1)
        <li data-toggle="tooltip" data-placement="top" title="numero di letti"><i class="fas fa-bed"></i> Letto: 1</li>
        @else
        <li data-toggle="tooltip" data-placement="top" title="numero di letti"><i class="fas fa-bed"></i> Letti: {{ $flat->number_of_beds }}</li>
        @endif

        @if ($flat->number_of_bathrooms == 1)
          <li data-toggle="tooltip" data-placement="top" title="numero di bagni"><i class="fas fa-restroom"></i> Bagno: 1</li>
        @else
          <li data-toggle="tooltip" data-placement="top" title="numero di bagni"><i class="fas fa-restroom"></i> Bagni: {{ $flat->number_of_bathrooms }}</li>
        @endif

      </ul>
      {{-- /option --}}

      {{-- stars --}}
      <div class="stars">

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

      </div>
      {{-- /stars --}}

      <div class="user_and_description">
        {{-- host info --}}
        <div class="user_avatar">

          <small>Annuncio pubblicato da</small>
          <div class="name">
            <a href="{{ route("guest.users.show", $flat->user->id) }}">
              <img src="{{ asset($flat->user->avatar) }}" alt="avatar utente">
              <h5>{{ $flat->user->firstname }} {{ $flat->user->lastname }}</h5>
              </a>
          </div>


          @if ($flat->user->description)
            <p class="overflow_two_rows">{{ $flat->user->description }}</p>
          @endif

          <span>Utente attivo dal {{ $flat->user->created_at->year }}</span>
        </div>
        {{-- /host info --}}

        {{-- <hr> --}}

        {{-- description --}}
        <div class="description">
          <h2>Descrizione</h2>

          <p>{{ $flat->description }}</p>
        </div>
        {{-- /description --}}
      </div>

      <hr>

      {{-- price --}}
      <div class="price">
        <h4><i class="far fa-calendar-alt"></i> Prezzo per notte:</h4>
        <span>{{ $flat->price }} € </span>
      </div>
      {{-- /price --}}

    </div>

    <hr>

    @if (count($flat->options) > 0)
      {{-- options --}}
      <div class="services">
            <h3>Servizi</h3>

            <ul class="flat_infos_list">
              @foreach($flat->options as $option)
                <li><i class="far fa-check-circle"></i> {{ $option->name }}</li>
              @endforeach
            </ul>
      </div>
      {{-- /options --}}
    @endif

    <hr>

    <!-- map -->
    <div class="flat_map">

      <h2>Trascina il muose e scopri dove si trova l'appartamento..</h2>
      <div id="map-example-container"></div>

      <span><i class="fas fa-map-marker-alt"></i> {{ $flat->street_name }} - {{ $flat->zip_code }} - {{ $flat->city }}</span>
    </div>
    <!--/map -->

    <hr>


    <!-- form per contattare il proprietario -->
    <div class="">
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
          <label for="name"><i class="fas fa-user"></i> Nome*</label>
          <input name="name" type="text" class="form-control" id="name" placeholder="Inserisci il tuo nome" min="3" max="50" required value="{{ old("name") ?? $user_name }}">
        </div>
        {{-- /name --}}

        {{-- email --}}
        <div class="form-group">
          <label for="email"><i class="fas fa-at"></i> Email*</label>
          <input name="email" type="text" class="form-control" id="email" placeholder="Inserisci la tua email" min="3" max="255" required value="{{ old("email") ?? $user_email }}">
        </div>
        {{-- /email --}}

        {{-- message --}}
        <div class="form-group">
          <label for="message"><i class="fas fa-envelope-open-text"></i> Messaggio*</label>
          <textarea name="message" class="form-control" id="message" placeholder="Inserisci il messaggio" rows="5" cols="10" min="3" max="10000" required>{{old("message")}}</textarea>
        </div>
        {{-- /message --}}

        {{-- button submit --}}
        <button type="submit" class="btn btn-primary button"><i class="far fa-paper-plane"></i> Invia Messaggio</button>
        {{-- /button submit --}}

      </form>
      {{-- /form - send message --}}
    </div>
  </div>
  <!-- form per contattare il proprietario -->




  {{-- slider images flat --}}
  <script>
      var slideIndex = 1;
      showSlides(slideIndex);

      // Next/previous controls
      function plusSlides(n) {
        showSlides(slideIndex += n);
      }

      // Thumbnail image controls
      function currentSlide(n) {
        showSlides(slideIndex = n);
      }

      function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("dot");
        if (n > slides.length) {slideIndex = 1}
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex-1].style.display = "block";
        dots[slideIndex-1].className += " active";
      }
  </script>
  {{-- /slider images flat --}}

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
  {{--  /function that show map for flats --}}

@endsection
