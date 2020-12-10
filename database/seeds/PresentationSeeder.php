<?php

// using Laravel Facades
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

// using Carbon
use Carbon\Carbon;

// using Faker
use Faker\Generator as Faker;

// using Models
use App\User;
use App\Flat;
use App\Image;
use App\Message;
use App\View;
use App\SponsorshipPrice;
use App\Payment;
use App\Sponsorship;
use App\Option;

class PresentationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        if (count(User::all()) == 0) {

          // UsersTableSeeder
          $users = [
                      [
                        'firstname' => 'Luca',
                        'lastname' => 'Guccione',
                        'email' => 'g.guccione3@gmail.com',
                        'password' => 'password',
                        'date_of_birth' => '1994-04-19',
                        'avatar' => 'link avatar',
                        'description' => 'descrizione'
                      ]
                    ];

          foreach ($users as $user) {
            $new_user = new User;

            $new_user->firstname = $user['firstname'];
            $new_user->lastname = $user['lastname'];
            $new_user->email = $user['email'];
            $new_user->password = Hash::make($user['password']);
            $new_user->date_of_birth = $user['date_of_birth'];
            $new_user->avatar = $user['avatar'];
            $new_user->description = $user['description'];

            $new_user->save();
          }

          // FlatsTableSeeder
          $flats = [
                      [
                        'title' => 'app1',
                        'number_of_rooms' => '1',
                        'number_of_beds' => '1',
                        'number_of_bathrooms' => '1',
                        'mq' => '1',
                        'price' => '1',
                        'type' => 'appartamento',
                        'description' => 'descrizione',
                        'images' => [
                          'media/placeholder_flat_image.jpg',
                          'media/placeholder_flat_image.jpg',
                          'media/placeholder_flat_image.jpg'
                        ],
                        'street_name' => 'via',
                        'zip_code' => '96100',
                        'city' => 'siracusa',
                        'lat' => '23.232322',
                        'lng' => '23.232322'
                      ],
                      [
                        'title' => 'app2',
                        'number_of_rooms' => '1',
                        'number_of_beds' => '1',
                        'number_of_bathrooms' => '1',
                        'mq' => '1',
                        'price' => '1',
                        'type' => 'appartamento',
                        'description' => 'descrizione',
                        'images' => [
                          'media/placeholder_flat_image.jpg',
                          'media/placeholder_flat_image.jpg',
                          'media/placeholder_flat_image.jpg',
                          'media/placeholder_flat_image.jpg',
                          'media/placeholder_flat_image.jpg'
                        ],
                        'street_name' => 'via',
                        'zip_code' => '96100',
                        'city' => 'siracusa',
                        'lat' => '23.232322',
                        'lng' => '23.232322'
                      ],

                    ];

          foreach ($flats as $flat) {
            $random_user_id = User::inRandomOrder()->first()->id;

            $new_flat = New Flat;

            $new_flat->user_id = $random_user_id;
            $new_flat->title = $flat['title'];
            $new_flat->slug = Str::slug($new_flat->title, '-');
            $new_flat->active = (rand(0, 6)) > 0 ? true : false;
            $new_flat->number_of_rooms = $flat['number_of_rooms'];
            $new_flat->number_of_beds = $flat['number_of_beds'];
            $new_flat->number_of_bathrooms = $flat['number_of_bathrooms'];
            $new_flat->mq = $flat['mq'];
            $new_flat->price = $flat['price'];
            $new_flat->type = $flat['type'];
            $new_flat->description = $flat['description'];
            $new_flat->stars = rand(5, 10);
            $new_flat->street_name = $flat['street_name'];
            $new_flat->zip_code = $flat['zip_code'];
            $new_flat->city = $flat['city'];
            $new_flat->lat = $flat['lat'];
            $new_flat->lng = $flat['lng'];

            $new_flat->save();

            // ImagesTableSeeder
            foreach ($flat['images'] as $key => $image) {
              $new_image = New Image;

              $new_image->flat_id = $new_flat->id;
              $new_image->index = $key;
              $new_image->path = $image;

              $new_image->save();
            }
          }

          // MessagesTableSeeder
          $messages = [
                        [
                          'name' => 'nome e cognome',
                          'email' => 'email',
                          'message' => 'messaggio',
                          'date_of_send' => '2020-12-10'
                        ]
                      ];

          $flats = Flat::all();
          $number_of_flats = count($flats);

          // defining the number of messages to generate
          // will be generate 8 messages for every 10 flats (10 / 8 = 1.25)
          // these messages will be assigned randomly
          $number_of_messages = intval($number_of_flats / 1.25);

          for ($i=0; $i < $number_of_messages; $i++) {
            $random_flat_id = Flat::inRandomOrder()->first()->id;

            $new_message = New Message;

            $message = $messages[rand(0, count($messages) - 1)];

            $new_message->flat_id = $random_flat_id;
            $new_message->name = $message['name'];
            $new_message->email = $message['email'];
            $new_message->message = $message['message'];
            $new_message->date_of_send = $message['date_of_send'];
            $new_message->seen = false;

            $new_message->save();
          }

