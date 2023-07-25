<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


# Sobre o Projeto

Esse é um projeto desenvolvido para fins didáticos, cujo objetivo é aprimorar minhas habilidades em laravel,
e também conhecer um pouco melhor o tão amado livewire.

## Dependências do projeto

- [Laravel Doc](https://laravel.com/docs/10.x).
- [Livewire Doc ](https://laravel-livewire.com/docs/2.x/quickstart).
- [PowerGrid Doc](https://v4.livewire-powergrid.com/table/features-setup.html?id=showsearchinput#showsearchinput)
- [Wire Elements Modal](https://github.com/wire-elements/modal).
- [Tailwindcss](https://tailwindcss.com/docs/installation).

## Funcionalidades

A plataforma conta com, um módulo de produtos, clientes e uma pagina de venda vinculada a empresa

## Instalação

Apos baixar o projeto para sua máquina, navegue até a pasta do projeto e dentro da pasta rode o seguinte comando, 
Para baixar todas as dependências do projeto 
````
$ composer install
````

Agora vamos rode o seguinte comando
````
$ php artisan key:generate
````

Agora você precisara criar um banco de dados local, e passar usuário e senha para seu arquivo.evn,
tendo feito isso rode o seguinte comando para subir as tabelas necessárias
````
$ php artisan migrate
````
Agora vamos pupular nossa tabela de usuário e empresa para que você já consiga loga no sistema, rode so seguinte comando.
````
$ php artisan db::seed
````
Prontinho, agora com tudo configurado é só roda o comando e usar a aplicação
````
$ php artisan serve
````
## Credencial de acesso
```
  E-mail: demo@cbcontrol.com
  Senha: 123456
```
