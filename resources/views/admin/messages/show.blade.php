@extends ('layouts.app')

@section('pageName', 'admin_messages_show')

@section('content')

  {{-- wrapper --}}
  <div class="container py-4">

    <div class="hero py-4">
      <img class="hero__image py-4" src="{{ asset('img/messages/message_2.svg') }}" alt="messages image">
      <h1 class="hero__title py-4">Messaggio da {{$message->name}}</h1>
    </div>

    <div class="message">

      <div class="message__info">
        <h5>
          <i class="fas fa-reply"></i>
          Info mittente
        </h5>
        <div class="message__name overflow_row">
          Nome: {{ $message->name }}
        </div>
        <div class="message__email overflow_row">
          Email: {{ $message->email }}
        </div>
        <div class="message__flat overflow_row">
          Appartamento: <a href="{{ route('guest.flats.show', $message->flat->slug) }}">{{ $message->flat->title }}</a>
        </div>
        <div class="message__date overflow_row">
          Data: {{ substr($message->date_of_send, 0, 16) }}
        </div>
      </div>

      <div class="message__body">
        <h5>
          <i class="fas fa-envelope-open-text"></i>
          Messaggio
        </h5>
        <p class="message__text">
          {{$message->message}}
        </p>

        <div class="center">
          <a href="mailto:{{ $message->email }}" class="btn message__reply"> <i class="fas fa-reply-all"></i> Rispondi</a>
        </div>

      </div>

    </div>


  </div>
  {{-- /wrapper --}}

@endsection