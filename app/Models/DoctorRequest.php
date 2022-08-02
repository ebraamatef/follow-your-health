<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'patient_id'
    ];
}
