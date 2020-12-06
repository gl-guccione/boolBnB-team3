<?php

// defining Namespace
namespace App\Http\Controllers\Admin;

// using Laravel Facades
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// using Carbon
use Carbon\Carbon;

// using Models
use App\View;
use App\Flat;

class ViewController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total_views = View::whereHas('flat', function ($query) {
          $query->where('user_id', Auth::id());
        })->count();

        // days
        $today = Carbon::today();
        $oneDayBefore = Carbon::today()->subDays(1);
        $twoDaysBefore = Carbon::today()->subDays(2);
        $threeDaysBefore = Carbon::today()->subDays(3);
        $fourDaysBefore = Carbon::today()->subDays(4);
        $fiveDaysBefore = Carbon::today()->subDays(5);
        $sixDaysBefore = Carbon::today()->subDays(6);

        // days names
        $days_names = [
          0 => $today->locale('it')->dayName,
          1 => $oneDayBefore->locale('it')->dayName,
          2 => $twoDaysBefore->locale('it')->dayName,
          3 => $threeDaysBefore->locale('it')->dayName,
          4 => $fourDaysBefore->locale('it')->dayName,
          5 => $fiveDaysBefore->locale('it')->dayName,
          6 => $sixDaysBefore->locale('it')->dayName,
        ];

        $today_views = View::where('date', '>', $today)->whereHas('flat', function ($query) {
          $query->where('user_id', Auth::id());
        })->count();

        $one_day_before_views = View::where([
                                              ['date', '>', $oneDayBefore],
                                              ['date', '<', $today]
                                            ])->whereHas('flat', function ($query) {
          $query->where('user_id', Auth::id());
        })->count();

        $two_days_before_views = View::where([
                                              ['date', '>', $twoDaysBefore],
                                              ['date', '<', $oneDayBefore]
                                            ])->whereHas('flat', function ($query) {
          $query->where('user_id', Auth::id());
        })->count();

        $three_days_before_views = View::where([
                                              ['date', '>', $threeDaysBefore],
                                              ['date', '<', $twoDaysBefore]
                                            ])->whereHas('flat', function ($query) {
          $query->where('user_id', Auth::id());
        })->count();

        $four_days_before_views = View::where([
                                              ['date', '>', $fourDaysBefore],
                                              ['date', '<', $threeDaysBefore]
                                            ])->whereHas('flat', function ($query) {
          $query->where('user_id', Auth::id());
        })->count();

        $five_days_before_views = View::where([
                                              ['date', '>', $fiveDaysBefore],
                                              ['date', '<', $fourDaysBefore]
                                            ])->whereHas('flat', function ($query) {
          $query->where('user_id', Auth::id());
        })->count();

        $six_days_before_views = View::where([
                                              ['date', '>', $sixDaysBefore],
                                              ['date', '<', $fiveDaysBefore]
                                            ])->whereHas('flat', function ($query) {
          $query->where('user_id', Auth::id());
        })->count();

        $user_flats = Flat::where('user_id', Auth::id())->get();

        // data to return with the view
        $data = [
          'total_views' => $total_views,
          'today_views' => $today_views,
          'one_day_before_views' => $one_day_before_views,
          'two_days_before_views' => $two_days_before_views,
          'three_days_before_views' => $three_days_before_views,
          'four_days_before_views' => $four_days_before_views,
          'five_days_before_views' => $five_days_before_views,
          'six_days_before_views' => $six_days_before_views,
          'last_seven_days_views' => $today_views + $one_day_before_views + $two_days_before_views + $three_days_before_views + $four_days_before_views + $five_days_before_views + $six_days_before_views,
          'days_names' => $days_names,
          'user:flats' => $user_flats
        ];

        return view('admin.statistics.index', $data);
    }
}
