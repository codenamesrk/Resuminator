<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\User;

class ResumeUploaded extends Event
{
    use SerializesModels;
    public $user, $originalName, $fileAlias, $parent;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, $orgName, $alias, $parent)
    {
        $this->user = $user;
        $this->originalName = $orgName;
        $this->fileAlias = $alias;
        $this->parent = $parent;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
