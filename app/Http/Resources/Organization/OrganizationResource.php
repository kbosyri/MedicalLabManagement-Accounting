<?php

namespace App\Http\Resources\Organization;

use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrganizationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    protected $collects = Organization::class;

    public function toArray(Request $request): array
    {
        return [
            'name'=>$this->name,
            'debts'=>OrganizationDebtResource::collection($this->debts),
        ];
    }
}
