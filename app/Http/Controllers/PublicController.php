<?php

namespace App\Http\Controllers;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Http\Request;


class PublicController extends Controller
{
    /**
     * Return all countries.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function get_countries()
    {
        return Country::orderBy('name')->get();
    }

    /**
     * Return all states.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function get_states(Request $request)
    {
        $request->validate([
            'country_id' => 'required',
        ]);
        return State::where('country_id', $request->country_id)->orderBy('name')->get();
    }

    

    /**
     * Return all cities.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function get_cities(Request $request)
    {
        $request->validate([
            'state_id' => 'required',
        ]);
        return City::where('state_id', $request->state_id)->get();
    }
}
