@extends ('layouts.app')

@section('content')

<h1>I miei messaggi</h1>

{{-- messages details--}}
@foreach($messages as $message)
<h3>{{$message->name}}</h3>
<div class="display_flex">
    <div>{{$message->message}}</div>
    <div>{{$message->flat_id}}</div> 
    <div>{{$message->date_of_send}}</div>
    <a class="red" href="#">Reply this message</a>
</div>
@endforeach


@endsection