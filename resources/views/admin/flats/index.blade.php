@extends ('layouts.app')

@section('content')
<div class="container">
  <h1 class="col-lg-12">Area privata - I miei appartamenti</h1>

  @foreach ($flats as $flat)
    <div class="row">
      <div class="col-lg-2 pt-4 m-3">
        <div class="img-flats">
          <h3>image</h3>
          <img style="max-width: 100px" src="{{ $flat->images[0]->path }}">
        </div>
      </div>

      <div class="card col-lg-6 pt-4 m-3">
        <h2>{{ $flat->title }}</h2>

          <a href="{{ route('admin.flats.show', $flat->slug) }}">Dettagli</a>

          <p>{{ $flat->description }}</p>

          <span> Valutazione: {{ $flat->stars }}</span>
      </div>
      <div class="card__icons col-lg-3 pt-4">
          <div class="sponsorship m-2">
            <a href="#"><i class="fas fa-shopping-cart"></i></a>
          </div>
          <div class="edit m-2">
            <a href="{{ route('admin.flats.edit', $flat->slug) }}"><i class="fas fa-edit"></i></a>
          </div>

          <div class="delete m-2">
              <a href={{ route('admin.flats.destroy', $flat->slug) }}"><i class="fas fa-trash-alt"></i></a>
          </div>

          <div class="message m-2">
            <a href="#"><i class="fas fa-envelope"></i></a>
          </div>
      </div>
      
    </div>
  @endforeach
</div>
@endsection
