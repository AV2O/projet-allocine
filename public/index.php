<?php
session_start();

require_once __DIR__ . '/../src/config/Database.php';
require_once __DIR__ . '/../src/controllers/AuthController.php';
require_once __DIR__ . '/../src/controllers/FilmController.php';

$url = $_SERVER['REQUEST_URI'];

// --- ROUTES AUTHENTIFICATION ---
if ($url === '/login') {
    $auth = new AuthController();
    $auth->loginForm();
} 
elseif ($url === '/register') {
    $auth = new AuthController();
    $auth->registerForm();
} 
elseif ($url === '/logout') {
    $auth = new AuthController();
    $auth->logout();
} 

// --- ROUTES FILMS ---

// 1. Suppression (Regex pour capturer l'ID)
elseif (preg_match('#^/films/delete/([0-9]+)$#', $url, $matches)) {
    $id = $matches[1];
    $filmController = new FilmController();
    $filmController->delete($id); 
}

// 2. Détail d'un film (Regex pour capturer l'ID)
elseif (preg_match('#^/films/detail/([0-9]+)$#', $url, $matches)) {
    $id = $matches[1];
    $filmController = new FilmController();
    $filmController->detail($id); // Assure-toi que la méthode s'appelle detail() dans ton Controller
    exit;
}

// 3. Formulaire d'ajout
elseif ($url === '/films/add') {
    $filmController = new FilmController();
    $filmController->add();
}

// 4. Liste des films (Catalogue)
elseif ($url === '/films' || $url === '/') {
    $filmController = new FilmController();
    $filmController->index();
    exit;
}

// Route pour modifier (ex: /films/edit/5)
elseif (preg_match('#^/films/edit/([0-9]+)$#', $url, $matches)) {
    $id = $matches[1];
    $filmController = new FilmController();
    $filmController->edit($id);
    exit;
}

// Route pour ajouter un commentaire MongoDB
elseif ($url === '/comment/add') {
    $filmController = new FilmController();
    $filmController->addComment();
    exit;
}

// --- ROUTE PAR DÉFAUT (404 ou redirection) ---
else {
    header('Location: /login');
    exit;
}