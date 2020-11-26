@extends('layouts.app')

@section('content')
  <form method="post" enctype="multipart/form-data">
    {{-- algolia input --}}
    <div class="form-group">

      <input type="search" id="address" class="form-control" placeholder="Inserisci indirizzo" />
      <p>Selected: <strong id="address-value">none</strong></p>
    </div>

      <button type="submit" class="btn btn-primary">Effettua la ricerca</button>

    {{-- /algolia input --}}
  </form>

  {{-- options --}}
  <div class="form-check">
  @foreach ($options as $option)
    <div class="div">
      <input type="checkbox" class="form-check-input" id="checkbox_{{$option->id}}">
      <label for="checkbox_{{$option->id}}" class="form-check-label">{{$option->name}}</label>
    </div>
  @endforeach
  </div>



@endsection
