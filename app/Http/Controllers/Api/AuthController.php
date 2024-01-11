<?php

namespace App\Http\Controllers\Api;

use App\Notifications\ApiResetPasswordNotification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\Token;


class AuthController extends Controller
{
    function user(Request $request) {
        return new UserResource($request->user);
    }

    function login(Request $request) {
        $request->validate([
            'email' => ['required', 'string'],
            'password' => ['required']
        ]);
        $user = User::where('email', $request->email)->first();
        if($user){
            if(Hash::check($request->password, $user->password)){
                $token = Token::create([
                    'token' => Str::random(40),
                    'user_id' => $user->id
                ]);
                return response()->json([
                    "message" => "Login successfully.",
                    "token" => $token->token
                ]);
            }
        }

        return response()->json(["error" => "Unauthenticates"], 401);
    }

    function logout(Request $request) {
        Token::where('user_id', $request->user->id)->delete();
        return response()->json([
            "message" => "Logout successfully.",
        ]);
    }

    function register(Request $request) {
        $request->validate([
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'country' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'zip' => ['required', 'string', 'max:255'],
            'profile_photo' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'interest' => ['required', 'array'],
        ]);

        $user = User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'zip' => $request->zip,
            'profile_path' => $request->profile_photo->store('profile-photos', 'public'),
            'interest' => implode(',,', $request->interest),
        ]);

        return response()->json([
            'message' => 'User registered successfully.',
            'user' => new UserResource($user)
        ]);
    }


    function forget_password(Request $request) {
        $request->validate([
            'email' => ['required', 'string', 'email', 'exists:App\Models\User,email'],
            'redirect_url' => ['required', 'url:http,https']
        ]);

        $redirect_url = $request->redirect_url;

        $response = Password::sendResetLink(
            $request->only('email'),
            function ($user, $token) use ($redirect_url) {
                $user->notify(new ApiResetPasswordNotification($token, $redirect_url));
            }
        );

        if($response === Password::RESET_LINK_SENT)
            return response()->json(['message' => 'Reset token generated and sent to email']);
        
        // $this->sendResetLinkFailedResponse($request, $response);
        return response()->json(['error' => $response], 400);
    }

    function reset_password(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );

        if($status === Password::PASSWORD_RESET)
            return response()->json(['message' => 'Password reset successfully']);

        return response()->json(['error' => $status]);
    }
}
