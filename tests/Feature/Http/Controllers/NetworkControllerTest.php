<?php

use App\Http\Livewire\Networks\Create;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\{get, actingAs};
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
        ->assertSee('Cadastrar');
});
it('verificar se ao clicar no botão cadastra o modal está sendo exibido', function(){

    Livewire::actingAs($this->user)
        ->test(Create::class)
        ->toggle('showModal')
        ->assertSee('Cadastrar Rede');

});
todo('verificar se no modal de criação tem o input de entrada');
todo('verificar se no modal de criação está mostrando os erros de validação');
todo('verificar se ouve o cadastro de uma nova rede');
todo('verificar se  está listando as redes cadastrada');
