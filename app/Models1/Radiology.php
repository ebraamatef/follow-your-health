<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Radiology extends Model
{
    use HasFactory;

    protected $fillable = [
        'radiology',
        'doctor_name',
        'lab_name',
        'date',
        'file',
        'patient_id',
        'lab_id'
    ];
}
