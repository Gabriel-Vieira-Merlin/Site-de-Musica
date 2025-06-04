<?php
require_once 'models/Album.php';
require_once 'config/database.php';

class AlbumController {
    private $album;
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->album = new Album($this->db);
    }

    // Exibir formulário de criação
    public function showCreateForm() {
        require_once 'views/templates/header.php';
        require_once 'views/albums/create.php';
        require_once 'views/templates/footer.php';
    }

    // Processar criação de álbum
    public function create() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            session_start();
            $this->album->user_id = $_SESSION['user_id'];
            $this->album->title = $_POST['title'];
            $this->album->artist = $_POST['artist'];
            $this->album->release_year = $_POST['release_year'];
            $this->album->genre = $_POST['genre'];
            $this->album->rating = $_POST['rating'];
            $this->album->review = $_POST['review'];
            $this->album->cover_url = $_POST['cover_url'];

            if ($this->album->create()) {
                header("Location: index.php?action=listAlbums");
            } else {
                $error = "Erro ao criar álbum.";
                require_once 'views/templates/header.php';
                require_once 'views/albums/create.php';
                require_once 'views/templates/footer.php';
            }
        }
    }

    // Listar todos os álbuns do usuário com filtros
    public function listAlbums() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit;
        }

        // Coletar filtros da URL
        $filters = [];
        if (isset($_GET['title']) && !empty(trim($_GET['title']))) {
            $filters['title'] = trim($_GET['title']);
        }
        if (isset($_GET['artist']) && !empty(trim($_GET['artist']))) {
            $filters['artist'] = trim($_GET['artist']);
        }
        if (isset($_GET['genre']) && !empty($_GET['genre'])) {
            $filters['genre'] = $_GET['genre'];
        }
        if (isset($_GET['release_year']) && !empty($_GET['release_year'])) {
            $filters['release_year'] = $_GET['release_year'];
        }
        if (isset($_GET['rating']) && $_GET['rating'] !== '') {
            $filters['rating'] = $_GET['rating'];
        }

        // Buscar álbuns com filtros
        $stmt = $this->album->readAll($_SESSION['user_id'], $filters);

        // Buscar opções únicas para os filtros
        $genres = $this->album->getGenres($_SESSION['user_id']);
        $artists = $this->album->getArtists($_SESSION['user_id']);
        $years = $this->album->getYears($_SESSION['user_id']);

        require_once 'views/templates/header.php';
        require_once 'views/albums/list.php';
        require_once 'views/templates/footer.php';
    }

    // Exibir um álbum específico
    public function viewAlbum($id) {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit;
        }

        $this->album->id = $id;
        $this->album->readOne();

        require_once 'views/templates/header.php';
        require_once 'views/albums/view.php';
        require_once 'views/templates/footer.php';
    }

    // Exibir formulário de edição
    public function showEditForm($id) {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit;
        }

        $this->album->id = $id;
        $this->album->readOne();

        require_once 'views/templates/header.php';
        require_once 'views/albums/edit.php';
        require_once 'views/templates/footer.php';
    }

    // Processar atualização de álbum
    public function update() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            session_start();
            $this->album->id = $_POST['id'];
            $this->album->user_id = $_SESSION['user_id'];
            $this->album->title = $_POST['title'];
            $this->album->artist = $_POST['artist'];
            $this->album->release_year = $_POST['release_year'];
            $this->album->genre = $_POST['genre'];
            $this->album->rating = $_POST['rating'];
            $this->album->review = $_POST['review'];
            $this->album->cover_url = $_POST['cover_url'];

            if ($this->album->update()) {
                header("Location: index.php?action=viewAlbum&id=" . $this->album->id);
            } else {
                $error = "Erro ao atualizar álbum.";
                require_once 'views/templates/header.php';
                require_once 'views/albums/edit.php';
                require_once 'views/templates/footer.php';
            }
        }
    }

    // Excluir álbum
    public function delete($id) {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit;
        }

        $this->album->id = $id;
        $this->album->user_id = $_SESSION['user_id'];

        if ($this->album->delete()) {
            header("Location: index.php?action=listAlbums");
        } else {
            $error = "Erro ao excluir álbum.";
            require_once 'views/templates/header.php';
            require_once 'views/albums/list.php';
            require_once 'views/templates/footer.php';
        }
    }
}
