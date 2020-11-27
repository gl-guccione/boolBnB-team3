@extends('layouts.app')

@section('content')
    @php
        $arrImage = $flat->images()->get();
    @endphp


  @foreach($flat->images as $img)
    <img src="{{asset('storage/'.$img->path)}}" alt="foto appartamento">
  @endforeach

  <h2>{{ $flat->title }} - {{ $flat->user()->first()->firstname }} {{ $flat->user()->first()->lastname }} - valutazione: {{ $flat->stars }} - € {{ $flat->price }}</h2>

  <p>{{ $flat->description }}</p>

  <h3>{{ $flat->user()->first()->firstname }} {{ $flat->user()->first()->lastname }}</h3>

  <img src="{{ $flat->user()->first()->avatar }}" atl="foto appartamento">

  @if ($flat->user()->first()->description)
    <p>{{ $flat->user()->first()->description }}</p>
  @endif

  <span>{{ $flat->street_name }} - {{ $flat->zip_code }} - {{ $flat->city }}</span>


  <h3>Servizi</h3>

  <ul>
    @foreach($flat->options()->get() as $option)
      <li>{{ $option->name }}</li>

    
<h2>{{$flat->title}} - {{$flat->user()->first()->firstname}} {{$flat->user()->first()->lastname}} - valutazione: {{$flat->stars}} - € {{$flat->price}}</h2>
<p>{{$flat->description}}</p>

<h3>{{$flat->user()->first()->firstname}} {{$flat->user()->first()->lastname}}</h3>
    <img src={{$flat->user()->first()->avatar}} atl=" ">
    @if ($flat->user()->first()->description) 
    <p>{{$flat->user()->first()->description}}</p>
    @endif

<span>{{$flat->street_name}} - {{$flat->zip_code}} - {{$flat->city}}</span>

<h3>Servizi</h3>
<ul>
@foreach($flat->options()->get() as $option)
    <li>{{$option->name}}</li>
@endforeach
</ul>

<h3>Informazioni</h3>
<ul>
<li>Stanze: {{$flat->number_of_rooms}}</li>
    <li>Letti: {{$flat->number_of_beds}}</li>
    <li> Bagni: {{$flat->number_of_bathrooms}}</li>
</ul>
@endsection