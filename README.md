echo "# README do Projeto

## Descrição
Este projeto foi desenvolvido como parte da disciplina da faculdade Uninassau. Ele foi criado utilizando o framework Laravel 10 e PHP, e inclui a integração com o Bootstrap para estilização da interface. O objetivo do projeto é demonstrar as habilidades adquiridas em desenvolvimento web, incluindo boas práticas de codificação, design responsivo e integração de funcionalidades.

## Tecnologias Utilizadas
- **Laravel 10**: Framework PHP para desenvolvimento de aplicações web.
- **PHP 8**: Linguagem de programação server-side.
- **Bootstrap**: Framework front-end para desenvolvimento de interfaces responsivas e modernas.
- **MySQL**: Sistema de gerenciamento de banco de dados relacional para armazenamento e gerenciamento de dados.

## Funcionalidades
O projeto inclui as seguintes funcionalidades:
- Sistema de login e autenticação de usuários.
- Interface de navegação responsiva e interativa com Bootstrap.
- Criação, leitura, atualização e exclusão de dados (CRUD).
- Painel de controle de usuários.

## Instruções de Instalação
Para rodar este projeto em sua máquina local, siga os seguintes passos:

### 1. Clone o repositório
```git clone git@github.com:MatheusMonthay/Sistemas-de-reservas.git```

### 2. Acesse o diretório do projeto
```cd sistema-de-reservas```

### 3. Instale as dependências do Composer
```composer install```

### 4. Configure o arquivo \`.env\`
Copie o arquivo \`.env.example\` e renomeie-o para \`.env\`.
```cp .env.example .env```

Atualize as configurações do banco de dados no arquivo `.env\`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=usuario
DB_PASSWORD=senha
```

### 5. Gere a chave de aplicativo
```php artisan key:generate```

### 6. Execute as migrações do banco de dados
```php artisan migrate```

### 7. Inicie o servidor embutido do Laravel
```php artisan serve```

Acesse a aplicação em: \`http://localhost:8000\`

## Estrutura do Projeto
- **app/**: Contém a lógica de aplicação, incluindo controladores e modelos.
- **resources/views/**: Contém as views em Blade, que representam a interface do usuário.
- **public/**: Contém os arquivos públicos, como CSS, JS e imagens.
- **routes/web.php**: Define as rotas da aplicação.
- **database/migrations/**: Contém os arquivos de migração do banco de dados.

## Contribuição
Sinta-se à vontade para contribuir com este projeto! Se você deseja colaborar, siga as instruções abaixo:

1. Fork este repositório.
2. Crie uma branch com a sua feature:
```git checkout -b minha-feature```
3. Commit suas alterações:
```git commit -m \"Adicionei uma nova feature\"```
4. Envie para o repositório remoto:
```git push origin minha-feature```
5. Crie um pull request.


## Autores
Matheus Monthay Almeida, Jefferson, Leonardo Henrique, Marcos Eduardo e Willianes

## Agradecimentos
Agradecemos ao professor Itamar Alves e aos colegas que contribuíram com ideias e feedback para o desenvolvimento deste projeto." 
