@extends ('layouts.app')

@section('pageName', 'admin_sponsorships_index')

@section('content')

  <div class="container">
  
    <h2>Le mie sponsorizzazzioni</h2>

    @foreach ($sponsorships as $sponsorship)

      <div class="message">

        <div class="title">
          <span>{{ $sponsorship->flat->type}}:</span>
          <h4>{{ $sponsorship->flat->title }}</h4>
        </div>

        <div class="info">
          <p>Durata sponsorizzazzione:</p>
          <span>{{ $sponsorship->sponsorship_price->duration_in_hours }} ore</span>
          <p>Prezzo pagato:</p>
          <span>{{ $sponsorship->sponsorship_price->price }} €</span>
        </div>
        
        <div class="date">
          <p>Data inizio:</p>
          <span>{{ $sponsorship->date_of_start }}</span>
          <p>Data fine:</p>
          <span>{{ $sponsorship->date_of_end }}</span>
        </div>

      </div>

    @endforeach
  
  </div>

@endsection