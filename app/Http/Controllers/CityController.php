<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class CityController extends Controller
{

    public function index(){

    }
    public function store(Request $request){
        try {
            //code...
            $valiadateData = $request->validate([
            'name'=> 'required|string|max:30',
            'state_id'=> 'required|integer',
        ]);
        $data = City::create([
            'name'=>$valiadateData['name'],
            'state_id'=>$valiadateData['state_id'],
        ]);
        return $data;
        } catch (\Throwable $th) {
            return $th;
        }
        

    }
public function show($id){
    try {
        // DB::enableQueryLog();
        $city = City::with('state')->findOrFail($id);
        // $city->state =   $city->state ;
        return $city;
        // $queries = DB::getQueryLog();
        // return$queries;

    } catch (\Throwable $th) {
        return $th;
    }
}

}
