<p align="center">
<a href="https://laravel.com" target="_blank">
<img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel Logo">
</a>
</p>



<h1 align="center">Desafio - Cadastro de Clientes</h1>

<p align="center">
Trata-se de um sistema web completo (CRUD) para gestão de clientes, com integração inteligente de busca de CEP.
</p>

🛠️ Tecnologias Utilizadas

Framework: Laravel 12 (PHP)

Front-end: HTML5, CSS3, Javascript Vanilla e Bootstrap 5

Banco de Dados: MySQL / SQLite

Integração de API: ViaCEP (Consumida pelo Back-end via Http::get e servida ao Front-end via requisição fetch())

✨ Funcionalidades Desenvolvidas

C (Create): Cadastro de novos clientes com validação rigorosa de dados.

R (Read): Listagem de todos os clientes cadastrados numa tabela responsiva.

U (Update): Edição de dados de clientes já existentes.

D (Delete): Exclusão de clientes (com alerta de confirmação de segurança para evitar exclusões acidentais).

🎯 Integração ViaCEP: Ao digitar o CEP no formulário (seja na criação ou edição), o sistema faz uma requisição assíncrona (sem recarregar a página) e preenche automaticamente os campos de Endereço, Bairro, Cidade e UF.

⚙️ Como executar o projeto localmente

Como as boas práticas de versionamento exigem, os ficheiros de configuração local (.env) e as dependências pesadas (/vendor) não foram incluídos no repositório. Para testar o projeto, siga os passos abaixo:

1. Pré-requisitos

Certifique-se de que tem instalado na sua máquina:

PHP (versão 8.2 ou superior)

Composer

Um servidor de banco de dados (MySQL/MariaDB) ou ambiente como Laravel Herd / XAMPP.

2. Instalação Passo a Passo

Abra o seu terminal e execute os comandos abaixo:

# 1. Clone este repositório
git clone [https://github.com/NicolyBB/desafio.git](https://github.com/NicolyBB/desafio.git)

# 2. Aceda à pasta do projeto
cd desafio

# 3. Instale as dependências do Laravel
composer install

# 4. Crie o ficheiro de configuração (No Windows pode usar: copy .env.example .env)
cp .env.example .env

# 5. Gere a chave de segurança da aplicação
php artisan key:generate


⚠️ Pausa para o Banco de Dados:
Neste momento, abra o ficheiro .env recém-criado na raiz do projeto e ajuste as credenciais de ligação ao seu banco de dados local (campos DB_DATABASE, DB_USERNAME, DB_PASSWORD).

Após configurar o .env, volte ao terminal e continue:

# 6. Execute as Migrations para criar a tabela de clientes
php artisan migrate

# 7. Inicie o servidor local
php artisan serve


Aceda no seu navegador ao endereço fornecido (geralmente http://localhost:8000).
