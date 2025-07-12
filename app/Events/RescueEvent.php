<?php

namespace App\Events;

use App\Models\Rescue;
use App\Models\Worker;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class RescueEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct($message)
    {
        $worker = Worker::find($message['person']);
        Rescue::updateOrCreate([
            'passport' => $worker->passport_number,
            'rescue_status' => 'pending',
        ],
        [
            'passport' => $worker->passport_number,
            'rescue_description'=> 'From Urgent Response : ' . $worker->fullname,
            'location' => $message['location'],
            'rescue_status' => 'pending',
        ]);
        $this->message = $message;
    }

    public function broadcastOn()
    {
        return new Channel('rescue-channel');
    }

    public function broadcastWith()
    {
        return $this->message;
    }
}
