<?php

namespace App\Http\Livewire\Companies;

use Livewire\Component;

class Create extends Component
{
    public $network;
    public ?bool $showModal = false;
    public ?string $corporate_reason = null;
    public ?string $cnpj = null;
    public ?string $state_registration = null;
    public ?string $foundation_date = null;
    public ?string $email = null;
    public ?string $phone = null;
    public ?string $site = null;
    public ?bool $status = null;

    public function rules()
    {
        return [

            'corporate_reason' => 'required|min:4|max:150',
            'cnpj' =>  'nullable|string|min:4|unique:companies,cnpj',
            'email' => 'nullable|string|min:4|unique:companies,email',
            'phone' => 'nullable|string|min:4|unique:companies,phone',
            'state_registration' => 'required|string',
            'site' => 'nullable|url',
            'foundation_date' => 'nullable|date',
            'status' => 'required',
        ];
    }
    public function create(): void
    {
        
        $this->validate();
        
    }
    public function render()    
    {   
        return view('livewire.companies.create');
    }
}
