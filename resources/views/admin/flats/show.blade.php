{{-- TODO move this page in the guest/flats/show ?? --}}

@extends('layouts.app')

@section('content')

  {{-- carousel images --}}

  {{-- TODO display images as carousel --}}
  @foreach($flat->images as $img)
    <img src="{{ asset('storage/'.$img->path) }}" alt="foto appartamento">
  @endforeach

  {{-- /carousel images --}}

  {{-- flat info --}}
  <h2>{{ $flat->title }} - {{ $flat->user->firstname }} {{ $flat->user->lastname }} - valutazione: {{ $flat->stars }} - € {{ $flat->price }}</h2>
  {{-- /flat info --}}

  {{-- host info --}}
  <h3>{{ $flat->user->firstname }} {{ $flat->user->lastname }}</h3>

  <img src="{{ $flat->user->avatar }}" atl="avatar utente">

  @if ($flat->user->description)
    <p>{{ $flat->user->description }}</p>
  @endif
  {{-- /host info --}}

  {{-- flat description --}}
  <p>{{ $flat->description }}</p>
  {{-- /flat description --}}

  {{-- maps --}}

    {{-- TODO add maps --}}

    <span>{{ $flat->street_name }} - {{ $flat->zip_code }} - {{ $flat->city }}</span>

  {{-- /maps --}}

  {{-- options --}}
  <h3>Servizi</h3>

  <ul>
    @foreach($flat->options as $option)
      <li>{{ $option->name }}</li>
    @endforeach
  </ul>
  {{-- /options --}}


  {{-- info --}}
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
  {{-- /info --}}


  {{-- extra info --}}
  @if ($flat->extra_options != null)
    <h3>Servizi aggiuntivi</h3>

    @php
      $extra_options_arr = explode(', ', $flat->extra_options)
    @endphp

    <ul>
      @foreach($extra_options_arr as $extra_option)
        <li>{{ $extra_option }}</li>
      @endforeach
    </ul>
  @endif
  {{-- /extra info --}}

@endsection

{{-- TODO form for request --}}