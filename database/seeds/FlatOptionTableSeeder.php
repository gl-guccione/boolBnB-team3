<?php

// using Laravel Facades
use Illuminate\Database\Seeder;

// using Models
use App\Flat;
use App\Option;

class FlatOptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $flats = Flat::all();
        $options = Option::all();

        foreach ($flats as $flat) {

          $number_option_for_flat = rand(0, count($options));
          $options_for_flat = Option::inRandomOrder()->limit($number_option_for_flat)->get();
          foreach ($options_for_flat as $option) {
            dd($option->flats());
            $option->flats()->attach($flat->id);
          }

        }
    }
}
