<?php

// defining Namespace
namespace App\Http\Controllers\Admin;

// using Laravel Facades
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// using Models
use App\Message;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
        $messages = Message::where('user_id', $user_id)->get();

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
        $messages = Message::where('id', $id)->where('user_id', $user_id)->first();

        //non so se posso fare un update dentro la show

        $messages->seen = true;

        $messages->update();

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
        Message::where('id', $id)->where('user_id', $user_id)->first()->delete();

        return view('admin.messages.index');
    }
}
