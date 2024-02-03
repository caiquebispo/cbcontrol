<?php

namespace App\Http\Livewire\Utils\Address;

use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class Update extends ModalComponent
{
    use Actions;

    public $address;

    public ?string $states = null;

    public ?string $zipe_code = null;

    public ?string $city = null;

    public ?string $road = null;

    public ?string $neighborhood = null;

    public ?int $number = null;

    public ?string $complement = null;

    protected $rules = [
        'address.states' => 'nullable|max:150',
        'address.zipe_code' => 'required|',
        'address.city' => 'nullable|required',
        'address.neighborhood' => 'nullable|required',
        'address.road' => 'nullable|required',
        'address.number' => 'nullable',
        'address.complement' => 'nullable',
    ];

    public function mount(Address $address)
    {
        $this->address = $address;
    }

    public function render()
    {
        return view('livewire.utils.address.update');
    }

    public function update(): void
    {

        $this->validate();
        $this->address->save();
        $this->notifications();
        $this->reset();
        $this->emit('address::index::updated');
        $this->closeModal();
    }

    public function notifications(): void
    {

        $this->notification()->success(
            $title = 'Parabéns!',
            $description = 'Endereço Atualizado com sucesso!'
        );
        foreach (Auth::user()->company->users as $user) {

            $notification = new \MBarlow\Megaphone\Types\General(
                'Cadastro de Endereço!',
                'O usuário(a) '.Auth::user()->name.' cadastrou o endereço de um usuário, na empresa '.Auth::user()->company->corporate_reason,
            );
            $user->notify($notification);
        }
    }
}
