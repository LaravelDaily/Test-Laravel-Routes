<?php
/*
Este teste verifica se `true` é igual a `true`.

Aqui está uma explicação passo a passo do que o teste está fazendo:

1. `expect(true)`: Esta linha cria uma nova instância de Expectation para o valor `true`.

2. `->toBeTrue()`: Esta linha verifica se o valor esperado é `true`.

Como `true` sempre será igual a `true`, este teste sempre passará.
*/
test('Teste que true eh true', function () {
    expect(true)->toBeTrue();
});
