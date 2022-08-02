<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedCondition extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'condition',
        'doctor_name',
    ];
}
