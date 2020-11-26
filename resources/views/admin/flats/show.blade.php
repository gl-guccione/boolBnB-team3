@extends('layouts.app')

@section('content')

  @foreach($flat->images as $img)
    <img src="{{ $img->path }}" alt="foto appartamento">
  @endforeach

  <h2>{{ $flat->title }} - {{ $flat->user->firstname }} {{ $flat->user->lastname }} - valutazione: {{ $flat->stars }} - € {{ $flat->price }}</h2>

  <p>{{ $flat->description }}</p>

  <h3>{{ $flat->user->firstname }} {{ $flat->user->lastname }}</h3>

  <img src="{{ $flat->user->avatar }}" atl="foto utente - {{ $flat->user->firstname }} {{ $flat->user->lastname }}">

  @if ($flat->user->description)
    <p>{{ $flat->user->description }}</p>
  @endif

  <span>{{ $flat->street_name }} - {{ $flat->zip_code }} - {{ $flat->city }}</span>


  <h3>Servizi</h3>

  <ul>

    @foreach($flat->options as $option)
      <li>{{ $option->name }}</li>
    @endforeach

  </ul>


  <h3>Informazioni</h3>

  <ul>

    @if ($flat->number_of_rooms == 1)
      <li>Stanza: 1</li>
    @else
      <li>Stanze: {{ $flat->number_of_rooms }}</li>
    @endif

    @if ($flat->number_of_beds == 1)
    <li>Letto: 1</li>
    @else
    <li>Letti: {{ $flat->number_of_beds }}</li>
    @endif

    @if ($flat->number_of_bathrooms == 1)
      <li>Bagno: 1</li>
    @else
      <li>Bagni: {{ $flat->number_of_bathrooms }}</li>
    @endif

  </ul>

@endsection