<?php
require_once __DIR__ . '/../config/Database.php';

// 1. Récupérer les données du formulaire 
$film_id = $_POST['film_id'] ?? 1;
$pseudo = $_POST['pseudo'] ?? 'Anonyme';
$commentaire = $_POST['commentaire'] ?? '';
$note = $_POST['note'] ?? 5;

try {
    // 2. Récupérer la connexion MongoDB 
    $mongoDb = Database::getInstance()->getMongoConnection();

    $result = $mongoDb->reviews->insertOne([
        'film_id'     => (int)$film_id, // On force en nombre entier
        'pseudo'      => htmlspecialchars($pseudo),
        'commentaire' => htmlspecialchars($commentaire),
        'note'        => (int)$note,
        'date_envoi'  => new MongoDB\BSON\UTCDateTime() // Format de date MongoDB
    ]);

    echo "Avis enregistré avec succès ! ID : " . $result->getInsertedId();

} catch (Exception $e) {
    echo "Erreur MongoDB : " . $e->getMessage();
}