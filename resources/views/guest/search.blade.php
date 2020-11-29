@php

  $today = date('Y-m-d');

@endphp

@extends('layouts.app')

@section('content')

  {{-- form --}}
  <form method="post">

    <div class="form-group">

      <input type="search" id="address" class="form-control" placeholder="Inserisci indirizzo" value="{{ $algolia }}" required>
      <p>Selected: <strong id="address-value">none</strong></p>

    </div>

    <div class="form-group">

      <label for="adults"><strong>Ospiti</strong></label>
      <input name="adults" type="number" class="form-control" id="adults" placeholder="Aggiungi adulti" min="1" value="{{ $adults }}" required>
      <input name="children" type="number" class="form-control" id="children" placeholder="Aggiungi bambini" min="0" value="{{ $children }}">

    </div>

    <div class="form-group">

      <label for="check_in"><strong>Check-in</strong></label>
      <input name="check_in" type="date" class="form-control" id="check_in" placeholder="Inserisci titolo" min="{{ $today }}" value="{{ $check_in }}" required>

    </div>

    <div class="form-group">

      <label for="check_out"><strong>Check-out</strong></label>
      <input name="check_out" type="date" class="form-control" id="check_out" placeholder="Inserisci titolo" min="{{ $today }}" value="{{ $check_out }}" required>

    </div>

    <div class="form-group">

      <label for="algolia_radius"><strong>Raggio di ricerca</strong></label>
      <select class="form-control" id="algolia_radius" name="algolia_radius" required>
        <option value="10">10km</option>
        <option value="20" selected>20km</option>
        <option value="50">50km</option>
        <option value="100">100km</option>
        <option value="500">500km</option>
      </select>

    </div>

    <a class="btn btn-primary">Cerca</a>

    {{-- options --}}
    <div class="form-check">
      @foreach ($options as $option)
        <div class="div">
          <input type="checkbox" class="form-check-input" id="checkbox_{{$option->id}}">
          <label for="checkbox_{{$option->id}}" class="form-check-label">{{$option->name}}</label>
        </div>
      @endforeach
    </div>
  {{-- /options --}}

  </form>
  {{-- /form --}}

  {{-- results --}}
  <section id="results"></section>
  {{-- /results --}}



@endsection
