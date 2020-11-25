<?php

// defining Namespace
namespace App;

// using Laravel Facades
use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
     /**
     * The attributes that remove the timestamp from the table.
     *
     * @var boolean
     */
    public $timestamps = false;

     /**
     * Create the relation between Sponsorship and Payment.
     * Sponsorship -> Payment
     *      1      ->    1
     *
     * @return App\Payment
     */
    public function payment()
    {
        return $this->belongsTo('App\Payment');
    }

     /**
     * Create the relation between Sponsorship and Sponsorship_price.
     * Sponsorship -> Sponsorship_price
     *      *      ->        1
     *
     * @return App\SponsorshipPrice
     */
    public function sponsorship_price()
    {
        return $this->belongsTo('App\SponsorshipPrice');
    }

     /**
     * Create the relation between Sponsorship and Flat.
     * Sponsorship -> Flat
     *      *      ->  1
     *
     * @return App\Flat
     */
    public function flat()
    {
        return $this->belongsTo('App\Flat');
    }
}
