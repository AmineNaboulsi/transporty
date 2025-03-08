<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthSignin;
use App\Http\Requests\AuthSignup;
use App\Models\campanys;
use App\Models\roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Login Method
     *
     */
    public function signin(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if($user->google2fa_enabled){
                return redirect()->route('2fa.verify');
            }else{
                return redirect()->route('home');
            }

        }else{
            return redirect()->route('login')->with('error','The provided credentials are incorrect.');
        }

    }

    /**
     * Register Method
     *
     *  */
    public function signup(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string',
                'email' => 'required|string|email',
                'password' => 'required|string',
                'account_type' => 'required|string|in:company,client'
            ]);
        } catch (ValidationException $e) {
            // $missingParams = array_keys($e->validator->failed());
            return response()->json([
                'status' => false,
                'message' => "Missing parametres"
            ], 422);
        }

        if (User::where('email', $validatedData['email'])->exists()) {
            return response()->json([
                'status' => false,
                'message' => 'Email already exists.'
            ], 400);
        }
        $role = roles::where('name','=',$validatedData['account_type'])->first();
        if(!$role){
            return response()->json([
                'status' => false,
                'message' => 'Account type does not exist.'
            ], 400);
        }
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role_id' => $role->id
        ]);
        if($validatedData['account_type'] == 'company'){
            campanys::create([
                'name' => $validatedData['name'],
                'user_id' => $user->id
            ]);
        }

        if ($user ) {
            session()->put('id', $user->id);
            return response()->json([
                'status' => true,
                'message' => 'Registered successfully'
            ], 201);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'We are facing some issues right now, please try later.'
            ], 500);
        }
    }

    /**
     *  Logout Method
     *
     *
     */
    public function logout(Request $request)
    {
        session()->flush();
        return redirect()->route('home');
    }
}
