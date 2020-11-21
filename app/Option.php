<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
     /**
     * The attributes that remove the timestamp from the table.
     *
     * @var boolean
     */
    public $timestamps = false;

     /**
     * Create the relation between Option and Flat.
     * Option -> Flat
     *    *   ->  *
     *
     * @return App\Flat (array)
     */
    public function flats()
    {
        return $this->belongsToMany('App\Flat');
    }
}
