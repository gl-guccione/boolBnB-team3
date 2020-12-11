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
                        'lastname' => 'DeCrema',
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
                        'lastname' => 'Rinaldi',
                        'date_of_birth' => '1990-08-27',
                        'avatar' => '/storage/media/avatar/avatar_d_5.jpg',
                        'description' => 'Sono nata in Calabria, anche se ho vissuto molti anni al nord Italia e per periodi anche all’estero. Ho una bellissima famiglia con un maschietto ed una femminuccia adorabili. Viviamo alla contrada Scinà, in un piano diverso da quello destinato ai nostri ospiti, i quali hanno accesso alla loro struttura da un’entrata indipendente. E’ una zona tranquilla, per la pace, il relax e le vacanze in ogni stagione, anche se d’estate è molto più popolata da turisti di ogni parte d’Italia e moltissimi anche dall’estero. Il mare vicino ci offre uno spettacolare incontro con lo stretto di Messina, dove è possibile ammirare ad occhio nudo la Sicilia ed il vulcano Stromboli. Mi piacciono gli animali, la natura e mangiare sano, per questo abbiamo il nostro piccolo giardino. E’un luogo dove i bambini godono di aria pulita e giocano in serenità.'
                      ],
                    ];

          foreach ($users as $user) {
            $new_user = new User;

            $new_user->firstname = $user['firstname'];
            $new_user->lastname = $user['lastname'];
            $new_user->email = strtolower($user['firstname']).strtolower($user['lastname']).'@gmail.com';
            $new_user->password = Hash::make('password');
            $new_user->date_of_birth = $user['date_of_birth'];
            $new_user->avatar = $user['avatar'];
            $new_user->description = $user['description'];

            $new_user->save();
          }

          // FlatsTableSeeder
          $flats = [
                      [
                        'title' => 'Trilocale in Affitto in Località Capo Piccolo 1 a Isola di Capo Rizzuto',
                        'number_of_rooms' => '3',
                        'number_of_beds' => '2',
                        'number_of_bathrooms' => '1',
                        'mq' => '55',
                        'price' => '40',
                        'type' => 'villetta',
                        'description' => 'Grazioso appartamento situato all\'interno del Villaggio vacanze Capo Piccolo a Isola di capo Rizzuto. Soluzione situata al piano superiore graziosa e accogliente. Trilocale arredato con cura, zona giorno con angolo cottura completamente attrezzato e dotata di tv; due camere da letto separate, soppalco con due lettini. Bagno con box doccia. All\'esterno graziosa verandina coperta e attrezzata con tavolo e sedie per mangiare all\'aperto. La soluzione è dotata di aria climatizzata. Gli ospiti possono usufruire di tutti i servizi del Villaggio. Il Villaggio Capo Piccolo al suo interno dispone di strutture polivalenti per il tempo libero e offre numerosi servizi: due piscine per gli adulti e una per i bambini, 3 campi da tennis e un campo da calcetto in erba sintetica, un campo da basket, un campo da bocce, un percorso di mini golf, ristorante e pizzeria, due snack bar, un minimarket. La spiaggia del Villaggio Capopiccolo è raggiungibile con una passeggiata nella pineta o tramite il servizio navetta. Per l\'intera durata della stagione balneare nel villaggio è presente un\'attività di animazione diurna e serale, coinvolgente le varie fasce d\'età, con attività sportive, balli, giochi, spettacoli serali di arte varia in anfiteatro, discoteca e piano bar. E per i più piccoli il Mini Club. Per le vostre vacanze al Mare in Calabria il Villaggio Capopiccolo è la scelta ideale.',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Strada provinciale per Le Cannella 47',
                        'zip_code' => '88841',
                        'city' => 'Isola di Capo Rizzuto',
                        'lat' => '38.9541',
                        'lng' => '17.1096'
                      ],
                      [
                        'title' => 'Bilocale in Affitto in Viale Parthenius 75 a Diamante',
                        'number_of_rooms' => '2',
                        'number_of_beds' => '1',
                        'number_of_bathrooms' => '1',
                        'mq' => '45',
                        'price' => '42',
                        'type' => 'appartamento',
                        'description' => 'Appartamento nuovo a 50 metri dal mare in parco privato finemente arredato.Con tv e aria condizionata;sito al secondo piano con ascensore e due balconi .Con servizio vigilanza.Si raggiunge il mare attraverso un vialetto privato,vicino a lidi attrezzati o spiaggia liebera.Posto auto all\'interno del parco.L\'appartamento e\' composto da camera da letto completa piu\' soggiorno con angolo di cottura, divano letto a due posti e bagno.',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Via Porto',
                        'zip_code' => '87022',
                        'city' => 'Cetaro',
                        'lat' => '39.5292',
                        'lng' => '15.9173'
                      ],
                      [
                        'title' => 'Trilocale in Affitto in Via delle Magnolie 3 a San Sostene',
                        'number_of_rooms' => '3',
                        'number_of_beds' => '2',
                        'number_of_bathrooms' => '1',
                        'mq' => '58',
                        'price' => '85',
                        'type' => 'villetta',
                        'description' => 'Vendo casa al mare! San Sostene Marina (CZ) - residence "Le Magnolie" vicino Ristorante "Paradise". A 230 mt dal bagnasciuga. 1° Piano - Ingresso Cucina, Camera Letto, Cameretta bambini (2 posti letto), bagno, due balconi e terrazzo, riscaldamento autonomo, predisposizione impianto di climatizzazione, posto auto interno recinto con cancello automatico.
                        -a 250mt dai lidi balneari con musica dal vivo, ristorante pizzeria e intrattenimento per i bambini.
                        -a 5 km (10 minuti d\'auto) da Soverato con discoteche, ristoranti, pizzerie, giostre per bambini e giovani, lungomare.
                        -vicino a 17 Km (21 minuti) Squillace con i suoi scavi archeologici.
                        -a 70 km (1 ora e 40 minuti) da Villaggio Mancuso e Villaggio Racise del Parco Nazionale Montano della Sila adatto per i bambini si possono vedere gli animali: Rapaci e Daini etc, custodito dai Carabinieri Forestali.',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Via delle Magnolie',
                        'zip_code' => '88900',
                        'city' => 'Crotone',
                        'lat' => '39.1443',
                        'lng' => '17.0872'
                      ],
                      [
                        'title' => 'Trilocale in Affitto in Via Gian Battista Vico 12 a Cirò Marina',
                        'number_of_rooms' => '3',
                        'number_of_beds' => '2',
                        'number_of_bathrooms' => '1',
                        'mq' => '90',
                        'price' => '78',
                        'type' => 'villetta',
                        'description' => 'Vicinissimo al mare, nella località di Cirò Marina, in provincia di Crotone, Bandiera Verde e Bandiera Blu da ben 18 anni consecutivi e record assoluto, per le limpide acque e per i servizi rivolti ai turisti, le nostre Case Vacanza sono composte da semplici e confortevoli arredi in un bel contesto naturale. I nostri appartamenti sono completamente arredati per 2 e fino a 12 posti letto a soli 80 metri dal mare e massimo 200 metri da negozi, ristoranti, pizzerie, bar, market ecc.. L\'esterno del nostro residence è caratterizzato da un ampio giardino privato, in comune con tutti gli ospiti, attrezzato con tavoli, parco giochi, barbecue, docce, wi-fi e parcheggio auto privato. MASSIMA TRANQUILLITA\'.',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Via Gian Battista Vico',
                        'zip_code' => '22078',
                        'city' => 'Lurago Marinone',
                        'lat' => '45.7104',
                        'lng' => '8.98486'
                      ],
                      [
                        'title' => 'Casa Indipendente in Affitto in Via Roma 43 a Roccella Ionica',
                        'number_of_rooms' => '1',
                        'number_of_beds' => '1',
                        'number_of_bathrooms' => '1',
                        'mq' => '80',
                        'price' => '50',
                        'type' => 'villetta',
                        'description' => 'La casa vacanze si trova proprio nel cuore del paese di Roccella Jonica,con due camere da letto, una matrimoniale e una doppia.Ampio e luminoso soggiorno con divano letto e cucina completamente attrezzata,un bagno. Questa casa vacanze si trova in centro, affaccia direttamente sul corso.Uscendo dal vico si trovano tutti i negozi e a solo pochi passi a piedi arrivate subito in spiaggia.La casa vacanze può ospitare fino a sei persone.Si trova vicino la stazione e alle fermate degli autobus.',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Via Roma 43',
                        'zip_code' => '95024',
                        'city' => 'Aci Catena',
                        'lat' => '37.6021',
                        'lng' => '15.1397'
                      ],
                      [
                        'title' => 'Trilocale in Affitto in Via Demiurgo Paragora 23 a Strongoli',
                        'number_of_rooms' => '3',
                        'number_of_beds' => '2',
                        'number_of_bathrooms' => '1',
                        'mq' => '80',
                        'price' => '69',
                        'type' => 'villetta',
                        'description' => 'Comodo appartamento di 80 mq composto d’ingresso, soggiorno cucina, bagno, due camere da letto e due balconi.
                        In località Marina di Strongoli a 200 metri dalla spiaggia.
                        L\'appartamento è posto al 1° piano con ampio cortile e barbecue nel giardino. ',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Via Domenico Demuro',
                        'zip_code' => '07100',
                        'city' => 'Sassari',
                        'lat' => '40.749',
                        'lng' => '8.52063'
                      ],
                      [
                        'title' => 'Villa in Affitto in Località Signorelli SNC a Gizzeria',
                        'number_of_rooms' => '7',
                        'number_of_beds' => '4',
                        'number_of_bathrooms' => '2',
                        'mq' => '200',
                        'price' => '90',
                        'type' => 'villetta',
                        'description' => 'Splendida villa, mq. 200 con tre camere da letto, 2 bagni, cucina, salone, tavernetta, garage.
                        Ampio giardino, con vista mare e angolo barbecue e forno a legna.
                        A meno di un minuto dalla spiaggia.
                        Si fitta per i mesi di giugno, luglio, agosto',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Località Signoria',
                        'zip_code' => '06089',
                        'city' => 'Torgiano',
                        'lat' => '43.0217',
                        'lng' => '12.4645'
                      ],
                      [
                        'title' => 'Trilocale in Affitto in Scesa Spirito Santo 6 a Vibo Valentia',
                        'number_of_rooms' => '3',
                        'number_of_beds' => '2',
                        'number_of_bathrooms' => '1',
                        'mq' => '52',
                        'price' => '58',
                        'type' => 'appartamento',
                        'description' => 'Affittasi per brevi periodi di max 30 giorni e minimo anche di una sola notte, appartamento signorile situato in pieno centro storico a Vibo Valentia in una traversa del rinomato Corso Umberto I, con facilità di parcheggi e vicinanza a tutti i servizi quali: supermarket, tabacchini, poste , ristoranti e pizzerie. IL prezzo è di 30,00 Euro a notte se una persona e poi con l\'aggiunta di 10,00 Euro per ogni persona in più con un massimo di 5 persone. Nel canone di locazione sono compresi prima fornitura di biancheria da letto e da bagno, wifi illimitato, utenze, macchinetta con cialde di vari tipi a volontà. L\'appartamento e\' composto da una camera da letto matrimoniale in cui si può aggiungere anche un letto singolo, una cucina soggiorno con un bel divano trasformabile all\'occorrenza in un comodo letto matrimoniale, un bagno ed un ripostiglio. La cucina è attrezzata di tutto. Ci sono due climatizzatori e due grandi smart TV',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Scesa Spirito Santo',
                        'zip_code' => '89900',
                        'city' => 'Vibo Valentia',
                        'lat' => '38.673',
                        'lng' => '16.1054'
                      ],
                      [
                        'title' => 'Villetta a Schiera in Affitto in Contrada Santa Domenica 5 a Isola di Capo Rizzuto',
                        'number_of_rooms' => '3',
                        'number_of_beds' => '2',
                        'number_of_bathrooms' => '1',
                        'mq' => '45',
                        'price' => '74',
                        'type' => 'villetta',
                        'description' => 'Affittasi mese agosto villetta con giardino situata nel villaggio Tucano, a pochi km dal suggestivo Castello Aragonese . Spiaggia e piscina raggiungibili a piedi.
                        La casa è composta da una camera matrimoniale, divano letto, cucina, bagno e veranda con giardino.
                        Il villaggio offre servizi di intrattenimento per piccoli e adulti, anfiteatro, piscine e campi da tennis.',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Contrada Santa Domenica',
                        'zip_code' => '88050',
                        'city' => 'Catanzaro',
                        'lat' => '38.9223',
                        'lng' => '16.6082'
                      ],
                      [
                        'title' => 'Quadrilocale in Affitto in Via Alcide De Gasperi 30 a Pizzo',
                        'number_of_rooms' => '4',
                        'number_of_beds' => '2',
                        'number_of_bathrooms' => '1',
                        'mq' => '75',
                        'price' => '90',
                        'type' => 'appartamento',
                        'description' => 'vista mare sul porto di Vibo Marina, splendidi Tramonti sullo Stromboli
                        Appartamento in Palazzo ubicato proprio sulla spiaggia, alla quale si accede direttamente dal portone. Composto da cucina, 2 camere da letto, 1 bagno. Climatizzato. ideale per coppia. disponibile da subito.',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Via Alcide De Gasperi',
                        'zip_code' => '95025',
                        'city' => 'Aci Sant\'Antonio',
                        'lat' => '37.5961',
                        'lng' => '15.1267'
                      ],
                      [
                        'title' => 'Attico, Mansarda in Vendita in Via Colombarina a Riccione',
                        'number_of_rooms' => '4',
                        'number_of_beds' => '2',
                        'number_of_bathrooms' => '1',
                        'mq' => '144',
                        'price' => '120',
                        'type' => 'appartamento',
                        'description' => 'A Sant\'Andrea in Besanigo, ai confini di Riccione a 2,5 Km da Viale Ceccarini, in piacevole zona residenziale, prossima realizzazione di due piccole palazzine. Varie soluzioni abitative per ogni esigenza. Il tutto realizzato con innovativi sistemi impiantistici per il contenimento dei consumi e l’utilizzo di fonti energetiche rinnovabili.
                        Ottimo rapporto qualità prezzo
                        Tipologia A7 Attico ultimo piano composta da: soggiorno, cucina, ampia camera matrimoniale, due ampie camere singole, due bagni, ampi balconi loggiati vivibili, garage doppio',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Via Colombarina',
                        'zip_code' => '40026',
                        'city' => 'Imola',
                        'lat' => '44.3247',
                        'lng' => '11.6587'
                      ],
                      [
                        'title' => 'Attico, Mansarda in Vendita in vico ferruccio a Reggio Calabria',
                        'number_of_rooms' => '5',
                        'number_of_beds' => '3',
                        'number_of_bathrooms' => '2',
                        'mq' => '161',
                        'price' => '95',
                        'type' => 'appartamento',
                        'description' => 'Reggio Calabria, in Vico Ferruccio, proponiamo in vendita uno splendido attico posto su due livelli al 6°e 7 piano con ascensore, di mq 161, composto da ingresso su ampio salone, cucina abitabile, nella zona notte troviamo 4 camere da letto, di cui una con cabina armadio, 2 bagni e 2 ampie verande vista mare. L\'immobile è in ottime condizioni, è rifinito con materiali di pregio, dotato di riscaldamento autonomo e climatizzatori in tutti gli ambienti, parquet in tutta la casa, infissi vetrocamera, zanzariere ed impianto di allarme. L\'attico è dotato di posto auto coperto all\'interno del cortile condominiale e di un garage di 29 mq.',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Vico I Ferruccio',
                        'zip_code' => '88046',
                        'city' => 'Lamezia Terme',
                        'lat' => '38.9685',
                        'lng' => '16.2823'
                      ],
                      [
                        'title' => 'Appartamento in via Antonio Galateo 40 a Lecce',
                        'number_of_rooms' => '5',
                        'number_of_beds' => '3',
                        'number_of_bathrooms' => '3',
                        'mq' => '235',
                        'price' => '120',
                        'type' => 'appartamento',
                        'description' => 'Casabella srl- Lecce- nel cuore del Centro Storico della Città, nelle immediate vicinanze di Via Libertini una delle principali vie di passeggio, a soli due minuti a piedi dal Duomo, proponiamo rifinita palazzina completamente ristrutturata con appartamento al piano terra, volte a stella e muri a vista, con accesso indipendente da corte privata antistante, composto da ingresso, ampia zona giorno- open space- zona pranzo, angolo cottura, doppi servizi, due vani letto soppalcati e scoperto di pertinenza retrostante con angolo lavanderia. Altro appartamento al 1°piano, composto da ingresso soggiorno, cucina semi abitabile con affaccio su balcone, ampia camera da letto, disimpegno, bagno, comodo pozzo luce adibito a lavanderia ed area solare di proprietà esclusiva, avente accesso sempre dalla corte antistante. Possibilità di vendita separata. € 170.000,00 il piano terra e 160.000,00 il primo piano.',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Via Antonio Galateo',
                        'zip_code' => '73100',
                        'city' => 'Lecce',
                        'lat' => '40.3526',
                        'lng' => '18.1662'
                      ],
                      [
                        'title' => 'Villetta a Schiera in Vendita in Via Giammatteo a Lecce',
                        'number_of_rooms' => '4',
                        'number_of_beds' => '3',
                        'number_of_bathrooms' => '3',
                        'mq' => '201',
                        'price' => '107',
                        'type' => 'villetta',
                        'description' => '',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Via Giammatteo',
                        'zip_code' => '73100',
                        'city' => 'Lecce',
                        'lat' => '40.3783',
                        'lng' => '18.1831'
                      ],
                      [
                        'title' => 'Villa in Vendita in Via Grossetto a Olbia',
                        'number_of_rooms' => '6',
                        'number_of_beds' => '4',
                        'number_of_bathrooms' => '2',
                        'mq' => '239',
                        'price' => '137',
                        'type' => 'villetta',
                        'description' => 'Olbia - Loc.Maria Rocca. Villa (135 mq) con giardino piantumato, prato verde con impianto di irrigazione automatico, rifiniture di pregio. La villa è composta da 3 livelli: al piano terra, soggiorno, cucina abitabile, studio, bagno, dispensa e due verande coperte. Al piano primo: due camere, bagno, due verande di cui una coperta. Al piano interrato taverna con garage al rustico.
                        Prezzo interessante Euro 430.000,00',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Via Grosseto',
                        'zip_code' => '95024',
                        'city' => 'Acireale',
                        'lat' => '37.5985',
                        'lng' => '15.1513'
                      ],
                      [
                        'title' => 'Appartamento in Vendita in Porto Rotondo Costa Smeralda 19 a Olbia',
                        'number_of_rooms' => '5',
                        'number_of_beds' => '3',
                        'number_of_bathrooms' => '2',
                        'mq' => '97',
                        'price' => '90',
                        'type' => 'appartamento',
                        'description' => 'Porto Rotondo centro.
                        Proponiamo in vendita l\'appartamento in Porto Rotondo villaggio Ginepri 2.
                        L\'immobile composto da 1 soggiorno con cucina a vista e bagno di servizio, 3 camere da letto , 2 bagni, 2 verande scoperte, 1 piccolo cortile .
                        Appartamento dotato di doppio ingresso, parzialmente ristrutturato con impianti nuovi .',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Via Porto Rotondo',
                        'zip_code' => '07026',
                        'city' => 'Olbia',
                        'lat' => '41.0257',
                        'lng' => '9.54633'
                      ],
                      [
                        'title' => 'Villa in Vendita in VIA DEL GIGLIO 112 a Olbia',
                        'number_of_rooms' => '7',
                        'number_of_beds' => '3',
                        'number_of_bathrooms' => '3',
                        'mq' => '238',
                        'price' => '144',
                        'type' => 'villetta',
                        'description' => 'Villa di pregio che sovrasta il golfo di Pittulongu con una incantevole vista panoramica sulle località di Capo Ceraso, Isola di Tavolara e Capo Figari. La villa è stata costruita con dotazioni di ottimo livello e si distingue per l\'ottimale disposizione degli ambienti suddivisi in due piani entrambi abitabili, comodi e funzionali e comunicanti tra loro sia dall\'interno che dall\'esterno. Il livello superiore è costituito da un soggiorno pranzo con caminetto, angolo cucina, disimpegno, 2 camere, 2 bagni, ripostiglio e una grande veranda con irripetibile vista mare. Il piano terra è composto da un soggiorno pranzo con caminetto, angolo cucina, 2 camere, bagno, cantinetta lavanderia, ripostiglio e circostante giardino coltivato con essenze della zona e dove insistono due comodi posti auto.
                        Completano la villa, al piano primo, accessibile da una scaletta esterna, un magnifico solariun con vista panoramica sul golfo di Olbia.',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Via Isola del Giglio',
                        'zip_code' => '00141',
                        'city' => 'Roma',
                        'lat' => '41.9305',
                        'lng' => '12.5351'
                      ],
                      [
                        'title' => 'Quadrilocale in Vendita in Via Santa Maria la Nova 32 a Napoli',
                        'number_of_rooms' => '4',
                        'number_of_beds' => '3',
                        'number_of_bathrooms' => '2',
                        'mq' => '110',
                        'price' => '76',
                        'type' => 'appartamento',
                        'description' => 'Centro Storico, Via S. Maria la Nova, in edificio storico appartamento composto da ingresso, ampio soggiorno con angolo cottura, due camere, cameretta, doppi servizi e piccolo terrazzino interno. L\'immobile, con prevalente affaccio su Via Donnalbina, è luminoso. Le condizioni generali di manutenzione sono buone.€ 310.000',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Via Santa Maria la Nova',
                        'zip_code' => '80133',
                        'city' => 'Napoli',
                        'lat' => '40.8442',
                        'lng' => '14.2531'
                      ],
                      [
                        'title' => 'Appartamento in Vendita in zona Borgo Trento a Verona',
                        'number_of_rooms' => '5',
                        'number_of_beds' => '3',
                        'number_of_bathrooms' => '2',
                        'mq' => '125',
                        'price' => '98',
                        'type' => 'appartamento',
                        'description' => 'BORGO TRENTO – VIA ROVERETO angolo VIA PRATO SANTO, proponiamo luminoso appartamento di nuova ristrutturazione del 2020, così composto internamente : ingresso, ampio soggiorno con zona cottura (trasformabile in cucina separata a seconda delle esigenze), locale lavanderia e balcone angolare a tutta la zona giorno ; nella zona notte troviamo tre camere da letto e due servizi, così suddivise : ampia camera padronale dotata di balcone abitabile, bagno finestrato en-suite e angolo guardaroba, due camere da letto singole, di cui una balconata ed infine il bagno principale. L\'unità abitativa si trova in uno stabile signorile dotato di ascensore, con facciate in mattoni a vista ed ubicato a 200 mt da “Ponte Garibaldi” e da "Ponte della Vittoria" e quindi dal "Centro Storico", con ottime finiture interne di ultima generazione, la metratura commerciale dell\'appartamento è di circa 125 mq. ed è completo di soffitta di mq. 15 al piano quinto e di un comodo garage di mq. 25 con facilità di manovra, al piano interrato. Teleriscaldamento centralizzato a consumo effettivo. Zona servita dai principali servizi di prima necessità quotidiana.',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Borgo Trento',
                        'zip_code' => '37126',
                        'city' => 'Verona',
                        'lat' => '45.4465',
                        'lng' => '10.9878'
                      ],
                      [
                        'title' => 'Trilocale in Vendita in zona Navigatori a Verona',
                        'number_of_rooms' => '3',
                        'number_of_beds' => '2',
                        'number_of_bathrooms' => '2',
                        'mq' => '106',
                        'price' => '77',
                        'type' => 'appartamento',
                        'description' => 'L’immobile è stato ristrutturato nel 2005 e presenta pavimenti in parquet nella zona notte e sanitari sospesi nel bagno.
                        Il riscaldamento è centralizzato con teleriscaldamento e contacalorie.
                        La casa è inoltre dotata di impianto dell’aria condizionata con 2 split e predisposizione per il secondo bagno.',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Via dei Navigatori Padani',
                        'zip_code' => '26100',
                        'city' => 'Cremona',
                        'lat' => '45.1311',
                        'lng' => '10.0127'
                      ],
                      [
                        'title' => 'Quadrilocale in Vendita in Via Frà Bartolommeo a Firenze',
                        'number_of_rooms' => '4',
                        'number_of_beds' => '2',
                        'number_of_bathrooms' => '1',
                        'mq' => '80',
                        'price' => '68',
                        'type' => 'appartamento',
                        'description' => 'L\'immobile è stato progettato per avere una soluzione confortevole e moderna: internamente si compone di un ingresso che disimpegna, subito al centro, l\'ampia zona giorno con angolo cottura dotata di due punti luce (finestre) e di un balcone che affaccia sull\'interno, mentre sul lato destro troviamo le due camere da letto ed il bagno finestrato.
                        La soluzione è ideale sia per giovani coppie, anche con due figli (possibilità di 3 camere da letto), che come forma di investimento da introdurre sul circuito delle locazioni.',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Via Fra\' Bartolommeo',
                        'zip_code' => '50120',
                        'city' => 'Firenze',
                        'lat' => '43.7838',
                        'lng' => '11.2658'
                      ],
                      [
                        'title' => 'Quadrilocale in Vendita in Via Panorama a Pinzolo',
                        'number_of_rooms' => '4',
                        'number_of_beds' => '3',
                        'number_of_bathrooms' => '2',
                        'mq' => '105',
                        'price' => '90',
                        'type' => 'appartamento',
                        'description' => 'Le Dolomiti di Brenta occupano una superficie totale di 436 kmq. La storia alpinistica e di passione per il territorio inizia a metà del 1800. Attualmente è una meta amata da escursionisti ed alpinisti che godono di viste incantevoli e percorsi di varie difficoltà. Una splendida vista su questo Gruppo si ha da Madonna di Campiglio. In questa località vi proponiamo in vendita un ampio appartamento. Questa soluzione è situata al primo piano, entrando si possono notare i materiali di pregio utilizzati nella ristrutturazione come, ad esempio, il legno, le incisioni sul mobilio, le maniglie. La zona living è composta da un ampio soggiorno con una stufa elettrica ad accumulo in maiolica, balcone con vista sul Brenta a completare troviamo un angolo cottura dotato di ogni elettrodomestico. La zona notte è composta da una stanza padronale con bagno e da altre due camere di cui una con balcone e secondo bagno. A completare la proprietà troviamo un posto auto coperto. Il condominio dispone di un custode fisso, di una zona lavanderia e giardino. Per ulteriori informazioni e per visionare l\'immobile contattaci al 0464-514425 o scrivi una mail a Contatta l\'Agenzia con il servizio "Invia Richiesta"',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Via del Panorama',
                        'zip_code' => '34134',
                        'city' => 'Trieste',
                        'lat' => '45.6615',
                        'lng' => '13.7752'
                      ],
                      [
                        'title' => 'Trilocale in Vendita in Fucine 17 a Pinzolo',
                        'number_of_rooms' => '3',
                        'number_of_beds' => '2',
                        'number_of_bathrooms' => '1',
                        'mq' => '70',
                        'price' => '90',
                        'type' => 'villetta',
                        'description' => 'In ottima posizione vicino ai servizi e agli impianti di risalita, ampio trilocale a primo piano da poco ristrutturato ed arredato con gusto. L\'appartamento è composto da ingresso nell\'ampia zona giorno con accesso al terrazzo esposto a sud/ovest, piccolo cucinotto separato, disimpegno, bagno finestrato, stanza matrimoniale e stanza a due letti, a piano interrato di pertinenza ampia cantina e posto auto.',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Via Renato Fucini',
                        'zip_code' => '95126',
                        'city' => 'Catania',
                        'lat' => '37.5308',
                        'lng' => '15.108'
                      ],
                      [
                        'title' => 'Attico, Mansarda in Vendita in via Renon a Bolzano',
                        'number_of_rooms' => '5',
                        'number_of_beds' => '4',
                        'number_of_bathrooms' => '2',
                        'mq' => '225',
                        'price' => '143',
                        'type' => 'appartamento',
                        'description' => 'Attico esclusivo con ampia terrazza e giardino Questo attico curatissimo distante pochi passi dal centro storico di Bolzano con ca.130 mq di superficie netta, un\'ampia terrazza e un giardino è un immobile particolare e fuori dal comune. Lappartamento è in ottime condizioni e grazie alla sua posizione e allarredamento può certamente essere definito esclusivo. L\'immobile offre molto spazio, non solo al suo interno ma anche allesterno, grazie allampia terrazza lungo le facciate sud, ovest e nord la quale permette di godere di una spendida vista sulla città di Bolzano, sole dalla mattina alla sera e di una calma inconsueta. Il prezzo include una cantina. È possibile acquistare un garage e un ampio posto auto pagando un sovrapprezzo. Il posto auto è coperto, chiuso a chiave e offre posto per 2 macchine. La consegna è prevista per inizio 2022. Questofferta Vi ha convinti? Allora contattateci per ulteriori informazioni!',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Via Renon',
                        'zip_code' => '39100',
                        'city' => 'Bolzano',
                        'lat' => '46.4985',
                        'lng' => '11.3614'
                      ],
                      [
                        'title' => 'Quadrilocale in Vendita in Corso Marconi a Sanremo',
                        'number_of_rooms' => '4',
                        'number_of_beds' => '2',
                        'number_of_bathrooms' => '2',
                        'mq' => '100',
                        'price' => '88',
                        'type' => 'appartamento',
                        'description' => 'In complesso fronte mare, proponiamo appartamento di mq 100 con terrazza di oltre 120 mq composto da ingresso, soggiorno doppio, cucina abitabile, due camere e due bagni. Ampio parcheggio condominiale.',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Corso Guglielmo Marconi',
                        'zip_code' => '18014',
                        'city' => 'Sanremo',
                        'lat' => '43.8049',
                        'lng' => '7.74711'
                      ],
                      [
                        'title' => 'Attico, Mansarda in Vendita in Strada Privata Vallarino a Sanremo',
                        'number_of_rooms' => '6',
                        'number_of_beds' => '5',
                        'number_of_bathrooms' => '2',
                        'mq' => '130',
                        'price' => '120',
                        'type' => 'appartamento',
                        'description' => 'Sanremo, zona Foce, via privata Vallarino, situato in un complesso signorile, circondato dal verde, attico pentalocale di ca. 130 mq. , posto al 4° ed ultimo piano molto soleggiato, esposizione: sud- ovest – nord, composto da: doppio ingresso, salone, cucina abitabile, 2 camere matrimoniali, una cameretta, uno studio, 2 bagni finestrati, terrazzo di ca. 100 mq. circostante con splendida vista mare, 2 garages, 1 posto auto 2 cantine, riscaldamento centralizzato con termovalvole.',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Via Privata Vallarino',
                        'zip_code' => '18038',
                        'city' => 'Sanremo',
                        'lat' => '43.8112',
                        'lng' => '7.75657'
                      ],
                      [
                        'title' => 'Attico, Mansarda in Vendita in Via Poncione a Lecco',
                        'number_of_rooms' => '3',
                        'number_of_beds' => '2',
                        'number_of_bathrooms' => '2',
                        'mq' => '160',
                        'price' => '106',
                        'type' => 'appartamento',
                        'description' => 'LECCO loc. Maggianico in zona residenziale, in posizione tranquilla e panoramica, in signorile villa quadrifamiliare, elegante appartamento di mq 160 ca libero su quattro lati, posto al quarto ed ultimo piano con splendida vista lago e sui monti circostanti, particolarmente luminoso, con possibilità di realizzo di terza camera, con ottime finiture ed ampi spazi, composto da: ampio e luminoso, ingresso - studio, soggiorno con cucina di mq. 75 ca , disimpegno, due ampie camere matrimoniali, doppi servizi con finestra. . Possibilità di ripristino di ascensore interno all’unità abitativa. L’immobile è stato recentemente parzialmente ristrutturato. Riscaldamento autonomo. Nessuna spesa condominiale. Euro 25.000 per ampio box doppio pertinenziale ed Euro 275.000 per l’unità abitativa.',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Via Poncione',
                        'zip_code' => '23900',
                        'city' => 'Lecco',
                        'lat' => '45.8356',
                        'lng' => '9.41277'
                      ],
                      [
                        'title' => 'Appartamento in Vendita in zona Centro a Lecco',
                        'number_of_rooms' => '6',
                        'number_of_beds' => '5',
                        'number_of_bathrooms' => '2',
                        'mq' => '240',
                        'price' => '160',
                        'type' => 'appartamento',
                        'description' => 'Vendita, Lecco centro, luminoso appartamento posto al 6° piano con splendida vista sulle montagne composto da ingresso, ampio soggiorno, cucina abitabile, quattro camere da letto, due bagni, una lavanderia, quattro balconi e una cantina spaziosa di 20 mq. Possibilità di uno o due box in affitto o in acquisto.
                        L\'appartamento è stato completamente ristrutturato nell\'anno 2015.
                        Per informazioni contattare la nostra Agenzia My Place in Lecco Corso Martiri della Liberazione n. 2 tel. 0341 / 289289 e-mail Contatta l\'Agenzia con il servizio "Invia Richiesta"',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Via Lecco',
                        'zip_code' => '23851',
                        'city' => 'Galibiate',
                        'lat' => '45.8172',
                        'lng' => '9.38031'
                      ],
                      [
                        'title' => 'Trilocale in Vendita in corso martiri a Lecco',
                        'number_of_rooms' => '3',
                        'number_of_beds' => '2',
                        'number_of_bathrooms' => '1',
                        'mq' => '122',
                        'price' => '50',
                        'type' => 'appartamento',
                        'description' => 'LECCO Pescarenico - Nel cuore del quartiere pittoresco di Pescarenico, inserito in casa bifamiliare, proponiamo ampio e luminoso appartamento trilocale di circa 122 mq senza spesa condominiali. L\'ingresso indipendente conduce alla spaziosa zona giorno composta dal soggiorno e dalla cucina a vista con affaccio su due balconi. Il disimpegno conduce alla zona notte che ospita la cameretta e la camera matrimoniale, entrambe con balcone, oltre all\'ampio bagno finestrato con doccia e vasca. La soluzione è stata oggetto di completa ristrutturazione nel 2002 pertanto le finiture sono curate nei minimi dettagli. Riscaldamento autonomo con caldaia a condensazione. Il box di circa 24 mq e la cantina completano la proprietà.',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Corso Martiri della Liberazione',
                        'zip_code' => '23900',
                        'city' => 'Lecco',
                        'lat' => '45.8484',
                        'lng' => '9.39594'
                      ],
                      [
                        'title' => 'Trilocale in Vendita in Via Gian Battista Grassi 12 a Como',
                        'number_of_rooms' => '3',
                        'number_of_beds' => '2',
                        'number_of_bathrooms' => '1',
                        'mq' => '93',
                        'price' => '50',
                        'type' => 'appartamento',
                        'description' => 'COMO - VIA GRASSI nel cuore del centro storico, a due passi dal lago e da Piazza Volta, comodo per la stazione, in contesto residenziale signorile di inizi \'900 VENDIAMO caratteristico appartamento di circa 90 mq.
                        L\'appartamento, si compone di ingresso con ballatoio , ampio salone , disimpegno, cucina abitabile, grande camera da letto, disimpegno e bagno.
                        L\'appartamento di recente ristrutturazione è molto ampio e luminoso con finiture di buon livello qualitativo. Termoautonomo e climatizzato. Ottima opportunità di investimento data da un\'ottima redditività!',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Via Gian Battista Grassi',
                        'zip_code' => '22072',
                        'city' => 'Cermenate',
                        'lat' => '45.7024',
                        'lng' => '9.08624'
                      ],
                      [
                        'title' => 'Trilocale in Vendita a Riccione centrale porto mare',
                        'number_of_rooms' => '3',
                        'number_of_beds' => '2',
                        'number_of_bathrooms' => '1',
                        'mq' => '70',
                        'price' => '40',
                        'type' => 'villetta',
                        'description' => 'RICCIONE CENTRALISSIMO PORTO MARE , a 200 mt dal mare in lussuosa palazzina di recente costruzione appartamento piano alto con ascensore panoramico e luminoso , rifiniture di altissimo livello , arredato moderno e fashion , composto da soggiorno con angolo cottura , 2 camere , 1 bagno , grande terrazzo abitabile , ampio ripostiglio , posto auto di proprietà , aria condizionata , riscald. autonomo RIF. 704 € 340.000',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Via Riccione',
                        'zip_code' => '37134',
                        'city' => 'Verona',
                        'lat' => '45.4085',
                        'lng' => '11.0057'
                      ],
                      [
                        'title' => 'Bilocale in Vendita a Catania - vista mare',
                        'number_of_rooms' => '2',
                        'number_of_beds' => '1',
                        'number_of_bathrooms' => '1',
                        'mq' => '50',
                        'price' => '30',
                        'type' => 'appartamento',
                        'description' => 'CATANIA MARE a 100 mt. dal mare in recente palazzina appartamento al piano 4° con ascensore composto da soggiorno con angolo cottura 1 camera matrimoniale , 1 bagno , terrazzo abitabile , cantina per le biciclette , arredato , riscaldamento autonomo € 185.000 RIF. 713',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Via Riccioli',
                        'zip_code' => '95131',
                        'city' => 'Catania',
                        'lat' => '37.5016',
                        'lng' => '15.086'
                      ],
                      [
                        'title' => 'Quadrilocale in Vendita in Via Barberia 11 a Bologna',
                        'number_of_rooms' => '4',
                        'number_of_beds' => '2',
                        'number_of_bathrooms' => '2',
                        'mq' => '90',
                        'price' => '60',
                        'type' => 'appartamento',
                        'description' => 'APPARTAMENTO IN VENDITA A BOLOGNA ZONA CENTRO STORICO
                        CENTRO STORICO - VIA BARBERIA N.11 - AD.ZE PIAZZA MAGGIORE
                        PALAZZO STORICO-PIANO NOBILE- NUOVISSIMO-90 MQ- TERRAZZO',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Via Barberia 11',
                        'zip_code' => '40123',
                        'city' => 'Bologna',
                        'lat' => '44.4922',
                        'lng' => '11.3377'
                      ],
                      [
                        'title' => 'Villa in Vendita in Via Di Casaglia a Bologna',
                        'number_of_rooms' => '10',
                        'number_of_beds' => '7',
                        'number_of_bathrooms' => '4',
                        'mq' => '300',
                        'price' => '167',
                        'type' => 'villetta',
                        'description' => 'VILLA IN VENDITA A BOLOGNA ZONA SARAGOZZA

                        SARAGOZZA – VIA DI CASAGLIA
                        VILLA UNIFAMILIARE IN CONTESTO RESIDENZIALE – 300 MQ- GIARDINO PRIVATO- IMPIANTO FOTOVOLTAICO- GRANDI TERRAZZE - GARAGE DOPPIO.
                        E\' disponibile per l\'acquisto una bellissima villa unifamiliare inserita in un contesto residenziale , prestigioso e ben curato ai piedi di S. Luca.',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Via di Casaglia',
                        'zip_code' => '40135',
                        'city' => 'Bologna',
                        'lat' => '44.4695',
                        'lng' => '11.3052'
                      ],
                      [
                        'title' => 'Quadrilocale in Vendita in zona Centro, Marconi a Bologna',
                        'number_of_rooms' => '4',
                        'number_of_beds' => '4',
                        'number_of_bathrooms' => '3',
                        'mq' => '165',
                        'price' => '110',
                        'type' => 'villetta',
                        'description' => 'Centro storico, via Montegrappa ad. ze, In strada di poco traffico in elegante e storico edificio del 1900 in ottimo stato di conservazione. Appartamento su due livelli di grande fascino totalmente ristrutturato secondo le indicazioni di un architetto con recupero dei volumi per complessivi mq 165 Gli ampi spazi, i materiali utilizzati, la luminosità e la razionalità della ristrutturazione caratterizzano questa residenza. Al piano secondo troviamo un ampio ingresso che raccorda il salone con camino l’ampia cucina abitabile, la camera principale con cabina guardaroba e stanza da bagno ed una lavanderia. Una bella scala interna porta al piano superiore, con zona studio, bagno ed ampio vano mansardato alto con velux da utilizzare come camera da letto o zona living (attuale uso) . Riscaldamento autonomo ed impianto climatizzazione. Ampia cantina. Cortile interno condominiale per deposito bici. RIF 00768 euro 660.000.',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Marconi',
                        'zip_code' => '40100',
                        'city' => 'Bologna',
                        'lat' => '44.5006',
                        'lng' => '11.3392'
                      ],
                      [
                        'title' => 'Bilocale in Affitto in Viale Scala Greca 426 a Siracusa',
                        'number_of_rooms' => '2',
                        'number_of_beds' => '1',
                        'number_of_bathrooms' => '2',
                        'mq' => '45',
                        'price' => '30',
                        'type' => 'appartamento',
                        'description' => 'A Scala Greca in contesto di recente costruzione, proponiamo in locazione grazioso appartamento arredato composto da ingresso su soggiorno con cucina a vista, una camera da letto con annesso bagno. Completano l\'immobile un balcone chiuso con infissi in cui è stato ricavato angolo lavanderia, ed un piccolo terrazzino con vista mare.',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Viale Scala Greca',
                        'zip_code' => '96100',
                        'city' => 'Siracusa',
                        'lat' => '37.0924',
                        'lng' => '15.2704'
                      ],
                      [
                        'title' => 'Trilocale in Affitto in Via Malta a Siracusa',
                        'number_of_rooms' => '3',
                        'number_of_beds' => '2',
                        'number_of_bathrooms' => '1',
                        'mq' => '100',
                        'price' => '60',
                        'type' => 'appartamento',
                        'description' => 'In Via Malta, ubicato al primo piano ascensorato di un palazzo signorile alle porte di Ortigia, Style Real Estate propone in affitto graziosissimo appartamento con affaccio sul mare della darsena. Il delizioso trilocale, completamente arredato e dotato di tutti i comfort, è composto da cucina, soggiorno, due camere da letto, bagno, cabina armadio e lavanderia. L\'appartamento si presenta come nuovo, ben curato e con rifiniture moderne. Posizione di prestigio in prossimità del centro storico non soggetta a ZTL.',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Via Malta',
                        'zip_code' => '96100',
                        'city' => 'Siracusa',
                        'lat' => '37.065',
                        'lng' => '15.2878'
                      ],
                      [
                        'title' => 'Bilocale in Affitto in via re ierone II 1 a Siracusa',
                        'number_of_rooms' => '2',
                        'number_of_beds' => '2',
                        'number_of_bathrooms' => '1',
                        'mq' => '45',
                        'price' => '32',
                        'type' => 'appartamento',
                        'description' => 'In zona Gelone, vicino al Santuario e all\'Ospedale Umberto I, Gabetti Siracusa propone in affitto a 300 € un bivani arredato posto al piano terra di un piccolo condominio. La casa, ideale per trasfertisti, misura 35 mq ed è composta da ingresso su cucina, spaziosa camera da letto e bagno con doccia. In casa, oltre agli arredi ordinari, è presente una pompa di calore in camera da letto.',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Via Re Ierone II',
                        'zip_code' => '96100',
                        'city' => 'Siracusa',
                        'lat' => '37.0704',
                        'lng' => '15.2862'
                      ],
                      [
                        'title' => 'Bilocale in Affitto in Via Costanza Bruno 10 a Siracusa',
                        'number_of_rooms' => '2',
                        'number_of_beds' => '1',
                        'number_of_bathrooms' => '1',
                        'mq' => '60',
                        'price' => '65',
                        'type' => 'appartamento',
                        'description' => 'Siracusa, zona servita Teracati - San Giovanni, e più precisamente in Via Costanza Bruno 10, RE/MAX società immobiliare internazionale propone in Affitto comodo e centrale appartamento arredato.
                        L\'immobile all\'interno di un condominio signorile, posto al terzo piano servito da ascensore, è composto da ingresso disimpegnato, soggiorno, 1 camera da letto matrimoniale, cucina abitabile, bagno, ripostiglio, mq 60 oltre 2 ampi balconi.
                        Il canone di locazione comprende tutte le spese tranne il consumo di energia elettrica. ',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Via Costanza Bruno',
                        'zip_code' => '96100',
                        'city' => 'Siracusa',
                        'lat' => '37.0787',
                        'lng' => '15.2825'
                      ],
                      [
                        'title' => 'Appartamento in Affitto in via largo porto piccolo 1 a Siracusa',
                        'number_of_rooms' => '6',
                        'number_of_beds' => '5',
                        'number_of_bathrooms' => '2',
                        'mq' => '170',
                        'price' => '68',
                        'type' => 'appartamento',
                        'description' => 'Gabetti Siracusa propone in affitto a 700 euro mese (condominio 35 €/m) un esavani di 170 mq sito in zona Borgata. La casa è al quarto piano di un palazzo di totale sei con ascensore ed è dotato di ben tre balconi e una veranda di 9 mq (con vista aperta sul mare e su ortigia). Internamente la casa è composta da ingresso su disimpegno, salone doppio, cucina abitabile con balcone (che ha una vista sul cortile interno), 4 camere (2 con un balcone ognuno), un bagno con doccia e un bagno con vasca idromassaggio e ripostiglio.',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Largo Porto Piccolo',
                        'zip_code' => '96100',
                        'city' => 'Siracusa',
                        'lat' => '37.0699',
                        'lng' => '15.2906'
                      ],
                      [
                        'title' => 'Quadrilocale in Affitto in Viale Teocrito 98 a Siracusa',
                        'number_of_rooms' => '4',
                        'number_of_beds' => '3',
                        'number_of_bathrooms' => '1',
                        'mq' => '90',
                        'price' => '40',
                        'type' => 'appartamento',
                        'description' => 'Affittasi in Viale Teocrito, zona centralissima e cuore della città di Siracusa, ampio quadrilocale di circa 90 mq COMPLTAMENTE RISTRUTTURATO ED ARREDATO. Composto da: salone, cucina abitabile, 2 camere da letto ed ampio bagno. L\'immobile ha 3 balconi che si affacciano sulla Madonnina delle lacrime. Appartamento climatizzato con clima inverter. Finemente ristrutturato ed arredato.Vicinissimo al museo Nazionale Paolo Orsi, Area archeologica della Neapolis. L\'isola di Ortigia raggiungibili con una breve passeggiata.',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Viale Teocrito',
                        'zip_code' => '96100',
                        'city' => 'Siracusa',
                        'lat' => '37.0754',
                        'lng' => '15.288'
                      ],
                      [
                        'title' => 'Bilocale in Affitto in Via Castello Maniace 5 a Siracusa',
                        'number_of_rooms' => '2',
                        'number_of_beds' => '1',
                        'number_of_bathrooms' => '1',
                        'mq' => '60',
                        'price' => '30',
                        'type' => 'appartamento',
                        'description' => 'Affittasi bivani di 60 mq sulla Fonte Aretusa nellisola di Ortigia a Siracusa, COMPLETAMENTE RISTRUTTURATO ED ARREDATO.E\' composto da una camera matrimoniale ed un soggiorno con un angolo cottura e bagno. E completamente arredato, comprese stoviglie, con televisione,lavabiancheria ed aria condizionata. Ha un balcone direttamente sulla Fonte Aretusa, a 150m. è possibile fare il bagno nel mare cristallino di Siracusa. , mentre piazza Duomo è a 100m.',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Via del Castello Maniace',
                        'zip_code' => '96100',
                        'city' => 'Siracusa',
                        'lat' => '37.0564',
                        'lng' => '15.2938'
                      ],
                      [
                        'title' => 'Trilocale in Affitto in Via D. Viviani 45 a Levanto',
                        'number_of_rooms' => '3',
                        'number_of_beds' => '2',
                        'number_of_bathrooms' => '2',
                        'mq' => '95',
                        'price' => '58',
                        'type' => 'appartamento',
                        'description' => 'Levanto, a due passi dal centro, proponiamo in affitto appartamenti di nuova costruzione da 60 mq. a 95 mq. con terrazzi, balconi, giardini. Ogni appartamento può essere dotato di box in garage.
                        A due passi da tutti i servizi e circa 400 metri dal mare è situata la residenza Santa Caterina, delimitata da cancello elettrico. Tutti gli appartamenti sono serviti da WiFi e dotati di TV ultima generazione, soggiorno con divano letto, cucina completamente attrezzata, lavatrice, forno, stoviglie, doppi servizi. Per ogni appartamento possiamo proporre soluzioni personalizzate.
                        La disponibilità in affitto è per il PERIODO AUTUNNO-INVERNO, da OTTOBRE ad APRILE.',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Via Domenico Viviani',
                        'zip_code' => '19015',
                        'city' => 'Levanto',
                        'lat' => '44.1722',
                        'lng' => '9.61589'
                      ],
                      [
                        'title' => 'Bilocale in Affitto in Riviera di Chiaia a Napoli',
                        'number_of_rooms' => '2',
                        'number_of_beds' => '1',
                        'number_of_bathrooms' => '1',
                        'mq' => '60',
                        'price' => '39',
                        'type' => 'appartamento',
                        'description' => 'RIVIERA DI CHIAIA: a pochi passi dal Lungomare, fronte villa comunale, In ottimo condominio moderno con servizio di portineria ed ascensore, proponiamo in locazione appartamento posto al quinto piano, ad uso abitazione transitoria (minimo 12 mesi) a persone referenziate.
                        L\'immobile è stato appena ristrutturato completamente e finemente arredato con mobili nuovi ed è composto da ingresso, salone con cucina a vista (completa di elettrodomestici), camera da letto e bagno. Dotato di aria condizionata, ed impianto di riscaldamento autonomo.',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Riviera di Chiaia',
                        'zip_code' => '80121',
                        'city' => 'Napoli',
                        'lat' => '40.8337',
                        'lng' => '14.2331'
                      ],
                      [
                        'title' => 'Appartamento in Affitto in Vico Paradiso Alla Salute 68 a Napoli',
                        'number_of_rooms' => '5',
                        'number_of_beds' => '4',
                        'number_of_bathrooms' => '1',
                        'mq' => '90',
                        'price' => '72',
                        'type' => 'appartamento',
                        'description' => 'Proponiamo in fitto grazioso appartamento panoramico in zona Materdei di circa 90 mq. L’immobile è situato all’ultimo piano in uno stabile di cemento armato favorito dal servizio di portierato. Il cespite si compone di ingresso, tre camere da letto, cucina abitabile e un bagno; il riscaldamento è autonomo, gli infissi sono di ultima generazione e la porta è blindata. La tripla esposizione favorita da ampie finestre rende la casa a dir poco luminosa. Gli affacci offrono una splendida vista, da Capodimonte a San Martino, trasmettendo grande quiete e profondità di veduta. Si precisa che l’annuncio è rivolto a persone referenziate e con reddito dimostrabile.',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Vico Paradiso',
                        'zip_code' => '80135',
                        'city' => 'Napoli',
                        'lat' => '40.8452',
                        'lng' => '14.2458'
                      ],
                      [
                        'title' => 'Appartamento in Affitto in Via Montevergine 39 a Napoli',
                        'number_of_rooms' => '5',
                        'number_of_beds' => '3',
                        'number_of_bathrooms' => '2',
                        'mq' => '130',
                        'price' => '86',
                        'type' => 'appartamento',
                        'description' => 'Nelle immediate adiacenze di Via Epomeo (Via Montevergine) in stabile signorile con servizio di portierato e video sorveglianza,vicinissimo a tutti i principali servizi ed attivita\' commerciali,proponiamo in locazione un appartamento completamente ristrutturato con materiali e finiture di pregio, ad un piano intermedio e luminoso. L\'immobile e\' cosi composto: ingresso in soggiorno living,da questo ambiente attraverso un porta in vetro di design scorrevole a scomparsa accediamo alla cucina abitabile esposta su un terrazzino con cucinino e tenda da sole.Dal soggiorno si raggiunge un corridoio che disimpegna a sinistra la camera da letto padronale con bagno in camera ,completamente arredato, fornito di doccia e termo arredo ed ampia cabina armadio arredata.Il corridoio conduce agli atri due vani letto ed al bagno principale,anche questo completamente arredato, con vasca e vano lavanderia ed alla cucina.Tutti questi ambienti affacciano su un ampia balconata con tende da sole e armadio/ripostiglio.La soluzione abitativa dispone di antenna satellitare collegata in tutte le camere,di impianto di antifurto,gli infissi esterni sono in legno/alluminio,le porte di design,le serrande sono comandate elettricamente, l\'impianto di climatizzazione e\' canalizzato con impianto Daikin e tutti gli impianti sono a norma.',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Via Montevergine',
                        'zip_code' => '80125',
                        'city' => 'Napoli',
                        'lat' => '40.8462',
                        'lng' => '14.202'
                      ],
                      [
                        'title' => 'Bilocale in Affitto in Via Chiaia 138 a Napoli',
                        'number_of_rooms' => '2',
                        'number_of_beds' => '1',
                        'number_of_bathrooms' => '1',
                        'mq' => '45',
                        'price' => '35',
                        'type' => 'appartamento',
                        'description' => 'Napoli - Chiaia: nella "galleria del verde" di Via Chiaia proponiamo in locazione un grazioso mini appartamento di 45 mq posto al 3° piano di un elegante palazzo d\'epoca con ascensore e servizio di portineria. L\'appartamento, ristrutturato, arredato ed accessoriato, è composto da: ingresso in soggiorno living, cucinotto, bagno e zona notte in soppalco. Possibilità di posto auto e moto.',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Via Chiaia',
                        'zip_code' => '80132',
                        'city' => 'Napoli',
                        'lat' => '40.836',
                        'lng' => '14.2452'
                      ],
                      [
                        'title' => 'Villa in Affitto in Via Lago Patria a Giugliano in Campania',
                        'number_of_rooms' => '8',
                        'number_of_beds' => '7',
                        'number_of_bathrooms' => '3',
                        'mq' => '240',
                        'price' => '140',
                        'type' => 'villetta',
                        'description' => 'La villa si estende su 4 livelli di 60 mq ciascuno ed ha uno spazio esterno pavimentato di circa 300 mq. Al primo livello troviamo salone, cucina e bagno; al secondo livello 3 camere da letto e un bagno. All’ultimo livello abbiamo una mansarda suddivisa in due ambienti, di cui uno provvisto di bagno; l’immobile è inoltre provvisto di garage al piano seminterrato, capienza 3 posti auto.
                        La casa è parzialmente arredata: cucina nuova e condizionatori nuovi.',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Via Lago Patria',
                        'zip_code' => '80147',
                        'city' => 'Napoli',
                        'lat' => '40.8506',
                        'lng' => '14.3345'
                      ],
                      [
                        'title' => 'Quadrilocale in Affitto in Via Carlo Poerio a San Giuseppe Vesuviano',
                        'number_of_rooms' => '4',
                        'number_of_beds' => '3',
                        'number_of_bathrooms' => '2',
                        'mq' => '130',
                        'price' => '77',
                        'type' => 'villetta',
                        'description' => 'San Giuseppe vesuviano Via Carlo Poerio, in palazzo signorile poco distante dal centro, proponiamo l\'affitto di un appartamento nuovo posto al terzo piano servito da ascensore. L\'immobile è composto da : salone e cucina living, tre camere da letto, due bagni, ripostiglio e box auto. Rifiniture di prestigio, predisposizione aria condizionata e allarme. ',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Via Carlo Poerio',
                        'zip_code' => '80121',
                        'city' => 'Napoli',
                        'lat' => '40.8339',
                        'lng' => '14.239'
                      ],
                      [
                        'title' => 'Quadrilocale in Affitto in Salita del Casale a Napoli',
                        'number_of_rooms' => '4',
                        'number_of_beds' => '4',
                        'number_of_bathrooms' => '2',
                        'mq' => '120',
                        'price' => '70',
                        'type' => 'appartamento',
                        'description' => 'Si affitta splendido appartamento a Posilippo in Salita del Casale.
                        L\'appartamento su tre livelli di circa 110 mq è composto da taverna con soggiorno cucina living, bagno con doccia e ripostiglio, primo livello :ingresso, soggiorno, cameretta e bagno con doccia, secondo livello : camera da letto con bagno con vasca idromassaggio. L\'appartamento non è arredato, ha riscaldamento autonomo. Parquet in tutta la casa, rifinita, infissi nuovi, inferriate, aria condizionata.
                        Il posto auto è compreso nel prezzo !
                        L\'appartamento è corredato da uno splendido giardino di circa 100 mq ad uso esclusivo. ',
                        'images' => [
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                          'media/appartamenti/foto'.rand(1, 168).'.jpg',
                        ],
                        'street_name' => 'Salita del Casale',
                        'zip_code' => '80123',
                        'city' => 'Napoli',
                        'lat' => '40.8033',
                        'lng' => '14.1891'
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
            'Buongiorno, è disponibile posto auto?',
            'Salve, sto prenotando per il 14 di febbraio e ho visto che il check-in è dalle 14.00, siccome saremo in viaggio dal mattino presto è possibile ottenere le chiavi prima di mezzogiorno?',
            'Buongiorno, la contatto perché ho visto che l appartamento non dispone del wi fi, volevo sapere se vi è un internet point nelle vicinanze.',
            'Buonasera, sono interessato al prenotare il suo appartamento e vorrei portare con me il mio cagnolino, è possibile?',
            'Buongiorno, mi sa dire se in paese c\'è un noleggio di biciclette?',
            'Buongiorno, il bagno è accessibile per disabili?',
            'Salve, ho notato che il suo appartamento si trova in una posizione particolare, viste le condizioni meteorologiche attuali, è disponibile un posto auto coperto?',
            'Salve, il nostro arrivo é previsto per lunedì, siccome viaggio insieme alla mia fidanzata in occasione del nostro anniversario, le posso chiedere di far trovare una bottiglia di spumante al nostro arrivo?',
            'Buongiorno, mi chiedevo se l appartamento fosse provvisto di forno microonde!',
            'Buonasera, è previsto il servizio di biancheria?',
          ];

          $flats = Flat::all();
          $number_of_flats = count($flats);

          // defining the number of messages to generate
          // will be generate 3 messages for every 1 flat (1 / 3 = 0.33)
          // these messages will be assigned randomly
          $number_of_messages = intval($number_of_flats / 0.33);

          for ($i=0; $i < $number_of_messages; $i++) {
            $random_flat_id = Flat::inRandomOrder()->first()->id;

            $new_message = New Message;

            $message = $messages[rand(0, count($messages) - 1)];

            $new_message->flat_id = $random_flat_id;
            $new_message->name = $faker->firstName().' '.$faker->lastName();
            $new_message->email = $faker->freeEmail();
            $new_message->message = $message;
            $new_message->date_of_send = $faker->dateTimeBetween('-7 days', 'now');
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
              $new_view->date = $faker->dateTimeBetween('-8 days', 'now');

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
            $new_payment->date_of_payment = (rand(0, 1)) ? $faker->dateTimeBetween('-10 days', 'now') : $faker->dateTimeBetween('-1 days', 'now');

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
