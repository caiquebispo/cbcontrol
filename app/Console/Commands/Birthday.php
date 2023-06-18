<?php

namespace App\Console\Commands;

use App\Models\Client;
use Illuminate\Console\Command;


class Birthday extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'birthday:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a happy birthday notification to due users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $clients = Client::where('birthday', date('Y-m-d'))->get();
        foreach ($clients as $client) {

          
        }
    }
}
