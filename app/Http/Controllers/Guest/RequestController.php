<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Request as FlatRequest;

use App\Flat;

class RequestController extends Controller
{
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
                'name' => 'required',
                'email' => 'required',
                'message' => 'required',
            ]
        );

        $newRequest = new Request;

        //non so se vada bene cosi
        $newRequest->flat_id = Flat::id();

        $newRequest->name = $data['name'];
        $newRequest->email = $data['email'];
        $newRequest->message = $data['message'];
        $newRequest->date_of_send = date('Y-m-d H:i:s');
        $newRequest->seen = false; 

        $newRequest->save();

        return redirect()->route('ui.flats.show', $newRequest->flat_id);

    }

    //questa mi sa che non esiste come view
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $request = FlatRequest::where('id', $id)->get()->first();

        return view('ui.request.show', compact('request'));
    }


}
