@php

  $today = date('Y-m-d');

@endphp

@extends('layouts.app')

@section('pageName', 'guest_search')

@section('content')

  <div id="SearchPage"></div>

    <div class="container-fluid">
      <div class="row">
        <div class="hero-container col-12">

          {{-- form --}}
          <div class="col-11 form-home">
            <form>

              {{-- first-row --}}
              <div class="form-row">

                <div class="col-12 col-md-12 col-xl-6">
                  <label for="city"><strong>Dove</strong></label>
                  <input type="search" id="city" data-algolia="{{ $data_algolia }}" class="form-control" placeholder="Inserisci indirizzo" value="{{ $algolia }}" required>
                </div>

                <div class="col-6 col-sm-4 col-md-3 col-xl-2">

                  <label for="check_in"><strong>Check-in</strong></label>
                  <input name="check_in" type="date" class="form-control" id="check_in" placeholder="Inserisci titolo" min="{{ $today }}" value="{{ $check_in }}" required>

                </div>
                <div class="col-6 col-sm-4 col-md-3 col-xl-2">

                  <label for="check_out"><strong>Check-out</strong></label>
                  <input name="check_out" type="date" class="form-control" id="check_out" placeholder="Inserisci titolo" min="{{ $today }}" value="{{ $check_out }}" required>

                </div>

                <div class="col-12 col-sm-4 col-md-3 offset-md-3 offset-xl-0 col-xl-2">
                  <div>
                    <label for="algolia_radius"><strong>Raggio di ricerca</strong></label>
                  </div>
                  <div>
                    <select class="form-control" id="algolia_radius" name="algolia_radius" required>
                      <option value="10">10km</option>
                      <option value="20" selected>20km</option>
                      <option value="50">50km</option>
                      <option value="100">100km</option>
                      <option value="500">500km</option>
                    </select>
                  </div>
                </div>

              </div>
              {{-- /first-row --}}

              {{-- second-row --}}
              <div class="form-row">

                <div class="col-6 col-sm-2 col-md-2">

                  <label for="adults"><strong>Ospiti</strong></label>
                  <input name="adults" type="number" class="form-control" id="adults" placeholder="Adulti" min="1" value="{{ $adults }}" required>

                </div>

                <div class="col-6 col-sm-2 col-md-2">

                  <label for="children"><strong class="transparent">.</strong></label>
                  <input name="children" type="number" class="form-control" id="children" placeholder="Bambini" min="0" value="{{ $children }}">

                </div>

                <div class="col-4 col-sm-2 col-md-2 offset-sm-2 offset-md-2 col-xl-1 offset-xl-1">

                  <label for="rooms"><strong>Stanze</strong></label>
                  <input type="number" class="form-control" id="rooms" placeholder="Min." min="1">

                </div>

                <div class="col-4 col-sm-2 col-md-2 col-lg-2 col-xl-1">

                  <label for="beds"><strong>Letti</strong></label>
                  <input type="number" class="form-control" id="beds" placeholder="Min." min="1">

                </div>

                <div class="col-4 col-sm-2  col-md-2 col-lg-2 col-xl-1">

                  <label for="bathrooms"><strong>Bagni</strong></label>
                  <input type="number" class="form-control" id="bathrooms" placeholder="Min." min="1">

                </div>

                {{-- button filters --}}
                <div class="col-4 offset-4 offset-sm-0 col-sm-3 offset-sm-5 offset-md-0 col-sm-3 col-md-2 offset-md-8 col-lg-2 col-xl-1 offset-xl-1">
                  <a id="filters" class="btn button edit" style="width: 100%">Filtri <i class="fas fa-chevron-down"></i></a>
                </div>
                {{-- /button filters --}}


                {{-- submit --}}
                <div class="col-4 col-sm-3 offset-sm-1 offset-md-0 col-sm-3 col-md-2 col-lg-2 col-xl-1 offset-xl-1">
                  <a id="submitSearch" class="btn button" style="width: 100%">Cerca</a>
                </div>
                {{-- /submit --}}

              </div>
              {{-- /second-row --}}

              {{-- options --}}
              <div class="form-check d_none">
                @foreach ($options as $option)

                  <div class="checkbox">
                    <input type="checkbox" id="checkbox_{{$option->id}}">
                    <label for="checkbox_{{$option->id}}" class="form-check-label">{{$option->name}}</label>
                  </div>

                @endforeach
                </div>
                {{-- /options --}}

            </form>
          </div>
          {{-- /form --}}

        </div>
      </div>

      </div>


  {{-- results --}}
  <section class="container-fluid results" id="results">
    <div class="row flat-line" id="sponsored">

    </div>
    <div class="row flat-line" id="not-sponsored">

    </div>
  </section>
  {{-- /results --}}

  <script id="flat-template" type="text/x-handlebars-template">
    <div class="col-12 col-sm-12 col-md-6 col-lg-4 entry-flat">
      <div class="card_container">
        <a class="link_view" href='@{{link}}'></a>
        <div class="flat-img-box">
          <img src="/storage/@{{image}}" alt="@{{ title }}">
        </div>
        <div class="flat-text-box">
          <h4>Titolo: @{{title}}</h4>
          <p>Descrizione: @{{description}}</p>
          <span>Valutazione: @{{stars}}</span><br>
          <span>Prezzo: @{{price}}</span>
        </div>
      </div>
    </div>
  </script>

</div>
@endsection
