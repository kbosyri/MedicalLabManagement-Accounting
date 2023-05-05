<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patients';

    public function debts()
    {
        return $this->hasMany(PatientDebt::class,'patient_id','id');
    }
}
