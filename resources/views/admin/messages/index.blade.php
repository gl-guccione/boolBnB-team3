@extends ('layouts.app')

@section('pageName', 'admin_messages_index')

@section('content')

  {{-- wrapper --}}
  <div class="container py-4">

    <div class="hero py-4">
      <img class="hero__image py-4" src="{{ asset('img/messages/message.svg') }}" alt="statistics image">
      <h1 class="hero__title py-4">I miei Messaggi</h1>
    </div>

    @if (count($messages) > 0)

      {{-- messages details--}}
      <div class="messages_list">

        @foreach($messages as $message)

          <div class="message p-2 @if($message->seen == 0) to-read  @endif">
            <a class="message__link" href="{{ route('admin.messages.show', $message->id) }}"></a>
            <div class="message__header">
              <div class="message__name overflow_row">{{ $message->name }}</div>
              <div class="message__body overflow_row">{{ $message->message }}</div>
            </div>

            <div class="message__date overflow_row">{{ substr($message->date_of_send, 0, 16) }}</div>

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
  {{-- <script src="https://unpkg.com/aos@next/dist/aos.js"></script> --}}
  {{-- <script>
    AOS.init();
  </script> --}}

@endsection