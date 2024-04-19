# Praticando TDD, DDD e SOLID com PHP

Este projeto é um exemplo prático de como aplicar conceitos de TDD, DDD e SOLID em um projeto PHP.

A aplicação é um caixa eletrônico que permite realizar apenas operações de saque.

A intenção é ter o mínimo de regras de negócio e focar na solução.

## Como iniciar e testar o projeto

Para rodar este projeto você precisará ter `Docker` e `Docker Compose` instalados.

Siga estes passos para configurar seu ambiente e executar os testes:

Inicie os containers:

```bash
docker-compose up -d
```

Acesse o container do PHP:

```bash
docker-compose exec app bash
```

Instale as dependências:

```bash
composer install
```

Execute as migrações do Phinx:

```bash
vendor/bin/phinx migrate
```

Execute os testes automatizados:

```bash
vendor/bin/phpunit
```

## Code Coverage

O Code Coverage é uma técnica que mede a quantidade de código que é coberta por testes automatizados.

O objetivo é garantir que todas as partes do código sejam testadas, evitando bugs e melhorando a qualidade do software.

Execute os testes automatizados com Code Coverage:

```bash
vendor/bin/phpunit --coverage-html coverage
```

## Testes de Comportamento

Os testes de comportamento são testes que validam o comportamento do sistema como um todo.

Eles são escritos em linguagem natural e são executados por ferramentas como o Behat.

Execute os testes de comportamento do projeto com o comando:

```bash
vendor/bin/behat
```
