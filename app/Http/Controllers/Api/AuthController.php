<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    
    public function register(Request $request)
	{
		$request->validate([
			'name'=>'string|required|min:6',
			'username'=>'string|required|min:8|unique:users',
			'email'=>'email|required|unique:users|min:8',
			'password'=>'string|required|confirmed',

		]);
		$user=new User([
			'name'=>$request->name,
			'username'=>$request->username,
			'email'=>$request->email,
			'password'=>Hash::make($request->password)
		]);
		$user->save();
		return response()->json([
			'success'=>true,
			'data'=>'Sucessful user created'
		],201);
    }
    
    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Intenta autenticar al usuario
        if (Auth::attempt($request->only('email','password'))){
            return response()->json([
                'success'=>true,
                'token'=>$request->user()->createtoken($request->name)->plainTextToken,
                'data'=>'Sucessful user created'
            ],201);
        } else {
            return response()->json([
                'success'=>false,
                'data'=>'ERROR: user not created'
            ],401);
        }
    }
}

