@extends ('layouts.app')

@section('pageName', 'admin_sponsorships_create')

@section('content')
    <div class="container pt-4">
        {{-- errori --}}
        @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{-- /errori --}}

        {{-- image --}}
        <div class="hero py-6">
          <img class="hero__image pt-4" src="{{ asset('img/flats/sponsorships_create.svg') }}" alt="sponsorships create image">
          <h1 class="hero__title py-4">
            <br>
            Qui puoi effettuare una sponsorizzazione per incrementare gli affitti.
          </h1>
        </div>
        {{-- /image --}}



        <form method="POST" id="payment-form" action="{{route('admin.sponsorships.store')}}" >

            @method('POST')
            @csrf

            {{-- select flat --}}
            <section>
              <label for="flat_id">
                <span class='input-label'>Seleziona appartamento</span>
                <div class="form-group">
                  <select name="flat_id" id="flat_id" class="form-control">
                    @foreach ($flats as $flat)
                        <option value="{{ $flat->id }}">{{ $flat->id }} - {{ $flat->title }}</option>
                    @endforeach
                  </select>
                </div>
              </label>
            </section>
            {{-- /select flat --}}

            {{-- select sponsorship --}}
            <section>
                <label for="amount">
                    <span class="input-label">Scegli il tipo di sponsorizzazione</span>
                    <div class="input-wrapper amount-wrapper form-group">
                        {{-- <input id="amount" name="amount" type="tel" min="1" placeholder="Amount" value="10"> --}}
                        <select name="amount" id="amount" class="form-control">
                          @foreach ($prices as $price)
                              <option value="{{ old('amount') ?? $price->price }}">{{ $price->duration_in_hours }} ore - {{ $price->price }} €</option>
                          @endforeach
                        </select>
                    </div>
                </label>

                <div class="bt-drop-in-wrapper">
                    <div id="bt-dropin" class="form-group"></div>
                </div>
            </section>
            {{-- /select sponsorship --}}

            <input id="nonce" name="payment_method_nonce" type="hidden" />
            <button class="button btn btn-custom" type="submit"><span>Paga</span></button>
        </form>
    </div>


    {{-- javascript --}}
    <script src="https://js.braintreegateway.com/web/dropin/1.25.0/js/dropin.min.js"></script>
    <script>
        var form = document.querySelector('#payment-form');
        var client_token = "{{ $token }}";

        braintree.dropin.create({
          authorization: client_token,
          selector: '#bt-dropin',
          paypal: {
            flow: 'vault'
          }
        }, function (createErr, instance) {
          if (createErr) {
            console.log('Create Error', createErr);
            return;
          }
          form.addEventListener('submit', function (event) {
            event.preventDefault();

            instance.requestPaymentMethod(function (err, payload) {
              if (err) {
                console.log('Request Payment Method Error', err);
                return;
              }

              // Add the nonce to the form and submit
              document.querySelector('#nonce').value = payload.nonce;
              form.submit();
            });
          });
        });
    </script>
@endsection