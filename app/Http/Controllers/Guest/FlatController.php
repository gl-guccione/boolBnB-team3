<?php

// defining Namespace
namespace App\Http\Controllers\Guest;

// using Laravel Facades
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// unsing Models
use App\Flat;

class FlatController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $flat = Flat::where('slug', $slug)->first();

        return view('guest.flats.show', compact('flat'));
    }
}
