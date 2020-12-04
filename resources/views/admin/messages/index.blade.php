@extends ('layouts.app')

@section('pageName', 'admin_messages_index')

@section('content')

  {{-- wrapper --}}
  <div class="container">
    <div class="row">
      <h1>I miei messaggi</h1>
    </div>
    {{-- TODO if there are messages show --}}
    @if (1)

      {{-- messages details--}}
      <div class="messages_list">

        @foreach($messages as $message)
        <div class="message_box row" data-aos="fade-up">
          <div class="mex_name mex_offset bg_lightgrey col-lg-7">
            <h3>&gt; {{$message->name}}</h3>
          </div>
          <div class="mex_id bg_lightgrey mex_offset col-lg-2">
            flat ID
            <span class="id_sign">{{$message->flat_id}}</span>
          </div>
          <div class="mex_date bg_lightgrey mex_offset col-lg-2">{{$message->date_of_send}}</div>    

          <div class="mex_text mex_offset col-lg-10">{{ substr($message->message, 0, 57).'...' }}</div>

          {{-- TODO show the complete message with api --}}
          <div class="leggi">
            <div class="link_box">
              <a class="" href="{{ route('admin.messages.show', $message->id) }}">Leggi</a>
            </div>
          </div>
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
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
@endsection