<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProviderRequest;
use App\Http\Requests\UpdateProviderRequest;
use App\Models\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $providers = Provider::all();
        return response()->json($providers, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProviderRequest $request)
    {
        $provider = Provider::create([
            'name' => $request->name,
            'address' => $request->address
        ]);

        $response = [
            'status' => 'success',
            'message' => 'Provider is created successfully.',
            'data' => $provider,
        ];

        return response()->json($response, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $provider = Provider::find($id);

        if (!isset($provider)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Provider not found.'
            ], 404);
        }

        return response()->json($provider, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProviderRequest $request, string $id)
    {
        $provider = Provider::find($id);

        $provider->name = $request->name ?? $provider->name;
        $provider->address = $request->address ?? $provider->address;
        $provider->save();

        $response = [
            'status' => 'success',
            'message' => 'Provider is updated successfully.',
            'data' => $provider,
        ];

        return response()->json($response, 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Provider::find($id)->delete();

        $response = [
            'status' => 'success',
            'message' => 'Provider is deleted successfully.',
        ];

        return response()->json($response, 200);
    }
}
