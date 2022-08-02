<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Doctor;

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

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }

    public function prescriptions()
    {
        return $this-> hasMany(prescription::class);
    }
}
