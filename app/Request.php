<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
     /**
     * The attributes that remove the timestamp from the table.
     *
     * @var boolean
     */
    public $timestamps = false;
}
