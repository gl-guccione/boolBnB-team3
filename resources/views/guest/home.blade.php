@extends ('layouts.app')

  @section('content')
    <div class="container">
      <div class="row">
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
      </div>
      <!-- slide 2 pubblicità sito e appartamenti in evidenza -->

      <div class="row">
        <h1>Qui ci andrà la descrizione del progetto</h1>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor distinctio dignissimos reprehenderit illo aliquam ab non vel repellat recusandae voluptatibus unde, ullam iste, iusto eveniet accusamus quia soluta minus dolores.
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor distinctio dignissimos reprehenderit illo aliquam ab non vel repellat recusandae voluptatibus unde, ullam iste, iusto eveniet accusamus quia soluta minus dolores.
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor distinctio dignissimos reprehenderit illo aliquam ab non vel repellat recusandae voluptatibus unde, ullam iste, iusto eveniet accusamus quia soluta minus dolores.
      </div>
      <div class="row sponsored-flats">
        @foreach ($flats as $flat)
          <div class="col-2">
            <a href="{{route("guest.users.show", $flat->id)}}"></a>
            <div class="overlay">
              <h3>{{$flat->title}}</h3>
              <p>{{$flat->city}}</p>
              <span>{{$flat->stars}}</span>
            </div>
            <img src="{{$flat->image}}" alt="#">
          </div>
        @endforeach
      </div>
    </div>

  @endsection
