<?php
require_once __DIR__ . '/../../vendor/autoload.php'; 

class Database {
    private static $instance = null;
    private $pdo;    // Pour MySQL
    private $mongo;  // Pour MongoDB

    private function __construct() {
        // --- CONFIGURATION MYSQL ---
        $host = getenv('DB_HOST') ?: 'mysql';
        $dbname = getenv('DB_NAME') ?: 'allocine_db';
        $user = getenv('DB_USER') ?: 'allocine_user';
        $pass = getenv('DB_PASS') ?: 'allocine_pass';

        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Connection au service 'mongodb'
            $this->mongo = new MongoDB\Client("mongodb://mongodb_container:27017");
            
        } catch (Exception $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (!self::$instance) self::$instance = new Database();
        return self::$instance;
    }

    // films (SQL)
    public function getConnection() {
        return $this->pdo;
    }

    // avis (NoSQL)
    public function getMongoConnection() {
        return $this->mongo->selectDatabase('allocine_db');
    }
}