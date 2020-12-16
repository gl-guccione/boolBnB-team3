## visualizza il progetto live su https://bool-bnb-xqb4n.ondigitalocean.app/

#               BoolBnb

## Cosa è Boolbnb

>Boolbnb è un’applicazione web sviluppata dal Team3 della Classe 17 di Boolean Careers.
Permette ad un utente di cercare e visualizzare annunci di appartamenti in base ad alcuni filtri (indirizzo, distanza, servizi ecc) e di contattare il proprietario di ogni appartamento. Permette anche la registrazione e dunque il login.
Ciascun utente registrato ha la possibilità di creare un annuncio per un suo appartamento, tale annuncio sarà modificabile, eliminabile, sponsorizzabile e permetterà la ricezione di messaggi da altri utenti.


## Intestazione e piè di pagina

>In tutte le pagine (tranne la dashboard personale) l'intestazione e il piè di pagina sono sempre uguali. L'intestazione è differente tra utente registrato e utente non registrato poiché nel primo caso viene visualizzato il nome dell'utente, un menù con 'Crea appartamento' e 'Il mio profilo' e scompaiono i tasti di registrazione e login. Viene fatto un altro controllo se l'utente ha pubblicato almenon un appartamento ed al menù vengono aggiunte le opzioni: 'I miei app ppartamenti', 'Le mia statistiche' e 'Le mie sponsorizzazioni'.

## Home Page

>La pagina iniziale invita subito l'utente a cercare una meta presso cui alloggiare, suggerendogli alcuni luoghi famosi grazie allo slider di monumenti. Per effettuare una ricerca basta scrivere il nome della città, il numero di ospiti e le date di check-in e check-out nel campo di testo e premere invio o il pulsante dedicato. Nella seconda metà della pagina sono mostrati gli appartamenti sponsorizzati attualmente attivi.


## Pagina di dettaglio

> La pagina di dettaglio dell’appartamento ne mostra tutte le caratteristiche. In alto troviamo il titolo e l’indirizzo, subito sotto troviamo una grande card con il resto delle info: l’immagine ingrandita in modo da permettere all’utente di avere una visione più chiara dell’appartamento, la descrizione, il dettaglio del numero di stanze, posti letto e bagni, la metratura e l’elenco dei servizi forniti. In basso troviamo la mappa che con un marker indica l'ubicazione esatta dell’appartamento.
Inoltre questa pagina è diversa in base all'utente che la visualizza:

>    - L'utente non registrato può inviare un messaggio al proprietario dell'appartamento inserendo una mail e la sua domanda nel form dedicato
>    - L'utente registrato, può inviare un messaggio al proprietario dell'appartamento. Il campo mail sarà pre-compilato con la mail di registrazione

## Pagina lista appartamenti (solo utenti registrati con almeno un appartamento)

> In questa pagina gli utenti che hanno pubblicato almeno un appartamento possono velocemente visualizzare le informazioni principali e vedranno i bottoni per modificarlo, cancellarlo, vederne le statistiche, inoltre:

>    - Se l'appartamento non è sponsorizzato potrà sponsorizarlo.
>    - Se l'appartamento è sponsorizzato potrà estenderne la sponsorizzazione.
>    - L'utente può scegliere se disattivare la visibilità dell'appartamento o riattivarla.


## Registrazione e login

