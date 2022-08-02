<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'alt_phone',
        'address',
        'type',
        'image',
    ];

    public function patients()
    {
        return $this->belongsToMany(Patient::class, 'lab_patients', 'lab_id', 'patient_id')->withPivot('lab_id','patient_id');
    }
}
