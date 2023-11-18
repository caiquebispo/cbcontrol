<?php

use App\Models\User;

beforeEach(function(){

    $this->user = User::factory()->createOne();
});

todo('verificar se somente usuários autendicado podem  acessar a rota');
todo('verificar se usuários não autenticados estão sendo redirecionados para pagina de login');
todo('verificar se o componente de listagem de modules/permissions está na tela');
todo('verificar se o componente para criar uma nova permissão está na tela');
todo('verificar se ao clicar no componente para cirar uma novoa permissão o modal está sendo exibido corretamente');
todo('verificar se os todos os dados fornecido pelo usuário estão correto e passando pelas validações');
todo('verificar se a tabela já existe no banco e se está com todos os campos');
todo('verificar se a permissão foi cadastrada com sucesso e o evento para recarregar a listagem foi disparado');
todo('verificar se o componete para editar uma permisão está em tela');
todo('verificar se ao clicar no componente para editar uma permissão o modal está  sendo exibido corretamente');
todo('verificar se todos os dados fornecido na edição estão sendo validados corretamente');
todo('verificar se a permissão foi editada com sucesso e o evento para recarregar a listagem foi disparado');
todo('verificar se o componente para deletar uma permissão está em tela');
todo('verificar se ao clicar no componente para deletar uma permissão o modal de alerta está sendo exibido');
todo('verificar se a permissão foi deletada e o evento para recarregar a listagem foi disparado');
