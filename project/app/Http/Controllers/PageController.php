<?php

namespace App\Http\Controllers;

use App\Models\citys;
use App\Models\navettes;
use App\Models\permission;
use App\Models\reservations;
use App\Models\roles;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

use function Laravel\Prompts\table;

class PageController extends Controller
{

    /**
     *
     */
    public function users() {
        $users = User::query()->with('role')->paginate(10);
        $roles = roles::all();
        return view('dashboard.users.index',compact("users","roles"));
    }

     /**
     *
     */
    public function tags() {
        $tags = Tag::withCount('navettes')->paginate(10);
        $tagsCount = Tag::count();
        return view('dashboard.tags.index',compact("tags","tagsCount"));
    }
    /**
     *
     */
    public function navettes() {
        $navettes = navettes::query()->with(["cityArrive","cityStart"])->paginate(10);
        return view('dashboard.navettes.index',compact("navettes"));
    }
    /**
     *
     */
    public function booking() {
        $reservations = reservations::with(['navette', 'user'])
            ->paginate(7);
        return view('dashboard.booking.index', compact('reservations'));
    }
    /**
     *
     */
    public function book($id) {
        $navette = navettes::findOrFail($id);
        return view('navettes.book', compact('navette'));
    }
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
    public function roles()  {
        $roles = roles::with('permissions')->paginate(10);
        return view('dashboard.roles.roles' , compact("roles"));
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
        return redirect()->route('login');
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
        $statistics = [
            "totalNavettes" => 100,
            "totalBookings" => 100,
            "totalRevenue" => 1000,
            "totalPassengers" => 100,
            "totalCompanies" => 100,
        ];

        $recentBookings = [
            [
                "id" => "vdqvq",
                "name" => "vdqvq",
                "email" => "vdqvq",
                "cityStart" => ["name"=> "vds"],
                "num_passengers" => 85956,
                "total_price" => 245,
                "status" => "Confirmed",
            ],
            [
                "id" => "vd sqqcsq csqvq",
                "name" => "v qsd sq s sqvq",
                "email" => " sq qs   sqvq",
                "cityStart" => ["name"=> "v sq qsqds"],
                "num_passengers" => 42,
                "total_price" => 35435,
                "status" => "Confirmed",
            ],
        ];
        return view('dashboard.index',compact("recentBookings","statistics"));
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
        $upcomingReservations  = DB::table('reservations')
            ->join('navettes', 'reservations.navette_id', '=', 'navettes.id')
            ->join('campanys', 'campanys.id', '=', 'navettes.campany_id')
            ->join('users', 'users.id', '=', 'campanys.user_id')
            ->join('citys as cs', 'cs.id', '=', 'navettes.city_start')
            ->join('citys as ce', 'ce.id', '=', 'navettes.city_arrive')
            ->select(
                'reservations.*',
                'navettes.campany_id',
                'navettes.nom',
                'navettes.price',
                'navettes.date_navette',
                'navettes.description',
                'navettes.type_vehicule',
                'navettes.places_disponible',
                'cs.name as start_city',
                'ce.name as end_city',
                'ce.region as start_city_region'
            )
            ->where('reservations.user_id' , '=' , Auth::user()->id)
            ->paginate(5);
        return view('profile.index',compact("upcomingReservations"));
    }


}
