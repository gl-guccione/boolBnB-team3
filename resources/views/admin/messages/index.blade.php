@extends ('layouts.app')

@section('content')
<div class="page_wrapper">
<h1>I miei messaggi</h1>

{{-- messages details--}}
<div class="messages_list">
@foreach($messages as $message)
<div class="mex_name">
    <h3>&gt; {{$message->name}}</h3>
</div>
<div class="display_flex">
    <div class="mex_text mex_offset">{{$message->message}}</div>
    <div class="mex_id mex_offset">flat ID<br /><div class="id_sign">{{$message->flat_id}}</div></div> 
    <div class="mex_offset">{{$message->date_of_send}}</div>
    <a class="mex_offset" href="#">Reply this message</a>
</div>
@endforeach
</div>
</div>

@endsection