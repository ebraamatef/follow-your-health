<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allergy extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'doctor',
        'allergy',
        'type',
        'status',
        'notes',
        'added_by',
    ];
}
