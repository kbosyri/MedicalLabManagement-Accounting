<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Patienttest;


class Patient extends Authenticatable
{
    use HasFactory,Notifiable,HasApiTokens;
    
    protected $table = 'patients';

    public function debts()
    {
        return $this->hasMany(PatientDebt::class,'patient_id','id');
    }
}
