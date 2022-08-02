<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'lab_id',
        'patient_id'
    ];
}
