@extends('layouts.app')

@section('content')
  <form action="{{route("admin.flats.store")}}" enctype="multipart/form-data" method="post">
    @csrf
    @method('POST')
    <div class="form-group">
      <label for="title">Titolo</label>
      <input name="title" type="text" class="form-control" id="title" placeholder="Inserisci titolo" required>
    </div>
    <div class="form-group">
      <label for="description">Descrizione</label>
      <textarea name="description"class="form-control" id="description" placeholder="Inserisci descrizione" rows="5" cols="10"required></textarea>
    </div>
    <div class="form-group">
      <label for="number_of_rooms">Numero di stanze</label>
      <input name="number_of_rooms" type="number" class="form-control" id="number_of_rooms" placeholder="Inserisci numero di stanze" required>
    </div>
    <div class="form-group">
      <label for="number_of_beds">Numero di letti</label>
      <input name="number_of_beds" type="number" class="form-control" id="number_of_beds" placeholder="Inserisci numero di letti" required>
    </div>
    <div class="form-group">
      <label for="number_of_bathrooms">Numero di bagni</label>
      <input name="number_of_bathrooms" type="number" class="form-control" id="number_of_bathrooms" placeholder="Inserisci numero di bagni" required>
    </div>
    <div class="form-group">
      <label for="mq">Metri quadri</label>
      <input name="mq" type="number" class="form-control" id="mq" placeholder="Metri quadri" required>mq
    </div>
    <div class="form-group">
      <label for="price">Prezzo</label>
      <input name="price" type="number" min="0" step="0.01" class="form-control" id="price" placeholder="Inserisci il prezzo per notte" required>
    </div>
    <div class="form-group">
      <label for="type">Tipologia</label>
      <select class="form-control" id="type" name="type">
        <option value="villetta">villetta</option>
        <option value="appartamento">appartamento</option>
      </select>
    </div>
    {{-- test algolia input --}}
 <input type="search" id="address" class="form-control" placeholder="Where are we going?" />  <p>Selected: <strong id="address-value">none</strong></p>

  {{-- @dd($options) --}}
  <div class="form-check">
  @foreach ($options as $option)
    <div class="div">
    <input type="checkbox" class="form-check-input" id="checkbox_{{$option->id}}">
    <label for="checkbox_{{$option->id}}" class="form-check-label">{{$option->name}}</label>
    </div>
  @endforeach
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
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
