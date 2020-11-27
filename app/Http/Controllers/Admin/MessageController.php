<?php

// defining Namespace
namespace App\Http\Controllers\Admin;

// using Laravel Facades
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// using Models
use App\Message;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // TODO select only message for the correct user (message->flats->user)
        // $user_id = Auth::id();
        // $messages = Message::where('user_id', $user_id)->get();

        $messages = Message::inRandomOrder()->limit(10)->get();

        return view('admin.messages.index', compact('messages'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_id = Auth::id();
        $message = Message::find($id)->where('user_id', $user_id)->first();

        // TODO update the 'seen' value when the user see the message
        // could be wrong
        if ($message->seen == false) {
          $message->seen = true;
          $message->update();
        }

        // TODO we should use API for this method
        return view('admin.messages.show', compact('messages'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user_id = Auth::id();
        Message::find($id)->where('user_id', $user_id)->first()->delete();

        return view('admin.messages.index');
    }
}
