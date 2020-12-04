@extends ('layouts.app')

@section('pageName', 'admin_sponsorships_index')

@section('content')

  <div>

    @foreach ($sponsorships as $sponsorship)

      <ul>

        <li><h3>Titolo appartemnto: {{ $sponsorship->flat->title }}</h3></li>
        <li>Prezzo pagato: {{ $sponsorship->sponsorship_price->price }}€</li>
        <li>Durata sponsorizzazzione: {{ $sponsorship->sponsorship_price->duration_in_hours }} ore</li>
        <li>Data inizio: {{ $sponsorship->date_of_start }}</li>
        <li>Data fine: {{ $sponsorship->date_of_end }}</li>

      </ul>


    @endforeach

    </div>


@endsection