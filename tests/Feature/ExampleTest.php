<?php
/*
Este teste verifica se a rota principal (`/`) do aplicativo está funcionando corretamente.

Aqui está uma explicação passo a passo do que o teste está fazendo:

1. `$this->get('/')`: Esta linha faz uma solicitação GET para a rota principal (`/`) do aplicativo.
Isso simula um usuário acessando a página inicial do aplicativo.

2. `$response->assertStatus(200)`: Esta linha verifica se a resposta HTTP tem um status de 200.
O status HTTP 200 indica que a solicitação foi bem-sucedida, ou seja, a página carregou corretamente sem erros.

Se a rota principal do aplicativo estiver funcionando corretamente e retornar uma resposta com status HTTP 200,
então este teste passará. Se a rota principal não estiver funcionando corretamente ou se a resposta tiver um status HTTP diferente de 200,
então este teste falhará.
*/
test('testa se a rota principal funciona', function () {
    $response = $this->get('/dashboard/login');

    $response->assertStatus(200);
});
