<?php

// defining Namespace
namespace App\Http\Controllers\Guest;

// using Laravel Facades
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// using Models
use App\Message;


class MessageController extends Controller
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
                'flat_id' => 'required|integer|exists:flats,id',
                'name' => 'required|string|between:1,50',
                'email' => 'required|string|email|between:1,255',
                'message' => 'required|max:10000',
            ]
        );

        $newMessage = new Message;

        $newMessage->flat_id = $data['flat_id'];
        $newMessage->name = $data['name'];
        $newMessage->email = $data['email'];
        $newMessage->message = $data['message'];
        $newMessage->date_of_send = date('Y-m-d H:i:s');

        $newMessage->save();

        return redirect()->back()->with('record_added', 'Messaggio inviato correttamente!');
    }
}
