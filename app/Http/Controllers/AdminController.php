<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    public function index(){
        Reservation::where('date','<',Carbon::now())->delete();
        return view('admin.index');
    }
}
        // $now = new DateTime();
        // dd($now);
        // $mytime = Carbon::now();
        //  dd($mytime->toDateTimeString());
