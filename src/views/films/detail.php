<?php
require_once __DIR__ . '/../../config/Database.php';

// Ta logique de récupération d'ID (ne pas changer ce qui marche)
if (!isset($id)) {
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $parts = explode('/', trim($uri, '/'));
    $id = end($parts);
}

$pdo = Database::getInstance()->getConnection();
$query = $pdo->prepare("SELECT * FROM films WHERE id = ?");
$query->execute([(int)$id]);
$movie = $query->fetch();

// Si le film n'existe pas, on garde ton message d'erreur
if (!$movie) {
    echo "<div class='detail-container'><h1>Ce film n'existe pas</h1></div>";
    exit;
}

$mongoDb = Database::getInstance()->getMongoConnection();
$reviews = $mongoDb->reviews->find(['film_id' => (int)$id]);
?>

<div class="container">
    <div class="detail-layout">

        <main class="movie-main">
            <h1><?= htmlspecialchars($movie['titre']) ?></h1>
            <div class="movie-meta">
                <?= htmlspecialchars($movie['realisateur']) ?> • <?= $movie['annee'] ?>
            </div>
            <p class="movie-synopsis"><?= nl2br(htmlspecialchars($movie['synopsis'])) ?></p>
        </main>

        <aside class="movie-aside">
            <h3>Avis des spectateurs</h3>
            <?php foreach ($reviews as $review): ?>
                <div class="review-card-small">
                    <div style="display:flex; justify-content:space-between; margin-bottom:5px;">
                        <strong style="color:var(--accent);"><?= htmlspecialchars($review['pseudo']) ?></strong>
                        <span style="font-size:0.75rem;">⭐ <?= $review['note'] ?? '-' ?>/5</span>
                    </div>
                    <p style="color:var(--text-dim);"><?= htmlspecialchars($review['commentaire']) ?></p>
                </div>
            <?php endforeach; ?>
        </aside>

    </div>
    <div class="auth-container">
        <h4>Laisser un avis</h4>
        <form action="/comment/add" method="POST">
            <input type="hidden" name="film_id" value="<?= $id ?>">
            <input type="text" name="pseudo" placeholder="Votre pseudo" required>
            <textarea name="commentaire" placeholder="Votre commentaire..." required></textarea>
            <select name="note">
                <option value="5">⭐⭐⭐⭐⭐</option>
                <option value="4">⭐⭐⭐⭐</option>
                <option value="3">⭐⭐⭐</option>
                <option value="2">⭐⭐</option>
                <option value="1">⭐</option>
            </select>
            <button type="submit">Envoyer</button>
        </form>
    </div>
</div>