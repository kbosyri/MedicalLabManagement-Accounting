<?php

namespace App\Http\Resources\Organization;

use App\Http\Resources\Insurance\MainInsuranceDebtInsuranceResource;
use App\Models\OrganizationDebt;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MainOrganizationDebtResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    protected $collects = OrganizationDebt::class;

    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'amount'=>$this->amount,
            'is_paid'=>$this->is_paid,
            'date'=>$this->date,
            'created_at'=>$this->created_at,
            'organization'=>new MainOrganizationDebtOrganizationResource($this->organization),
        ];
    }
}
