<?php

namespace App\Http\Resources\Insurance;

use App\Models\Insurance;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InsuranceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    protected $collects = Insurance::class;

    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'address'=>$this->address,
            'phone'=>$this->phone,
            'email'=>$this->email,
            'depts'=>InsuranceDebtResource::collection($this->debts),
        ];
    }
}
