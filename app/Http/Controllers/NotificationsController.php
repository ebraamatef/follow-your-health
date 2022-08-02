<?php

namespace App\Http\Controllers;
use App\Models\Notification;

use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function index($notif_id, $link){
        Notification::destroy('id', $notif_id);
        dd($link);
        return redirect($link);
    }
}
