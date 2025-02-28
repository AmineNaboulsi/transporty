<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorereservationsRequest;
use App\Http\Requests\UpdatereservationsRequest;
use App\Models\reservations;
use Illuminate\Support\Facades\Auth;

class ReservationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReservationsRequest $request)
    {
        try {
            $isreserved = Reservations::query()
                ->where('navette_id', $request->id)
                ->where('user_id', Auth::user()->id)
                ->first();
            if(!$isreserved){
                $Reservations = new Reservations();
                $Reservations->navette_id = $request->id ;
                $Reservations->user_id =  Auth::user()->id ;
                $Reservations->status = 'pending';
                $Reservations->save();
                // echo 'Réservation ajoutée avec succès';
                return redirect()
                    ->back()
                    ->with('success', 'Réservation ajoutée avec succès');
            }else{
                return redirect()
                ->back()
                ->with('error', 'Navette already reserved ');
            }
        } catch (\Exception $e) {
            // echo 'Erreur lors de la création de la réservation ' .$e->getMessage();
            return redirect()
                ->back()
                ->with('error', 'Erreur lors de la création de la réservation');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(reservations $reservations)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(reservations $reservations)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatereservationsRequest $request, reservations $reservations)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(reservations $reservations)
    {
        //
    }
}
