<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function createUser(CreateUserRequest $request){
        //$request->password
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>  Hash::make($request->password)
        ]);

        $data['token'] = $user->createToken($request->email)->plainTextToken;
        $data['user'] = $user;

        $response = [
            'status' => 'success',
            'message' => 'User is created successfully.',
            'data' => $data,
        ];

        return response()->json($response, 201);
    }

    public function loginUser(LoginRequest $request){
        if (!Auth::attempt($request->only(['email', 'password']))) {

            return response()->json([
                'status'=>'false',
                'message'=>'Email & Password do not match with our records'
            ], 401);
        };

        $user = User::where('email', $request->email)->first();

        return response()->json([
            'status'=>true,
            'message'=>'User logged in successfully',
            'token' => $user->createToken('API TOKEN')->plainTextToken
        ], 401);
    }

}
