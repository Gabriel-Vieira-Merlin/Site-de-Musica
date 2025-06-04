Site para catalogar e avaliar álbuns ouvidos pelo usuário.

--INTEGRANTES
Gabriel Merlin - 3014082
Daniel Monteiro - 3009590
Filipe Cruz - 3003566
Orlando Neto - 2987933

ALBUMZ é um site para cadastrar e exibir álbuns musicais. Este projeto permite que os usuários adicionem informações sobre álbuns, sendo título, artista, gênero, ano, avalição, comentário e imagem da capa.

--TECNOLOGIAS UTILIZADAS
PHP
JavaScript
CSS
HTML
Bootstrap
SQL
XAMPP
Visual Studio Code

--ESTRUTURA DO DIRETÓRIO
/rock_vin2
│
├── /config/
│   └── database.php
│
├── /controllers/
│   ├── AlbumController.php
│   └── AuthController.php
│
├── /models/
│   ├── Album.php
│   └── User.php
│
├── /views/
│   ├── /templates/
│   │   ├── header.php
│   │   └── footer.php
│   │
│   ├── /auth/
│   │   ├── login.php
│   │   └── register.php
│   │
│   └── /albums/
│       ├── create.php
│       ├── edit.php
│       ├── list.php
│       └── view.php
│
├── /assets/
│   ├── /css/
│   │   └── style.css
│   │
│   └── /js/
│       └── script.js
├── db-setup-sql.sql
├── index.php
└── README.md


--COMO EXECUTAR 
1- Baixe o diretório e extraia os arquivos
2- Após isso insira a pasta rockvin2 na pasta htdocs do xampp
3- Abra o XAMPP, inicie o Apache e o MySQL e acesse o PHPMyAdmin.
4- Crie um Banco de dados novo (recomendo chamar de sistema_cadastro)
5- Clique em Importar e selecione o banco de dados db-setup-sql.sql
6- Abra o nevegador e digite "localhost/rockvin2"
