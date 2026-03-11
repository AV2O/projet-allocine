<div class="auth-container">
    <h2>Connexion</h2>
    <?php if (isset($_SESSION['error'])): ?>
        <p style="color: red;"><?= htmlspecialchars($_SESSION['error']);
                                unset($_SESSION['error']); ?></p>
    <?php endif; ?>
    <?php if (isset($_SESSION['error'])): ?>
        <p style="color: red;"><?= $_SESSION['error'];
                                unset($_SESSION['error']); ?></p>
    <?php endif; ?>

    <form action="/login" method="POST">
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
        <button type="submit">Se connecter</button>
    </form>
    <p>Pas encore de compte ? <a href="/register">S'inscrire</a></p>
</div>