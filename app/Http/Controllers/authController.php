<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Validation\Rules\Password as RulesPassword;

class authController extends Controller
{
    public function register(StoreUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'timezone_offset' => $request->timeZoneOffset,
            'timezone' => $request->timeZone,
            'mobile_number' => $request->mobile_number,
            'country' => $request->country,
            'password' => Hash::make($request->password),
            'role_id' => 1
        ]);

        event(new Registered($user));

        $token = $user->createToken($request->userAgent());

        return [
            'user' => $user,
            'token' => $token->plainTextToken
        ];
    }

    public function login(Request $request){

        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::whereEmail($fields['email'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)){
            return response([
                'message' => 'bad creds'
            ], 401);
        }

        $token = $user->createToken('myapptoken');

        return [
                'user' => $user,
                'token' => $token->plainTextToken
            ];
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();

        return [
                'message' => 'logged out'
            ];
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required|string',
            'password' => 'required|string|confirmed'
        ]);

        if (!Hash::check($request->old_password, $request->user()->password )){
            return response("Old password is invalid", 401);
        }

        $request->user()->update([ "password" => Hash::make($request->password) ]);

        return "Password has been updated successfully";
    }

    public function forgotPassword(Request $request)
    {
         $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::whereEmail($request->email)->first();
        if (!$user){
            return response("error",500);
        }

        $status = Password::sendResetLink( $request->only("email") );

        if ($status == Password::RESET_LINK_SENT) {
            return [
                'status' => __($status)
            ];
        }

        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
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

        if ($request->email !== $request->user()->email){
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
        return User::find($request->user()->id);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', RulesPassword::defaults()],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => bcrypt($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                $user->tokens()->delete();

                event(new PasswordReset($user));
            }
        );

        $message =  $status == Password::PASSWORD_RESET ? 'Password reset successfully' : __($status) ;
        $res_code = $status == Password::PASSWORD_RESET ? 200 : 500;

        return response([ 'message'=> $message ], $res_code);

    }

}
