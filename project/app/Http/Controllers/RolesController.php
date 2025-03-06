<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorerolesRequest;
use App\Http\Requests\UpdaterolesRequest;
use App\Models\permission;
use App\Models\roles;

class RolesController extends Controller
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
        //
        $permissions = permission::all();
        $permissionGroups = $permissions->groupBy(function($permission) {
            return explode('.', $permission->route)[0];
        });
        // dd($permissionGroups);
        return view('dashboard.roles.create', compact('permissionGroups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorerolesRequest $request)
    {
        $validatepermissions = $request->validate([
            'name' => 'required|string',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id'
        ]);
        if($validatepermissions){
            $role = roles::create([
                "name" => $request->name
            ]);
            foreach($request->permissions as $permission){
                $role->permissions()->attach($permission);
            }
        }
        return redirect()->route('roles.index')->with('success', "$request->name Added successfully");;
    }

    /**
     * Display the specified resource.
     */
    public function show(roles $roles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(roles $roles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdaterolesRequest $request, roles $roles)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(roles $roles)
    {
        //
        $name = $roles->name;
        $roles->delete();
        return redirect()->back()->with('success', "$name deleted successfully");
    }
}
