@extends ('layouts.app')

@section('pageName', 'admin_sponsorships_create')

@section('content')
    <div class="container">
        {{-- errori --}}
        @if (session('success_message'))
            <div class="alert alert-success">
                    {{ session('success_message')}}
            </div>
        @endif

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
      

        <form method="POST" id="payment-form" action="{{route('admin.sponsorships.store')}}">
            
            @method('POST')
            @csrf

            {{-- select flat --}}
            <section>
              <label for="flat_id">
                <span class='input-label'>Seleziona appartamento</span>
                <div class="input-wrapper amount-wrapper">
                  <select name="flat_id" id="flat_id">
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
                    <div class="input-wrapper amount-wrapper">
                        {{-- <input id="amount" name="amount" type="tel" min="1" placeholder="Amount" value="10"> --}}
                        <select name="amount" id="amount">
                          @foreach ($prices as $price)
                              <option value="{{ old('amount') ?? $price->price }}">{{ $price->duration_in_hours }} ore - {{ $price->price }} €</option>
                          @endforeach
                        </select>
                    </div>
                </label>

                <div class="bt-drop-in-wrapper">
                    <div id="bt-dropin"></div>
                </div>
            </section>
            {{-- /select sponsorship --}}

            <input id="nonce" name="payment_method_nonce" type="hidden" />
            <button class="button" type="submit"><span>Paga</span></button>
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