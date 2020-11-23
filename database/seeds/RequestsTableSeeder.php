<?php

// using Laravel Facades
use Illuminate\Database\Seeder;

// using Faker
use Faker\Generator as Faker;

// using Models
use App\Flat;
use App\Request;

class RequestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $flats = Flat::all();
        $number_of_flats = count($flats);

        // defining the number of request to generate
        // will be generate 8 request for every 10 flats (10 / 8 = 1.25)
        // these requests will be assigned randomly
        $number_of_requests = intval($number_of_flats / 1.25);

        for ($i=0; $i < $number_of_requests; $i++)
        {
          $random_flat_id = Flat::inRandomOrder()->first()->id;
          $new_request = New Request;

          $new_request->flat_id = $random_flat_id;
          $new_request->name = $faker->firstName().' '.$faker->lastName();
          $new_request->email = $faker->freeEmail();
          $new_request->message = 'messaggio - '.$faker->paragraph(6);
          $new_request->date_of_send = $faker->dateTimeBetween('-1 years', 'now');

          if (!rand(0, 2))
          {
            $new_request->seen = true;
          }

          $new_request->save();

        }



    }
}
