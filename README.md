# Av-crud-php-oo

Aplicação Web do tipo monolitica, criada com:
- PHP para o backend. ^7.4
- HTML, CSS e Javascript pro frontend.
- MySQL/Maria DB para o banco de dados

## Funcionalidades:
 - CRUD de Alunos.
 - CRUD de Professores.
 - CRUD  de Cursos.
 - CRUD de Categorias.
 - CRUD de Usuários.


## Passo a passo para rodar o projeto:

- Certifique-se que seu computador tem os softwares:
    - PHP
    - MySQL  ou MariaDB
    - Editor de texto ( por exemplo VS code)
    - Navegador Web
    - Composer

  ## Clone o projeto
  Baixe ou faça o clone do repositorio:
  `git clone ....`

  Após isso, entre no diretorio que foi gerado
  `cd Av-crud-php-oo`

  ### Habilitar as extensões do PHP
  Abra o diretório de instalação do PHP, encontre o arquivo *php.ini-production* , renomeie-o para *php.ini* e abra-o com algum editor de texto.

  Encontre as seguintes linhas e descomente-as, removendo ; que precede a linha.
    - pdo_mysql
    - curl 
    - mb_string
    - openssl 

  #### Instalar as dependencias 
  - Dentro do diretorio da aplicação execute no terminal :
  `composer install` 
  Certifique-se que um diretório **/vendor** foi criado.

  #### Banco de Dados

  > O banco de dados é do tipo relacional e contém as tabelas com até 2 niveis de normatização.

  #### Criando o banco de dados
  Entre no seu cliente de banco de dados, e execute o comando:
  ```sql 
  CREATE DATABASE db_escola;
  ```

  #### Migrar a estrutura do banco de dados

  Ainda dentro do cliente de banco de dados, copie e cole o conteudo do arquivo **db.sql** e execute.

  Certifique-se que as tabelas foram criadas, executando o comando:
  ```sql
   SHOW TABLES;
  ```
  Se o resultado for a lista de tabelas existentes, então pronto! 

  #### Configure as credencias de acesso:
  Encontre o arquivo **/config/database.php** e edite-o conforme as credencias do seu usuário do banco de dados.

 ### Crie o primeiro usuario de acesso
  Dentro do diretório da aplicação, execute no terminal o comando
  `php config/create-admin.php`;

  Isso criará um usuário com as credenciais:
 |Nome |Email |Senha|
 | -   |  -   |  -  |
 | Administrador | admin@admin.com | 123456 |


### Executando a aplicação

Para executar e testar a aplicação, dentro do terminal execute: 
`php -S localhost:8000 -t public`

- Agora acesse o endereço  https://localhost:8000 no seu navegador.
 O projeto deve funcionar se os passos forem seguidos corretamente.

