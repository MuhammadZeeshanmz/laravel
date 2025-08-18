<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Validator;


class CountryController extends Controller
{
    //
    public function index() {}

    public function store(Request $request)
    {
        try {
            $validateData = $request->validate([
                'name' => 'required|string|max:30',
                'state_ids' => 'array|nullable',
                'state_ids.*' => 'integer|exists:states,id',
            ]);
            $data = Country::create([
                'name' => $validateData['name'],
                'state_ids' => isset($validateData['state_ids']) ? json_encode($validateData['state_ids']) : null,
            ]);
            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }


    public function show($id)
    {
        try {
            $country = Country::findOrFail($id);
             $country->states = $country->states_with_cities;
             

            return $country;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
