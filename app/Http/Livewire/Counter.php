<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use App\Models\Notification;
class Counter extends Component
{
    // public $notification ;
    public function render()
    {
            $notification = Notification::with('user')->where('reciever', Auth::user()->id)->latest()->take(10)->orderBy('created_at', 'desc')->get();


        return view('livewire.counter',compact('notification'));
    }

}
