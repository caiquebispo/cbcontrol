<?php

namespace App\Console\Commands;

use App\Models\Order;
use DateTime;
use Illuminate\Console\Command;

class VerifyDuetDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:verify-duet-day';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $orders = Order::with('company.users', 'client')
            ->where([
                ['payment_status', 'pending'],
                ['duet_day', '<=', (new DateTime('now'))->format('Y-m-d')]
            ])
            ->get();

        foreach ($orders as $order) {
            foreach ($order->company->users as $user) {

                $notification = new \MBarlow\Megaphone\Types\General(
                    'Vencimento de Conta!',
                    'Aviso entre em contato com o cliente ' . $order->client->full_name . ' a compra que foi realizada vence/e ou venceceu no dia ' . (new DateTime($order->duet_day))->format('d/m/Y') . ', contato: ' . $order->client->number_phone,

                );
                $user->notify($notification);
            }
        }
    }
}
