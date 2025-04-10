<?php

namespace App\Livewire\Workers;

use App\Events\RescueEvent;
use Livewire\Component;

class EmergecyButtonLivewire extends Component
{
    public function render()
    {
        return view('livewire.workers.emergecy-button-livewire');
    }

    public function testPush()
    {
        broadcast(new RescueEvent(['person' => '1', 'location' => '{1232134,123123}']));
    }
}
