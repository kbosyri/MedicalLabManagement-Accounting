<?php

namespace App\Http\Resources\Patients;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
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
            'first_name'=>$this->First_Name,
            'father_name'=>$this->Father_Name,
            'last_name'=>$this->Last_Name,
            'gender'=>$this->Gender,
            'debts'=>PatientPatientDebtResource::collection($this->debts),
        ];
    }
}
