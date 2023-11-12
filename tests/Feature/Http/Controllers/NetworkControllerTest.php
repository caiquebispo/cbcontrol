<?php

use App\Http\Livewire\Networks\Create;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\{get, actingAs};;
beforeEach(function(){
    $this->user = User::factory()->createOne();
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
it('verificar se o nome da rede tem pelo menos 4 letras', function(){

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
todo('verificar se no modal de criação tem o input de entrada');
todo('verificar se ouve o cadastro de uma nova rede');
todo('verificar se  está listando as redes cadastrada');
