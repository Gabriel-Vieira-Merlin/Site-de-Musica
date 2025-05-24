<?php
require_once 'models/User.php';
require_once 'config/database.php';

class AuthController {
    private $user;
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
    }

    // Exibir formulário de login
    public function showLoginForm() {
        require_once 'views/templates/header.php';
        require_once 'views/auth/login.php';
        require_once 'views/templates/footer.php';
    }

    // Processar login
    public function login() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->user->email = $_POST['email'];
            $password = $_POST['password'];

            if($this->user->emailExists()) {
                if(password_verify($password, $this->user->password)) {
                    session_start();
                    $_SESSION['user_id'] = $this->user->id;
                    $_SESSION['username'] = $this->user->username;
                    header("Location: index.php?action=listAlbums");
                } else {
                    $error = "Senha incorreta.";
                    require_once 'views/templates/header.php';
                    require_once 'views/auth/login.php';
                    require_once 'views/templates/footer.php';
                }
            } else {
                $error = "Email não encontrado.";
                require_once 'views/templates/header.php';
                require_once 'views/auth/login.php';
                require_once 'views/templates/footer.php';
            }
        }
    }

    // Exibir formulário de registro
    public function showRegisterForm() {
        require_once 'views/templates/header.php';
        require_once 'views/auth/register.php';
        require_once 'views/templates/footer.php';
    }

    // Processar registro
    public function register() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->user->username = $_POST['username'];
            $this->user->email = $_POST['email'];
            $this->user->password = $_POST['password'];

            if($this->user->create()) {
                header("Location: index.php?action=login");
            } else {
                $error = "Erro ao registrar. Tente novamente.";
                require_once 'views/templates/header.php';
                require_once 'views/auth/register.php';
                require_once 'views/templates/footer.php';
            }
        }
    }

    // Logout
    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: index.php?action=login");
    }
}