<?php

// using Laravel Facades
use Illuminate\Database\Seeder;

// using Faker
use Faker\Generator as Faker;

// using Models
use App\Flat;
use App\View;

class ViewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $flats = Flat::all();

        foreach ($flats as $flat) {

          if (rand(0, 3)) {

            // defining the number of views for each flat
            // could be from 0 -> 15
            $number_of_views = rand(0, 14);

            for ($i=0; $i < $number_of_views; $i++) {

              $new_view = New View;

              $new_view->flat_id = $flat->id;
              $new_view->session_id = rand(10, 99);
              $new_view->date = $faker->dateTimeBetween('-1 years', 'now');

              $new_view->save();

            }

          }

        }

    }
}
