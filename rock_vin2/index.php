<?php
require_once 'controllers/AuthController.php';
require_once 'controllers/AlbumController.php';

$authController = new AuthController();
$albumController = new AlbumController();

$action = isset($_GET['action']) ? $_GET['action'] : 'login';
$id = isset($_GET['id']) ? $_GET['id'] : null;

switch ($action) {
    // Autenticação
    case 'login':
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $authController->login();
        } else {
            $authController->showLoginForm();
        }
        break;
    case 'register':
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $authController->register();
        } else {
            $authController->showRegisterForm();
        }
        break;
    case 'logout':
        $authController->logout();
        break;
    
    // Álbuns
    case 'createAlbum':
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $albumController->create();
        } else {
            $albumController->showCreateForm();
        }
        break;
    case 'listAlbums':
        $albumController->listAlbums();
        break;
    case 'viewAlbum':
        $albumController->viewAlbum($id);
        break;
    case 'editAlbum':
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $albumController->update();
        } else {
            $albumController->showEditForm($id);
        }
        break;
    case 'deleteAlbum':
        $albumController->delete($id);
        break;
    
    default:
        $authController->showLoginForm();
        break;
}