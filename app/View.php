<?php

// defining Namespace
namespace App;

// using Laravel Facades
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
     /**
     * The attributes that remove the timestamp from the table.
     *
     * @var boolean
     */
    public $timestamps = false;

     /**
     * Create the relation between View and Flat.
     * View -> Flat
     *   *  ->  1
     *
     * @return App\Flat
     */
    public function flat()
    {
        return $this->belongsTo('App\Flat');
    }
}
