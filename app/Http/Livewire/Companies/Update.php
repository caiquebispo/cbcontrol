<?php

namespace App\Http\Livewire\Companies;

use App\Models\Company;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use WireUi\Traits\Actions;

class Update extends Component
{
    use Actions;

    public Company $company;

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

            'company.corporate_reason' => 'required|min:4|max:150',
            'company.cnpj' => 'nullable|string|min:4|unique:companies,cnpj,'.$this->company->id,
            'company.email' => 'nullable|string|min:4|unique:companies,email,'.$this->company->id,
            'company.phone' => 'nullable|string|min:4|unique:companies,phone,'.$this->company->id,
            'company.state_registration' => 'required|string',
            'company.site' => 'nullable|url',
            'company.foundation_date' => 'nullable|date',
            'company.status' => 'required',
        ];
    }

    public function __construct()
    {
        $this->company = Auth::user()->company;

    }

    public function render(): View
    {

        return view('livewire.companies.update');
    }

    public function update(): void
    {

        $this->validate();
        $this->company->save();
        $this->notifications();

    }

    public function notifications()
    {

        $this->notification()->success(
            $title = 'Parabéns!',
            $description = 'Você atualizou as inforamções da empresa!'
        );
        foreach ($this->company->users as $user) {

            $notification = new \MBarlow\Megaphone\Types\General(
                'Atualização de informação da empresa!',
                'O usuário(a) '.Auth::user()->name.' editou as informações da empresa na empresa '.$this->company->corporate_reason,

            );
            $user->notify($notification);
        }
    }
}
