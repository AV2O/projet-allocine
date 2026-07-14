<?php
$host = getenv('DB_HOST');
$port = getenv('DB_PORT');
$dbname = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Test : on essaie de créer une table temporaire pour voir si ça marche
    $pdo->exec("CREATE TABLE IF NOT EXISTS test_connection (id INT)");
    echo "Connexion OK ! La base est accessible.<br>";

    // Maintenant on essaie d'importer le fichier
    if (file_exists('dump.sql')) {
        $sql = file_get_contents('dump.sql');
        $pdo->exec($sql);
        echo "Importation terminée avec succès !";
    } else {
        echo "Erreur : Le fichier dump.sql est introuvable sur le serveur.";
    }

} catch (Exception $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
?>