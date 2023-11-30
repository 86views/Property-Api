<?php

namespace App\Http\Controllers;

use App\Models\Broker;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\BrokerResource;
use App\Http\Requests\StoreBrokerRequest;

class BrokersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return BrokerResource::collection(Broker::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrokerRequest $request)
    {
        $brokers = Broker::create($request->validated());

        return new BrokerResource($brokers);


    }

    /**
     * Display the specified resource.
     */
    public function show(Broker $broker)
    {
        return BrokerResource::make($broker);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreBrokerRequest $request, Broker $broker)
    {
        // $broker->update($request->validated());
        // return response()->json(BrokerResource::make($broker), Response::HTTP_ACCEPTED);

        $broker->update($request->only([
            'name', 'address', 'city' , 'zip_code' , 'phone_number', 'logo_path'
        ]));
         return response()->json(BrokerResource::make($broker), Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Broker $broker)
    {
        $broker->delete();

        return response()->json([
            'success' => true,
            'message' => 'Brokers  Successfully deleted'
        ]);
    }
}
