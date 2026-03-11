<div class="container">
    <h2>Catalogue des films</h2>

    <div class="films-grid">
        <?php foreach ($films as $film): ?>
            <div class="film-card">

                <div class="film-poster-container">
                    <?php if (!empty($film['affiche'])): ?>
                        <img src="<?= htmlspecialchars(trim($film['affiche'])) ?>" alt="Affiche de <?= htmlspecialchars($film['titre']) ?>" class="film-poster">
                    <?php else: ?>
                        <div class="no-poster">
                            <span>🎬 Pas d'affiche</span>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="film-info">
                    <h3><?= htmlspecialchars($film['titre']) ?></h3>
                    <p><?= htmlspecialchars($film['realisateur']) ?> • <?= $film['annee'] ?></p>
                    <a href="/films/detail/<?= $film['id'] ?>" class="btn-detail">Voir la fiche</a>
                    <?php if (isset($_SESSION['user_id'])): ?>

                        <div class="admin-actions">
                            <a href="/films/edit/<?= $film['id'] ?>" class="btn-edit">✏️ Modifier</a>
                            <form action="/films/delete/<?= $film['id'] ?>" method="POST" class="delete-form">
                                <button type="submit" class="btn-delete">🗑️ Supprimer</button>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>

            </div>
        <?php endforeach; ?>
    </div>
</div>