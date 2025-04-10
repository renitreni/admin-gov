<?php

namespace App\Livewire;

use App\Events\RescueEvent;
use Livewire\Component;

class EchoLivewire extends Component
{
    public function render()
    {
        return view('livewire.echo-livewire');
    }
}
