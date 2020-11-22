<?php

// using Laravel Facades
use Illuminate\Database\Seeder;

// using Faker
use Faker\Generator as Faker;

// using Carbon
use Carbon\Carbon;

// using Models
use App\Sponsorship;
use App\Flat;
use App\Payment;
use App\SponsorshipPrice;

class SponsorshipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
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
          if ($sponsorship_same_flat == null) {

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
}
