<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use App\Models\Location;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = Location::all();
        return response()->json($locations, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateLocationRequest $request)
    {
        $location = Location::create([
            'name' => $request->name,
            'address' => $request->address,
        ]);

        $response = [
            'status' => 'success',
            'message' => 'Location is created successfully.',
            'data' => $location,
        ];

        return response()->json($response, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $location = Location::find($id);
        return response()->json($location, 200);
    }   

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLocationRequest $request, string $id)
    {
        $location = Location::find($id);
        $location->name = $request->name;
        $location->address = $request->address;

        $response = [
            'status' => 'success',
            'message' => 'Location is updated successfully.',
            'data' => $location,
        ];

        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Location::find($id)->delete();

        $response = [
            'status' => 'success',
            'message' => 'Location is deleted successfully.',
        ];

        return response()->json($response, 200);
    }
}
