<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Flat;
use App\Option;

class HomepageController extends Controller
{
     /**
     * Display the homepage.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flats = Flat::inRandomOrder()->limit(10)->get();

        return view('guest.home', compact('flats'));
    }

     /**
     * Display the search page.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        $options = Option::all();

        dd($options);

        return view('guest.search');
    }
}
