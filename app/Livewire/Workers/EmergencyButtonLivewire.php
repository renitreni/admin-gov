<?php

namespace App\Livewire\Workers;

use App\Events\RescueEvent;
use Livewire\Component;

class EmergencyButtonLivewire extends Component
{
    public $lat;

    public $lng;

    public function render()
    {
        return view('livewire.workers.emergency-button-livewire');
    }

    public function sendEmergency()
    {
        broadcast(new RescueEvent(['person' => '1', 'location' => "https://www.google.com/maps?q=$this->lat,$this->lng"]));
    }
}
