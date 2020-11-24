<?php

// using Laravel Facades
use Illuminate\Database\Seeder;

// using Faker
use Faker\Generator as Faker;

// using Models
use App\Flat;
use App\Image;

class ImagesTableSeeder extends Seeder
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

          // defining the number of images for each flat
          // could be from 1 -> 3
          $number_of_images = rand(1, 3);

          for ($i=0; $i < $number_of_images; $i++) {

            $new_image = New Image;

            $new_image->flat_id = $flat->id;
            $new_image->index = $i;
            $new_image->path = '/public/placeholder_flat_image.jpg';

            $new_image->save();

          }

        }
    }
}