          // ViewsTableSeeder
          $flats = Flat::all();

          foreach ($flats as $flat) {
            $number_of_views = rand(10, 100);

            for ($i=0; $i < $number_of_views; $i++) {
              $new_view = New View;

              $new_view->flat_id = $flat->id;
              $new_view->session_id = $faker->regexify('[a-zA-Z0-9]{40}');
              $new_view->date = $faker->dateTimeBetween('-3 months', 'now');

              $new_view->save();
            }
          }

          // SponsorshipPriceTableSeeder
          $list_of_prices = [
                              [
                                'price' => '2.99',
                                'duration' => '24'
                              ],
                              [
                                'price' => '5.99',
                                'duration' => '72'
                              ],
                              [
                                'price' => '9.99',
                                'duration' => '144'
                              ]
                            ];

          $sponsorship_prices = SponsorshipPrice::all();

          if (count($sponsorship_prices) == 0) {
            foreach ($list_of_prices as $list_of_price) {
              $new_sponsorship_price = New SponsorshipPrice();

              $new_sponsorship_price->price = $list_of_price['price'];
              $new_sponsorship_price->duration_in_hours = $list_of_price['duration'];

              $new_sponsorship_price->save();
            }
          }

          // PaymentTableSeeder
          $flats = Flat::all();
          $number_of_flats = count($flats);

          // defining the number of payments to generate
          // will be generate 1 payment for every 2 flats
          // these payments will be assigned randomly
          $payments_to_generate = intval($number_of_flats / 2);

          for ($i=0; $i < $payments_to_generate; $i++) {
            $new_payment = New Payment;

            $new_payment->transaction_id = $faker->regexify('[a-z]{5}[0-9]{1}[a-z]{2}');
            $new_payment->amount = SponsorshipPrice::inRandomOrder()->first()->price;
            $new_payment->status = 'confirmed';
            $new_payment->date_of_payment = (rand(0, 1)) ? $faker->dateTimeBetween('-3 month', 'now') : $faker->dateTimeBetween('-1 days', 'now');

            $new_payment->save();
          }

          // SponsorshipsTableSeeder
          $payments = Payment::orderBy('date_of_payment', 'asc')->get();

          foreach ($payments as $payment) {
            $new_sponsorship = New Sponsorship;

            $random_flat = Flat::inRandomOrder()->first();
            $new_sponsorship->flat_id = $random_flat->id;

            $new_sponsorship->payment_id = $payment->id;

            $amount = $payment->amount;
            $sponsorship_price = SponsorshipPrice::where('price', $amount)->first();
            $new_sponsorship->sponsorship_price_id = $sponsorship_price->id;


            // check if exist an other sponsorship for the same flat (in desc order, selecting only the first)
            $sponsorship_same_flat = Sponsorship::orderByDesc('date_of_end')->where('flat_id', $new_sponsorship->flat_id)->first();

            // if exist i set the date_of_start of the new sponsorship as the date_of_end of the last sponsorship (only if it is in the future), otherwise i set it as the date_of_payment
            if (!isset($sponsorship_same_flat)) {

              $new_sponsorship->date_of_start = $payment->date_of_payment;

            } else {

              $date_of_payment = Carbon::parse($payment->date_of_payment);
              $old_sponsorship_date = Carbon::parse($sponsorship_same_flat->date_of_end);

              if ($date_of_payment->gt($old_sponsorship_date)) {

                $new_sponsorship->date_of_start = $payment->date_of_payment;

              } else {

                $new_sponsorship->date_of_start = $sponsorship_same_flat->date_of_end;

              }

            }

            $new_sponsorship->date_of_end = Carbon::parse($new_sponsorship->date_of_start)->addHours($sponsorship_price->duration_in_hours);

            $new_sponsorship->save();
          }

          // OptionsTableSeeder
          $list_of_options = [
            'wifi',
            'tv',
            'riscaldamento',
            'aria condizionata',
            'posto macchina',
            'bagno privato',
            'piscina',
            'portineria',
            'sauna',
            'vista mare'
          ];

          $options = Option::all();

          if (count($options) == 0) {

            foreach ($list_of_options as $option) {

              $new_option = New Option;

              $new_option->name = $option;

              $new_option->save();

            }

          }

          // FlatOptionTableSeeder
          $flats = Flat::all();
          $options = Option::all();

          foreach ($flats as $flat) {
            $number_option_for_flat = rand(0, count($options));
            $options_for_flat = Option::inRandomOrder()->limit($number_option_for_flat)->get();

            foreach ($options_for_flat as $option) {
              $option->flats()->attach($flat->id);
            }
          }

        }
    }
}
