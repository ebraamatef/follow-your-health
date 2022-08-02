<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\DocMessage;

use App\Models\Notification;
class Dchat extends Component
{
    public $scnd_party;
    public $messageText;


    public function render()
    {
        if(Auth::user()->type == "patient"){
            $messages = DocMessage::where('patient_id', Auth::user()->patient->id)->where('doctor_id', $this->scnd_party)->orderBy('created_at', 'asc')->get();

        }elseif(Auth::user()->type == "doctor"){
            $messages = DocMessage::where('doctor_id', Auth::user()->doctor->id)->where('patient_id', $this->scnd_party)->orderBy('created_at', 'asc')->get();

        }
        return view('livewire.chat', [
            'messages' => $messages,
        ]);
    }

    public function sendMessage()
    {   
        if(Auth::user()->type == "patient"){
            DocMessage::create([
                'sender' => Auth::user()->id,
                'patient_id' => Auth::user()->patient->id,
                'doctor_id' => $this->scnd_party,
                'message' => $this->messageText,
            ]);
        }elseif(Auth::user()->type == "doctor"){
            DocMessage::create([
                'sender' => Auth::user()->id,
                'doctor_id' => Auth::user()->doctor->id,
                'patient_id' => $this->scnd_party,
                'message' => $this->messageText,
            ]);
        }

        $this->messageText = '';
    }

}
