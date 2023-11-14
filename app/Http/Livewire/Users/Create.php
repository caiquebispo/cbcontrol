<?php

namespace App\Http\Livewire\Users;

// use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use MBarlow\Megaphone\Types\General;
use WireUi\Traits\Actions;

class Create extends Component
{
    use Actions;
    public ?string $name = null;
    public ?string $number_phone = null;
    public ?string $email = null;
    public ?string $birthday = null;
    public ?string $password = null;
    public ?bool $showModal = false;
    public ?string $password_confirm = null;

    protected array $rules = [

        'name' => 'required|min:4|max:150',
        'number_phone' => 'nullable|max:16|unique:users',
        'email' => 'required|email|unique:users',
        'birthday' => 'nullable|date',
        'password' => 'required|min:8|max:16',
        'password_confirm' => 'required|min:8|max:16|same:password'

    ];

    public function render(): View
    {
        return view('livewire.users.create');
    }

    public function create(): void
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'number_phone' =>  $this->number_phone,
            'email' => $this->email,
            'birthday' => $this->birthday,
            'password' => $this->password,
            'company_id' => Auth::user()->company_id,
        ];

        Auth::user()->company->users()->create($data);
        $this->notifications();
        $this->reset();
        $this->emitTo(ListUsers::class, 'users::index::created');

    }
    public function notifications(): void
    {

        $this->notification()->success(
            'Parabéns!',
            'Usuário Cadastrado com sucesso!'
        );
        foreach(Auth::user()->company->users as $user){

            $notification = new General(
                'Cadastro de Usuário!',
                'O usuário(a) '.Auth::user()->name.' cadastrou um usuário na empresa '.Auth::user()->company->corporate_reason,

            );
            $user->notify($notification);
        }
    }
}
