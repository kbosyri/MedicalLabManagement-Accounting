<?php

namespace App\Http\Resources\Insurance;

use App\Http\Resources\Organization\MainOrganizationDebtOrganizationResource;
use App\Models\InsuranceDebt;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MainInsuranceDebtResource extends JsonResource
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
            'date'=>$this->date,
            'is_paid'=>$this->is_paid,
            'created_at'=>$this->created_at,
            'organization'=>new MainOrganizationDebtOrganizationResource($this->organization),
        ];
    }
}
