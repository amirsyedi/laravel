<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $user = User::where('role','user')->get();

        return response()->json($user,200);
   }

   public function delete($id){

       $user =User::find($id);
       $user->delete();

       return response()->json('User Deleted');
   }

   public function edit($id){
       $user = User::find($id);

       return response()->json($user);
   }

   public function update($id, Request $request){

        $request -> validate([
            'name' => ['required'],
            'email' => ['required'],
        ]);

        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();

        return response()->json($user);
   }
}
