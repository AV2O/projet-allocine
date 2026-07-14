<div class="auth-container">
    <h2>Ajouter un nouveau film</h2>
    
    <form action="/films/add" method="POST" enctype="multipart/form-data" class="film-form">
        <div class="form-group">
            <label for="titre">Titre du film</label>
            <input type="text" id="titre" name="titre" required>
        </div>

        <div class="form-group">
            <label for="realisateur">Réalisateur</label>
            <input type="text" id="realisateur" name="realisateur" required>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="annee">Année</label>
                <input type="number" id="annee" name="annee" min="1895" max="2030" required>
            </div>
            <div class="form-group">
                <label for="duree">Durée (min)</label>
                <input type="number" id="duree" name="duree" min="1" required>
            </div>
        </div>

        <div class="form-group">
            <label for="synopsis">Synopsis</label>
            <textarea id="synopsis" name="synopsis" rows="5"></textarea>
        </div>

        <div class="form-group">
            <label for="affiche_url">URL de l'affiche (Optionnel)</label>
            <input type="url" id="affiche_url" name="affiche_url" placeholder="https://...">
        </div>

        <div class="upload-section">
            <label for="affiche_file" class="file-label">OU Importer un fichier</label>
            <input type="file" id="affiche_file" name="affiche_file" accept="image/*">
        </div>

        <button type="submit" class="btn-primary">Enregistrer le film</button>
    </form>
    
    <a href="/films" class="back-link">← Retour au catalogue</a>
</div>