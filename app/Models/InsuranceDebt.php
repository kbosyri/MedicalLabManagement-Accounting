<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuranceDebt extends Model
{
    use HasFactory;

    public function insurancedepts()
    {
        return $this->hasMany(InsuranceDebt::class,'insurance_id');
    }
}
