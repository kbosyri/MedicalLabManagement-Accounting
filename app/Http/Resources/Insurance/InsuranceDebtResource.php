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
            'id'=>$this->id,
            'amount'=>$this->amount,
            'is_paid'=>$this->is_paid,
            'date'=>$this->date,
            'created_at'=>$this->created_at
        ];
    }
}
