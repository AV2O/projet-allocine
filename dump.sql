-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql
-- Généré le : mar. 14 juil. 2026 à 14:59
-- Version du serveur : 8.0.45
-- Version de PHP : 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `allocine_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `films`
--

CREATE TABLE `films` (
  `id` int NOT NULL,
  `titre` varchar(255) NOT NULL,
  `realisateur` varchar(255) DEFAULT NULL,
  `annee` int DEFAULT NULL,
  `duree` int DEFAULT NULL,
  `synopsis` text,
  `affiche` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `films`
--

INSERT INTO `films` (`id`, `titre`, `realisateur`, `annee`, `duree`, `synopsis`, `affiche`, `created_at`) VALUES
(1, 'Inception', 'Christopher Nolan', 2010, 148, 'Rêves dans des rêves', 'https://image.tmdb.org/t/p/w500/98906be7538f98ec51794b96791b.jpg', '2026-03-25 09:06:15'),
(2, 'Pulp Fiction', 'Quentin Tarantino', 1994, 154, 'Gangs et braquages', '/uploads/1773148426_luffy_cover.jpg', '2026-03-25 09:06:15'),
(5, 'Tarzan', 'Disney', 2013, 128, 'L\'homme élevé par les singes', 'https://picsum.photos/400/600', '2026-03-25 09:06:15'),
(6, 'La casa de papel', 'Netflix', 2024, 45, 'Série épisode 2', '/uploads/1773148384_luffy_cover.jpg', '2026-03-25 09:06:15'),
(7, 'The Dark Knight', 'Christopher Nolan', 2008, 152, 'Le combat de Batman contre le Joker.', 'https://picsum.photos/400/600', '2026-03-25 09:06:15'),
(8, 'Interstellar', 'Christopher Nolan', 2014, 169, 'Un voyage spatial à travers un trou de ver.', 'https://image.tmdb.org/t/p/w500/gEU2QvYvTthvBaseqOOpKDpNm7l.jpg', '2026-03-25 09:06:15'),
(9, 'Fight Club', 'David Fincher', 1999, 139, 'Un employé de bureau insomniaque crée un club de combat.', 'https://image.tmdb.org/t/p/w500/pB8S7SjFWZJjnKN62WvOa9I91pG.jpg', '2026-03-25 09:06:15'),
(10, 'Matrix', 'Les Wachowski', 1999, 136, 'Un hacker découvre que sa réalité est une simulation.', 'https://image.tmdb.org/t/p/w500/f89U3Y9L7dbptvTMRccpP3FdC69.jpg', '2026-03-25 09:06:15'),
(11, 'Seven', 'David Fincher', 1995, 127, 'Deux inspecteurs traquent un tueur en série.', 'https://image.tmdb.org/t/p/w500/69Yjw368S5y2v9fwO687983pB.jpg', '2026-03-25 09:06:15'),
(12, 'Le Parrain', 'Francis Ford Coppola', 1972, 175, 'L\'ascension d\'une famille mafieuse.', 'https://image.tmdb.org/t/p/w500/3bhkrj98Vv9pwcR9R8P62URLEkx.jpg', '2026-03-25 09:06:15'),
(13, 'Gladiator', 'Ridley Scott', 2000, 155, 'Un général romain déchu devient gladiateur.', 'https://image.tmdb.org/t/p/w500/ty8TGRSsp21o96zP01aY1oScv6.jpg', '2026-03-25 09:06:15'),
(14, 'Parasite', 'Bong Joon-ho', 2019, 132, 'Une famille pauvre s\'immisce chez une famille riche.', 'https://image.tmdb.org/t/p/w500/7S9Zas66u1p89vV7IAnS6NThe42.jpg', '2026-03-25 09:06:15'),
(15, 'Léon', 'Luc Besson', 1994, 110, 'Un tueur à gages prend sous son aile une jeune fille.', 'https://image.tmdb.org/t/p/w500/76z9qBv94r79pM9Y8oScwP01aY.jpg', '2026-03-25 09:06:15'),
(16, 'The Truman Show', 'Peter Weir', 1998, 103, 'Un homme découvre que sa vie est une télé-réalité.', 'https://image.tmdb.org/t/p/w500/6S9Zas66u1p89vV7IAnS6NThe42.jpg', '2026-03-25 09:06:15');

-- --------------------------------------------------------

--
-- Structure de la table `film_genre`
--

CREATE TABLE `film_genre` (
  `film_id` int NOT NULL,
  `genre_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `genres`
--

CREATE TABLE `genres` (
  `id` int NOT NULL,
  `nom` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `genres`
--

INSERT INTO `genres` (`id`, `nom`) VALUES
(1, 'Action'),
(3, 'Comédie'),
(2, 'Drame'),
(4, 'Science-Fiction'),
(5, 'Thriller');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `pseudo` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `pseudo`, `created_at`) VALUES
(1, 'alexis.f@email.fr', '$2y$10$CPvs7TKpabFgTsyq7DvGYeQjhtKeZ6BzNFE0ykIHlHSmZk4tl9Xa6', 'alexis', '2026-03-25 09:06:15');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `film_genre`
--
ALTER TABLE `film_genre`
  ADD PRIMARY KEY (`film_id`,`genre_id`),
  ADD KEY `genre_id` (`genre_id`);

--
-- Index pour la table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom` (`nom`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `films`
--
ALTER TABLE `films`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `film_genre`
--
ALTER TABLE `film_genre`
  ADD CONSTRAINT `film_genre_ibfk_1` FOREIGN KEY (`film_id`) REFERENCES `films` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `film_genre_ibfk_2` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
