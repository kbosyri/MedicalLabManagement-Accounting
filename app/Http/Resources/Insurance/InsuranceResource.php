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
            'name'=>$this->name,
            'depts'=>InsuranceDebtResource::collection($this->debts),
        ];
    }
}
