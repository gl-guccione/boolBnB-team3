<?php

// using Laravel Facades
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

// using Faker
use Faker\Generator as Faker;

// using Models
use App\User;
use App\Flat;

class FlatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // defining the number of flats to generate
        $flats_to_generate = 50;

        for ($i=0; $i < $flats_to_generate; $i++) {

          $random_user_id = User::inRandomOrder()->first()->id;

          $new_flat = New Flat;

          $new_flat->user_id = $random_user_id;
          $new_flat->title = $faker->sentence(7);
          $new_flat->slug = Str::slug($new_flat->title, '-');
          $new_flat->active = (rand(0, 9)) > 0 ? true : false;
          $new_flat->number_of_rooms = rand(1, 5);
          $new_flat->number_of_beds = $new_flat->number_of_rooms == 1 ? rand(1, 2) : rand(1, 5);
          $new_flat->number_of_bathrooms = $new_flat->number_of_rooms == 1 ? 1 : rand(1, $new_flat->number_of_rooms - 1);
          $new_flat->mq = (rand(9, 30) * $new_flat->number_of_rooms) + 15;
          $new_flat->price = (rand(10, 70) * $new_flat->number_of_rooms) + 0.99;
          $new_flat->type = (rand(1, 3) == 1) ? 'appartamento' : 'villetta';
          $new_flat->description = $faker->paragraph(12, true);
          $new_flat->stars = rand(1, 10);

          if (rand(0, 2))
          {
            $options = $faker->words(rand(1, 5));
            $options = implode(', ', $options);
            $new_flat->extra_options = $options;
          }

          $new_flat->street_name = $faker->streetAddress;
          $new_flat->zip_code = substr($faker->postcode, 0, 5);
          $new_flat->city = $faker->city;
          $new_flat->lat = $faker->latitude(45, 37);
          $new_flat->lng = $faker->longitude(8, 16);

          $new_flat->save();
        }

    }
}
