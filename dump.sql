SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- Nettoyage pour un import propre
DROP TABLE IF EXISTS `film_genre`, `films`, `genres`, `users`;

-- 1. STRUCTURE DES TABLES
CREATE TABLE `users` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `email` VARCHAR(255) UNIQUE NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `pseudo` VARCHAR(100) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `genres` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `nom` VARCHAR(100) UNIQUE NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `films` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `titre` VARCHAR(255) NOT NULL,
  `realisateur` VARCHAR(255),
  `annee` INT,
  `duree` INT,
  `synopsis` TEXT,
  `affiche` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `film_genre` (
  `film_id` INT,
  `genre_id` INT,
  PRIMARY KEY (`film_id`, `genre_id`),
  FOREIGN KEY (`film_id`) REFERENCES `films`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`genre_id`) REFERENCES `genres`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. INSERTION DES DONNÉES 
INSERT INTO `genres` (`id`, `nom`) VALUES
(1, 'Action'), (2, 'Drame'), (3, 'Comédie'), (4, 'Science-Fiction'), (5, 'Thriller');

INSERT INTO `films` (`id`, `titre`, `realisateur`, `annee`, `duree`, `synopsis`, `affiche`) VALUES
(1, 'Inception', 'Christopher Nolan', 2010, 148, 'Rêves dans des rêves', '/uploads/inception.jpg'),
(2, 'Pulp Fiction', 'Quentin Tarantino', 1994, 154, 'Gangs et braquages', '/uploads/pulp-fiction.jpg'),
(5, 'Tarzan', 'Disney', 2013, 128, 'L\'homme élevé par les singes', '/uploads/tarzan.jpg'),
(6, 'La casa de papel', 'Netflix', 2024, 45, 'Série épisode 2', '/uploads/laCasaDePapel'),
(7, 'The Dark Knight', 'Christopher Nolan', 2008, 152, 'Le combat de Batman contre le Joker.', '/uploads/theDarkKnight.avif'),
(8, 'Interstellar', 'Christopher Nolan', 2014, 169, 'Un voyage spatial à travers un trou de ver.', '/uploads/interstellar.jpg'),
(9, 'Fight Club', 'David Fincher', 1999, 139, 'Un employé de bureau insomniaque crée un club de combat.', '/uploads/fightClub.jpg'),
(10, 'Matrix', 'Les Wachowski', 1999, 136, 'Un hacker découvre que sa réalité est une simulation.', '/uploads/matrix.jpg'),
(11, 'Seven', 'David Fincher', 1995, 127, 'Deux inspecteurs traquent un tueur en série.', '/uploads/seven.jpg'),
(12, 'Le Parrain', 'Francis Ford Coppola', 1972, 175, 'L\'ascension d\'une famille mafieuse.', '/uploads/leParrain.jpg'),
(13, 'Gladiator', 'Ridley Scott', 2000, 155, 'Un général romain déchu devient gladiateur.', '/uploads/Gladiator.png'),
(14, 'Parasite', 'Bong Joon-ho', 2019, 132, 'Une famille pauvre s\'immisce chez une famille riche.', '/uploads/Parasite.webp'),
(15, 'Léon', 'Luc Besson', 1994, 110, 'Un tueur à gages prend sous son aile une jeune fille.', '/uploads/leon.jpg'),
(16, 'The Truman Show', 'Peter Weir', 1998, 103, 'Un homme découvre que sa vie est une télé-réalité.', '/uploads/theTrumanShow.jpg');

-- Utilisateur 
INSERT INTO `users` (`id`, `email`, `password`, `pseudo`) VALUES
(1, 'alexis.f@email.fr', '$2y$10$CPvs7TKpabFgTsyq7DvGYeQjhtKeZ6BzNFE0ykIHlHSmZk4tl9Xa6', 'alexis');

SET FOREIGN_KEY_CHECKS = 1;