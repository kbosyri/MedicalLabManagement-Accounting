<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StaffRoleResource extends JsonResource
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
            'name'=>$this->name,
            'tests'=>$this->tests,
            'patient_tests'=>$this->patient_tests,
            'auditing'=>$this->auditing,
            'reports'=>$this->reports,
            'announcements'=>$this->announcements,
            'job_applications'=>$this->job_applications,
            'finance'=>$this->finance,
            'human_resources'=>$this->human_resources,
        ];
    }
}
