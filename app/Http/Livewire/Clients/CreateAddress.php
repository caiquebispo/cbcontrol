<?php

namespace App\Http\Livewire\Clients;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use WireUi\Traits\Actions;
use LivewireUI\Modal\ModalComponent;
use Livewire\Component;

class CreateAddress extends ModalComponent
{   
    use Actions;
    public ?object $user;

    public ?string $states = null;
    public ?string $zipe_code = null;
    public ?string $city = null;
    public ?string $road = null;
    public ?string $neighborhood = null;
    public ?int $number = null;
    public ?string $complement = null;
    
    protected $rules = [
        'states' => 'nullable|max:150',
        'zipe_code' => 'required|',
        'city' => 'nullable|required',
        'neighborhood' => 'nullable|required',
        'road' => 'nullable|required',
        'number' => 'nullable|required',
        'complement' => 'nullable|required',
    ];

    public function mount(User $user){

        $this->user = Auth::user();
    }
    public function render(): View
    {
        return view('livewire.clients.create-address');
    }

    public function create(): void
    {
        $this->validate();
        $this->user->address()->create($this->validate());
        $this->notifications();
        $this->reset();
        $this->closeModal(); 
    }
    public function notifications(): void
    {

        $this->notification()->success(
            $title = 'Parabéns!',
            $description = 'Endereço Cadastrado com sucesso!'
        ); 
        foreach(Auth::user()->company->users as $user){
            
            $notification = new \MBarlow\Megaphone\Types\General(
                'Cadastro de Endereço!',
                'O usuário(a) '.Auth::user()->name.' cadastrou o endereço de um usuário, na empresa '.$this->user->company->corporate_reason,
                
            );
            $user->notify($notification);
        }
    }
}
