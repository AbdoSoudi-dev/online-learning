<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Image;

class userController extends Controller
{
    public function index()
    {
        return User::with("role")->where("removed",0)->get();
    }

    public function store(Request $request)
    {
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

}
