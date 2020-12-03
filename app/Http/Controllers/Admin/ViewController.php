<?php

// defining Namespace
namespace App\Http\Controllers\Admin;

// using Laravel Facades
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// using Models
use App\View;

class ViewController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $views = View::whereHas('flat', function ($query) {
          $query->where('user_id', Auth::id());
        })->get();

        return view('admin.statistics.index', compact('views'));
    }
}
