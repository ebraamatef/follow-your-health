<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\labMessage;

use App\Models\Notification;
class Lchat extends Component
{
    public $scnd_party;
    public $messageText;


    public function render()
    {
        if(Auth::user()->type == "patient"){
            $messages = labMessage::where('patient_id', Auth::user()->patient->id)->where('lab_id', $this->scnd_party)->orderBy('created_at', 'asc')->get();

        }elseif(Auth::user()->type == "lab"){
            $messages = labMessage::where('lab_id', Auth::user()->lab->id)->where('patient_id', $this->scnd_party)->orderBy('created_at', 'asc')->get();

        }
        return view('livewire.chat', [
            'messages' => $messages,
        ]);
    }

    public function sendMessage()
    {   
        if(Auth::user()->type == "patient"){
            labMessage::create([
                'sender' => Auth::user()->id,
                'patient_id' => Auth::user()->patient->id,
                'lab_id' => $this->scnd_party,
                'message' => $this->messageText,
            ]);
        }elseif(Auth::user()->type == "lab"){
            labMessage::create([
                'sender' => Auth::user()->id,
                'lab_id' => Auth::user()->lab->id,
                'patient_id' => $this->scnd_party,
                'message' => $this->messageText,
            ]);
        }

        $this->messageText = '';
    }

}
