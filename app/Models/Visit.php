<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'doctor_name',
        'specialty',
        'patient_complaint',
        'visit_report',
        'treatment_action',
        'date',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
