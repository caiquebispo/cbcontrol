<?php

namespace App\Http\Livewire\Companies;

use Livewire\Component;
use WireUi\Traits\Actions;

class Delete extends Component
{
    use Actions;

    public $company;

    public ?bool $showModal = false;

    public function delete(): void
    {
        $this->company->delete();
        $this->notifications();
        $this->reset();
    }

    public function notifications(): void
    {

        $this->notification()->success(
            'Parabéns!',
            'Empresa Deletado com sucesso!'
        );
    }

    public function render()
    {
        return view('livewire.companies.delete');
    }
}
