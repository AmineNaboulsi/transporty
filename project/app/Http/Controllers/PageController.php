<?php

namespace App\Http\Controllers;

use App\Models\citys;
use App\Models\navettes;
use App\Models\reservations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\table;

class PageController extends Controller
{

        /**
     *
     */
    public function editprofile() {
        return view('profile.editprofile');
    }
        /**
     *
     */
    public function notification() {
        return view('profile.notification');
    }
        /**
     *
     */
    public function payment() {
        return view('profile.payment');
    }
        /**
     *
     */
    public function favorite() {
        return view('profile.favorite');
    }
    /**
     *
     */

    public function posts()
    {
        $query = navettes::query();

        $departure = request()?->departure;
        $destination = request()?->destination;
        $date = request()?->date;

        if (!empty($departure)) {
            $query->where(function($q) use ($departure) {
                $q->where('city_arrive', '=', $departure)
                  ->orWhere('city_start', 'LIKE', "%{$departure}%");
            });
        }

        if (!empty($destination)) {
            $query->where(function($q) use ($destination) {
                $q->where('city_start', '=', $destination)
                  ->orWhere('city_arrive', 'LIKE', "%{$destination}%");
            });
        }

        if (!empty($date)) {
            $query->whereDate('date_navette', $date);
        }

        $navettes = $query->get();
        // if(count($navettes)==0){
        //     $navettes = $query->paginate(10);
        // }

        return view('navettes.index', compact('navettes', 'departure', 'destination', 'date'));
    }

        /**
     *
     */
    public function register() {
        return view('auth.register');
    }

    /**
     *
     */
    public function login() {
        return view('auth.login');
    }
     /**
     *
     */
    public function logout() {
        Auth::logout();
        return view('auth.login');
    }
        /**
     *
     */
    public function home() {
        $navettes = navettes::with(['cityStart' ,'cityArrive'])->take(3)->get();
        $cities = citys::all();
        return view('home' , compact("navettes","cities"));
    }
      /**
     *
     */
    public function forgetpassword() {
        echo "forgetpassword";
        // return view('forgetpassword');
    }
      /**
     *
     */
    public function dashboard() {
        return view('dashborad.index');
    }

       /**
     *
     */
    public function password() {
        return view('profile.password');
    }
      /**
     *
     */
    public function profile() {
        // $upcomingReservations  = reservations::all();
        $upcomingReservations  = DB::table('reservations')
            ->join('navettes', 'reservations.navette_id', '=', 'navettes.id')
            ->join('campanys', 'campanys.id', '=', 'navettes.campany_id')
            ->join('users', 'users.id', '=', 'campanys.user_id')
            ->join('citys as cs', 'cs.id', '=', 'navettes.city_start')
            ->join('citys as ce', 'ce.id', '=', 'navettes.city_arrive')
            ->select(
                'reservations.*',
                'navettes.*',
                'cs.name as start_city',
                'ce.name as end_city',
                'ce.region as start_city_region'
            )
            ->where('users.id' , '=' , Auth::user()->id)
            ->paginate(5);
        // return response()->json($upcomingReservations);
        return view('profile.index',compact("upcomingReservations"));
    }


}
