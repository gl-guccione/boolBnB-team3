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
                        'date_of_birth' => '1994-04-19',
                        'avatar' => '/storage/media/avatar/avatar_u_1.png',
                        'description' => 'Amo la mia terra e la mia cultura ed il desiderio di condividerla è al centro stesso di questo progetto. Sarò per cui felicemente a disposizione per aiutare ad accedere ad attività escursionistiche, sportive, enogastronomiche.'
                      ],
                      [
                        'firstname' => 'Giuseppe',
                        'lastname' => 'Falco',
                        'date_of_birth' => '1993-07-23',
                        'avatar' => '/storage/media/avatar/avatar_u_2.png',
                        'description' => 'Sono felice di poter essere d’aiuto per i miei ospiti tramite messaggio per qualsiasi richiesta o info, la modalità per l’accoglienza è tramite self check in!'
                      ],
                      [
                        'firstname' => 'Alessandro',
                        'lastname' => 'Boscato',
                        'date_of_birth' => '1991-10-29',
                        'avatar' => '/storage/media/avatar/avatar_u_3.png',
                        'description' => 'Sono Alessandro e sono anche io un host su Roma. Insieme a mia moglie ci piace viaggiare e conoscere nuovi luoghi in cambio avrete gentilezza, sorrisi e cura dei vostri alloggi.'
                      ],
                      [
                        'firstname' => 'Marco',
                        'lastname' => 'De Crema',
                        'date_of_birth' => '1992-09-01',
                        'avatar' => '/storage/media/avatar/avatar_u_4.png',
                        'description' => 'Se solo fossimo pienamente padroni del nostro tempo... Brevemente intendo che la nostra è una vita frenetica! Tra tutto il resto, sempre di più, si afferma questa passione ad accogliere "altre storie", intrecciare altre vite. Preferiamo proprio quelle come le nostre, veloci e tuttavia attente, comunicative ma senza troppe chiacchiere. Siate i benvenuti quindi, capiremo di voi dalla prima occhiata! E vi offriremo quello che possiamo: speriamo sia abbastanza!'
                      ],
                      [
                        'firstname' => 'Domenico',
                        'lastname' => 'Garofalo',
                        'date_of_birth' => '1998-01-13',
                        'avatar' => '/storage/media/avatar/avatar_u_5.jpg',
                        'description' => 'Saremo lieti di essere presenti e a disposizione durante la vostra vacanza, qualora ne avrete bisogno. Una buona vacanza ha sempre inizio con un ottimo check-in. Saremo in grado di fornirvi tutti gli strumenti necessari per non farvi stressare e per non farvi perdere tempo, alla ricerca di informazioni che noi sapremo darvi in anticipo. Vi daremo i nostri contatti telefonici, anche wuotsapp e Viber, per essere sempre a vostra disposizione per qualsiasi necessità o semplice informazione. Non aspettare, prenota ora!'
                      ],
                      [
                        'firstname' => 'Carla',
                        'lastname' => 'Artale',
                        'date_of_birth' => '1990-03-11',
                        'avatar' => '/storage/media/avatar/avatar_d_1.jpg',
                        'description' => 'Siamo una famiglia con casa a Marina di Cecina, costruita da mio padre nel 1968. La locazione turistica di due porzioni è affidata a Claudia, mia figlia. Roberto, il suo ex marito, è di nazionalità Svizzera e all\'occorrenza aiuta con i turisti dall\'estero. Amiamo la natura e gli animali, abbiamo gatti e cani, giardino e un piccolo angolo aromatiche e orto. Ci piace leggere, scattare foto, cucinare, ascoltare musica. Roberto parla fluentemente svizzero-tedesco, tedesco, inglese e francese.'
                      ],
                      [
                        'firstname' => 'Lucilla',
                        'lastname' => 'Costantini',
                        'date_of_birth' => '1988-01-08',
                        'avatar' => '/storage/media/avatar/avatar_d_2.png',
                        'description' => 'Sono una giovane mamma che ama viaggiare. Durante uno dei nostri viaggi in Alaska (più di 10 anni fa!) siamo stati ospiti per la prima volta in un B&B gestito da una gentile signora.....Da quella esperienza abbiamo deciso di aprire la nostra casa ai viaggiatori di tutto il mondo :) Amo la natura selvaggia, e il mio stile di viaggio è con lo zaino in spalla. Vorrei poter visitare ogni angolo della Terra, e in viaggio riesco a sentirmi pienamente libera: essenzialmente sono una backpaker! Mangiare, leggere un libro davanti al camino con un bicchiere di un buon vino, vedere un bel film fanno parte delle gioie quotidiane! I miei ospiti si sentiranno a casa propria (almeno è quello il mio intento!), e con loro vorrei instaurare un rapporto di fiducia e convivialità.'
                      ],
                      [
                        'firstname' => 'Federica',
                        'lastname' => 'Palumbo',
                        'date_of_birth' => '1999-06-15',
                        'avatar' => '/storage/media/avatar/avatar_d_3.png',
                        'description' => 'Sarei felicissima di essere la vostra guida durante il vostro soggiorno nella bellissima Napoli. Sono a disposizione per qualsiasi tipo di consiglio su cose da fare e posti da visitare e soprattutto ristoranti dove è possibile assaggiare i veri sapori di Napoli!'
                      ],
                      [
                        'firstname' => 'Graziella',
                        'lastname' => 'Fontana',
                        'date_of_birth' => '1987-12-13',
                        'avatar' => '/storage/media/avatar/avatar_d_4.png',
                        'description' => 'Sono una persona solare - Adoro dipingere - Amo la mia famiglia e i miei figli Roberta e Marco - Ascolto tutta la musica ma in particolare i cantautori italiani e le canzoni "senza tempo" - Leggo romanzi e mi piace vedere i film tratti dagli stessi libri - Mi piace la gente, mi piace conoscerla e mi piace imparare da loro cose nuove.'
                      ],
                      [
                        'firstname' => 'Eleonora',
                        'lastname' => 'De Luca',
                        'date_of_birth' => '1990-08-27',
                        'avatar' => '/storage/media/avatar/avatar_d_5.jpg',
                        'description' => 'Sono nata in Calabria, anche se ho vissuto molti anni al nord Italia e per periodi anche all’estero. Ho una bellissima famiglia con un maschietto ed una femminuccia adorabili. Viviamo alla contrada Scinà, in un piano diverso da quello destinato ai nostri ospiti, i quali hanno accesso alla loro struttura da un’entrata indipendente. E’ una zona tranquilla, per la pace, il relax e le vacanze in ogni stagione, anche se d’estate è molto più popolata da turisti di ogni parte d’Italia e moltissimi anche dall’estero. Il mare vicino ci offre uno spettacolare incontro con lo stretto di Messina, dove è possibile ammirare ad occhio nudo la Sicilia ed il vulcano Stromboli. Mi piacciono gli animali, la natura e mangiare sano, per questo abbiamo il nostro piccolo giardino. E’un luogo dove i bambini godono di aria pulita e giocano in serenità.'
                      ],
                    ];

          foreach ($users as $user) {
            $new_user = new User;

            $new_user->firstname = $user['firstname'];
            $new_user->lastname = $user['lastname'];
            $new_user->email = $user['firstname'].$user['lastname'].'@gmail.com';
            $new_user->password = Hash::make('password');
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
