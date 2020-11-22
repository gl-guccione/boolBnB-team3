<?php

// using Laravel Facades
use Illuminate\Database\Seeder;

// using Faker
use Faker\Generator as Faker;

// using Models
use App\Payment;
use App\SponsorshipPrice;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // defining the number of payment to generate
        $payments_to_generate = 25;

        for ($i=0; $i < $payments_to_generate; $i++) {

          $new_payment = New Payment;

          $new_payment->transaction_id = $faker->regexify('[a-z]{5}[0-9]{1}[a-z]{2}');
          $new_payment->amount = SponsorshipPrice::inRandomOrder()->first()->price;
          $new_payment->status = (rand(0, 5) == 0) ? 'failed' : 'confirmed';
          $new_payment->date_of_payment = $faker->dateTimeBetween('-1 years', 'now');

          $new_payment->save();

        }
    }
}
