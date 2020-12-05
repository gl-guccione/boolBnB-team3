<?php

// defining Namespace
namespace App\Http\Controllers\Guest;

// using Laravel Facades
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// using Carbon
use Carbon\Carbon;

// unsing Models
use App\Flat;
use App\View;

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

        $session_id = session()->getId();

        $last_view = View::where([
                                  ['flat_id', $flat->id],
                                  ['session_id', $session_id],
                                ])->orderBy('date', 'DESC')->first();

        $new_view = new View;

        $new_view->flat_id = $flat->id;
        $new_view->session_id = $session_id;
        $new_view->date = Carbon::now();

        if ($last_view == null || Carbon::now()->gt(Carbon::create($last_view->date)->addMinutes(15))) {
          $new_view->save();
        }

        return view('guest.flats.show', compact('flat'));
    }
}
