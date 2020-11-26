<?php

// defining Namespace
namespace App\Http\Controllers\Guest;

// using Laravel Facades
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// using Models
use App\Message;


class RequestController extends Controller
{

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
                'name' => 'required|max:50',
                'email' => 'required|max:255',
                'message' => 'required|max:10000',
                'flat_id' => 'numeric',
            ]
        );

        $newMessage = new Message;

        $newMessage->flat_id = $data['flat_id'];
        $newMessage->name = $data['name'];
        $newMessage->email = $data['email'];
        $newMessage->message = $data['message'];
        $newMessage->date_of_send = date('Y-m-d H:i:s');
        $newMessage->seen = false;

        $newMessage->save();

        return redirect()->route('ui.flats.show', $newMessage->flat_id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $messages = Message::where('id', $id)->first();

        return view('ui.messages.show', compact('messages'));
    }


}
