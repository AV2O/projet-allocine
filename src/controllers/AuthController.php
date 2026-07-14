<?php
require_once __DIR__ . '/../models/User.php';

class AuthController {
    
    private function render($viewPath) {
        ob_start();
        include __DIR__ . '/../views/' . $viewPath . '.php';
        $content = ob_get_clean();
        include __DIR__ . '/../views/layout.php';
    }

    public function loginForm() {
        // Si c'est un POST, on tente la connexion
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = User::verify($_POST['email'], $_POST['password']);
            if ($user) {
                $_SESSION['user_id'] = $user->getId();
                header('Location: /films');
                exit;
            } else {
                $_SESSION['error'] = "Email ou mot de passe incorrect.";
            }
        }
        $this->render('auth/login');
    }

    public function registerForm() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // On récupère les données du formulaire
            $email = $_POST['email'] ?? '';
            $pseudo = $_POST['pseudo'] ?? '';
            $password = $_POST['password'] ?? '';

            // On appelle la méthode statique du modèle User
            if (User::create($email, $pseudo, $password)) {
                header('Location: /login');
                exit;
            } else {
                $_SESSION['error'] = "Erreur lors de l'inscription.";
            }
        }
        $this->render('auth/register');
    }

    public function logout() {
        session_destroy();
        header('Location: /login');
        exit;
    }
}