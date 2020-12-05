<?php

// defining Namespace
namespace App\Http\Controllers\Api;

// using Laravel Facades
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// using Models
use App\Message;
use App\View;

class ApiController extends Controller
{
     /**
     * Display fitered data.
     *
     * @param \Illuminate\Http\Request  $request
     * @return json $results[]
     */
    public function new_messages(Request $request)
    {
        if (isset($request->user_id)) {

          $user_id = $request->user_id;

          $count_messages = Message::where('seen', '0')->whereHas('flat', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
          })->count();

          $result = ($count_messages != 0) ? true : false;

          return response()->json($result);

        } else {

          return response()->json(['error'=>'missing user_id parameter']);

        }

    }
}
