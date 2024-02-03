<?php

use App\Http\Livewire\Modules\Create;
use App\Http\Livewire\Modules\Delete;
use App\Http\Livewire\Modules\ListModules;
use App\Http\Livewire\Modules\Profiles;
use App\Http\Livewire\Modules\Toggle;
use App\Http\Livewire\Modules\Update;
use App\Models\Module;
use App\Models\Profile;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

beforeEach(function () {

    $this->user = User::factory()->createOne();
});

it('verificar se somente usuários autendicado podem  acessar a rota', function () {

    actingAs($this->user)
        ->get('/app/permissions')
        ->assertViewIs('permissions.index');
});
it('verificar se usuários não autenticados estão sendo redirecionados para pagina de login', function () {

    get('/app/permissions')
        ->assertFound()
        ->assertRedirect('login');
});
it('verificar se o componente de listagem de modules/permissions está na tela', function () {

    actingAs($this->user)
        ->get('/app/permissions')
        ->assertOk()
        ->assertSeeLivewire(ListModules::class);
});
it('verificar se o componente para criar uma nova permissão está na tela', function () {

    actingAs($this->user)
        ->get('/app/permissions')
        ->assertOk()
        ->assertSeeLivewire(Create::class);
});
it('verificar se ao clicar no componente para cirar uma novoa permissão o modal está sendo exibido corretamente', function () {

    actingAs($this->user)
        ->get('/app/permissions')
        ->assertOk();

    Livewire::test(Create::class)
        ->toggle('showModal')
        ->assertSee('Cadastrar Módulo ou Permissão');
});
it('verificar se os todos os dados fornecido pelo usuário estão correto e passando pelas validações', function () {

    actingAs($this->user)
        ->get('/app/permissions')
        ->assertOk();

    Livewire::test(Create::class)
        ->toggle('showModal')
        ->call('create')
        ->assertHasErrors();
});
it('verificar se a permissão foi cadastrada com sucesso e o evento para recarregar a listagem foi disparado', function () {

    actingAs($this->user)
        ->get('/app/permissions')
        ->assertOk();

    Livewire::test(Create::class)
        ->set('name', 'Categorias')
        ->set('label', 'categories')
        ->set('url', '/app/categories')
        ->set('menu_name', 'Produtos')
        ->set('order_list', 1)
        ->set('is_module', 1)
        ->call('create')
        ->assertHasNoErrors()
        ->assertEmittedTo(ListModules::class, 'module::index::created');

    $this->assertDatabaseHas('modules', [
        'id' => 1,
    ]);
});
it('verificar se o componente para editar uma permisão está em tela', function () {

    Livewire::test(Create::class)
        ->set('name', 'Categorias')
        ->set('label', 'categories')
        ->set('url', '/app/categories')
        ->set('menu_name', 'Produtos')
        ->set('order_list', 1)
        ->set('is_module', 1)
        ->call('create')
        ->assertHasNoErrors()
        ->assertEmittedTo(ListModules::class, 'module::index::created');

    actingAs($this->user)
        ->get('/app/permissions')
        ->assertOk()
        ->assertSeeLivewire(Update::class);

});
it('verificar se ao clicar no componente para editar uma permissão o modal está  sendo exibido corretamente', function () {

    Livewire::test(Create::class)
        ->set('name', 'Categorias')
        ->set('label', 'categories')
        ->set('url', '/app/categories')
        ->set('menu_name', 'Produtos')
        ->set('order_list', 1)
        ->set('is_module', 1)
        ->call('create')
        ->assertHasNoErrors()
        ->assertEmittedTo(ListModules::class, 'module::index::created');

    Livewire::actingAs($this->user)
        ->test(Update::class)
        ->toggle('showModal')
        ->assertSee('Editar Módulo ou Permissão');
});
it('verificar se todos os dados fornecido na edição estão sendo validados corretamente', function () {

    Livewire::test(Create::class)
        ->set('name', 'Categorias')
        ->set('label', 'categories')
        ->set('url', '/app/categories')
        ->set('menu_name', 'Produtos')
        ->set('order_list', 1)
        ->set('is_module', 1)
        ->call('create')
        ->assertHasNoErrors()
        ->assertEmittedTo(ListModules::class, 'module::index::created');

    Livewire::test(Update::class)
        ->toggle('showModal')
        ->call('update')
        ->assertHasErrors();
});
it('verificar se a permissão foi editada com sucesso e o evento para recarregar a listagem foi disparado', function () {

    $module = Module::factory()->createOne();

    Livewire::test(Create::class)
        ->set('name', 'Categorias')
        ->set('label', 'categories')
        ->set('url', '/app/categories')
        ->set('menu_name', 'Produtos')
        ->set('order_list', 1)
        ->set('is_module', 1)
        ->call('create')
        ->assertHasNoErrors()
        ->assertEmittedTo(ListModules::class, 'module::index::created');

    Livewire::test(Update::class, ['module' => $module])
        ->toggle('showModal')
        ->set('module.name', 'Categorias - EDITADO')
        ->set('module.label', 'categories')
        ->set('module.url', '/app/categories')
        ->set('module.menu_name', 'Produtos')
        ->set('module.order_list', 1)
        ->set('module.is_module', 1)
        ->call('update')
        ->assertHasNoErrors()
        ->assertEmittedTo(ListModules::class, 'module::index::updated');

    $this->assertDatabaseHas('modules', [

        'name' => 'Categorias - EDITADO',
    ]);
});
it('verificar se o componente para deletar uma permissão está em tela', function () {
    Livewire::test(Create::class)
        ->set('name', 'Categorias')
        ->set('label', 'categories')
        ->set('url', '/app/categories')
        ->set('menu_name', 'Produtos')
        ->set('order_list', 1)
        ->set('is_module', 1)
        ->call('create')
        ->assertHasNoErrors()
        ->assertEmittedTo(ListModules::class, 'module::index::created');

    actingAs($this->user)
        ->get('/app/permissions')
        ->assertOk()
        ->assertSeeLivewire(Delete::class);
});
it('verificar se ao clicar no componente para deletar uma permissão o modal de alerta está sendo exibido', function () {

    Livewire::test(Create::class)
        ->set('name', 'Categorias')
        ->set('label', 'categories')
        ->set('url', '/app/categories')
        ->set('menu_name', 'Produtos')
        ->set('order_list', 1)
        ->set('is_module', 1)
        ->call('create')
        ->assertHasNoErrors()
        ->assertEmittedTo(ListModules::class, 'module::index::created');

    Livewire::actingAs($this->user)
        ->test(Delete::class)
        ->toggle('showModal')
        ->assertSee('Tem certeza de que deseja excluir');
});
it('verificar se a permissão foi deletada e o evento para recarregar a listagem foi disparado', function () {

    $module = Module::factory()->createOne();

    Livewire::actingAs($this->user)
        ->test(Delete::class, ['module' => $module])
        ->toggle('showModal')
        ->call('delete')
        ->assertEmittedTo(ListModules::class, 'module::index::deleted')
        ->assertDontSee($module->name);

    $this->assertDatabaseCount('modules', 0);
});
it('verificar se o componente para associar um perfil a uma permissão está em tela', function () {

    Livewire::test(Create::class)
        ->set('name', 'Categorias')
        ->set('label', 'categories')
        ->set('url', '/app/categories')
        ->set('menu_name', 'Produtos')
        ->set('order_list', 1)
        ->set('is_module', 1)
        ->call('create')
        ->assertHasNoErrors()
        ->assertEmittedTo(ListModules::class, 'module::index::created');

    actingAs($this->user)
        ->get('/app/permissions')
        ->assertOk()
        ->assertSeeLivewire(Profiles::class);
});
it('verificar se ao clicar no componente associar uma permissão a uma perfil o modal de alerta está sendo exibido', function () {

    $profile = Profile::factory()->createOne();
    $module = Module::factory()->createOne();

    Livewire::test(Create::class)
        ->set('name', 'Categorias')
        ->set('label', 'categories')
        ->set('url', '/app/categories')
        ->set('menu_name', 'Produtos')
        ->set('order_list', 1)
        ->set('is_module', 1)
        ->call('create')
        ->assertHasNoErrors()
        ->assertEmittedTo(ListModules::class, 'module::index::created');

    Livewire::actingAs($this->user)
        ->test(Profiles::class, ['profile' => $profile, 'module' => $module])
        ->toggle('showModal')
        ->assertSee('Adicionar permissão');
});
it('verificar se ao clicar no componente toggle uma permissão foi associada ao perfil e se o evento foi desparado', function () {

    $profile = Profile::factory()->createOne();
    $module = Module::factory()->createOne();

    Livewire::test(Create::class)
        ->set('name', 'Categorias')
        ->set('label', 'categories')
        ->set('url', '/app/categories')
        ->set('menu_name', 'Produtos')
        ->set('order_list', 1)
        ->set('is_module', 1)
        ->call('create')
        ->assertHasNoErrors()
        ->assertEmittedTo(ListModules::class, 'module::index::created');

    Livewire::actingAs($this->user)
        ->test(Toggle::class, ['profile' => $profile, 'module' => $module])
        ->call('attach')
        ->assertHasNoErrors()
        ->assertEmittedTo(Profiles::class, 'profile::index::attach');

    $this->assertDatabaseHas('module_profiles', [

        'module_id' => $module->id,
        'profile_id' => $profile->id,
    ]);
});
it('verificar se ao clicar no componente toggle uma permissão foi removida do perfil e se o evento foi desparado', function () {

    $profile = Profile::factory()->createOne();
    $module = Module::factory()->createOne();

    Livewire::test(Create::class)
        ->set('name', 'Categorias')
        ->set('label', 'categories')
        ->set('url', '/app/categories')
        ->set('menu_name', 'Produtos')
        ->set('order_list', 1)
        ->set('is_module', 1)
        ->call('create')
        ->assertHasNoErrors()
        ->assertEmittedTo(ListModules::class, 'module::index::created');

    Livewire::actingAs($this->user)
        ->test(Toggle::class, ['profile' => $profile, 'module' => $module])
        ->call('detach')
        ->assertHasNoErrors()
        ->assertEmittedTo(Profiles::class, 'profile::index::detach');

    $this->assertDatabaseCount('module_profiles', 0);
});
