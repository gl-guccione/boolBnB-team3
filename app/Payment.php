<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
     /**
     * The attributes that remove the timestamp from the table.
     *
     * @var boolean
     */
    public $timestamps = false;

     /**
     * Create the relation between Payment and Sponsorship.
     * Payment -> Sponsorship
     *    1    ->     1
     *
     * @return App\Sponsorship
     */
    public function sponsorship()
    {
        return $this->hasOne('App\Sponsorship');
    }
}
