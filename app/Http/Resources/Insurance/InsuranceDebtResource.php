<?php

namespace App\Http\Resources\Insurance;

use App\Models\InsuranceDebt;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InsuranceDebtResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    protected $collects = InsuranceDebt::class;

    public function toArray(Request $request): array
    {
        return [
            'amount'=>$this->amount,
            'date'=>$this->date,
            'created_at'=>$this->created_at
        ];
    }
}
