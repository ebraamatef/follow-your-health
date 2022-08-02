<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OffMed extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'medication',
        'status',
    ];

}
