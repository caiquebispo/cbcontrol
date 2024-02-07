<?php

namespace App\Listeners;

use App\Events\UnaAuthenticated;
use DateTime;
use Illuminate\Support\Arr;

class SaveLogUserUnaAuthenticated
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(UnaAuthenticated $event): void
    {

        $las_access_day = $event->user->history_log()
            ->whereDate('day', (new DateTime('now'))->format('Y-m-d'))
            ->orderBy('login', 'desc')
            ->first();

        if ($las_access_day) {

            $las_access_day->update([
                'logout' => (new DateTime('now'))->format('Y-m-d H:i:s'),
                'location' => json_encode($event->location != false ? Arr::except($event->location->toArray(), ['driver']) : [], true),
            ]);

            $las_access_day->save();
        }
    }
}
