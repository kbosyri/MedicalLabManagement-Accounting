<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientTest extends Model
{
    use HasFactory;

    protected $table = 'patienttests';

    public function test()
    {
        return $this->belongsTo(Test::class,'test_id');
    }
}
