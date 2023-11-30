<?php

namespace App\Http\Resources;

use App\Models\Broker;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
         $broker = Broker::find($this->broker_id);
      
        return [
            'id' => (string) $this->id,
            'attributes' => [
                'broker_id' =>  $this->broker_id,
                'address' => $this->address,
                'listing_type' => $this->listing_type,
                'city' => $this->city,
                'ZipCode' => $this->zip_code,
                'description' => $this->description,
                'build_year' => $this->build_year,
                'created_at' => $this->created_at->toDateTimeString()  
            ],
            'characteristics' => [
               new CharacteristicsResource($this->characteristics),
            ],

            'property' => [
                // 'name' => $this->broker->name,
                'name' => $broker->name,
                'address' => $broker->address,
                'phoneNumber' => $broker->phone_number
             ],


            


                
           
        ];
    }
}
