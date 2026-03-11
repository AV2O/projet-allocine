<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>AlloCiné</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="icon" type="image/png" href="/images/popcorn.png">
    <script src="/js/script.js" defer></script>
</head>

<body>
    <nav>
        <a href="/films" class="logo">🎬 AlloCiné</a>
        <div class="nav-links">
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="/films/add">➕ Ajouter un film</a>
                <a href="/films">Catalogue</a>
                <a href="/logout">Déconnexion</a>
            <?php else: ?>
                <a href="/login">Connexion</a>
                <a href="/register">Inscription</a>
            <?php endif; ?>
        </div>
    </nav>

    <main>
        <?= $content ?>
    </main>

    <footer class="main-footer">
        <p>&copy; <?= date('Y') ?> - par AV2O - tous droits réservés</p>
    </footer>
</body>

</html>