<?php

// defining Namespace
namespace App\Http\Controllers\Guest;

// using Laravel Facades
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// using Carbon
use Carbon\Carbon;

// using Models
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

        // ONPROD send only the sponsored flats
        $datetime_now = Carbon::now();
        $sponsorhip_flats = Flat::whereHas('sponsorships', function ($query) use ($datetime_now) {
          $query->where('date_of_end', '>', $datetime_now);
        })->get();

        return view('guest.home', compact('flats'));
    }

     /**
     * Display the search page.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        $algolia = isset($_GET['algolia']) ? $_GET['algolia'] : "";
        $adults = isset($_GET['adults']) ? $_GET['adults'] : "";
        $children = isset($_GET['children']) ? $_GET['children'] : "";
        $check_in = isset($_GET['check_in']) ? $_GET['check_in'] : "";
        $check_out = isset($_GET['check_out']) ? $_GET['check_out'] : "";
        $options = Option::all();

        $data = [
          'algolia' => $algolia,
          'adults' => $adults,
          'children' => $children,
          'check_in' => $check_in,
          'check_out' => $check_out,
          'options' => $options
        ];
        return view('guest.search', $data);
    }
}
