<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Doctor;
use App\Models\PatientProfile;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
    ];

    public function doctors()
    {
        return $this->belongsToMany(Doctor::class, 'doctor_patients', 'patient_id', 'doctor_id')->withPivot('patient_id','doctor_id');
    }

    public function labs()
    {
        return $this->belongsToMany(Lab::class, 'lab_patients', 'patient_id', 'lab_id')->withPivot('patient_id','lab_id');
    }

    public function profile(){

        return $this->hasOne(
            PatientProfile::class,
            'id',
            'patient_id',
        );
    }

}
