<h1 align="center">Cidadão de Olho</h1>

## Sobre

Sistema criado para Processo de Seleção, utilizando PHP-Laravel.

## Requisitos

- <a href="https://www.php.net">PHP</a>
- <a href="https://getcomposer.org">Composer</a>
- <a href="https://laravel.com">Laravel</a>

        composer require install/laravel
- Certificado cURL (baixado: <a href="https://curl.haxx.se/ca/cacert.pem">cacert.pem</a>, e alterando o php.ini -> curl.cainfo = "path_to_cert\cacert.pem" )
- <a href="https://git-scm.com/book/en/v2/Getting-Started-Installing-Git">git</a> (recomendado)

## Inicializando
- Na pasta desejada, iniciar um terminal, e inserir:

      git clone https://github.com/edujunqueira/codificar_desafio codificar_desafio
      cd codificar_desafio
      composer install
      cp .env.example .env

- Criar banco de dados (utilizado MySQL, com schema nomeado "desafio_codificar")
- Configurar arquivo <strong>.env</strong> do Laravel, que está na pasta do projeto, com as informações do seu banco de dados:

      DB_DATABASE=database
      DB_USERNAME=user
      DB_PASSWORD=password

- Criar as tabelas do banco de dados:

      php artisan migrate

- Povoar o banco de dados (pode demorar <strong>vários</strong> minutos, cerca de 30; no entanto, o sistema pode ser utilizado enquanto os dados são carregados):

      php artisan db:seed

- Iniciar servidor de desenvolvimento do Laravel:

      php artisan serve

- Acessar a página https://127.0.0.1:8000 (conforme a configuração padrão).

## Utilizando

- Acessando as APIs:
    - Mostrar os top 5 deputados que mais pediram reembolso de verbas indenizatórias por mês, considerando somente o ano de 2019:
    
        Mostrar a média anual:
    
            http://127.0.0.1:8000/api/gastadores

        Mostrar a média por mês (exemplo):
        
            http://127.0.0.1:8000/api/gastadores/1
                
    - Mostrar o ranking das redes sociais mais utilizadas dentre os deputados, ordenado de forma decrescente:
    
            http://127.0.0.1:8000/api/redesSociais
        
- Consumir as APIs (exemplo):
    <p align="center"><img src="https://imgur.com/NQF6sCK.png"></img></p>
    
    - Apertando algum dos botões, é mostrado um exemplo de consumação da API.
