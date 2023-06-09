<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    use HasFactory;

    public function debts()
    {
        return $this->hasMany(InsuranceDebt::class,'insurance_id','id');
    }
}
