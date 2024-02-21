<div align="right">

### ⚡ RMM ⚡

</div>

# Slim 4 Api Skeleton

Este é um micro esqueleto baseado no framework Slim 4 e compatível com PSR-7.

Auxilia na criação acelerada de aplicações, poc's e estudos da tecnologia.

## Requisitos

- Composer 2.x
- PHP 8.x
- Docker (opcional)

## Características

- PSR-7 Standard
- Logs em arquivos usando Monolog
- Injeção de dependência usando PHP-DI
- Vardump (Dev) do Symfony
- Response Handlers (Json, html)

## Descrição

[Slim](https://www.slimframework.com/) Framework é uma microestrutura PHP que ajuda você a escrever rapidamente aplicações web e APIs simples, mas poderosas. Basicamente, Slim é um despachante que recebe uma solicitação HTTP, invoca uma rotina de retorno de chamada apropriada e retorna uma resposta HTTP. É isso.


## Instalar

```powershell
$ composer install
```

## iniciar

```powershell
$ composer serve
```

## testar

Verifica se esta online usando `curl`

```powershell
$ curl --request GET --url http://localhost:8080/ 

```


## Licença

[![License](https://img.shields.io/badge/license-MIT-green?style=plastic)](LICENSE.md)


Criado e mantido com diversão e :heart: por [![Github](https://img.shields.io/badge/-ricardo%20melo%20martins-000?style=plastic&logo=github)](https://github.com/ricardo-melo-martins)
