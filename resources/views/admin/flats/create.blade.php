@extends('layouts.app')

@section('content')

  <form action="{{route("admin.flats.store")}}" method="post" enctype="multipart/form-data">

    @csrf
    @method('POST')

    <div class="form-group">
      <label for="title">Titolo</label>
      <input name="title" type="text" class="form-control" id="title" placeholder="Inserisci titolo" min="3" max="255" required>
    </div>

    <div class="form-group">
      <label for="description">Descrizione</label>
      <textarea name="description" class="form-control" id="description" placeholder="Inserisci descrizione" rows="5" cols="10" min="3" max="65000" required></textarea>
    </div>

    <div class="form-group">
      <label for="number_of_rooms">Numero di stanze</label>
      <input name="number_of_rooms" type="number" class="form-control" id="number_of_rooms" placeholder="Inserisci numero di stanze" min="0" max="254" required>
    </div>

    <div class="form-group">
      <label for="number_of_beds">Numero di letti</label>
      <input name="number_of_beds" type="number" class="form-control" id="number_of_beds" placeholder="Inserisci numero di letti" min="0" max="254" required>
    </div>

    <div class="form-group">
      <label for="number_of_bathrooms">Numero di bagni</label>
      <input name="number_of_bathrooms" type="number" class="form-control" id="number_of_bathrooms" placeholder="Inserisci numero di bagni" min="0" max="254" required>
    </div>

    <div class="form-group">
      <label for="mq">Metri quadri</label>
      <input name="mq" type="number" class="form-control" id="mq" placeholder="Metri quadri" min="0" max="65000" required>mq
    </div>

    <div class="form-group">
      <label for="price">Prezzo</label>
      <input name="price" type="number" class="form-control" id="price" placeholder="Inserisci il prezzo per notte" min="0" max="9999" step="0.01" required>
    </div>

    <div class="form-group">
      <label for="type">Tipologia</label>
      <select class="form-control" id="type" name="type">
        <option value="villetta">villetta</option>
        <option value="appartamento">appartamento</option>
      </select>
    </div>

    {{-- algolia input --}}

      <input name="algolia" type="search" id="address" class="form-control" placeholder="Inserisci indirizzo" />
      <p>Selected: <strong id="address-value">none</strong></p>

    {{-- /algolia input --}}

    <div class="form-check">
    @foreach ($options as $option)
      <div class="div">
        <input type="checkbox" class="form-check-input" id="checkbox_{{$option->id}}">
        <label for="checkbox_{{$option->id}}" class="form-check-label">{{$option->name}}</label>
      </div>
    @endforeach
    </div>

    <button type="submit" class="btn btn-primary">Pubblica appartamento</button>

  </form>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
         @foreach ($errors->all() as $error)
           <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

@endsection