@extends ('layouts.app')

  @section('content')

    <!-- slide 1 jumbotron e form search -->
  <div class="jumbotron">
    <form action="{{route("guest.homepage.search")}}" method="get" enctype="multipart/form-data">
      @csrf
      @method('GET')
      <div class="form-group">
        <input type="search" id="address" class="form-control" placeholder="Inserisci indirizzo" />
        <p>Selected: <strong id="address-value">none</strong></p>
      </div>
      <div class="form-group">
        <label for="guests">Numero di ospiti</label>
        <input name="guests" type="number" class="form-control" id="guests" placeholder="Aggiungi ospiti" min="0" max="254" required>
      </div>
      <div class="form-group">
        <label for="title">Check-in</label>
        <input name="title" type="date" class="form-control" id="title" placeholder="Inserisci titolo" min="3" max="255" required>
      </div>
      <div class="form-group">
        <label for="title">Check-out</label>
        <input name="title" type="date" class="form-control" id="title" placeholder="Inserisci titolo" min="3" max="255" required>
      </div>
        <button type="submit" class="btn btn-primary">Cerca</button>
    </form>
  </div>


  @endsection
