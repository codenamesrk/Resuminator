<?php

namespace App\Listeners;

use App\Events\ResumeUploaded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Resume;

class RegisterResume
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
     * @param  ResumeUploaded  $event
     * @return void
     */
    public function handle(ResumeUploaded $event)
    {
        $resume = Resume::create([
            'name' => $event->fileAlias,
            'original_name' => $event->originalName,
            'review_id' => 1,
            'parent' => $event->parent,            
        ]);
        $event->user->resumes()->save($resume);
        $payment = $event->user->payments()->get()->last();
        $payment->resume()->save($resume);
    }
}
