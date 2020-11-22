<?php

// using Laravel Facades
use Illuminate\Database\Seeder;

// using Models
use App\Option;

class OptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // defining the list of the default options
        $list_of_options = [
          'wifi',
          'tv',
          'riscaldamento',
          'aria condizionata',
          'ferro da stiro',
          'cucina',
          'parcheggio',
          'bagno privato'
        ];

        $options = Option::all();

        if (count($options) == 0) {

          foreach ($list_of_options as $option) {

            $new_option = New Option;

            $new_option->name = $option;

            $new_option->save();

          }

        }


    }
}
