# TO COM FOME

A aplicação To Com Fome é um sistema de doação em que as empresas e produtores doadores recebem prêmios que geram autoridade pelo seu empenho no combate à fome na mesma medida que promove incentivo à agricultura sustentável.

O maior beneficiado é a pessoa vulnerável que terá acesso de maneira mais ágil e próxima a um prato de comida. A fome não espera! 

Os produtores serão os únicos a comercializar o seu serviço.

## Instalação

Para utilizar a aplicação, você pode optar por duas formas de instalação:

### Docker

Utilizando o Docker, necessita-se de um arquivo de variáveis ambiente. Após criá-lo, pode rodar o comando abaixo:

```bash
docker-compose --env-file .env up
```

### Apache

Utilizando o XAMPP, inicie o Apache e o MySQL.

Para conferir se você está conectado, acesse [essa URL](http://localhost/server/api/hello.php). Ela deve te mostrar a seguinte mensagem:

```json
{
  "message": "Você está conectado"
}
```

## Criando o banco

### Docker

Com a aplicação rodando, acesse a URL do [PHPMyAdmin](http://localhost:8080). Efetue o login solicitado, utilizando o mesmo usuário e senha no arquivo `.env`.

Ao acessar a página do PHPMyAdmin, vá na opção do menu "Importar" e suba o arquivo `db.sql` que está na pasta `db`.

### Apache

Com o Apache e o MySQL rodando, acesse a URL do [PHPMyAdmin](http://localhost/phpmyadmin). 

Ao acessar a página do PHPMyAdmin, vá na opção do menu "Importar" e suba o arquivo `db.sql` que está na pasta `db`.

## API

A API se encontra na pasta `server`, com o CRUD completo da aplicação.

- Perfis
  - Listar todos os perfis: GET - /role.php
  - Listar um perfil: GET - /role.php?id=\<id\>
  - Criar um perfil: POST - /role.php
  - Editar um perfil: PUT/PATCH - /role.php?id=\<id\>
  - Deletar um perfil: DELETE - /role.php?id=\<id\>

<br>

- Usuários
  - Listar todos os usuários: GET - /user.php
  - Listar todos os usuários pelo seu perfil (role): GET - /user.php?roleId=\<id\>
  - Listar um usuário: GET - /user.php?id=\<id\>
  - Criar um usuário: POST - /user.php
  - Editar um usuário: PUT/PATCH - /user.php?id=\<id\>
  - Deletar um usuário: DELETE - /user.php?id=\<id\>

<br>

- Tipos de doação
  - Listar todos os tipos de doação: GET - /typeDonnation.php
  - Listar um tipo de doação: GET - /typeDonnation.php?roleId=\<id\>
  - Criar um tipo de doação: POST - /typeDonnation.php
  - Editar um tipo de doação: PUT/PATCH - /typeDonnation.php?id=\<id\>
  - Deletar um tipo de doação: DELETE - /typeDonnation.php?id=\<id\>

<br>

- Tipos de alimento
  - Listar todos os tipos de alimento: GET - /typeFood.php
  - Listar um tipo de alimento: GET - /typeFood.php?roleId=\<id\>
  - Criar um tipo de alimento: POST - /typeFood.php
  - Editar um tipo de alimento: PUT/PATCH - /typeFood.php?id=\<id\>
  - Deletar um tipo de alimento: DELETE - /typeFood.php?id=\<id\>

<br>

- Tipos de notícia
  - Listar todos os tipos de notícia: GET - /typeNews.php
  - Listar um tipo de notícia: GET - /typeNews.php?roleId=\<id\>
  - Criar um tipo de notícia: POST - /typeNews.php
  - Editar um tipo de notícia: PUT/PATCH - /typeNews.php?id=\<id\>
  - Deletar um tipo de notícia: DELETE - /typeNews.php?id=\<id\>

<br>

- Doações
  - Listar todos as doações: GET - /donnation.php
  - Listar uma doação: GET - /donnation.php?id=\<id\>
  - Criar uma doação: POST - /donnation.php
  - Editar uma doação: PUT/PATCH - /donnation.php?id=\<id\>
  - Deletar uma doação: DELETE - /donnation.php?id=\<id\>

<br>

- Notícias
  - Listar todos as notícias: GET - /news.php
  - Listar uma notícia: GET - /news.php?id=\<id\>
  - Criar uma notícia: POST - /news.php
  - Editar uma notícia: PUT/PATCH - /news.php?id=\<id\>
  - Deletar uma notícia: DELETE - /news.php?id=\<id\>

## Contribuidores

- Caio Lopes Oliveira - RM 94693
- Carlos Henrique Faustino Cardoso - RM 94213
- Eder Bruno Almeida Teodoro - RM 93254
- Fernando Rodrigues Candiani - RM 94249
- Gustavo Lopes de Oliveira - RM 92927
