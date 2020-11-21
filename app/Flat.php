<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flat extends Model
{
     /**
     * Create the relation between Flat and User.
     * Flat -> User
     *   *  ->  1
     *
     * @return App\User
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
