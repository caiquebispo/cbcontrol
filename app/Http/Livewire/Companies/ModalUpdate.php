<?php

namespace App\Http\Livewire\Companies;

use App\Models\Company;
use Livewire\Component;
use WireUi\Traits\Actions;

class ModalUpdate extends Component
{
    use Actions;
    public $company;
    public ?string $corporate_reason = null;
    public ?string $cnpj = null;
    public ?string $state_registration = null;
    public ?string $foundation_date = null;
    public ?string $email = null;
    public ?string $phone = null;
    public ?string $site = null;
    public ?bool $status = null;
    public ?bool $showModal = false;

    public function rules()
    {
        return [

            'company.corporate_reason' => 'required|min:4|max:150',
            'company.cnpj' =>  'nullable|string|min:4|unique:companies,cnpj,' . $this->company->id,
            'company.email' => 'nullable|string|min:4|unique:companies,email,' . $this->company->id,
            'company.phone' => 'nullable|string|min:4|unique:companies,phone,' . $this->company->id,
            'company.state_registration' => 'required|string',
            'company.site' => 'nullable|url',
            'company.foundation_date' => 'nullable|date',
            'company.status' => 'required',
        ];
    }
    public function update(): void
    {   
        $this->validate();
        $this->company->save();
        $this->notifications();
        $this->reset();
        
    }
    public function notifications(){

        $this->notification()->success(
            $title = 'Parabéns!',
            $description =  'Você atualizou as inforamções da empresa!'
        );
    }
    public function render()
    {
        return view('livewire.companies.modal-update');
    }
}
