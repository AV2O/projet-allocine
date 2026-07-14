<?php
require_once __DIR__ . '/../../vendor/autoload.php'; 

class Database {
    private static $instance = null;
    private $pdo;
    private $mongo;

    private function __construct() {
        // --- CONFIGURATION MYSQL (Aiven) ---
        $host = getenv('DB_HOST');
        $port = getenv('DB_PORT') ?: '3306'; // Défaut 3306 si non précisé
        $dbname = getenv('DB_NAME');
        $user = getenv('DB_USER');
        $pass = getenv('DB_PASS');

        try {
            // Ajout du port et des options SSL pour Aiven
            $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                // Si Aiven demande une vérification SSL, tu peux avoir besoin de ceci :
                // PDO::MYSQL_ATTR_SSL_CA => '/etc/ssl/certs/ca-certificates.crt'
            ];
            $this->pdo = new PDO($dsn, $user, $pass, $options);
            
            // --- CONFIGURATION MONGODB (Atlas) ---
            $mongoUri = getenv('MONGODB_URI');
            $this->mongo = new MongoDB\Client($mongoUri);
            
        } catch (Exception $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (!self::$instance) self::$instance = new Database();
        return self::$instance;
    }

    public function getConnection() {
        return $this->pdo;
    }

    public function getMongoConnection() {
        // Récupère le nom de la base depuis l'URI ou force le nom
        return $this->mongo->selectDatabase('allocine');
    }
}