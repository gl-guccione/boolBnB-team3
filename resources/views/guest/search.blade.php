@extends('layouts.app')

@section('content')

  {{-- form --}}
  <form method="post">

    <div class="form-group">

      <input type="search" id="address" class="form-control" placeholder="Inserisci indirizzo" />
      <p>Selected: <strong id="address-value">none</strong></p>

    </div>

    <div class="form-group">

      <label for="adults"><strong>Ospiti</strong></label>
      <input name="adults" type="number" class="form-control" id="adults" placeholder="Aggiungi adulti" min="1" required>
      <input name="children" type="number" class="form-control" id="children" placeholder="Aggiungi bambini" min="0">

    </div>

    <div class="form-group">

      <label for="title"><strong>Check-in</strong></label>
      <input name="title" type="date" class="form-control" id="title" placeholder="Inserisci titolo" required>

    </div>

    <div class="form-group">

      <label for="title"><strong>Check-out</strong></label>
      <input name="title" type="date" class="form-control" id="title" placeholder="Inserisci titolo" required>

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
