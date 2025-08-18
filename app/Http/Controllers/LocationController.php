<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    // Get all countries
    public function getCountries()
    {
  
        return Country::all();
    }

    // Get a country with its states and cities
    public function getCountryDetails($id)
    {
        return Country::with('states.cities')->findOrFail($id);
    }

    // Get all states of a country
    public function getStatesByCountry($country_id)
    {
        return State::where('country_id', $country_id)->with('cities')->get();
    }

    // Get all cities of a state
    public function getCitiesByState($state_id)
    {
        return City::where('state_id', $state_id)->get();
    }
}
