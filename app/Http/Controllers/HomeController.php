<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Checkin;
use Carbon\Carbon;
use DB;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $now;

    public function __construct() {
        $this->now = \Carbon\Carbon::now();
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //Get Today Entry to show hide checkin/checkout button
        $current_user_id = \Auth::user()->id;
        $checkin = DB::table('checkins')
                ->whereDate('created_at', $this->now->toDateString())->where('user_id', $current_user_id)
                ->get();
        
        //Prepare Data Array
        $data = array();
        $data['greeting'] = $this->get_greetings();
        $data['today'] = "Today is: " . $this->now->formatLocalized('%A %d %B %Y');
        $data['checkin'] = (count($checkin) == 0 ? true : false);
        $data['checkout'] = (count($checkin) > 0 ? true : false);
        return view('home', ["data" => $data]);
    }

    function get_greetings() {
        $current_hour = date("G");
        if ($current_hour > 0 && $current_hour < 24) {
            if ($current_hour >= 3 && $current_hour < 12) {
                $greetings = "Good Morning ".Auth::user()->name;
            } else if ($current_hour >= 12 && $current_hour < 17) {
                $greetings = "Good afternoon ".Auth::user()->name;
            } else {
                $greetings = "Good evening ".Auth::user()->name;
            }
        }
        return $greetings;
    }

    function checkin(Request $request) {
        $current_user_id = \Auth::user()->id;
        Checkin::create([
            'user_id' => $current_user_id,
            'checkin_latitude' => $request->lat,
            'checkin_longitude' => $request->long,
            'checkin' => $this->now->toDateTimeString(),
        ]);
        $response = array('status' => 'success');
        return \Response::json($response);
    }
    
    function checkout(Request $request) {
        $current_user_id = \Auth::user()->id;
        DB::table('checkins')
            ->whereDate('created_at', $this->now->toDateString())->where('user_id', $current_user_id)
            ->update(['checkout' => $this->now->toDateTimeString(),'checkout_latitude'=>$request->lat,'checkout_longitude'=>$request->long]);
//        /Checkin::where(['created_at','=', $this->now->toDateString()],['user_id','=', $current_user_id])->update(['checkout' => $this->now->toDateTimeString()]);
        $response = array('status' => 'success');
        return \Response::json($response);
    }

}
