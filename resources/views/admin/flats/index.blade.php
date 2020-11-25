@extends ('layouts.app')

@section('content')

    <h1 class="">Area privata - I miei appartamenti</h1>


   
@foreach ($flats as $flat) 
    <h2>{{$flat->title}}</h2>
    <img src={{$flat->images()->first()->path}} />
    <p>{{$flat->description}}</p>
    <span> Valutazione: {{$flat->stars}}</span>
    <a href="#">Sponsorizza</a>
    <a href="#">Edit</a>
    <form action="" method="POST">  
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
    <a href="">Contatti</a>
@endforeach



@endsection

