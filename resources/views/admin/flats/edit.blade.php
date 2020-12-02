@extends('layouts.app')

@section('pageName', 'admin_flats_edit')

@section('content')

  {{-- form --}}
  <form action="{{route("admin.flats.update", $flat->slug)}}" method="post" enctype="multipart/form-data">

    @csrf
    @method('PUT')

    {{-- title --}}
    <div class="form-group">
      <label for="title">Titolo*</label>
      <input name="title" type="text" class="form-control" id="title" placeholder="Inserisci titolo" min="3" max="255" required value="{{old("title") ?? $flat->title}}">
    </div>
    {{-- /title --}}

    {{-- description --}}
    <div class="form-group">
      <label for="description">Descrizione*</label>
      <textarea name="description" class="form-control" id="description" placeholder="Inserisci descrizione" rows="5" cols="10" min="3" max="65000" required>{{old("description") ?? $flat->description}}</textarea>
    </div>
    {{-- /description --}}

    {{-- number_of_rooms --}}
    <div class="form-group">
      <label for="number_of_rooms">Numero di stanze*</label>
      <input name="number_of_rooms" type="number" class="form-control" id="number_of_rooms" placeholder="Inserisci numero di stanze" min="0" max="254" required value="{{old("number_of_rooms") ?? $flat->number_of_rooms}}">
    </div>
    {{-- /number_of_rooms --}}

    {{-- number_of_beds --}}
    <div class="form-group">
      <label for="number_of_beds">Numero di letti*</label>
      <input name="number_of_beds" type="number" class="form-control" id="number_of_beds" placeholder="Inserisci numero di letti" min="0" max="254" required value="{{old("number_of_beds") ?? $flat->number_of_beds}}">
    </div>
    {{-- /number_of_beds --}}

    {{-- number_of_bathrooms --}}
    <div class="form-group">
      <label for="number_of_bathrooms">Numero di bagni*</label>
      <input name="number_of_bathrooms" type="number" class="form-control" id="number_of_bathrooms" placeholder="Inserisci numero di bagni" min="0" max="254" required value="{{old("number_of_bathrooms") ?? $flat->number_of_bathrooms}}">
    </div>
    {{-- /number_of_bathrooms --}}

    {{-- mq --}}
    <div class="form-group">
      <label for="mq">Metri quadri*</label>
      <input name="mq" type="number" class="form-control" id="mq" placeholder="Metri quadri" min="0" max="65000" required value="{{old("mq") ?? $flat->mq}}">mq
    </div>
    {{-- /mq --}}

    {{-- price --}}
    <div class="form-group">
      <label for="price">Prezzo*</label>
      <input name="price" type="number" class="form-control" id="price" placeholder="Inserisci il prezzo per notte" min="0" max="9999" step="0.01" required value="{{old("price") ?? $flat->price}}">
    </div>
    {{-- /price --}}

    {{-- type --}}
    <div class="form-group">
      <label for="type">Tipologia*</label>
      <select class="form-control" id="type" name="type">
        <option value="villetta">villetta</option>
        <option value="appartamento">appartamento</option>
      </select>
    </div>
    {{-- /type --}}

    {{-- TODO add images --}}

    {{-- algolia input --}}
    <div class="form-group">
      <label for="street_name">Indirizzo*</label>
      <input type="search" class="form-control" id="street_name" name="street_name" placeholder="Inserisci l'indirizzo" value="{{old("street_name") ?? $flat->street_name}}">
    </div>

    <div class="form-group">
      <label for="form-address2">Indirizzo 2</label>
      <input type="text" class="form-control" id="form-address2" placeholder="Opzionale" value="{{old("form-address2")}}">
    </div>

    <div class="form-group">
      <label for="city">Città*</label>
      <input type="text" class="form-control" id="city" name="city" placeholder="Inserisci città" value="{{old("city") ?? $flat->city}}">
    </div>

    <div class="form-group">
      <label for="zip_code">CAP*</label>
      <input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="Inserisci codice postale" value="{{old("zip_code") ?? $flat->zip_code}}">
    </div>
    {{-- /algolia input --}}

    {{-- input hidden for address --}}
      <input type="hidden" id="lat" name="lat" value="{{old("lat") ?? $flat->lat}}">
      <input type="hidden" id="lng" name="lng" value="{{old("lng") ?? $flat->lng}}">
    {{-- /input hidden for address --}}

   {{-- options --}}
    <div class="form-check">

      {{-- option --}}
      @foreach ($options as $option)

        @php
          $checked = in_array($option->id, $flat->options->pluck('id')->toArray()) ? true : false;
        @endphp

        <div class="div">
          <input type="checkbox" class="form-check-input" name="options[]" id="checkbox_{{$option->id}}" value="{{$option->id}}" {{ $checked ? 'checked' : null}}>
          <label for="checkbox_{{$option->id}}" class="form-check-label">{{$option->name}}</label>
        </div>
      @endforeach
      {{-- /option --}}

    </div>
    {{-- /options --}}


    {{-- post privacy --}}
    <div class="form-check">
      <input type="radio" value=1 name="active" id="active" checked>
      <label for="active" class="form-check-label">Crea annuncio pubblico</label>

      <input type="radio" value=0 name="active" id="active_off" >
      <label for="active" class="form-check-label">Crea annuncio privato</label>
    </div>
    {{-- /post privacy --}}

    {{-- button submit --}}
    <button type="submit" class="btn btn-primary">Pubblica appartamento</button>
    {{-- /button submit --}}

  </form>
  {{-- /form --}}

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