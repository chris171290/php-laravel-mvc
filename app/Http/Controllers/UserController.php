<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return response()->json($users, 200);
    }

    public function store(CreateUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>  Hash::make($request->password)
        ]);

        $response = [
            'status' => 'success',
            'message' => 'User is created successfully.',
            'data' => $user,
        ];

        return response()->json($response, 201);
    }

    public function show(string $id)
    {
        $user = User::find($id);

        return response()->json($user, 200);
    }

    public function update(UpdateUserRequest $request, string $id)
    {
        $user = User::find($id);

        $user->name = $request->name;
        //$user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $response = [
            'status' => 'success',
            'message' => 'User is updated successfully.',
            'data' => $user,
        ];

        return response()->json($response, 201);
    }

    public function destroy(string $id)
    {
        User::find($id)->delete();
        return response()->json(['success'=>true], 200);
    }
}

