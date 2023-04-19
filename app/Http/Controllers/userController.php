<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Image;

class userController extends Controller
{

    public function __construct()
    {
        $this->middleware("isSuperAdmin")->except("index");
    }

    public function index()
    {
        return User::with("role")->latest()->get();
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'timezone_offset' => $request->timeZoneOffset,
            'timezone' => $request->timeZone,
            'mobile_number' => $request->mobile_number,
            'country' => $request->country,
            'password' => Hash::make($request->password),
            'role_id' => ($request->role_id ? $request->role_id : 1)
        ]);

        return $user;
    }

    public function removeUser(Request $request)
    {
        User::find($request->id)->update([
            'removed' => 1
        ]);

        return true;
    }



    public function getUser($id)
    {
        return User::find($id);
    }

    public function update(Request $request)
    {
        User::find($request->id)->update([
            "name" => $request->name,
            "email" => $request->email,
            "country" => $request->country,
            "mobile_number" => $request->mobile_number,
            "timezone" => $request->timezone,
            "timezone_offset" => $request->timezone_offset,
            "role_id" => $request->role_id,
        ]);

        return true;
    }
}
