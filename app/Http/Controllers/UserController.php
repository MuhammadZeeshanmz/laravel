<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        try{

        
        $task = User::with('assignedTasks')->get();
        $Users = User::all();
        return view('users', compact('Users'));

        return response()->json([
            'data' => $Users,
        ], 200);

    } catch (Exception $e) {
        return $e;
    }

       
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'nullable|string|max:255',
            'password'      => 'required|string|min:8',
            'dob'           => 'nullable|date',
            'phone_number'  => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

     
        $User = User::create([
            'first_name'    => $request->input('first_name'),
            'last_name'     => $request->input('last_name'),
            'password'      => Hash::make($request->input('password')), // Secure hashing
            'dob'           => $request->input('dob'),
            'phone_number'  => $request->input('phone_number'),
        ]);

        return response()->json([
            'data' => $User,
        ], 201);
    }
// use a custom login 
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'password'   => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::where('first_name', $request->input('first_name'))->first();

        if (!$user || !Hash::check($request->input('password'), $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }

        $token = $user->createToken('api token')->plainTextToken;
        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
            'token' => $token,
        ], 200);
    }

    public function show($id)
{
    try {
        $user = User::with('assignedTasks')->findOrFail($id);

        return response()->json([
            'data' => $user,
        ], 200);

    } catch (\Exception $e) {
        return response()->json([
            'error' => $e->getMessage(),
        ], 500);
    }
}


    

}

