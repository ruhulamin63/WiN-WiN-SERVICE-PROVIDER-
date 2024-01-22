<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        try {
            $customers = Customer::all();
            return response()->json($customers);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error retrieving customers']);
        }
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
        // return $request->all();
    //    try {
            foreach ($request->all() as $customer) {
                Customer::create([
                    'area_id' => $customer['location'],
                    'name' => $customer['full_name'],
                    'code' => $customer['code'],
                    'age' => $customer['age'],
                ]);
            }
    //     } catch (\Exception $e) {
    //         return response()->json(['message' => 'Error creating customer']);
    //    }
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
