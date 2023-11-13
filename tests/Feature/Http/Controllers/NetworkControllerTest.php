<?php

use App\Http\Livewire\Networks\Create;
use App\Http\Livewire\Networks\Delete;
use App\Http\Livewire\Networks\ListNetworks;
use App\Http\Livewire\Networks\Show;
use App\Http\Livewire\Networks\Update;
use App\Models\Network;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\{get, actingAs, assertDatabaseHas, assertEquals};;
beforeEach(function(){
    $this->user = User::factory()->createOne();
    $this->network = Network::factory()->createOne();
});

it('verifica se somente usuário logado pode acessar a rota', function () {
    
    actingAs($this->user)
        ->get('/app/networks')
        ->assertOk();
});
it('verifica se o usuário não logado está sendo redirecionando para login', function () {

    get('/app/networks')
        ->assertFound()
        ->assertRedirect('login');
});
it('verificar se existe o componente para criar uma nova rede está na tela', function () {

    actingAs($this->user)
        ->get('/app/networks')
        ->assertOk()
        ->assertSeeLivewire(Create::class);
});
it('verificar se ao clicar no botão cadastra o modal está sendo exibido', function(){

    Livewire::actingAs($this->user)
        ->test(Create::class)
        ->toggle('showModal')
        ->assertSee('Cadastrar Rede');

});
it('verificar se o nome da rede está preenchido', function(){
    
    Livewire::actingAs($this->user)
    ->test(Create::class)
    ->set('name', '')
    ->call('create')
    ->assertHasErrors(['name' => 'required']);
    
});
it('verificar se o nome da rede tem pelomenos 4 letras', function(){

    Livewire::actingAs($this->user)
    ->test(Create::class)
    ->set('name', 'abc')
    ->call('create')
    ->assertHasErrors(['name' => 'min']);
});
it('verificar se o nome da rede tem menos de 150 letras', function(){

    Livewire::actingAs($this->user)
    ->test(Create::class)
    ->set('name', str_repeat('abc',150))
    ->call('create')
    ->assertHasErrors(['name' => 'max']);
});
it('verificar se o nome da rede é único', function(){

    Livewire::actingAs($this->user)
    ->test(Create::class)
    ->set('name', 'abc')
    ->call('create')
    ->assertHasNoErrors(['name' => 'unique']);
});
it('verificar se cadastrou a rede com sucesso!', function(){

    
    $this->user->networks()->attach($this->network);

    Livewire::actingAs($this->user)
    ->test(Create::class)
    ->set('name', '{$this->network->name}')
    ->call('create')
    ->assertHasNoErrors('name')
    ->assertEmittedTo(ListNetworks::class,'network::index::created');
    
    $this->assertDatabaseHas('networks',[
        'name' => $this->network->name
    ]);

});

it('verificar se está listando as redes cadastrada', function(){

    $this->user->networks()->attach($this->network);

    Livewire::actingAs($this->user)
    ->test(ListNetworks::class)
    ->assertViewHas('networks')
    ->assertSee($this->network->name);
    
});
it('verificar se o componente de edição  está na tela', function(){

    $this->user->networks()->attach($this->network);

    actingAs($this->user)
    ->get('/app/networks')
    ->assertOk()
    ->assertSeeLivewire(Update::class);
});
it('verificar se ao clicar no compoente para editar a rede o modal modal de edição está sendo exibido', function(){

    Livewire::actingAs($this->user)
    ->test(Update::class)
    ->toggle('showModal')
    ->assertSee('Editar Rede');
});
it('verificar se o componente de visualizar rede está na tela', function(){

    $this->user->networks()->attach($this->network);

    actingAs($this->user)
    ->get('/app/networks')
    ->assertOk()
    ->assertSeeLivewire(Show::class);
});

