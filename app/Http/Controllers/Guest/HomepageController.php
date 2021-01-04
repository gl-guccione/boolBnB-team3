<?php

// defining Namespace
namespace App\Http\Controllers\Guest;

// using Laravel Facades
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// using Carbon
use Carbon\Carbon;

// using Faker
use Faker\Generator as Faker;

// using Models
use App\Flat;
use App\Option;
use App\View;
use App\Payment;
use App\SponsorshipPrice;
use App\Sponsorship;


class HomepageController extends Controller
{
     /**
     * Display the homepage.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Faker $faker)
    {
        $datetime_now = Carbon::now();
        $sponsored_flats = Flat::whereHas('sponsorships', function ($query) use ($datetime_now) {
          $query->where('date_of_end', '>', $datetime_now);
        })->get();

        if (count($sponsored_flats) < 5) {
          // Generate sponsorships if the sponsored flats are less than 5
          $flats = Flat::all();
          $number_of_flats = count($flats);

          // defining the number of payments to generate
          // will be generate 1 payment for every 2 flats
          // these payments will be assigned randomly
          $payments_to_generate = intval($number_of_flats / 2);

          for ($i=0; $i < $payments_to_generate; $i++) {
            $new_payment = New Payment;

            $new_payment->transaction_id = $faker->regexify('[a-z]{5}[0-9]{1}[a-z]{2}');
            $new_payment->amount = SponsorshipPrice::inRandomOrder()->first()->price;
            $new_payment->status = 'confirmed';
            $new_payment->date_of_payment = (rand(0, 1)) ? $faker->dateTimeBetween('-10 days', 'now') : $faker->dateTimeBetween('-1 days', 'now');

            $new_payment->save();
          }

          // SponsorshipsTableSeeder
          $payments = Payment::orderBy('date_of_payment', 'asc')->get();

          foreach ($payments as $payment) {
            $new_sponsorship = New Sponsorship;

            $random_flat = Flat::inRandomOrder()->first();
            $new_sponsorship->flat_id = $random_flat->id;

            $new_sponsorship->payment_id = $payment->id;

            $amount = $payment->amount;
            $sponsorship_price = SponsorshipPrice::where('price', $amount)->first();
            $new_sponsorship->sponsorship_price_id = $sponsorship_price->id;


            // check if exist an other sponsorship for the same flat (in desc order, selecting only the first)
            $sponsorship_same_flat = Sponsorship::orderByDesc('date_of_end')->where('flat_id', $new_sponsorship->flat_id)->first();

            // if exist i set the date_of_start of the new sponsorship as the date_of_end of the last sponsorship (only if it is in the future), otherwise i set it as the date_of_payment
            if (!isset($sponsorship_same_flat)) {

              $new_sponsorship->date_of_start = $payment->date_of_payment;

            } else {

              $date_of_payment = Carbon::parse($payment->date_of_payment);
              $old_sponsorship_date = Carbon::parse($sponsorship_same_flat->date_of_end);

              if ($date_of_payment->gt($old_sponsorship_date)) {

                $new_sponsorship->date_of_start = $payment->date_of_payment;

              } else {

                $new_sponsorship->date_of_start = $sponsorship_same_flat->date_of_end;

              }

            }

            $new_sponsorship->date_of_end = Carbon::parse($new_sponsorship->date_of_start)->addHours($sponsorship_price->duration_in_hours);

            $new_sponsorship->save();
          }
        }

        $views = View::all()->count();

        $data = [
          'flats' => $sponsored_flats,
          'views' => $views
        ];

        return view('guest.home', $data);
    }

     /**
     * Display the search page.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        $algolia = isset($_GET['algolia']) ? $_GET['algolia'] : "";
        $data_algolia = isset($_GET['data-algolia']) ? $_GET['data-algolia'] : "";
        $adults = isset($_GET['adults']) ? $_GET['adults'] : "";
        $children = isset($_GET['children']) ? $_GET['children'] : "";
        $check_in = isset($_GET['check_in']) ? $_GET['check_in'] : "";
        $check_out = isset($_GET['check_out']) ? $_GET['check_out'] : "";
        $options = Option::all();

        $data = [
          'algolia' => $algolia,
          'data_algolia' => $data_algolia,
          'adults' => $adults,
          'children' => $children,
          'check_in' => $check_in,
          'check_out' => $check_out,
          'options' => $options
        ];
        return view('guest.search', $data);
    }
}
