<?php

// using Laravel Facades
use Illuminate\Database\Seeder;

// using Models
use App\SponsorshipPrice;

class SponsorshipPricesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // defining the prices
        $list_of_prices = [
          [
            'price' => '2.99',
            'duration' => '24'
          ],
          [
            'price' => '5.99',
            'duration' => '72'
          ],
          [
            'price' => '9.99',
            'duration' => '144'
          ]
        ];

        $sponsorship_prices = SponsorshipPrice::all();

        if (count($sponsorship_prices) == 0) {

          foreach ($list_of_prices as $list_of_price) {

            $new_sponsorship_price = New SponsorshipPrice();

            $new_sponsorship_price->price = $list_of_price['price'];
            $new_sponsorship_price->duration_in_hours = $list_of_price['duration'];

            $new_sponsorship_price->save();

          }

        }
    }
}
