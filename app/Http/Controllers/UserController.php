<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class UserController extends Controller
{
    /**
     * Return all Users.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function get_users()
    {
        $users = User::whereNot('id', Auth::user()->id)->orderBy('id')->paginate(15);
        return view('users')->with('users', $users);
    }

    /**
     * Opens a user edit form.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    function edit_user_form($user_id) {
        $user = User::findOrFail($user_id);
        $countries = Country::all();
        $states = State::where('country_id', $user->country)->get();
        $cities = City::where('state_id', $user->state)->get();
        $interests = explode(",,", $user->interest);
        return view('user.edit_user')
            ->with('user', $user)
            ->with('interests', $interests)
            ->with('countries', $countries)
            ->with('states', $states)
            ->with('cities', $cities);
    }

    function edit_user($user_id, Request $request) {
        $user = User::findOrFail($user_id);
        $request->validate([
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'zip' => ['required', 'string', 'max:255'],
            'profile_photo' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'interest' => ['required', 'array'],
        ]);

        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->country = $request->country;
        $user->state = $request->state;
        $user->city = $request->city;
        $user->zip = $request->zip;
        $user->interest = implode(",,", $request->interest);
        if($request->profile_photo)
           $user->profile_path = $request->profile_photo->store('profile-photos', 'public');

        $user->save();
        return redirect()->route('users')->with('status', 'User updated successfully.');
    }

    /**
     * Opens a delete user form.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    function delete_user_form($user_id) {
        $user = User::findOrFail($user_id);
        return view('user.delete_user')->with('user', $user);
    }

    /**
     * Opens a password reset form.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    function reset_password_form($user_id) {
        $user = User::findOrFail($user_id);
        return view('user.reset_password')->with('user', $user);
    }
}
