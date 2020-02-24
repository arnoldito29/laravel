<?php

namespace App\Events;

use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LogEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var User
     */
    protected $user;

    /**
     * @var array
     */
    protected $params;

    /**
     * LogEvent constructor.
     * @param string $type
     * @param User $user
     * @param array $params
     */
    public function __construct(
        string $type,
        User $user,
        array $params
    ) {
        $this->user = $user;
        $this->type = $type;
        $this->params = $params;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }
}
