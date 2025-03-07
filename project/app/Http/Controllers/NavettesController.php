<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorenavettesRequest;
use App\Http\Requests\UpdatenavettesRequest;
use App\Models\citys;
use App\Models\navettes;
use App\Models\NavetteTags;
use App\Models\rolespermissions;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class NavettesController extends Controller
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
        $cities = citys::all();
        $tags = Tag::all();
        return view('dashboard.navettes.create',compact("cities","tags"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorenavettesRequest $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'date_navette' => 'required|date',
            'type_vehicule' => 'required|string',
            'places_disponible' => 'required|integer',
            'city_start' => 'required|exists:citys,id',
            'city_arrive' => 'required|exists:citys,id',
            'time_start' => 'required|date_format:H:i',
            'time_end' => 'required',
            'tags' => 'required|array',
            'tags.*' => 'exists:tags,id',
            'description' => 'required|string'
        ]);
        if(!Auth::user()->company){
            abort(403,"Your Company Account not valide");
            return;
        }
        $validatedData['campany_id'] = Auth::user()->company?->id;
        $navette = navettes::create($validatedData);
        $navette->tags()->attach($request->tags);

        return redirect()->route('navettes.index')->with('success', 'Navette created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(navettes $navettes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            // $navettes = navettes::findOrFail($id)->with('tags')->get();
            $navettes = navettes::findOrFail($id);
            $cities = citys::all();
            $tags = Tag::all();
            return view('dashboard.navettes.update', compact("cities", "tags","navettes"));
        } catch (\Exception $e) {
            echo $e->getMessage();
            // return view('dashboard.navettes.nan');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatenavettesRequest $request, navettes $navettes)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'date_navette' => 'required|date',
            'type_vehicule' => 'required|string',
            'places_disponible' => 'required|integer',
            'city_start' => 'required|exists:citys,id',
            'city_arrive' => 'required|exists:citys,id',
            'time_start' => 'required',
            'time_end' => 'required',
            'tags' => 'required|array',
            'tags.*' => 'exists:tags,id',
            'description' => 'required|string'
        ]);

        if(!Auth::user()->company){
            abort(403,"Your Company Account not valid");
            return;
        }

        $navettes->update($validatedData);
        $navettes->tags()->sync($request->tags);

        return redirect()->route('navettes.index')->with('success', 'Navette updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(navettes $navettes)
    {
        //
        $navettes->delete();
        return redirect()->route('navettes.index')->with('success', 'Navette deleted successfully');
    }
}
