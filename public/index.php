<?php

// --- IMPORTATION FORCÉE DE SÉCOURS ---
// Ce bloc vérifie si une table essentielle (ex: 'films') existe déjà.
// Si elle n'existe pas, il importe ton dump.sql automatiquement.
if (file_exists(__DIR__ . '/../dump.sql')) {
    try {
        $pdo = new PDO("mysql:host=" . getenv('DB_HOST') . ";port=" . getenv('DB_PORT') . ";dbname=" . getenv('DB_NAME'), getenv('DB_USER'), getenv('DB_PASS'));
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // On vérifie si la table 'films' existe déjà pour éviter de réimporter à chaque fois
        $check = $pdo->query("SHOW TABLES LIKE 'films'");
        if ($check->rowCount() == 0) {
            $sql = file_get_contents(__DIR__ . '/../dump.sql');
            $pdo->exec($sql);
            die("IMPORTATION RÉUSSIE ! Rafraîchissez votre navigateur.");
        }
    } catch (PDOException $e) {
        // On ignore les erreurs ici pour laisser le reste du site charger si la DB est déjà prête
    }
}

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

// 2. Détail d'un film
elseif (preg_match('#^/films/detail/([0-9]+)$#', $url, $matches)) {
    $id = $matches[1];
    $filmController = new FilmController();
    $filmController->detail($id);
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
}

// 5. Route pour modifier
elseif (preg_match('#^/films/edit/([0-9]+)$#', $url, $matches)) {
    $id = $matches[1];
    $filmController = new FilmController();
    $filmController->edit($id);
}

// 6. Route pour ajouter un commentaire MongoDB
elseif ($url === '/comment/add') {
    $filmController = new FilmController();
    $filmController->addComment();
}

// --- ROUTE PAR DÉFAUT ---
else {
    header('Location: /login');
    exit;
}