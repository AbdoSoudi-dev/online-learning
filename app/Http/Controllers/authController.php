<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class authController extends Controller
{
    public function register(Request $request){
        $fields = $request->validate([
            'name' => 'required|string',
            'country' => 'required|string',
            'mobile_number' => 'required|string',
            'timeZone' => 'required|string',
            'timeZoneOffset' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'timezone_offset' => $fields['timeZoneOffset'],
            'timezone' => $fields['timeZone'],
            'mobile_number' => $fields['mobile_number'],
            'country' => $fields['country'],
            'password' => bcrypt($fields['password']),
            'role_id' => ($request->role_id ? $request->role_id : 1)
        ]);
        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response,201);
    }

    public function login(Request $request){
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);


        // check email
        $user = User::where('email', $fields['email'])->where("removed",0)->first();

        //check password
        if (!$user || !Hash::check($fields['password'], $user->password)){
            return response([
                'message' => 'bad creds'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response,201);
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return [
            'message' => 'looged out'
        ];
    }
}
