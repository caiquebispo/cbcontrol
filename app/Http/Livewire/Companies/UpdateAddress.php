<?php

namespace App\Http\Livewire\Companies;

use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use WireUi\Traits\Actions;

class UpdateAddress extends Component
{
    use Actions;
    public Address $address;
    public ?string $states = null;
    public ?string $zipe_code = null;
    public ?string $city = null;
    public ?string $road = null;
    public ?string $neighborhood = null;
    public ?int $number = null;

    protected function getListeners(): array
    {
        return array_merge(
            parent::getListeners(),
            [
                'address::index::deleted' => '$refresh',
                'address::index::created' => '$refresh',
                'address::index::updated' => '$refresh',
            ]
        );
    }
    protected $rules = [
        'address.states' => 'nullable|max:150',
        'address.zipe_code' => 'required|',
        'address.city' => 'nullable|required',
        'address.neighborhood' => 'nullable|required',
        'address.road' => 'nullable|required',
        'address.number' => 'nullable',
        'address.complement' => 'nullable',
    ];
    public function __construct()
    {
        if(count(Auth::user()->company->address) > 0){
            $this->address = Auth::user()->company->address->first();
        }
    }
    public function render()
    {
        return view('livewire.companies.update-address');
    }
    public function update(): void
    {
        $this->validate();
        $this->address->save();
        $this->notifications();
    }
    public function notifications(): void
    {

        $this->notification()->success(
            $title = 'Parabéns!',
            $description = 'Endereço Atualizado com sucesso!'
        ); 
        foreach(Auth::user()->company->users as $user){
            
            $notification = new \MBarlow\Megaphone\Types\General(
                'Cadastro de Endereço!',
                'O usuário(a) '.Auth::user()->name.' atualizou o endereço de uma empresa ',
            );
            $user->notify($notification);
        }
    }
}
