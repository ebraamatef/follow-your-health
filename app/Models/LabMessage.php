<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabMessage extends Model
{
    use HasFactory;
    protected $fillable = [
        'lab_id',
        'message',
        'sender',
        'patient_id',
    ];
}
