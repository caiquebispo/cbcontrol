<?php

use App\Models\User;

use function Pest\Laravel\{get,actingAs};

it('verifica se somente usuário logado pode acessar a rota', function(){

    $user = User::factory()->createOne();
    
    actingAs($user)
    ->get('/app/networks')
    ->assertOk();

});
