<div class="auth-container">
    <h2>Connexion</h2>
    <?php if (isset($_SESSION['error'])): ?>
        <p style="color: red;"><?= htmlspecialchars($_SESSION['error']);
                                unset($_SESSION['error']); ?></p>
    <?php endif; ?>

    <form action="/register" method="POST">
        <div>
            <label>Pseudo :</label>
            <input type="text" name="pseudo" required>
        </div>
        <br>
        <div>
            <label>Email :</label>
            <input type="email" name="email" required>
        </div>
        <br>
        <div>
            <label>Mot de passe :</label>
            <input type="password" name="password" required>
        </div>
        <br>
        <button type="submit">Créer mon compte</button>
    </form>
    <p>Déjà inscrit ? <a href="/login">Se connecter</a></p>
</div>