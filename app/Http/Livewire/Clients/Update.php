<?php

namespace App\Http\Livewire\Clients;

use App\Models\Client;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use WireUi\Traits\Actions;

class Update extends Component
{
    use Actions;

    public Client $client;

    public User $user;

    public ?bool $showModal = false;

    public ?string $full_name = null;

    public ?string $number_phone = null;

    public ?float $value = null;

    public ?string $payment_method = null;

    public ?string $local = null;

    public ?string $delivery = null;

    public ?string $birthday = null;

    public ?int $group_id = null;

    public function rules()
    {

        return [

            'client.full_name' => 'required|min:4|max:150',
            'client.number_phone' => 'nullable|string|min:4|unique:clients,number_phone,'.$this->client->id,
            'client.value' => 'required',
            'client.payment_method' => 'required|min:4|max:16',
            'client.delivery' => 'required|min:4|max:16',
            'client.local' => 'string',
            'client.birthday' => 'nullable|date',
        ];
    }

    public function __construct()
    {
        $this->client = new Client;
        $this->user = Auth::user();
    }

    public function render(): View
    {
        $groups = $this->user->company->groups;

        return view('livewire.clients.update', compact('groups'));
    }

    public function update(): void
    {

        $this->validate();
        $this->client->save();
        $this->client->groups()->detach();
        $this->client->groups()->attach($this->group_id);

        $this->notifications();
        $this->reset();
        $this->emitTo(ListClient::class, 'client::index::updated');
    }

    public function notifications()
    {

        $this->notification()->success(
            $title = 'Parabéns!',
            $description = 'Cliente Editado com sucesso!'
        );
        foreach ($this->user->company->users as $user) {

            $notification = new \MBarlow\Megaphone\Types\General(
                'Atualização de cliente!',
                'O usuário(a) '.$this->user->name.' editou as informações do cliente '.$this->client->full_name.' na empresa '.$this->user->company->corporate_reason, // Notification Body

            );
            $user->notify($notification);
        }
    }
}
