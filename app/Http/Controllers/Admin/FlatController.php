<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Flat;
use App\Option;

class FlatController extends Controller
{

    // //transform a text into slug
    // public function slugify($text)
    // {
    // // replace non letter or digits by -
    // $text = preg_replace('~[^\pL\d]+~u', '-', $text);

    // // transliterate
    // $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // // remove unwanted characters
    // $text = preg_replace('~[^-\w]+~', '', $text);

    // // trim
    // $text = trim($text, '-');

    // // remove duplicate -
    // $text = preg_replace('~-+~', '-', $text);

    // // lowercase
    // $text = strtolower($text);

    // if (empty($text)) {
    //     return 'n-a';
    // }

    // return $text;
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
        $flats = Flat::where('user_id', $user_id)->get();

        dd($flats);
        return view('admin.flats.index', compact($flats));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $options = Option::all();

        return view('admin.flats.create', compact($options));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $request->validate(
            [
                'title' => 'required|unique',
                'slug' => 'required|unique',
                'number_of_rooms' => 'required',
                'number_of_beds' => 'required',
                'number_of_bathrooms' => 'required',
                'mq' => 'required',
                //price ?
                'type' => 'required',
                'description' => 'required',
                //stars random
                //extra options 
                'street_name' => 'required',
                'zip_code' => 'required',
                'city' => 'required',
                //lat
                //lng
            ]
        );

        $newFlat = new Flat;

        $newFlat->user_id = Auth::id();
        $newFlat->title = $data['title'];
        // $newFlat->slug = controlla slugify inizio controller;
        $newFlat->active = $data['active'];
        $newFlat->number_of_rooms = $data['number_of_rooms'];
        $newFlat->number_of_beds = $data['number_of_beds'];
        $newFlat->number_of_bathrooms = $data['number_of_bathrooms'];
        $newFlat->mq = $data['mq'];
        $newFlat->price = $data['price'];
        $newFlat->type = $data['type'];
        $newFlat->description = $data['description'];
        $newFlat->stars = rand(1,10);
        // $newFlat->extra_options = non ricordo se erano da dividere o usciranno assieme;
        $newFlat->street_name = $data['street_name'];
        $newFlat->zip_code = $data['zip_code'];
        $newFlat->city = $data['city'];
        $newFlat->lat = $data['lat'];
        $newFlat->lng = $data['lng'];

        $newFlat->save();

        return redirect()->route('admin.flats,show', $newFlat->slug);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $flats = Flat::where('id', $id)->get()->first();

        return view('admin.flats.show', compact('flats'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        Flat::where('slug', $slug)->get()->first()->delete();

        return redirect()->route('admin.flats.index');
    }
}
