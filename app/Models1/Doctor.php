<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Patient;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'alt_phone',
        'clinic_address',
        'speciality',
        'gender',
    ];

    public function patients()
    {
        return $this-> belongsToMany(Patient::class, 'doctor_patients', 'doctor_id', 'patient_id')->withPivot('doctor_id','patient_id');
    }
}
