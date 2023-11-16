<?php

namespace App\Http\Livewire\Companies;

use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use WireUi\Traits\Actions;

class Create extends Component
{
    use Actions;
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

    protected $rules =  [

        'corporate_reason' => 'required|min:4|max:150',
        'cnpj' =>  'nullable|string|min:4|unique:companies,cnpj',
        'email' => 'nullable|string|min:4|unique:companies,email',
        'phone' => 'nullable|string|min:4|unique:companies,phone',
        'state_registration' => 'nullable|required|string',
        'site' => 'nullable|url',
        'foundation_date' => 'nullable|date',
    ];

    public function create(): void
    {
        
       $validated =  $this->validate();
       $company = Company::create($validated);
       $this->network->companies()->attach($company);
       $this->reset();
       $this->notifications();
        
    }
    public function notifications()
    {
        $this->notification()->success(
            'Parabéns!',
            'Você cadastrou uma nova empresa!'
        ); 
    }
    public function render()    
    {   
        return view('livewire.companies.create');
    }
}
