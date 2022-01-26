<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class userController extends Controller
{
    public function index()
    {
        return User::with("role")->where("removed",0)->get();
    }

    public function store(Request $request){
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'role_id' => $request->role_id
        ]);


        return response($user,201);
    }

    public function removeUser(Request $request){
        $user = User::find($request->id);
        $user->removed = 1;
        $user->save();
        if ($user->save()){
            return response("DONE",201);
        }
        return response("false",203);

    }

}
