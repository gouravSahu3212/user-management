<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;
use App\Models\User;

class UserController extends Controller
{
    function users_list(Request $request) {
        $users = User::whereNot('id', $request->user->id)
            ->orderBy('id')
            ->paginate(15);
        
        return response()->json([
            'users' => new UserCollection($users)
        ]);
    }

    function get_user(int $user_id) {
        $user = User::find($user_id);
        if($user)
            return new UserResource($user);

        return response()->json([
            'message' => 'No user found.'
        ], 404);
    }

    function update_user(int $user_id, Request $request) {
        $request->validate([
            'fname' => ['string', 'max:255'],
            'lname' => ['string', 'max:255'],
            'password' => ['string', 'min:8'],
            'country' => ['string', 'max:255'],
            'state' => ['string', 'max:255'],
            'city' => ['string', 'max:255'],
            'zip' => ['string', 'max:255'],
            'profile_photo' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'interest' => ['array'],
        ]);

        $user = User::find($user_id);
        if(!$user)
            return response()->json([
                'message' => 'No user found.'
            ], 404);
        
        $user->fname = $request->fname ? $request->fname : $user->fname;
        $user->lname = $request->lname ? $request->lname : $user->lname;
        $user->password = $request->password ? Hash::make($request->password) : $user->password;
        $user->country = $request->country ? $request->country : $user->country;
        $user->state = $request->state ? $request->state : $user->state;
        $user->city = $request->city ? $request->city : $user->city;
        $user->zip = $request->zip ? $request->zip : $user->zip;
        $user->profile_path = $request->profile_photo ? $request->profile_photo->store('profile-photos', 'public') : $user->profile_path;
        $user->interest = $request->interest ? implode(',,', $request->interest) : $user->interest;
        $user->save();
        return response()->json([
            'message' => 'User updated successfully.',
            'user' => new UserResource($user)
        ]);
    }

    function delete_user(int $user_id) {
        $user = User::find($user_id);
        if(!$user)
            return response()->json([
                'message' => 'No user found.'
            ], 404);
        
        $user->delete();
        return response()->json([
            'message' => 'User deleted successfully.',
        ]);
    }
}
