<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Command; 


class CommandeValidee implements ShouldBroadcast
{
    use SerializesModels;

    public $command;

    public function __construct(Command $command)
    {
        $this->command = $command;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('user.commands.' . $this->command->user_id);
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->command->id,
            'status' => $this->command->status,
            'message' => 'Commande validée ! 🎉'
        ];
    }
}


