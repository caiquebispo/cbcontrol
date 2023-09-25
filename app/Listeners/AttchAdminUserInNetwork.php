<?php

namespace App\Listeners;

use App\Events\StorageNetwork;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
