<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Image;

class userController extends Controller
{
    public function index()
    {
        return User::with("role")->where("removed",0)->latest()->get();
    }

    public function store(Request $request)
    {
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


        return response($user,201);
    }

    public function removeUser(Request $request)
    {
        $user = User::find($request->id);
        $user->removed = 1;
        $user->save();
        if ($user->save()){
            return response("DONE",201);
        }
        return response("false",203);

    }

    public function editProfile(Request $request)
    {
        if ($request->hasFile("profile_image")){
            $request->validate([
                'profile_image' => 'image|mimes:jpg,png,jpeg|max:5120',
            ]);
            $image = $request->file('profile_image');
            $imageName = date("Y-m-dHis").$image->getClientOriginalName();
            Image::make($image)->save(public_path('profile_images/'  .  $imageName));
            @unlink("public/profile_images/". $request->user()->profile_image );

            User::find($request->user()->id)->update(["profile_image" =>$imageName]);
        }

        if ($request->email !== $request->user()->id){
            User::find($request->user()->id)->update(["email_verified_at" =>NULL]);
        }


       User::find($request->user()->id)->update([
            "name" => $request->name,
            "email" => $request->email,
            "country" => $request->country,
            "mobile_number" => $request->mobile_number,
            "timezone" => $request->timezone,
            "timezone_offset" => $request->timezone_offset,
        ]);
       return response(User::find($request->user()->id),201);
    }

    public function getUser($id, Request $request)
    {
        if ($request->user()->role_id == 3){
            return response(User::find($id),200);
        }
        return response("Unauthorized",500);
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

        return response("DONE",200);
    }
}
