<?php

namespace App\Http\Controllers;

use App\Http\Requests\CoutryRequest;
use App\Http\Resources\CountryResource;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;



class CountryController extends Controller
{
    //
    public function index() {}

    public function store(CoutryRequest $request)
    {

        DB::beginTransaction();
        try {
            $data = Country::create([
                'name' => $request['country_name'],
            ]);
            if (!empty($request->states)) {
                foreach ($request->states as $state) {
                    State::create([
                        'country_id' => $data->id,
                        'name' => $state['state_name']
                    ]);
                }
            };
            DB::commit();

            return new CountryResource($data);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }




    // try {
    //     $validateData = $request->validate([
    //         'name' => 'required|string|max:30',
    //         'state_ids' => 'array|nullable',
    //         'state_ids.*' => 'integer|exists:states,id',
    //     ]);
    //     $data = Country::create([
    //         'name' => $validateData['name'],
    //         'state_ids' => isset($validateData['state_ids']) ? json_encode($validateData['state_ids']) : null,
    //     ]);
    //     return $data;
    // } catch (\Exception $e) {
    //     return $e;
    // }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $validateData = $request->validate([
                'country_name' => 'required|string|max:255',

            ]);
            $data = Country::findOrFail($id);
            $data->update([
                'name' => $validateData['country_name']
            ]);
            if (!empty($request->states)) {
                foreach ($request->states as $state) {
                    State::updateOrCreate(

                        [
                            'id' => $state['id'] ?? null,
                            'country_id' => $data->id,
                        ],
                        [

                            'name' => $state['state_name'],
                        ]
                    );
                }
            }
            DB::commit();
            return true;
        } catch (\Throwable $th) {
            // return $th;
            DB::rollBack();
            return false;
        }
        // $validateData = $request->validate([
        //     'name' => 'required|string|max:255',
        // ]);
        // $data = Country::findOrFail($id);
        // $data->update([
        //     'name' => $validateData['name'],
        // ]);
        // return $data;
    }


    public function show($id)
    {
        try {
            $country = Country::with('states.cities')->findOrFail($id);

            return $country;
        } catch (\Throwable $th) {
            return $th;
        }
        // try {
        //     $country = Country::findOrFail($id);
        //      $country->states = $country->states_with_cities;


        //     return $country;
        // } catch (\Exception $e) {
        //     return $e->getMessage();
        // }
    }
}
