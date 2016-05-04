<?php

namespace App\Listeners;

use App\Events\ReportGenerated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyUser implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ReportGenerated  $event
     * @return void
     */
    public function handle(ReportGenerated $event)
    {
         \Log::info("REPORT OF USER {$event->user->email} GENERATED ");
    }
}
