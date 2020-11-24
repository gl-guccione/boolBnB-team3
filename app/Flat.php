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

     /**
     * Create the relation between Flat and Request.
     * Flat -> Request
     *   1  ->  *
     *
     * @return App\Request (array)
     */
    public function requests()
    {
        return $this->hasMany('App\Request');
    }

     /**
     * Create the relation between Flat and View.
     * Flat -> View
     *   1  ->  *
     *
     * @return App\View (array)
     */
    public function views()
    {
        return $this->hasMany('App\View');
    }

     /**
     * Create the relation between Flat and Image.
     * Flat -> Image
     *   1  ->  *
     *
     * @return App\Image (array)
     */
    public function images()
    {
        return $this->hasMany('App\Image');
    }

     /**
     * Create the relation between Flat and Sponsorship.
     * Flat -> Sponsorship
     *   1  ->  *
     *
     * @return App\Sponsorship (array)
     */
    public function sponsorships()
    {
        return $this->hasMany('App\Sponsorship');
    }

     /**
     * Create the relation between Flat and Option.
     * Flat -> Option
     *   *  ->  *
     *
     * @return App\Option (array)
     */
    public function options()
    {
        return $this->belongsToMany('App\Option');
    }
}
