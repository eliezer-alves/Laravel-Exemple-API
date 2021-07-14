# Laravel-Exemple-API
<hr />

## Funcionalidades
<hr />
- Cadastro de empresa;

## Tecnologias
<hr />
-   ⭐ Laravel

## Documentação
<hr />

### Configuração Banco de Dados: .env

DB_CONNECTION=sqlite
DB_FOREIGN_KEYS=true

Caso também for utilizar o SQLITE como estou utilizando, não se esqueça de criar o arquivo 'database.sqlite' em ./database

### <a href="https://laravel.com/docs/8.x/passport#introduction">Passport</a>

Para autenticação dos end-points a API está utilizando o Passport. Os endpoints estão com o middleware client, assim é necessário criar um novo client e especificar corretamente o id e a secret_key gerados na rota de autenticação. 


