<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\PropertyResource;
use App\Http\Requests\StorePropertyRequest;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PropertyResource::collection(Property::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePropertyRequest $request)
    {
        $request->validated();

        $property  = Property::create([
         'broker_id' => $request->broker_id,
         'address' => $request->address,
         'listing_type' => $request->listing_type,
         'city' => $request->city,
         'zip_code' => $request->zip_code,
         'description' => $request->description,
         'build_year' => $request->build_year

        ]);


        $property->characteristics()->create([
            'property_id' => $request->property_id,
            'price' => $request->price,
            'bathrooms' => $request->bathrooms,
            'bedrooms' => $request->bedrooms,
            'sqft' => $request->sqft,
            'price_sqft' => $request->price_sqft,
            'property_type' => $request->property_type,
            'status' => $request->status,
        ]);

        return new PropertyResource($property);

    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        return PropertyResource::make($property);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property)
    {
       

        $property->update($request->only([
            'broker_id', 'address', 'list_type' , 'city' , 'zip_code', 'description', 'build_year'
        ]));

        
        $property->characteristics()->where('property_id', $property->id)->update($request->only([
            'property_id', 'price', 'bedrooms' , 'sqft' , 'price_sqft', 'property_type', 'status'
        ]));

        return response()->json(PropertyResource::make($property), Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        $property->delete();

        return response()->json([
            
            'success' => true,
            'messaage' => 'Property has been deleted succesfully'
        ]);
    }
}
