<?php

use App\Models\User;

use function Pest\Laravel\{get,actingAs};

it('verifica se somente usuário logado pode acessar a rota', function(){

    $user = User::factory()->createOne();
    
    actingAs($user)
    ->get('/app/networks')
    ->assertOk();

});
it('verifica se o usuário não logado está sendo redirecionando para login', function(){

    get('/app/networks')
    ->assertFound()
    ->assertRedirect('login');
});