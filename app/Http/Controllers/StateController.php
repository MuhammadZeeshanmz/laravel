<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;
use Exception;
use Illuminate\Support\Facades\Validator;

class StateController extends Controller
{
    public function index() {

    }
    public function store(Request $request ){
        try {
            //code...
             $validateData = $request->validate([
            'name'=>'required|string|max:30',
            'country_id'=> 'required|integer',
        ]);
        $data = State::create([
            'name'=>$validateData['name'],
            'country_id'=>$validateData['country_id'],
        ]);
        return $data;
        } catch (\Throwable $th) {
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
