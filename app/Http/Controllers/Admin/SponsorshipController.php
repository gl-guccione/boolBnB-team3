<?php

// defining Namesapce
namespace App\Http\Controllers\Admin;

// using Laravel Facades
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//use auth
use Illuminate\Support\Facades\Auth;

// use braintree
use Braintree;

// use carbon
use Carbon\Carbon;

// use model
use App\SponsorshipPrice;
use App\Sponsorship;
use App\Payment;
use App\Flat;

class SponsorshipController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sponsorships = Sponsorship::whereHas('flat', function ($query) {
          $query->where('user_id', Auth::id());
        })->get();

        return view('admin.sponsorships.index', compact('sponsorships'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gateway = new Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey'),
        ]);

        $token = $gateway->ClientToken()->generate();

        $prices = SponsorshipPrice::all();

        $user_id = Auth::id();

        $flats = Flat::where('user_id', $user_id)->get();

        return view('admin.sponsorships.create', compact('token', 'prices', 'flats'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $gateway = new Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey'),
        ]);

        $amount = $request->amount;
        $nonce = $request->payment_method_nonce;




        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            $transaction = $result->transaction;

            // create payment
            $newPayment = new Payment;

            $newPayment->transaction_id = $transaction->id;
            $newPayment->amount = $transaction->amount;
            $newPayment->status = $transaction->status;
            $newPayment->date_of_payment = Carbon::now();

            $newPayment->save();

            //obtain and validate flat id
            $data = $request->all();

            $request->validate(
                [
                    'flat_id' => 'required|integer|exists:flats,id',
                ]
            );

            // create sponsorship
            $sponsorship = SponsorshipPrice::where('price', $amount)->first();

            if (!isset($sponsorship)) {
              return back()->withErrors('errore, importo non valido, e ci teniamo pure i tuoi soldi!');
            }

            $newSponsorship = new Sponsorship;

            $newSponsorship->flat_id = $data['flat_id'];
            $newSponsorship->payment_id = $newPayment->id;
            $newSponsorship->sponsorship_price_id = $sponsorship->id;


            // check if exist an other sponsorship for the same flat (in desc order, selecting only the first)
            $sponsorship_same_flat = Sponsorship::orderByDesc('date_of_end')->where('flat_id', $newSponsorship->flat_id)->first();

            // if exist i set the date_of_start of the new sponsorship as the date_of_end of the last sponsorship (only if it is in the future), otherwise i set it as the date_of_payment
            if (!isset($sponsorship_same_flat)) {

              $newSponsorship->date_of_start = Carbon::now();

            } else {

              $date_of_payment = Carbon::now();
              $old_sponsorship_date = Carbon::parse($sponsorship_same_flat->date_of_end);

              if ($date_of_payment->gt($old_sponsorship_date)) {

                $newSponsorship->date_of_start = $date_of_payment;

              } else {

                $newSponsorship->date_of_start = $sponsorship_same_flat->date_of_end;

              }

            }

            $newSponsorship->date_of_end = Carbon::parse($newSponsorship->date_of_start)->addHours($sponsorship->duration_in_hours);

            $newSponsorship->save();

            return redirect()->route('admin.flats.index')->with('record_added_perm', 'Hai pagato correttamente '.$transaction->amount.'€');

        } else {
            $errorString = "";

            foreach($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }

            return back()->withErrors('errore'.$result->message);

        }
    }
}
