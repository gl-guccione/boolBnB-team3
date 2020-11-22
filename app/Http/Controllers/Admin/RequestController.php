<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Request as FlatRequest;

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
        $requests = FlatRequest::where('user_id', $user_id)->get()->first();

        return view('admin.requests.index', compact('requests'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $request = FlatRequest::where('id', $id)->get()->first();

        //non so se posso fare un update dentro la show

        $request->seen = true;

        $request->update();
        
        return view('admin.request.show', compact('request'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FlatRequest::where('id', $id)->get()->first()->delete();

        return view('admin.request.index');
    }
}
