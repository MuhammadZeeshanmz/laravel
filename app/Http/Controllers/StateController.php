<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use App\Models\State;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class StateController extends Controller
{
    public function index() {

    }
    public function store(Request $request ){
        DB::begInTransaction();
        try {
           
            //code...
             $validateData = $request->validate([
            'state_name'=>'required|string|max:30',
            'country_id'=> 'required|integer',
        ]);
        $data = State::create([
            'name'=>$validateData['state_name'],
            'country_id'=>$validateData['country_id'],
        ]);
        if (!empty($request->cities)){
            foreach($request->cities as $city){
                City::create([
                    'state_id'=>$data->id,
                    'name'=>$city['city_name'],
                ]);
            }
        }
        DB::commit();

        return $data;
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th;
        }

    }
    public function update(Request $request, $id){
        DB::beginTransaction();
        try {
            //code...
             $validateData = $request->validate([
                'state_name'=>'required|string|max:255',
                'country_id'=>'required|integer',
            ]);
            $data = State::findOrFail($id);
            $data->update([
                'name'=>$validateData['state_name'],
                'country_id'=>$validateData['country_id'],
            ]);
            if(!empty($request->cities)){
                foreach($request->cities as $city){
                    City::updateOrCreate([
                        'id'=>$city['id'] ?? null,
                        'state_id'=>$data->id,
                    ],
                    [
                        'name'=>$city['city_name']

                    ]);
                }
            }
            DB::commit();
            return $data;
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th;
        }
           
        }
    public function show($id){
        try {
            $state = State::with('country')->findOrFail($id);
            return $state;
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
