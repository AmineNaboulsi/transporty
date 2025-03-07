<?php

namespace App\Http\Controllers;

use App\Models\permission;
use App\Models\roles;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function edit(){

    }
    public function assignrole(Request $request){

        $user = User::find($request->user_id);
        $roles = roles::find($request->role_id);
        $user->role()->associate($roles);
        $user->save();
        return response([]);

    }
}
