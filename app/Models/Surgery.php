<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surgery extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'surgery',
        'reason',
        'foreign_object',
        'doctor',
        'year',
        'added_by',
    ];
}
