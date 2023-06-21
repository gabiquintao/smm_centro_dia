<h1 align="center">
    <span>Projeto de Aptidão Profissional</span>
  <img width="auto" height="50px" src=""/>
</h1>

# Contéudos

- [Introdução](#introdução)
- [Manual de Instalação](#manual-de-instalação)
    - [Pré-requisitos](#pré-requisitos)
    - [Clone do Projeto](#clone-do-projeto)
    - [Projeto](#projeto)
    - [Configuração do Mailtrap](#configuracao-do-mailtrap)
- [Utilização](#utilizacao)
    - [Base de Dados](#base-de-dados)
    - [Uso](#uso) 
- [Manual de Uso](#how-to-try-it-out)

## Introdução

No âmbito da Prova de Aptidão Profissional (PAP) do Curso Técnico de Gestão e Programação de Sistemas Informáticos (GPSI), foi desenvolvido este projeto que consiste numa plataforma web de suporte à gestão operacional do Centro de Dia do CSPNSF (Centro Social e Paroquial de Nossa Senhora De Fátima).

Neste projeto tem disponível um manual de instalação e de uso que fornece os requisitos necessários para garantir que tudo funciona corretamente.

## Manual de Instalação

> Nota: a aplicação **xampp** foi a escolhida para a realização da PAP.

### Pré-requisitos

Para a instalação do projeto, são necessárias as seguintes ferramentas:
- **Servidor web:** deve ter um servidor web instalado, como o Apache;
- **PHP:** o projeto requer uma versão específica do PHP, esta é a 8.1;
- **Base de dados:** o projeto foi criado com o sistema de gestão de base de dados MySQL;
- **Composer:** o Composer é uma ferramenta de gestão de dependências para o PHP;
- **Node.js e NPM:** é necessário ter o Node.js instalado no seu sistema para executar as tarefas de compilação de recursos;
- **Git:** É necessário ter o Git instalado para gerir o controlo de importação de código;

### Clone do Projeto

1. **Abra o terminal ou o prompt de comando** no seu computador
2. Navegue até o diretório onde deseja clonar o projeto usando o comando **cd nome_do_diretório**
3. Execute o clone do projeto com o comando **git clone https://github.com/gabiquintao/smm_centro_dia.git**

### Projeto

**No diretório do projeto**, execute o seguintes comandos:

1. **composer install**, para instalar as dependências do composer do projeto
2. **cp .env.example .env**, para fazer criar um novo ficheiro .env, cópia do .env.example
4. **php artisan key:generate**, para definir a chave do projeto

### Configuração do Mailtrap

1. Acesse o website [Mailtrap](https://mailtrap.io/) e faça login ou crie uma nova conta;
2. Depois de se autenticar, será redirecionado para o painel do Mailtrap;
3. No menu, clique em **Email Testing**;
4. Na página, crie um novo projeto, no botão **Add Project**, preferencialmente com o nome "Centro de Dia";
5. No projeto "Centro de Dia" agora criado, adicione uma caixa de entrada no botão **Add Inbox**, preferencialmente com o nome "Centro de Dia";
6. Aceda às definições na inbox agora criada, ao clicar no **ícone de configurações**, na categoria **Actions**;
7. No menu **STMP Settings**, localize o nome **Integrations** e selecione a opção **Laravel 7+**;
8. Copie o código que lhe foi atríbuido, e no ficheiro .env do seu projeto, localize o seguinte código, e substitua peloo seu novo código:
```
MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

## Utilização

**No diretório do projeto**, execute o seguinte comando para instalar as dependências: **npm install**

### Base de Dados

**No diretório do projeto**, deve executar os seguintes comandos
1. **php artisan migrate**, para fazer as migrações da aplicação para a base de dados
2. **php artisan migrate:fresh --seed**, para atualizar a base de dados, e plantar dados
3. **php artisan shield:install --fresh**, para atualizar a ferramenta Filament Shield, __nesta prompt, é possível selecionar um novo utilizador com a função super_admin__
4. **php artisan db:seed --class=ShieldSeeder**, para atualizar a lista de funções e permissões da aplicação

### Uso

Execute os seguintes comandos, **no diretório do projeto**
- **npm run build** para criar a versão otimizada da aplicação frontend do Laravel
- **php artisan serve** para iniciar o servidor de desenvolvimento do Laravel
