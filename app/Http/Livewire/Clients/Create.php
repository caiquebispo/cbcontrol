<?php

namespace App\Http\Livewire\Clients;


use App\Models\User;
use DateTime;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class Create extends Component
{
    use Actions;
    public User $user;

    public ?string $full_name = null;
    public ?string $number_phone = null;
    public ?float $value = null;
    public ?string $payment_method = null;
    public ?string $local = null;
    public ?string $delivery = null;
    public ?string $birthday = null;
    public ?int $group_id = null;
    public bool $showModal = false;
    protected $rules = [

        'full_name' => 'required|min:4|max:150',
        'number_phone' => 'nullable|max:16',
        'value' => 'required',
        'payment_method' => 'required|min:4|max:16',
        'delivery' => 'required|min:4|max:16',
        'local' => 'string',
        'birthday' => 'nullable|date',
    ];

    public function __construct()
    {
        $this->user = Auth::user();
    }
    public function render(): View
    {
        $groups = $this->user->company->groups;
        return view('livewire.clients.create', compact('groups'));
    }
    public function create(): void
    {

        $validated = $this->validate();
        $this->user->company->clients()->create($validated)->groups()->attach($this->group_id);
        $this->notifications();
        $this->reset();
        $this->emitTo(ListClient::class, 'client::index::created');
    }
    public function notifications(){

        $this->notification()->success(
            $title = 'Parabéns!',
            $description = 'Cliente Cadastrado com sucesso!'
        );
        foreach($this->user->company->users as $user){

            $notification = new \MBarlow\Megaphone\Types\General(
                'Cadastro de cliente!',
                'O usuário(a) '.$this->user->name.' cadastrou um novo cliente na empresa '.$this->user->company->corporate_reason, // Notification Body

            );
            $user->notify($notification);
        }
    }

}
