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
    public function get_states(int $country_id)
    {
        return State::where('country_id', $country_id)->orderBy('name')->get();
    }

    

    /**
     * Return all cities.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    /* public function get_cities(int $state_id)
    {
        return City::where('state_id', $state_id)->get();
    } */
}
