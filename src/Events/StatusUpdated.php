<?php

namespace TwentySixB\LaravelAccountStatus\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StatusUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @param \Illuminate\Database\Eloquent\Model $user
     * @param string $previous_state
     * @return void
     */
    public function __construct(
        protected Model $user,
        protected ? string $previous_state = null
    ) {}

    /**
     * Returns the User instance.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getUser() : Model
    {
        return $this->user;
    }

    /**
     * Returns the status before the update.
     *
     * @return string
     */
    public function getPreviousState() : string
    {
        return $this->previous_state ?? '';
    }
}
