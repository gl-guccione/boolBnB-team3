<?php

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
        // the line bellow is temporarily commented becouse the seeder is still WIP!!

        $this->call([
          UsersTableSeeder::class,
          FlatsTableSeeder::class,
          RequestsTableSeeder::class,
          ViewsTableSeeder::class,
          ImagesTableSeeder::class,
          SponsorshipPricesTableSeeder::class
        ]);
    }
}
