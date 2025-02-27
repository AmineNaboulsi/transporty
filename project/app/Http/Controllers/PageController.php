<?php

namespace App\Http\Controllers;

use App\Models\citys;
use App\Models\navettes;
use Illuminate\Http\Request;

class PageController extends Controller
{

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
            $query->where('city_arrive', 'like', "%$departure%");
        }

        if (!empty($destination)) {
            $query->where('city_start', 'like', "%$destination%");
        }

        if (!empty($date)) {
            $query->whereDate('date_navette', $date);
        }

        $navettes = $query->paginate(10);

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

}
