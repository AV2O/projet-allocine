<?php
require_once __DIR__ . '/../config/Database.php';

class Film {
    
    public static function create($data) {
        $db = Database::getInstance()->getConnection();
        $sql = "INSERT INTO films (titre, realisateur, annee, duree, synopsis, affiche) 
                VALUES (:titre, :realisateur, :annee, :duree, :synopsis, :affiche)";
        
        $stmt = $db->prepare($sql);
        return $stmt->execute([
            ':titre'       => $data['titre'],
            ':realisateur' => $data['realisateur'],
            ':annee'       => $data['annee'],
            ':duree'       => $data['duree'],
            ':synopsis'    => $data['synopsis'],
            ':affiche'     => $data['affiche']
        ]);
    }

    public static function getAll() {
        $db = Database::getInstance()->getConnection();
        return $db->query("SELECT * FROM films ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function delete($id) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("DELETE FROM films WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public static function getById($id) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM films WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function update($id, $data) {
        $db = Database::getInstance()->getConnection();
        $sql = "UPDATE films SET 
                titre = :titre, 
                realisateur = :realisateur, 
                annee = :annee, 
                duree = :duree, 
                synopsis = :synopsis, 
                affiche = :affiche 
                WHERE id = :id";
                
        $stmt = $db->prepare($sql);
        return $stmt->execute([
            ':titre'       => $data['titre'],
            ':realisateur' => $data['realisateur'],
            ':annee'       => $data['annee'],
            ':duree'       => $data['duree'],
            ':synopsis'    => $data['synopsis'],
            ':affiche'     => $data['affiche'],
            ':id'          => $id
        ]);
    }
}