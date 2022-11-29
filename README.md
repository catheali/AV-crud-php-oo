# Av-crud-php-oo


- Para visualizar o projeto, vai ser necessário criar um banco de dados e baixar o <a href="https://getcomposer.org/Composer-Setup.exe">Composer</a>. 

- Abra o arquivo db.sql e cole no mysql comand line.

- Depois de colocar o banco no server:
  - Agora entre na pasta `src/config/database.php` e altere a senha ` DB_PASSWORD = 'sua senha';`.
  - No terminal digite: `composer install` e depois `composer update` 
  - Após isso,  no digite:
           ` php -S localhost:8000 -t public `

- Entre no link https://localhost:8000/tabela.php . O projeto deve funcionar se os passos forem seguidos corretamente.

Se o erro sqli ou pdo_mysql aparecer:
-entre na pasta onde o php foi instalado e procure pelo arquivo php.ini.developer, renomeei o arquivo para php.ini, abra no vscode e tire o ';' da linha 928 onde tem : `extension=mysqli` ou `pdo_mysql`
