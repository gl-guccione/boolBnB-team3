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
        return view('admin.sponsorships.create');
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
            $newPayment->date_of_payment = $transaction->updatedAt;

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
            
            $newSponsorship = new Sponsorship;

            $newSponsorship->flat_id = $data['flat_id'];
            $newSponsorship->payment_id = $newPayment->id;
            $newSponsorship->sponsorship_price_id = $sponsorship->id;
            $newSponsorship->date_of_start= Carbon::now();
            $newSponsorship->date_of_end = Carbon::now()->addHours($sponsorship->duration_in_hours);

            $newSponsorship->save();
        dd($newSponsorship);
            return back()->with('success_message', 'Hai pagato correttamente '.$transaction->amount.'€');
        
        } else {
            $errorString = "";

            foreach($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }

            return back()->withErrors('errore'.$result->message);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd('cnaikl');
    }

}