>In qualsiasi pagina del sito è possibile fare la registrazione o login, cliccando nella sezione dedicata dell’intestazione di pagina.
Cliccando su "Registrati" l'utente viene reindirizzato in una pagina con un form di registrazione.
Il form di registrazione controlla che i dati obbligatori vengano inseriti e che siano coerenti con la tipologia di dato richiesta (esempio la mail deve contenere la @ e il punto). Nel caso in cui i dati inseriti non soddisfino determinati controlli (come l'età minima 18 anni) verrà restituito un messaggio con uno o più suggerimenti. Se la registrazione va a buon fine, e al login, l'utente viene subito reindirizzato nella Home Page.

## Pagina di ricerca

>Nella pagina di ricerca l'utente trova in alto la SearchBox con il campo ricerca già compilato con la query inserita nella Home Page, un tasto “cerca” nel caso in cui volesse farne un'altra e il tasto “più filtri” per raffinarla.
Quest’ultimo tasto, se premuto, fa apparire un prolungamento della SearchBox che permette di inserire parametri di ricerca più restrittivi: Wi-Fi, Tv, Riscaldamento, Aria condizionata, Bagno privato, Posto Auto, Piscina, Portineria, Sauna e Vista Mare. Un secondo click sul tasto “più filtri” nasconde il prolungamento.
Sotto la SearchBox si estende la lista dei risultati filtrati in base ai parametri di ricerca: per primi verranno mostrati gli appartamenti sponsorizzati poi in ordine di distanza (dal più vicino al lontano) gli altri appartamenti.
In formato Card, ogni risultato fornisce informazioni sull’appartamento: il Titolo, la Descrizione (con un numero limitato di caratteri), i Servizi disponibili, e la distanza dall'indirizzo inserito in ricerca (in km).

## Sponsorizzazione

>E’ possibile sponsorizzare il proprio annuncio cliccando sull'apposita icona nella pagina lista appartamenti. La pagina dello sponsor permette la scelta di tre tariffe:

>    - 2.99€
>    - 24 Ore

>    - 5.99€
>    - 72 Ore

>    - 9.99€
>    - 144 Ore


>Scelto uno sponsor si attiva il pulsante per il pagamento e una volta cliccato è possibile inserire i dati della carta di credito per procedere all’acquisto. L’esito del pagamento viene comunicato in alto alla pagina. Una volta attivata la sponsorizzazione per un appartamento si può in ogni momento cambiarne le caratteristiche o anche prolungarla.

## Statistiche

> Per ogni appartamento il proprietario può visualizzare le statistiche degli ultimi 7 giorni di visualizzazioni.

## Creare Annuncio

Cliccando sul tasto "Crea annuncio" nella Home Page si viene reindirizzati in una pagina con un form in cui ogni campo è obbligatorio. I dati inseriti sono controllati sia lato front-end che back-end. Il proprietario può decidere se rendere subito attivo l’annuncio (dunque visibile alla ricerca) del proprio appartamento o riattivarlo successivamente. Se la creazione avviene con successo si è reindirizzati alla pagina di dettaglio dell'appartamento appena inserito.

## Modificare un Annuncio

>E’ possibile modificare un proprio annuncio cliccando sull'apposita icona nella pagina lista appartamenti. Anche in questa pagina i dati inseriti sono controllati sia lato front-end che back-end. Il proprietario può cambiare qualunque informazione desideri. Se la modifica avviene con successo si è reindirizzati alla pagina di dettaglio dell'appartamento modificato.

## Aspetto e Responsiveness

>L'aspetto del sito è pensato per rimanere costante e coerente in ogni sua pagina così da offrire un'esperienza utente fluida, intuitiva e familiare.
La gerarchia degli elementi mostrati è assicurata grazie a un effetto profondità che accomuna gli elementi con la stessa importanza. L'interazione dell'utente su un elemento della pagina ne aumenta l'importanza e dunque l'impatto visivo.
L'intera applicazione è totalmente responsive: supporta tutte le risoluzioni di tutti i più comuni devices.



---

## :key: Istruzioni:

> ## 1. Clonare la repo

* `git clone https://github.com/gl-guccione/boolBnB-team3.git`

> ## 2. Compilare le seguenti key nel file .env:

* `cp '.env.example' .env`

> Database Setup (Progetto realizzato in MySql)

1. `DB_CONNECTION`
2. `DB_HOST`
3. `DB_DATABASE`
2. `DB_USERNAME`
3. `DB_PASSWORD`

> Braintree (pagamenti)

1. `BT_ENVIRONMENT`
2. `BT_MERCHANT_ID`
3. `BT_PUBLIC_KEY`
4. `BT_PRIVATE_KEY`

* `composer dump-autoload`

> ## 3. Eseguire i seguenti comandi

* `composer install`

* `php artisan key:generate`

* `php artisan migrate`

* `php artisan db:seed --class=PresentationSeeder`

* `npm install`

* `php artisan storage:link`
    * estrai il file media.zip in public/storage

* `npm run dev`

* `php artisan serve`


### :computer: Linguaggi e Tecnologie utilizzate:


* HTML


* CSS


* SASS


* Bootstrap


* JS


* jQuery


* Chart Js


* Leaflet Js


* Algolia (Places/Scout/Autocomplete)


* Braintree


* Ajax


* Handlebars


* MySql


* PHP


* Laravel


* Carbon
