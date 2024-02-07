<?php

namespace App\Listeners;

use App\Events\StorageNetwork;

class AttchAdminUserInNetwork
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
    public function handle(StorageNetwork $event): void
    {
        //        dd($event);
    }
}
