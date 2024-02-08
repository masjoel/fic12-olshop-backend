<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $addresses = Address::where('user_id', $request->user()->id)->get();
        return response()->json([
            'status' => 'success',
            'data' => $addresses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $address = Address::insert([
            'name' => $request->name,
            'full_address' => $request->full_address,
            'phone' => $request->phone,
            'prov_id' => $request->prov_id,
            'city_id' => $request->city_id,
            'district_id' => $request->district_id,
            'postal_code' => $request->postal_code,
            'user_id' => $request->user()->id,
            'is_default' => $request->is_default,
        ]);

        if ($address) {
            return response()->json([
                'status' => 'success',
                'message' => 'address saved'
            ], 201);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'address failed to save'
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
