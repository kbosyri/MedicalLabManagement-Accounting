<?php

namespace App\Http\Resources\Organization;

use App\Models\OrganizationDebt;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrganizationDebtResource extends JsonResource
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
            'amount'=>$this->amount,
            'date'=>$this->date,
            'created_at'=>$this->created_at,
        ];
    }
}
