<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorecitysRequest;
use App\Http\Requests\UpdatecitysRequest;
use App\Models\citys;

class CitysController extends Controller
{

    public function getcitys()
    {
        //
        $citys = citys::select('id', 'name')->get();
        return json_encode($citys);
    }

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorecitysRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(citys $citys)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(citys $citys)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecitysRequest $request, citys $citys)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(citys $citys)
    {
        //
    }
}
