<?php

namespace App\Listeners;
use Carbon\Carbon;

class UserEventListener {
    /**
     * Handles user login events
     * @param  [type] $event [description]
     * @return [type]        [description]
     */
    public function onUserLogin($event)
    {
        // \Log::info('User has logged in');
        $event->user->last_login = Carbon::now();
        $event->user->ip = \Request::ip();
        $event->user->save();
    }

    /**
     * Handles User logout events
     * @param  [type] $event [description]
     * @return [type]        [description]
     */
    public function onUserLogout($event)
    {
         // \Log::info('User has logged out' . $event->user->email );
    }

    /**
     * Registers the Listeners for the subscriber
     * @return [type] [description]
     */
    public function subscribe($events)
    {
        $events->listen(
            'Illuminate\Auth\Events\Login',
            'App\Listeners\UserEventListener@onUserLogin'
        );
        $events->listen(
            'Illuminate\Auth\Events\Logout',
            'App\Listeners\UserEventListener@onUserLogout'
        );        
    }
}