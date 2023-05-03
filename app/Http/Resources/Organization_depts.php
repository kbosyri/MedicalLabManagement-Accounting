<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Organization_depts extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
        
            'amount'=>$this->amount,
            'date'=>$this->date,
            'organization_id'=>new Organization($this->organization),


        ];
    }
}
