<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RewardStaffResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $active = false;
        if($this->is_active)
        {
            $active = true;
        }

        return [
            'id'=>$this->id,
            'biometric_id'=>$this->biometric_id,
            'first_name'=>$this->first_name,
            'father_name'=>$this->father_name,
            'last_name'=>$this->last_name,
            'salary'=>$this->salary,
            'username'=>$this->username,
            'qualifications'=>$this->qualifications,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'is_admin'=>$this->when($this->is_admin,true,false),
            'is_lab_staff'=>$this->when($this->is_lab_staff,true,false),
            'is_reception'=>$this->when($this->is_reception,true,false),
            'is_active'=>$active,
            'is_staff'=>true,
            'role'=>new StaffRoleResource($this->role),
        ];
    }
}
