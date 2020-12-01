@php

  $today = date('Y-m-d');

@endphp

@extends('layouts.app')

@section('content')

  <div id="SearchPage">

  <div class="hero">
    {{-- form --}}
    
    <form class="form-box" method="post">
     
      {{-- input algolia search --}}
      <div class="line">
      <div class="form-group address fl_left">
          <input type="search" id="city" data-algolia="{{ $data_algolia }}" class="form-control" placeholder="Inserisci indirizzo" value="{{ $algolia }}" required>
      </div>
          <div class="form-group km fl_left">
            <div class="fl_left">
              <label class="l_height_30" for="algolia_radius"><strong>Raggio di ricerca</strong></label>
            </div>
            <div class="fl_left">
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
          
      <div class="line">
          <div class="form-group fl_left">
    
              <label for="check_in"><strong>Check-in</strong></label>
              <input name="check_in" type="date" class="form-control" id="check_in" placeholder="Inserisci titolo" min="{{ $today }}" value="{{ $check_in }}" required>
    
          </div>
    
          <div class="form-group fl_left">
    
              <label for="check_out"><strong>Check-out</strong></label>
              <input name="check_out" type="date" class="form-control" id="check_out" placeholder="Inserisci titolo" min="{{ $today }}" value="{{ $check_out }}" required>
    
          </div>
         
          
          {{-- ospiti --}}
          <div class="form-group fl_left">

            <label for="adults"><strong>Ospiti</strong></label>
            <input name="adults" type="number" class="form-control" id="adults" placeholder="Aggiungi adulti" min="1" value="{{ $adults }}" required>
            <input name="children" type="number" class="form-control" id="children" placeholder="Aggiungi bambini" min="0" value="{{ $children }}">

          </div>
          {{-- stanze-bagni-letti --}}
          <div class="form-group fl_left">

            <input type="number" class="form-control" id="rooms" placeholder="Minimo stanze" min="1">
            <input type="number" class="form-control" id="beds" placeholder="Minimo posti letto" min="1">
            <input type="number" class="form-control" id="bathrooms" placeholder="Minimo bagni" min="1">

          </div>
        </div>
        {{--SUBMIT  --}}
        <div class="line">
          <a id="submitSearch" class="btn btn-primary">Cerca</a>
          <a id="filters" class="btn">more filters <i class="fas fa-chevron-down"></i></a>
        </div>

        {{-- options --}}
        <div class="form-check ">
        @foreach ($options as $option)
          <div class="checkbox fl_left">
            <input type="checkbox" class="form-check-input" id="checkbox_{{$option->id}}">
            <label for="checkbox_{{$option->id}}" class="form-check-label">{{$option->name}}</label>
          </div>
        @endforeach
      </div>
      {{-- /options --}}
    </form>
    {{-- /form --}}
    </div>


  {{-- results --}}
  <section class="container" id="results">
    <div class="row flat-line" id="sponsored">

    </div>
    <div class="row flat-line" id="not-sponsored">

    </div>
  </section>
  {{-- /results --}}

  <script id="flat-template" type="text/x-handlebars-template">
    <div class="entry-flat">
      <div class="flat-img-box">
        <img src="/storage/@{{image}}" alt="@{{ title }}">
      </div>
      <div class="flat-text-box">
        <h4>Titolo: @{{title}}</h4>
        <p>Descrizione: @{{description}}</p>
        <p>Valutazione: @{{stars}}</p>
        <p>Prezzo: @{{price}}</p>
      </div>
    </div>
  </script>

  </div>
@endsection
