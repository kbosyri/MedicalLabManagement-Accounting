<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    public function debts()
    {
        return $this->hasMany(OrganizationDebt::class,'organization_id','id');
    }
}
