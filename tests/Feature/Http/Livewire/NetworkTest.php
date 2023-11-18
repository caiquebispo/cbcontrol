<?php

use App\Http\Livewire\Companies\Create as CompaniesCreate;
use App\Http\Livewire\Networks\{Create,ListNetworks,Show, Update};
use App\Http\Livewire\Users\Create as UsersCreate;
use App\Http\Livewire\Users\UpdatePassword;
use App\Models\Company;
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
it('verificar se ao clicar no componente para visualizar a rede o modal modal de visualização está sendo exibido', function(){

    Livewire::actingAs($this->user)
    ->test(Show::class)
    ->toggle('showModal')
    ->assertSee('Visualizar Rede');
});
it('verificar se no modal de edição de rede tem o compente para cadastro de usuário', function(){

    Livewire::actingAs($this->user)
    ->test(Update::class)
    ->toggle('showModal')
    ->assertSee('Editar Rede');

    Livewire::test(UsersCreate::class)
    ->assertSee('Cadastrar');
});
it('verificar se ao clicar no componente para cadastra um novo usuário o modal de cadastro está sendo exibido', function(){

    Livewire::actingAs($this->user)
        ->test(Update::class)
        ->toggle('showModal')
        ->assertSee('Editar Rede');

    Livewire::actingAs($this->user)
        ->test(UsersCreate::class)
        ->toggle('showModal')
        ->assertSee('Cadastrar Usuário');
});
it('validar se no cadastro de um usuarios está retornando erro caso as informações não sejam fornecida corretamente', function(){

    Livewire::actingAs($this->user)
    ->test(Update::class)
    ->toggle('showModal')
    ->assertSee('Editar Rede');

    Livewire::actingAs($this->user)
    ->test(UsersCreate::class)
    ->call('create')
    ->assertHasErrors();

});
it('verificar se o cadastro do usuário foi relalizado com sucesso e se ele foi associado a rede correta', function(){

    Livewire::actingAs($this->user)
    ->test(Update::class)
    ->toggle('showModal')
    ->assertSee('Editar Rede');

    Livewire::actingAs($this->user)
    ->test(UsersCreate::class, ['network' => $this->network])
    ->set('name', 'User Test')
    ->set('email', 'test@example.com')
    ->set('password', '12345678')
    ->set('password_confirm', '12345678')
    ->call('create')
    ->assertHasNoErrors();
    
    $this->assertDatabaseHas('users', [
        'email' => "test@example.com",
    ]);

});
it('verificar se o componente de cadastro de empresa está na tela', function(){

    Livewire::actingAs($this->user)
    ->test(Update::class)
    ->toggle('showModal')
    ->assertSee('Editar Rede');

    Livewire::test(CompaniesCreate::class)
    ->assertSee('Cadastrar Empresa');
});
it('verificar se ao clicar no componente de cadasto de empresa o modal está sendo exibido', function(){

    Livewire::actingAs($this->user)
    ->test(Update::class)
    ->toggle('showModal')
    ->assertSee('Editar Rede');

    Livewire::test(CompaniesCreate::class)
    ->toggle('showModal')
    ->assertSee('Cadastrar Empresa');
});
it('verificar se todas as infromações necessarias para cadastrar uma empresa estão preenchidas', function(){

    Livewire::actingAs($this->user)
    ->test(Update::class)
    ->toggle('showModal')
    ->assertSee('Editar Rede');

    Livewire::test(CompaniesCreate::class)
    ->toggle('showModal')
    ->call('create')
    ->assertHasErrors();
});
it('verificar se o cadastro de uma nova empresa foi relaizado com sucesso e se a empresa foi associada corretamente a rede', function(){

    Livewire::actingAs($this->user)
    ->test(Update::class)
    ->toggle('showModal')
    ->assertSee('Editar Rede');

    Livewire::test(CompaniesCreate::class,['network' => $this->network])
    ->toggle('showModal')
    ->set('corporate_reason', 'Company Teste')
    ->set('email', 'companyteste@teste.com')
    ->set('state_registration', 'BA')
    ->set('foundation_date', '2023-11-16')
    ->set('phone', '48 93411-9802')
    ->set('cnpj', '01.167.370/0111-01')
    ->call('create')
    ->assertHasNoErrors();

    $this->assertDatabaseHas('companies', [
        'corporate_reason' => "Company Teste",
        'cnpj' => "01.167.370/0111-01",
    ]);
    $this->assertDatabaseHas('network_companies', [
        'company_id' => 1,
        'network_id' => $this->network->id,
    ]);
});