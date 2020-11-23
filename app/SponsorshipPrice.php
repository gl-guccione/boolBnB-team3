<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SponsorshipPrice extends Model
{
     /**
     * The attributes that remove the timestamp from the table.
     *
     * @var boolean
     */
    public $timestamps = false;

     /**
     * Create the relation between Sponsorship_price and Sponsorship.
     * Sponsorship_price -> Sponsorship
     *         1         ->     *
     *
     * @return App\Sponsorship (array)
     */
    public function sponsorships()
    {
        return $this->hasMany('App\Sponsorship');
    }
}
