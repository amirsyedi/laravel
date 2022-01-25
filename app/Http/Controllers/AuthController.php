<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){

        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token= $user ->createToken('appToken')->plainTextToken;

        $response =[
            'users' => $user,
            'token' => $token
        ];

        return response($response,200);
    }
    public function login(Request $request){
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
            'device_name' => 'required'
        ]);

        // if(Auth::attempt($request->only('email','password'))){
        //     $user = Auth::user();
        //     // $token= $user->createToken($fields['device_name'])->plainTextToken;
        //     return response()->json($user,200);
        // }else{
        //     return response([
        //         'message' => 'Wrong creds'
        //     ],401);
        // }

        $user = User::where('email',$fields['email'])->first();

        if(!$user || !Hash::check($fields['password'], $user->password)){
            return response([
                'message' => 'Not matching'
            ],401);
        }

        $token= $user->createToken($fields['device_name'])->plainTextToken;

        $response =[
            'user' => $user,
            'token' => $token
        ];

        return response()->json($response,200);
    }

    public function logout(Request $request){
        $request -> user() ->currentAccessToken()->delete;
        // Auth::logout();
        return response()->json(['message'=> 'Logged out']);
    }
}
