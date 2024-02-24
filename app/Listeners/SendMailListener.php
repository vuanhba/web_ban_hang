<?php

namespace App\Listeners;

use App\Jobs\SendMailJob;
use App\Events\SendMailEvent;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailListener 
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SendMailEvent $event): void
    {
        SendMailJob::dispatch($event->data);
    }
}
