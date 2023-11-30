<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BrokerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'city' => $this->city,
            'ZipCode' => $this->zip_code,
            'phoneNumber' => $this->phone_number,
            'logo_path' => $this->logo_path,
            'created_at' => $this->created_at->toDateTimeString()      
           
        ];
    }
}
