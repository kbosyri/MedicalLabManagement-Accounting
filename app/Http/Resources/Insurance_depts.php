<?php

namespace App\Http\Resources;

use App\Models\Insurance;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Insurance_depts extends JsonResource
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
            'insurance_id'=>new Insurance($this->insurance_id),


        ];
        
    }
}
