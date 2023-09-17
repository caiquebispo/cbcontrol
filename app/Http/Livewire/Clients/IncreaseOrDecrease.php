<?php

namespace App\Http\Livewire\Clients;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use WireUi\Traits\Actions;

class IncreaseOrDecrease extends Component
{
    use Actions;
    public User $user;
    public ?int $type_increase_or_decrease = null;
    public ?float $value = null;
    public ?string $type =  null;
    public ?bool $showModal = false;
    public function __construct()
    {
        $this->user = Auth::user();
    }
    public function render(): View
    {
        return view('livewire.clients.increase-or-decrease');
    }

    public function update(): void
    {

        foreach ($this->user->company->clients as $client) {
            switch ($this->type_increase_or_decrease) {
                case 0:
                    $this->type = "Decréscimo";
                    $client->update(['value' => ($client->value - $this->value)]);
                    break;
                case 1:
                    $this->type = "Acréscimo";
                    $client->update(['value' => ($client->value + $this->value)]);
                    break;
            }
        }

        $this->notifications($this->type, $this->value);
        $this->reset();
        $this->emitTo(ListClient::class, 'client:index::increase-or-decrease');
    }
    public function notifications($type, $value){

        $this->notification()->success(
            $title = 'Parabéns!',
            $description = 'Valor Alterado com sucesso!'
        );
        foreach($this->user->company->users as $user){

            $notification = new \MBarlow\Megaphone\Types\General(
                'Atualização de Preço!',
                'O usuário(a) '.$this->user->name.' fez um '.$type. ' de R$ '. number_format($value, 2, ',','.').'  na empresa '.$this->user->company->corporate_reason,

            );
            $user->notify($notification);
        }
    }
}
