<?php

namespace App\Console\Commands;

use App\Models\Client;
use App\Models\Notify;
use App\Models\User;
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
        $clients = Client::where('birthday', 'like', '%'.date('m-d').'%')->get();
       
        foreach ($clients as $client) {

            foreach($client->companies as  $company){
                foreach($company->users as $user){
                    
                    $notification = new \MBarlow\Megaphone\Types\General(
                        'Felicitação!',
                        'O cliente '.$client->full_name.' está completando idade hoje, deseje-o(a) felicitações', // Notification Body
                        
                    );
                    $user->notify($notification);
                }
            };
        }
    }
}
