<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientProfile extends Model
{
    use HasFactory;
    protected $fillable = [
       
        'exercise' ,
        'patient_id' ,
    'dieting'  ,
    'medical_diet' ,
    'meals_average' ,
    'Rank_salt' ,
    'caffeine' ,
    'cups' ,
    'alchohol' ,
    'alchohol_kind' ,
    'alchohol_rate' ,
    'alchohol_concerned' ,
    'alchohol_stopping' ,
    'alchohol_binge' ,
    'alchohol_drive',
    'use_tobacco' ,
    'use_drugs' ,
    'drug_needle'  ,
    'sexually_active'  ,
    'sexually_pregnancy' ,
    'sexually_discomfort' ,
    'live_alone'  ,
    'frequent_falls' ,
    'vision_hearing_loss', 
    'stress' ,
    'depressed',
    'panic' ,
    'appetite' ,
    'cry_frequently',
    'suicide'  ,
    'hurting_yourself' ,
    'trouble_sleeping' ,
    'counselor '
    ];
}
