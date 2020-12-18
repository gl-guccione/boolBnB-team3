@extends('layouts.app')

@section('pageName', 'admin_flats_edit')

@section('content')

{{-- container --}}
<div class="container edit_box pt-4">

  <div class="hero py-4">
    <img class="hero__image py-4" src="{{ asset('img/flats/edit.svg') }}" alt="edit flat">
    <h1 class="hero__title py-4">Modifica appartamento</h1>
  </div>

  {{-- row --}}
  <div class="">


    {{-- form --}}
    <form action="{{route("admin.flats.update", $flat->slug)}}" method="post" enctype="multipart/form-data" class="row wd_100">

      @csrf
      @method('PUT')

      {{-- title --}}
      <div class="form-group col-lg-12">
        <label for="title"><i class="fas fa-heading"></i> Titolo*</label>
        <input name="title" type="text" class="form-control" id="title" placeholder="Inserisci titolo" min="3" max="255" required value="{{old("title") ?? $flat->title}}">
      </div>
      {{-- /title --}}

      {{-- description --}}
      <div class="form-group col-lg-12">
        <label for="description"><i class="fas fa-info"></i> Descrizione*</label>
        <textarea name="description" class="form-control" id="description" placeholder="Inserisci descrizione" rows="5" cols="10" min="3" max="65000" required>{{old("description") ?? $flat->description}}</textarea>
      </div>
      {{-- /description --}}

      {{-- number_of_rooms --}}
      <div class="form-group col-lg-4 col-md-6">
        <label for="number_of_rooms"><i class="fas fa-door-open"></i> Numero di stanze*</label>
        <input name="number_of_rooms" type="number" class="form-control" id="number_of_rooms" placeholder="Inserisci numero di stanze" min="0" max="254" required value="{{old("number_of_rooms") ?? $flat->number_of_rooms}}">
      </div>
      {{-- /number_of_rooms --}}

      {{-- number_of_beds --}}
      <div class="form-group col-lg-4 col-md-6">
        <label for="number_of_beds"><i class="fas fa-bed"></i> Numero di letti*</label>
        <input name="number_of_beds" type="number" class="form-control" id="number_of_beds" placeholder="Inserisci numero di letti" min="0" max="254" required value="{{old("number_of_beds") ?? $flat->number_of_beds}}">
      </div>
      {{-- /number_of_beds --}}

      {{-- number_of_bathrooms --}}
      <div class="form-group col-lg-4 col-md-6">
        <label for="number_of_bathrooms"><i class="fas fa-restroom"></i> Numero di bagni*</label>
        <input name="number_of_bathrooms" type="number" class="form-control" id="number_of_bathrooms" placeholder="Inserisci numero di bagni" min="0" max="254" required value="{{old("number_of_bathrooms") ?? $flat->number_of_bathrooms}}">
      </div>
      {{-- /number_of_bathrooms --}}

      {{-- mq --}}
      <div class="form-group col-lg-4 col-md-6">
        <label for="mq"><i class="fas fa-border-style"></i> Superficie m²*</label>
        <input name="mq" type="number" class="form-control" id="mq" placeholder="Metri quadri" min="0" max="65000" required value="{{old("mq") ?? $flat->mq}}">mq
      </div>
      {{-- /mq --}}

      {{-- price --}}
      <div class="form-group col-lg-4 col-md-6">
        <label for="price"><i class="fas fa-euro-sign"></i> Prezzo*</label>
        <input name="price" type="number" class="form-control" id="price" placeholder="Inserisci il prezzo per notte" min="0" max="9999" step="0.01" required value="{{old("price") ?? $flat->price}}">
      </div>
      {{-- /price --}}

      {{-- type --}}
      <div class="form-group col-lg-4 col-md-6">
        <label for="type"><i class="fas fa-home"></i> Tipologia*</label>
        <select class="form-control" id="type" name="type">
          <option value="villetta">villetta</option>
          <option value="appartamento">appartamento</option>
        </select>
      </div>
      {{-- /type --}}

      {{-- TODO add images --}}

      {{-- algolia input --}}
      <div class="form-group col-lg-6 col-md-12">
        <label for="street_name"><i class="fas fa-map-marker-alt"></i> Indirizzo*</label>
        <input type="search" class="form-control" id="street_name" name="street_name" placeholder="Inserisci l'indirizzo" value="{{old("street_name") ?? $flat->street_name}}">
      </div>

      <div class="form-group col-lg-6 col-md-12">
        <label for="form-address2"><i class="fas fa-info-circle"></i> Indirizzo 2</label>
        <input type="text" class="form-control" id="form-address2" placeholder="Opzionale" value="{{old("form-address2")}}">
      </div>

      <div class="form-group col-lg-6 col-md-6">
        <label for="city"><i class="fas fa-city"></i> Città*</label>
        <input type="text" class="form-control" id="city" name="city" placeholder="Inserisci città" value="{{old("city") ?? $flat->city}}">
      </div>

      <div class="form-group col-lg-6 col-md-6">
        <label for="zip_code"><i class="far fa-window-restore"></i> CAP*</label>
        <input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="Inserisci codice postale" value="{{old("zip_code") ?? $flat->zip_code}}">
      </div>
      {{-- /algolia input --}}

      {{-- input hidden for address --}}
        <input type="hidden" id="lat" name="lat" value="{{old("lat") ?? $flat->lat}}">
        <input type="hidden" id="lng" name="lng" value="{{old("lng") ?? $flat->lng}}">
      {{-- /input hidden for address --}}

      {{-- options --}}
      <div class="form-row">
        <div class="form-check col-md-12">
          <div class="row mg-l">

            {{-- option --}}
            @foreach ($options as $option)

              @php
                $checked = in_array($option->id, $flat->options->pluck('id')->toArray()) ? true : false;
              @endphp

              <div class="div col-lg-3 col-md-6 col-sm-12">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="form-check-input" name="options[]" id="checkbox_{{$option->id}}" value="{{$option->id}}" {{ $checked ? 'checked' : null}}>
                  <label for="checkbox_{{$option->id}}" class="form-check-label">{{$option->name}}</label>
                </div>
              </div>
            @endforeach
            {{-- /option --}}

          </div>
        </div>
      </div>
      {{-- /options --}}

      {{-- button submit --}}
      <button type="submit" class="btn btn-custom submit">Aggiorna appartamento</button>
      {{-- /button submit --}}

    </form>
    {{-- /form --}}

  </div>
  {{-- /row --}}

{{-- /container --}}
</div>

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

@endsection