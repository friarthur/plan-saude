# Plan Saude

Plan Saude é um projeto web desenvolvido para gerenciar planos de saúde e permitir o cadastro, autenticação, e recuperação de senha de usuários.
# Plan Saúde

## Descrição do Projeto

O **Plan Saúde** é um sistema web projetado para gerenciar planos de saúde, permitindo a administração de cadastros de usuários, autenticação, recuperação de senha, além de funcionalidades adicionais como a locação de jogos de tabuleiro.

Este projeto é destinado a facilitar a gestão de informações dos clientes de um plano de saúde, oferecendo uma interface amigável e moderna para usuários e administradores. Além disso, ele inclui uma seção dedicada ao aluguel de jogos de tabuleiro, proporcionando uma experiência completa e integrada.

## Funcionalidades Principais

1. **Cadastro de Usuários**: 
   - Formulários de registro que permitem aos usuários criar uma conta no sistema.
   - Validação de dados e armazenamento seguro das informações no banco de dados MySQL.

2. **Autenticação de Usuários**:
   - Login seguro com verificação de credenciais.
   - Sessões de usuário para manter o estado de autenticação.

3. **Recuperação de Senha**:
   - Processo de recuperação de senha que envolve verificação por e-mail.
   - Funcionalidade para redefinição de senha utilizando tokens seguros.

4. **Gestão de Planos de Saúde**:
   - Ferramentas para administrar diferentes planos de saúde.
   - Visualização e edição das informações dos planos.



## Tecnologias Utilizadas

- **PHP**: Linguagem de programação utilizada para o desenvolvimento do back-end.
- **MySQL**: Banco de dados relacional utilizado para armazenar as informações do sistema.
- **Composer**: Gerenciador de dependências para PHP, utilizado para instalar pacotes como o PHPMailer.
- **PHPMailer**: Biblioteca de envio de e-mails usada para comunicação e verificação de usuários.
- **HTML/CSS/JavaScript**: Tecnologias de front-end para construir a interface do usuário.

## Estrutura do Projeto

O projeto é organizado em diversas pastas, cada uma contendo arquivos relacionados a diferentes funcionalidades:

- `css/`: Arquivos de estilos CSS.
- `html/`: Arquivos HTML para as diferentes páginas do site.
- `img/`: Imagens utilizadas no projeto.
- `js/`: Scripts JavaScript para funcionalidades interativas.
- `php/`: Scripts PHP para manipulação de dados e lógica de negócio.
- `srcs/`: Biblioteca de código fonte, incluindo namespaces personalizados.
- `sql/`: Scripts SQL para criação e manipulação do banco de dados.

## Contribuição

Contribuições para o projeto são bem-vindas! Sinta-se à vontade para fazer um fork do repositório e enviar pull requests com melhorias, correções de bugs ou novas funcionalidades.


## Índice

- [Instalação](#instalação)
- [Configuração](#configuração)
- [Uso](#uso)
- [Estrutura do Projeto](#estrutura-do-projeto)
- [Tecnologias Utilizadas](#tecnologias-utilizadas)
- [Contribuição](#contribuição)
- [Licença](#licença)

## Instalação

1. Clone o repositório:
    ```sh
    git clone https://github.com/friarthur/plan-saude.git
    cd plan-saude
    ```

2. Instale as dependências do Composer:
    ```sh
    composer install
    ```

3. Configure seu ambiente:
    - Renomeie o arquivo `.env.example` para `.env` e configure suas variáveis de ambiente, incluindo as credenciais do banco de dados.

4. Configure o banco de dados:
    - Crie o banco de dados e as tabelas necessárias executando os scripts SQL fornecidos na pasta `sql`.

## Configuração

- **PHP**: Certifique-se de ter o PHP 8.3.8 instalado em `C:\tools\php83\php.exe`.
- **Composer**: Certifique-se de ter o Composer instalado.

## Uso

1. Inicie o servidor Apache:
    ```sh
    apachectl start
    ```

2. Acesse o projeto no navegador:
    ```
    http://localhost/plan-saude
    ```

## Estrutura do Projeto

```plaintext
plan-saude/
│
├── css/
│   ├── main.css
│
├── html/
│   ├── cadastro.html
│   ├── login.html
│
├── img/
│   ├── logo.svg
│   ├── monopoly.png
│   ├── ticket_to_ride.png
│   ├── takenoko.png
│
├── js/
│   ├── app.js
│
├── php/
│   ├── conexao.php
│   ├── registro.php
│   ├── login.php
│   ├── verificar_email.php
│   ├── reset_senha.php
│
├── srcs/
│   ├── EmailNamespace/
│
├── .env
├── composer.json
├── index.php
├── README.md

```
## version in english
# Plan Saúde

## Project Description

**Plan Saúde** is a web system designed to manage health plans, allowing for user registration management, authentication, password recovery, and additional functionalities such as board game rental.

This project aims to facilitate the management of health plan client information by providing a user-friendly and modern interface for users and administrators. Additionally, it includes a section dedicated to board game rental, providing a complete and integrated experience.

## Main Features

1. **User Registration**:
   - Registration forms that allow users to create an account in the system.
   - Data validation and secure storage of information in the MySQL database.

2. **User Authentication**:
   - Secure login with credential verification.
   - User sessions to maintain authentication state.

3. **Password Recovery**:
   - Password recovery process involving email verification.
   - Functionality to reset password using secure tokens.

4. **Health Plan Management**:
   - Tools to manage different health plans.
   - Viewing and editing plan information.

5. **Board Game Rental**:
   - Interface to view, rent, and return board games.
   - Return confirmation system to ensure secure processes.

## Technologies Used

- **PHP**: Programming language used for back-end development.
- **MySQL**: Relational database used to store system information.
- **Composer**: Dependency manager for PHP, used to install packages like PHPMailer.
- **PHPMailer**: Email sending library used for user communication and verification.
- **HTML/CSS/JavaScript**: Front-end technologies to build the user interface.

## Project Structure

The project is organized into several folders, each containing files related to different functionalities:

- `css/`: CSS style files.
- `html/`: HTML files for different site pages.
- `img/`: Images used in the project.
- `js/`: JavaScript scripts for interactive functionalities.
- `php/`: PHP scripts for data manipulation and business logic.
- `srcs/`: Source code library, including custom namespaces.
- `sql/`: SQL scripts for database creation and manipulation.

## Contribution

Contributions to the project are welcome! Feel free to fork the repository and submit pull requests with improvements, bug fixes, or new features.

## Index

- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Project Structure](#project-structure)
- [Technologies Used](#technologies-used)
- [Contribution](#contribution)
- [License](#license)

## Installation

Clone the repository:

```sh
git clone https://github.com/friarthur/plan-saude.git
cd plan-saude


