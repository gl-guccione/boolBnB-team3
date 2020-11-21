<?php

namespace App;

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
