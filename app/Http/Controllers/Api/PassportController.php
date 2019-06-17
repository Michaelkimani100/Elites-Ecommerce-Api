<?php

namespace App\Http\Controllers\Api;
use App\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PassportController extends Controller
{
    public function register(Request $request)
    {
        $rules= array(
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        );
        $this->validate($request,$rules);
        $user= User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' =>bcrypt($request->input('password'))
        ]);
        $token=$user->createToken('elites')->accessToken;
        return response()->json(['token' => $token],200);
    }
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];

        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('elites')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'UnAuthorised'], 401);
        }
    }
}
