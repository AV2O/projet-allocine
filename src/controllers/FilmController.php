<?php
require_once __DIR__ . '/../models/Film.php';

class FilmController
{
    private $filmModel;

    public function __construct()
    {
        $this->filmModel = new Film();
        $this->checkAuth();
    }

    // Cette fonction permet d'insérer une vue dans le layout.php
    private function render($viewPath, $data = [])
    {
        extract($data); // Transforme les clés du tableau en variables (ex: $films)
        ob_start();
        include __DIR__ . '/../views/' . $viewPath . '.php';
        $content = ob_get_clean();
        include __DIR__ . '/../views/layout.php';
    }

    public function index()
    {
        $films = $this->filmModel->getAll();
        $this->render('films/index', ['films' => $films]);
    }

    private function checkAuth()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }
    }

    public function add()
    {
        $this->checkAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $affiche = $_POST['affiche_url']; 

            
            if (isset($_FILES['affiche_file']) && $_FILES['affiche_file']['error'] === 0) {
                $uploadDir = __DIR__ . '/../../public/uploads/';

                // Créer le dossier s'il n'existe pas
                if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

                $fileName = time() . '_' . $_FILES['affiche_file']['name'];
                $targetPath = $uploadDir . $fileName;

                if (move_uploaded_file($_FILES['affiche_file']['tmp_name'], $targetPath)) {
                    $affiche = '/uploads/' . $fileName; // On stocke le chemin local
                }
            }

            $data = $_POST;
            $data['affiche'] = $affiche;

            if (Film::create($data)) {
                header('Location: /films');
                exit;
            }
        }
        $this->render('films/add');
    }

    public function delete($id)
    {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Film::delete($id);
        }
        header('Location: /films');
        exit;
    }

    public function show($id)
    {
        $film = Film::getById($id);
        if (!$film) {
            header('Location: /films');
            exit;
        }
        $this->render('films/show', ['film' => $film]);
    }

    public function detail($id)
    {
        $film = Film::getById($id);
        if (!$film) {
            header('Location: /films');
            exit;
        }
        $this->render('films/detail', ['film' => $film]);
    }

    public function edit($id)
    {
        $this->checkAuth();
        $film = Film::getById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $affiche = $_POST['affiche_url'];

            // 2. Si un nouveau fichier est envoyé, on l'utilise
            if (isset($_FILES['affiche_file']) && $_FILES['affiche_file']['error'] === 0) {
                $uploadDir = __DIR__ . '/../../public/uploads/';
                if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

                $fileName = time() . '_' . $_FILES['affiche_file']['name'];
                if (move_uploaded_file($_FILES['affiche_file']['tmp_name'], $uploadDir . $fileName)) {
                    $affiche = '/uploads/' . $fileName;
                }
            }

            // 3. Préparation des données pour le modèle
            $data = [
                'titre' => $_POST['titre'],
                'realisateur' => $_POST['realisateur'],
                'annee' => $_POST['annee'],
                'duree' => $_POST['duree'],
                'synopsis' => $_POST['synopsis'],
                'affiche' => $affiche
            ];

            if (Film::update($id, $data)) {
                header('Location: /films');
                exit;
            }
        }
        $this->render('films/edit', ['film' => $film]);
    }

    public function addComment()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $film_id = $_POST['film_id'];
            $pseudo = $_POST['pseudo'];
            $commentaire = $_POST['commentaire'];
            $note = $_POST['note'];

            $mongoDb = Database::getInstance()->getMongoConnection();
            $mongoDb->reviews->insertOne([
                'film_id'     => (int)$film_id,
                'pseudo'      => htmlspecialchars($pseudo),
                'commentaire' => htmlspecialchars($commentaire),
                'note'        => (int)$note, 
                'date_envoi'  => new MongoDB\BSON\UTCDateTime()
            ]);

            header("Location: /films/detail/" . $film_id);
            exit;
        }
    }
}
