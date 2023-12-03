<?php

namespace App\Listeners;

use App\Events\AuthenticatedUser;
use DateTime;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Arr;

class SaveLogUserAuthenticated
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {}

    /**
     * Handle the event.
     */
    public function handle(AuthenticatedUser $event): void
    {
        
        $event->user->history_log()
        ->insert(
            [
                'user_id' => $event->user->id,
                'day' => (new DateTime())->format('Y-m-d'),  
                'login' => (new DateTime())->format('Y-m-d H:i:s'),
                'location' => json_encode($event->location != false ? Arr::except($event->location->toArray(), ['driver']): [], true)
            ]
        );
    }
    
}
