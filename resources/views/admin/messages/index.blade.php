@extends ('layouts.app')

@section('content')

  {{-- wrapper --}}
  <div class="page_wrapper">

    <h1>I miei messaggi</h1>

    {{-- TODO if there are messages show --}}
    @if (1)

      {{-- messages details--}}
      <div class="messages_list">

        @foreach($messages as $message)

          <div class="mex_name">
            <h3>&gt; {{$message->name}}</h3>
          </div>

          <div class="display_flex">

            {{-- TODO show only 1 row of message --}}
            <div class="mex_text mex_offset">{{$message->message}}</div>

            <div class="mex_id mex_offset">
              flat ID
              <div class="id_sign">{{$message->flat_id}}</div>
            </div>

            <div class="mex_offset">{{$message->date_of_send}}</div>

            {{-- TODO show the complete message with api --}}
            <a class="mex_offset" href="#">Leggi</a>

          </div>

        @endforeach

      </div>
      {{-- /messages details--}}

    @else

      {{-- message if count($messages == 0) --}}

      <h2>Casella postale vuota</h2>

      {{-- /message if count($messages == 0) --}}

    @endif

  </div>
  {{-- /wrapper --}}

@endsection