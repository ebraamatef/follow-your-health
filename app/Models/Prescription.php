<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'visit_id',
        'medication',
        'instructions',
        'start_date',
        'end_date',
        'status',
        'doctor_name',
    ];
}
