<?php
require_once __DIR__ . '/../config/Database.php';

class User {
    private $id;
    private $email;
    private $pseudo;

    public function __construct($id, $email, $pseudo) {
        $this->id = $id;
        $this->email = $email;
        $this->pseudo = $pseudo;
    }

    // 1. Pour l'inscription
    public static function create($email, $pseudo, $password) {
        $db = Database::getInstance()->getConnection();
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt = $db->prepare("INSERT INTO users (email, password, pseudo) VALUES (?, ?, ?)");
        return $stmt->execute([$email, $hashed, $pseudo]);
    }

    // 2. Pour chercher un utilisateur et son mot de passe
    public static function findByEmail($email) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            return [
                'object' => new User($data['id'], $data['email'], $data['pseudo']),
                'password' => $data['password']
            ];
        }
        return null;
    }

    // 3. Pour la connexion 
    public static function verify($email, $password) {
        $userData = self::findByEmail($email);
        if ($userData && password_verify($password, $userData['password'])) {
            return $userData['object'];
        }
        return null;
    }

    public function getId() { return $this->id; }
    public function getPseudo() { return $this->pseudo; }
}