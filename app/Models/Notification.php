<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable =[
        'sender_id',
        'sender_image',
        'sender_type',
        'reciever',
        'subject',
        'notification',
        'link'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
