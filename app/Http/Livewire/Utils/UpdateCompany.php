<?php

namespace App\Http\Livewire\Utils;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use WireUi\Traits\Actions;

class UpdateCompany extends Component
{
    public ?int $company_id = null;

    public ?bool $showComponentChangeCompany = false;

    public User $user;

    use Actions;

    protected $listeners = [
        'changeCompany',
    ];

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function render()
    {
        return view('livewire.utils.update-company');
    }

    public function changeCompany()
    {

        $this->user->update(['company_id' => $this->company_id]);
        $this->notification()->success(
            $title = 'Parabéns!',
            $description = 'Você mudou de empresa, iremos lhe redirecionar!'
        );

        return redirect()->to('/');
    }
}
