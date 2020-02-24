<?php

namespace App\Listeners;

use App\Events\LogEvent;
use App\Services\LogService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogListener
{
    /**
     * LogListener constructor.
     * @param LogService $logService
     */
    public function __construct(LogService $logService)
    {
        $this->logService = $logService;
    }

    /**
     * @param LogEvent $event
     */
    public function handle(LogEvent $event)
    {
        $this->logService->addLog($event->getType(), $event->getUser(), $event->getParams());
    }
}
