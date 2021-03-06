<?php

// using Laravel Facades
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
          UsersTableSeeder::class,
          FlatsTableSeeder::class,
          MessagesTableSeeder::class,
          ViewsTableSeeder::class,
          ImagesTableSeeder::class,
          SponsorshipPricesTableSeeder::class,
          PaymentsTableSeeder::class,
          SponsorshipsTableSeeder::class,
          OptionsTableSeeder::class,
          FlatOptionTableSeeder::class
        ]);
    }
}
