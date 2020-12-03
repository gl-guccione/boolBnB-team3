@extends ('layouts.app')

@section('pageName', 'admin_messages_show')

@section('content')

  <h2>Messaggio da {{$message->name}}</h2>
  <h2>del {{$message->date_of_send}}</h2>
  <h2>per l'appartamento con id {{$message->flat_id}}</h2>
  <h2>email {{$message->email}}</h2>
  <p>
    {{$message->message}}
  </p>

@endsection