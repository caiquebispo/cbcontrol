<?php

use App\Http\Livewire\Profiles\Create;
use App\Http\Livewire\Profiles\Delete;
use App\Http\Livewire\Profiles\ListProfiles;
use App\Models\Profile;
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
it('verificar se os dados estão devidamente preenchidos', function(){
    
    actingAs($this->user)
    ->get('/app/permissions')
    ->assertOk();

    Livewire::test(Create::class)
    ->toggle('showModal')
    ->call('create')
    ->assertHasErrors();
});
it('verificar se foi realizado o cadastro de um perfil com sucesso e se o evento foi desparado corretamente', function(){

    actingAs($this->user)
    ->get('/app/permissions')
    ->assertOk();
    
    Livewire::test(Create::class)
    ->toggle('showModal')
    ->set('name', "Perfil Base")
    ->call('create')
    ->assertHasNoErrors()
    ->assertEmittedTo(ListProfiles::class,'profiles::index::created');

    $this->assertDatabaseHas('profiles', [
        'id' => 1
    ]);
});
it('verficar se exite o componete para deletar um perfil na tela', function(){

    Livewire::test(Create::class)
    ->toggle('showModal')
    ->set('name', "Perfil Base")
    ->call('create')
    ->assertHasNoErrors()
    ->assertEmittedTo(ListProfiles::class,'profiles::index::created');

    actingAs($this->user)
    ->get('/app/permissions')
    ->assertOk()
    ->assertSeeLivewire(Delete::class);
});

it('verificar se ao clicar no componente para deletar um perfil o modal de alerta está sendo exibido', function(){
    
    Livewire::test(Create::class)
    ->toggle('showModal')
    ->set('name', "Perfil Base")
    ->call('create')
    ->assertHasNoErrors()
    ->assertEmittedTo(ListProfiles::class,'profiles::index::created');

    Livewire::actingAs($this->user)
    ->test(Delete::class)
    ->toggle('showModal')
    ->assertSee('Tem certeza de que deseja excluir');
});