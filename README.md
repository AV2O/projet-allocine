# 🎬 AlloCiné - Plateforme de Gestion de Films

Bienvenue sur mon projet AlloCiné ! Cette application est un exercice complet de développement web full-stack, mettant en œuvre une architecture conteneurisée et une gestion de données hybride.

## 🌟 Fonctionnalités principales

- **Catalogue de films :** Affichage dynamique des films sous forme de grille.
- **Gestion SQL :** Utilisation de MySQL pour les données structurées (utilisateurs, films, genres).
- **Gestion NoSQL :** Utilisation de MongoDB pour le stockage souple des avis et commentaires.
- **Espace Membre :** Inscription et connexion sécurisée des utilisateurs.
- **Initialisation Auto :** La base de données se remplit automatiquement au premier lancement.

---

## 🛠️ Infrastructure & Outils

Le projet tourne entièrement sous **Docker**. Voici les accès directs pour piloter l'application :

| Service | Accès Navigateur | Rôle |
| :--- | :--- | :--- |
|  App Web** | [http://localhost:8080](http://localhost:8080) | Interface utilisateur (PHP/Apache) |
|  phpMyAdmin** | [http://localhost:8082](http://localhost:8082) | Gestion visuelle de **MySQL** |
|  DbGate** | [http://localhost:8086](http://localhost:8086) | Gestion visuelle de **MongoDB** |

---

## 🏗️ Architecture des Données

Ce projet utilise deux moteurs de base de données pour répondre à des besoins différents :
1. **MySQL (Relationnel) :** Pour tout ce qui nécessite des relations strictes (ex: un film appartient à un genre, un utilisateur possède un email unique).
2. **MongoDB (Document) :** Pour les avis. Cela permet de stocker des commentaires sans structure fixe (notes, textes longs, réactions) de manière très performante.

---

## 🚀 Installation rapide

1. Assurez-vous que **Docker Desktop** est lancé.
2. Clonez le projet et ouvrez un terminal dans le dossier.
3. Lancez les services :
   ```bash
   docker compose up -d