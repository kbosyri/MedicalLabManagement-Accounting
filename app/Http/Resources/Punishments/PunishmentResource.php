<?php

namespace App\Http\Resources\Punishments;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PunishmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'amount'=>$this->amount,
            'date'=>$this->date,
            'staff'=>new PunishmentStaffResource($this->staff),
        ];
    }
}
