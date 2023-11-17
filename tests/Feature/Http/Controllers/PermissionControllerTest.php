<?php

use App\Http\Livewire\Profiles\Create;
use App\Http\Livewire\Profiles\ListProfiles;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\{actingAs, get,};
beforeEach(function(){
    
    $this->user = User::factory()->createOne();
});

it('verificar se somente usuários autenticado podem acessar essa rota', function(){

    actingAs($this->user)
    ->get('/app/permissions')
    ->assertOk()
    ->assertViewIs('permissions.index');
});
it('verificar se usuários não autenticados estão sendo redirecionando para pagina de login', function(){

    get('/app/permissions')
    ->assertFound()
    ->assertRedirect('login');
});
it('verificar se na pagina tem o componente para criação de um perfil', function(){

    actingAs($this->user)
    ->get('/app/permissions')
    ->assertOk()
    ->assertSeeLivewire(ListProfiles::class)
    ->assertSeeLivewire(Create::class);
});
it('verificar se ao clicar no componente o modal para cadastro de perfil está sendo exibido corretamente', function(){

    actingAs($this->user)
    ->get('/app/permissions')
    ->assertOk();
    
    Livewire::test(Create::class)
    ->toggle('showModal')
    ->assertSee('Cadastrar Perfil');

});
todo('verificar se os dados estão devidamente preenchidos');
todo('verificar se foi realizado o cadastro de um perfil com sucesso e se o evento foi desparado corretamente');

//Permission "Modules" Tests

