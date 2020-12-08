<?php

// using Laravel Facades
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

// using Faker
use Faker\Generator as Faker;

// using Model
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // defining the number of user to generate
        $users_to_generate = 25;

        for ($i=0; $i < $users_to_generate; $i++) {

          $new_user = new User;

          $new_user->firstname = $faker->firstName();
          $new_user->lastname = $faker->lastName();
          $new_user->email = $faker->freeEmail();
          $new_user->password = Hash::make('password');
          $new_user->date_of_birth = $faker->dateTimeBetween('-50 years', '-20 years');
          $new_user->avatar = $faker->imageUrl(250, 250, 'person', true, 'avatar');
          $new_user->description = 'Descrizione persona - '.$faker->text(800);

          $new_user->save();
        }
    }
}
