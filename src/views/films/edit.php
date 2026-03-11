<div class="auth-container">
    <h2>Modifier : <?= htmlspecialchars($film['titre']) ?></h2>
    
    <form action="/films/edit/<?= $film['id'] ?>" method="POST" enctype="multipart/form-data">
        
        <div>
            <label>Titre du film</label>
            <input type="text" name="titre" value="<?= htmlspecialchars($film['titre']) ?>" required>
        </div>

        <div>
            <label>Réalisateur</label>
            <input type="text" name="realisateur" value="<?= htmlspecialchars($film['realisateur']) ?>" required>
        </div>

        <div>
            <div style="flex: 1;">
                <label>Année</label>
                <input type="number" name="annee" value="<?= $film['annee'] ?>" required>
            </div>
            <div style="flex: 1;">
                <label>Durée (min)</label>
                <input type="number" name="duree" value="<?= $film['duree'] ?>" required>
            </div>
        </div>

        <div>
            <label>Synopsis</label>
            <textarea name="synopsis" rows="5"><?= htmlspecialchars($film['synopsis']) ?></textarea>
        </div>

        <div>
            <label>URL de l'affiche actuelle</label>
            <input type="text" name="affiche_url" value="<?= htmlspecialchars($film['affiche'] ?? '') ?>">
        </div>

        <div>
            <label>OU Remplacer par un fichier local</label>
            <input type="file" name="affiche_file" accept="image/*">
        </div>

        <button type="submit" class="btn-primary">Mettre à jour</button>
    </form>
</div>