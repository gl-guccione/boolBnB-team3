<?php

// using Laravel Facades
use Illuminate\Database\Seeder;

// using Faker
use Faker\Generator as Faker;

// using Models
use App\Flat;
use App\Message;

class MessagesTableSeeder extends Seeder
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

        // defining the number of message to generate
        // will be generate 8 message for every 10 flats (10 / 8 = 1.25)
        // these messages will be assigned randomly
        $number_of_messages = intval($number_of_flats / 1.25);

        for ($i=0; $i < $number_of_messages; $i++)
        {
          $random_flat_id = Flat::inRandomOrder()->first()->id;
          $new_message = New Message;

          $new_message->flat_id = $random_flat_id;
          $new_message->name = $faker->firstName().' '.$faker->lastName();
          $new_message->email = $faker->freeEmail();
          $new_message->message = 'messaggio - '.$faker->paragraph(6);
          $new_message->date_of_send = $faker->dateTimeBetween('-1 years', 'now');

          if (!rand(0, 2))
          {
            $new_message->seen = true;
          }

          $new_message->save();

        }
    }
}
