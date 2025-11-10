-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 01 nov. 2025 à 21:00
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gftnth00_wp333`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`) VALUES
(4, 'Arcade'),
(5, 'Projet finissant'),
(6, 'Jour de la Terre'),
(7, 'Populaire');

-- --------------------------------------------------------

--
-- Structure de la table `etudiants`
--

CREATE TABLE `etudiants` (
  `id` int(11) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `photo_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `etudiants`
--

INSERT INTO `etudiants` (`id`, `prenom`, `nom`, `photo_url`) VALUES
(1, 'Malaïka', 'Abevi', NULL),
(2, 'Ibrahima Nouhou', 'Bah', NULL),
(3, 'Lîna', 'Bensenouci', NULL),
(4, 'Justin', 'Bonin', NULL),
(5, 'Mélanie', 'Caillol', NULL),
(6, 'Samuel', 'César', NULL),
(7, 'Gabriel', 'Chan-Dion', NULL),
(8, 'Weiqiang', 'Chen', NULL),
(9, 'Alexis', 'David', NULL),
(10, 'Arthur', 'Fanton', NULL),
(11, 'Leyna', 'Feknous', NULL),
(12, 'Peterson', 'Germain', NULL),
(13, 'Valérie', 'Giroux-Martone', NULL),
(14, 'Yohan', 'Jacques', NULL),
(15, 'Lhaïssa Nomie', 'Jérôme', NULL),
(16, 'Matilda', 'Kang', NULL),
(17, 'Emile', 'Litalien', NULL),
(18, 'Arik', 'Malenfant-Lacombe', NULL),
(19, 'Sébastien', 'Malo', NULL),
(20, 'David', 'Marier', NULL),
(21, 'Laurence', 'Mongeau', NULL),
(22, 'Sophie', 'Nadeau', NULL),
(23, 'Guillaume', 'Nagy', NULL),
(24, 'Yanis', 'Oulmane', NULL),
(25, 'Léo', 'Paquet-Gauthier', NULL),
(26, 'Erik', 'Perez Angel', NULL),
(27, 'Lili-Rose', 'Perreault', NULL),
(28, 'Rémy', 'Roger', NULL),
(29, 'Alicia', 'Sau', NULL),
(30, 'Azpen', 'Sbrizzi', NULL),
(31, 'Constantin', 'Schmouker', NULL),
(32, 'Justin', 'Soulard', NULL),
(33, 'Hanson', 'Tan', NULL),
(34, 'Johnny', 'Tan', NULL),
(35, 'Valérie', 'Therrien', NULL),
(36, 'Massimo', 'Trimboli', NULL),
(37, 'Laura', 'Visentin', NULL),
(38, 'Matys', 'Voisin', NULL),
(39, 'Eric', 'Vu', NULL),
(40, 'Wichardson', 'Jean-Baptiste', NULL),
(41, 'Maxim', 'Chauvette', NULL),
(43, 'Sammuel', 'Rwota', NULL),
(45, 'Faranirina', 'Julianna Rakotoson', NULL),
(46, 'Imane', 'Mechali', NULL),
(48, 'Jeslyn', 'Chung', NULL),
(49, 'Alexandre', 'Leblanc', NULL),
(50, 'Noah', 'Moreau Gomez-Urda', NULL),
(51, 'Batoul', 'Fakih', NULL),
(52, 'Naïka', 'Odélus', NULL),
(53, 'Rima', 'Wangue', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `etudiants_projets_arcade`
--

CREATE TABLE `etudiants_projets_arcade` (
  `etudiant_id` int(11) NOT NULL,
  `projet_arcade_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `etudiants_projets_arcade`
--

INSERT INTO `etudiants_projets_arcade` (`etudiant_id`, `projet_arcade_id`) VALUES
(1, 8),
(3, 9),
(4, 1),
(5, 3),
(6, 5),
(8, 4),
(9, 1),
(10, 5),
(12, 2),
(13, 2),
(14, 4),
(15, 9),
(16, 6),
(17, 3),
(18, 3),
(19, 8),
(20, 9),
(21, 7),
(22, 1),
(23, 7),
(24, 8),
(25, 1),
(26, 6),
(27, 7),
(28, 4),
(29, 6),
(30, 9),
(31, 5),
(32, 7),
(33, 6),
(34, 4),
(35, 1),
(37, 2),
(38, 8),
(39, 6);

-- --------------------------------------------------------

--
-- Structure de la table `etudiants_projets_terre`
--

CREATE TABLE `etudiants_projets_terre` (
  `etudiant_id` int(11) NOT NULL,
  `projet_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `etudiants_projets_terre`
--

INSERT INTO `etudiants_projets_terre` (`etudiant_id`, `projet_id`) VALUES
(1, 11),
(16, 13),
(19, 10),
(43, 10),
(45, 12),
(46, 12),
(48, 13),
(49, 14),
(50, 14),
(51, 15),
(52, 16),
(53, 16);

-- --------------------------------------------------------

--
-- Structure de la table `populaire`
--

CREATE TABLE `populaire` (
  `projet_id` int(11) NOT NULL,
  `score` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `projets`
--

CREATE TABLE `projets` (
  `id` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `projets`
--

INSERT INTO `projets` (`id`, `categorie_id`, `titre`, `description`) VALUES
(1, 4, 'Dramatour', 'Jeu multijoueur en écran séparé où il faut construire la tour la plus haute dans un environnement théâtral.'),
(2, 4, 'L’Ombre', 'L’Ombre est un jeu de plateforme 3D d’horreur dans lequel vous incarnez R.E.D, un petit robot de maintenance envoyé en mission de dernier recours. À bord d’un vaisseau scientifique abandonné, la recherche a mal tourné et quelque chose de sombre rôde désormais dans les couloirs.'),
(3, 4, 'Éveil', 'Un jeu d’aventure linéaire parsemé de défis où le joueur devra utiliser son ingéniosité pour achever les tâches données par l’Intelligence Artificielle dans le but d’accomplir son objectif... ou de la trahir.'),
(4, 4, 'Réalité Fragmentée', 'Dans l’enfer du Vietnam, William Robinson disparaît et se réveille loin du front, mais proche de la folie dans un asile abandonné. Couloirs décrépis, ombres qui murmurent et une réalité qui se fissure… Trouvez les pages de son journal et survivez.'),
(5, 4, 'Opsis', 'Opsis est un jeu 2D basé sur l’introspection du joueur. Vous incarnez Aster, un adolescent vivant dans un petit village dans un monde inspiré du temps médiéval.'),
(6, 4, 'Intemporel', 'Un homme se réveille dans un lieu sombre et inconnu après avoir été kidnappé par un individu mystérieux. Utilisé comme cobaye dans une série d’expérimentations troublantes, il devra affronter des pièges, résoudre des énigmes et survivre à des horreurs cachées pour espérer retrouver la liberté.'),
(7, 4, 'Meliora', 'X6T, petit robot de l’espace, explore une nouvelle galaxie. Cette fois, son aventure le conduit tout près de Méliora, étrange petite planète violette. Malheur ! X6T entre en collision avec un astéroïde et s’écrase sur la mystérieuse planète.'),
(8, 4, 'Hachiman', 'Hachiman est un jeu d’aventure et de combat narratif inspiré de la culture japonaise et de grands classiques du genre fantastique, tels qu’Elden Ring et Sekiro. Le joueur incarne Hachiman, un jeune Adachi persécuté pour ses pouvoirs magiques, qui se bat pour survivre et mettre fin à l’oppression de son peuple.'),
(9, 4, 'Code 3', 'Code 3 est un jeu 3D solo créé dans le cadre du cours Création de jeux en équipe pour l’hiver 2025. Le joueur incarne Numéro 3, qui se réveille dans un bunker après une crise apocalyptique. Il doit s’échapper du labyrinthe, éviter les monstres et interagir avec un mystérieux marchand pour espérer survivre.'),
(10, 6, 'Charge vélo', 'Pédaler permet de produire de l’électricité pour son logement et ses appareils.'),
(11, 6, 'Écolire', 'Le but de l’application est d’offrir une plateforme permettant de donner une seconde vie aux livres des étudiants du Collège. De plus, elle servira à sensibiliser la population étudiante sur la pollution et les enjeux environnementaux liés à l’industrie du papier.'),
(12, 6, 'Écoruche', 'Ecoruche est une application innovante qui encourage les habitants à prendre soin de leur environnement en leur permettant d\'améliorer l\'état de leurs quartiers. Les utilisateurs peuvent organiser des actions de nettoyage, planter des plantes et des arbres, et partager des graines avec leurs voisins pour promouvoir la biodiversité. L\'application offre une plateforme pour documenter et partager les progrès, avec des fonctionnalités avant-après pour mettre en valeur les transformations des espaces publics. Ecoruche vise à renforcer le sentiment de communauté et de responsabilité envers la nature, tout en contribuant à rendre les quartiers plus verts et plus agréables à vivre.'),
(13, 6, 'Écotidien', 'Le joueur prend le rôle d\'un extraterrestre venant d\'une exoplanète similaire à la Terre, mais cette exoplanète a été détruite par leur propre manque de considération à leur planète et leur consommation non-durable. Cherchant un nouveau foyer, il atterrit sur la Terre et constate avec déception que les humains répètent la même erreur. Déterminé à éviter ce destin funeste, l\'extraterrestre se transforme en humain pour mieux comprendre la société terrienne et la guider vers un avenir durable.'),
(14, 6, 'Lybonrehct', 'Le drame de Lybonrenct, encore plus grave que Tchernobyl, a marqué un tournant dans l’histoire de l’énergie nucléaire. Une tempête radioactive a déclenché une réaction en chaîne, faisant exploser plusieurs génératrices nucléaires à travers le pays. Ce jeu de survie et d’horreur post-apocalyptique te place dans la peau d’un survivant pris dans ce chaos, tentant de rejoindre un vieux bunker situé au cœur d’une grande ville. La tempête te poursuit sans relâche, et ton seul espoir est ta voiture, avec laquelle tu dois traverser des routes désertes, t’arrêter dans des maisons abandonnées pour chercher de la nourriture, et éviter les bêtes irradiées devenues folles.'),
(15, 6, 'Mi jour', 'Vivant seul dans un château, vous êtes un vampire qui court la ville voisine pour vos promenades nocturnes et bien sûr, mangez quelques victimes. Mais les temps ont changé. Toute la ville est devenue trop lumineuse pour vous due aux nombreuses sources de lumière artificielle. La région est devenue tellement illuminée qu’elle est capable de brûler votre peau. Alors, il est de votre devoir de reprendre l’obscurité perdue de la nuit en détruisant le plus d’objets brillants possible.'),
(16, 6, 'Opération coraux', 'Notre mini jeu mobile divertissant et éducatif suit la quête d’une tortue verte nommée Iluka qui doit migrer hors de la barrière de corail qui est devenue invivable face au blanchissement, à la pollution par les micro plastiques et à l’activité humaine constante dans ce milieu.');

-- --------------------------------------------------------

--
-- Structure de la table `projets_arcade`
--

CREATE TABLE `projets_arcade` (
  `projet_id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `projets_arcade`
--

INSERT INTO `projets_arcade` (`projet_id`, `titre`, `description`, `video_url`, `image_url`) VALUES
(1, 'Dramatour', 'Jeu multijoueur en écran séparé où il faut construire la tour la plus haute dans un environnement théâtral.', 'https://www.youtube.com/watch?v=hwYKBv_Yuzw&list=PLK9vPiFDI9I-T61FM4aXEOuuJ1HLMMvKk&index=8', NULL),
(2, 'L’Ombre', 'L’Ombre est un jeu de plateforme 3D d’horreur dans lequel vous incarnez R.E.D, un petit robot de maintenance envoyé en mission de dernier recours. À bord d’un vaisseau scientifique abandonné, la recherche a mal tourné et quelque chose de sombre rôde désormais dans les couloirs.', 'https://www.youtube.com/watch?v=N5lOLT8SLkI&list=PLK9vPiFDI9I-T61FM4aXEOuuJ1HLMMvKk&index=18', NULL),
(3, 'Éveil', 'Un jeu d’aventure linéaire parsemé de défis où le joueur devra utiliser son ingéniosité pour achever les tâches données par l’Intelligence Artificielle dans le but d’accomplir son objectif... ou de la trahir.', 'https://www.youtube.com/watch?v=NgIfoEoa5Po&list=PLK9vPiFDI9I-T61FM4aXEOuuJ1HLMMvKk&index=10', NULL),
(4, 'Réalité Fragmentée', 'Dans l’enfer du Vietnam, William Robinson disparaît et se réveille loin du front, mais proche de la folie dans un asile abandonné. Couloirs décrépis, ombres qui murmurent et une réalité qui se fissure… Trouvez les pages de son journal et survivez.', 'https://www.youtube.com/watch?v=WZU15Z3_7ZQ&list=PLK9vPiFDI9I-T61FM4aXEOuuJ1HLMMvKk&index=12', NULL),
(5, 'Opsis', 'Opsis est un jeu 2D basé sur l’introspection du joueur. Vous incarnez Aster, un adolescent vivant dans un petit village dans un monde inspiré du temps médiéval.', 'https://www.youtube.com/watch?v=Bf9RJyF_6nk&list=PLK9vPiFDI9I-T61FM4aXEOuuJ1HLMMvKk&index=16', NULL),
(6, 'Intemporel', 'Un homme se réveille dans un lieu sombre et inconnu après avoir été kidnappé par un individu mystérieux. Utilisé comme cobaye dans une série d’expérimentations troublantes, il devra affronter des pièges, résoudre des énigmes et survivre à des horreurs cachées pour espérer retrouver la liberté.', 'https://www.youtube.com/watch?v=21zyc_FERTw&list=PLK9vPiFDI9I-T61FM4aXEOuuJ1HLMMvKk&index=2', NULL),
(7, 'Meliora', 'X6T, petit robot de l’espace, explore une nouvelle galaxie. Cette fois, son aventure le conduit tout près de Méliora, étrange petite planète violette. Malheur ! X6T entre en collision avec un astéroïde et s’écrase sur la mystérieuse planète.', 'https://www.youtube.com/watch?v=D8s__a91FTs&list=PLK9vPiFDI9I-T61FM4aXEOuuJ1HLMMvKk&index=4', NULL),
(8, 'Hachiman', 'Hachiman est un jeu d’aventure et de combat narratif inspiré de la culture japonaise et de grands classiques du genre fantastique, tels qu’Elden Ring et Sekiro. Le joueur incarne Hachiman, un jeune Adachi persécuté pour ses pouvoirs magiques, qui se bat pour survivre et mettre fin à l’oppression de son peuple.', 'https://www.youtube.com/watch?v=VMeXxPyAlyc&list=PLK9vPiFDI9I-T61FM4aXEOuuJ1HLMMvKk&index=6', NULL),
(9, 'Code 3', 'Code 3 est un jeu 3D solo créé dans le cadre du cours Création de jeux en équipe pour l’hiver 2025. Le joueur incarne Numéro 3, qui se réveille dans un bunker après une crise apocalyptique. Il doit s’échapper du labyrinthe, éviter les monstres et interagir avec un mystérieux marchand pour espérer survivre.', 'https://www.youtube.com/watch?v=1f6azUj1Av8&list=PLK9vPiFDI9I-T61FM4aXEOuuJ1HLMMvKk&index=14', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `projets_finissants`
--

CREATE TABLE `projets_finissants` (
  `projet_id` int(11) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `projets_jour_terre`
--

CREATE TABLE `projets_jour_terre` (
  `projet_id` int(11) NOT NULL,
  `nom_projet` varchar(255) DEFAULT NULL,
  `site_url` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `projets_jour_terre`
--

INSERT INTO `projets_jour_terre` (`projet_id`, `nom_projet`, `site_url`, `description`, `image`) VALUES
(10, 'Charge vélo', 'https://www.behance.net/gallery/195519651/TP2B-Charge-vlo', 'Pédaler permet de produire de l’électricité pour son logement et ses appareils.', NULL),
(11, 'Écolire', 'https://www.behance.net/gallery/194237421/EcoLire-Un-projet-pour-lenvironnement', 'Le but de l’application est d’offrir une plateforme permettant de donner une seconde vie aux livres des étudiants du Collège. Elle sensibilise aussi la population étudiante à la pollution et aux enjeux environnementaux liés à l’industrie du papier.', NULL),
(12, 'Écoruche', 'https://www.behance.net/gallery/222557649/Projet-jour-de-la-terre', 'Ecoruche est une application qui encourage les habitants à prendre soin de leur environnement en organisant des actions de nettoyage, de plantation et de partage de graines pour promouvoir la biodiversité. Elle renforce la communauté et la responsabilité écologique.', NULL),
(13, 'Écotidien', 'https://www.behance.net/gallery/195671753/Ecotidien-Concept-de-jeu', 'Le joueur incarne un extraterrestre dont la planète a été détruite par la surconsommation. En arrivant sur Terre, il cherche à guider les humains vers un avenir durable et à éviter le même destin tragique.', NULL),
(14, 'Lybonrehct', 'https://www.behance.net/gallery/224048593/LYBONREHCT', 'Le drame de Lybonrehct, pire que Tchernobyl, a causé une tempête radioactive. Ce jeu de survie post-apocalyptique te met dans la peau d’un survivant cherchant refuge dans un bunker tout en échappant à la tempête et aux bêtes irradiées.', NULL),
(15, 'Mi jour', 'https://www.behance.net/gallery/222436201/Mijour', 'Vous incarnez un vampire dans une ville devenue trop lumineuse à cause des sources de lumière artificielle. Votre mission est de ramener l’obscurité de la nuit en détruisant un maximum d’objets brillants.', NULL),
(16, 'Opération coraux', 'https://www.behance.net/gallery/195517227/Opration-Coraux-Projet-jour-de-la-terre', 'Mini-jeu éducatif suivant la tortue verte Iluka, fuyant une barrière de corail détruite par le blanchissement, la pollution plastique et l’activité humaine. Le jeu sensibilise à la préservation des océans.', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `etudiants`
--
ALTER TABLE `etudiants`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `etudiants_projets_arcade`
--
ALTER TABLE `etudiants_projets_arcade`
  ADD PRIMARY KEY (`etudiant_id`,`projet_arcade_id`),
  ADD KEY `projet_arcade_id` (`projet_arcade_id`);

--
-- Index pour la table `etudiants_projets_terre`
--
ALTER TABLE `etudiants_projets_terre`
  ADD PRIMARY KEY (`etudiant_id`,`projet_id`),
  ADD KEY `projet_id` (`projet_id`);

--
-- Index pour la table `populaire`
--
ALTER TABLE `populaire`
  ADD PRIMARY KEY (`projet_id`);

--
-- Index pour la table `projets`
--
ALTER TABLE `projets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categorie_id` (`categorie_id`);

--
-- Index pour la table `projets_arcade`
--
ALTER TABLE `projets_arcade`
  ADD PRIMARY KEY (`projet_id`);

--
-- Index pour la table `projets_finissants`
--
ALTER TABLE `projets_finissants`
  ADD PRIMARY KEY (`projet_id`);

--
-- Index pour la table `projets_jour_terre`
--
ALTER TABLE `projets_jour_terre`
  ADD PRIMARY KEY (`projet_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `etudiants`
--
ALTER TABLE `etudiants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT pour la table `projets`
--
ALTER TABLE `projets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `etudiants_projets_arcade`
--
ALTER TABLE `etudiants_projets_arcade`
  ADD CONSTRAINT `fk_etudiant_arcade` FOREIGN KEY (`etudiant_id`) REFERENCES `etudiants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_projet_arcade` FOREIGN KEY (`projet_arcade_id`) REFERENCES `projets_arcade` (`projet_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `etudiants_projets_terre`
--
ALTER TABLE `etudiants_projets_terre`
  ADD CONSTRAINT `etudiants_projets_terre_ibfk_1` FOREIGN KEY (`etudiant_id`) REFERENCES `etudiants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `etudiants_projets_terre_ibfk_2` FOREIGN KEY (`projet_id`) REFERENCES `projets` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `populaire`
--
ALTER TABLE `populaire`
  ADD CONSTRAINT `populaire_ibfk_1` FOREIGN KEY (`projet_id`) REFERENCES `projets` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `projets`
--
ALTER TABLE `projets`
  ADD CONSTRAINT `projets_ibfk_1` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`);

--
-- Contraintes pour la table `projets_arcade`
--
ALTER TABLE `projets_arcade`
  ADD CONSTRAINT `projets_arcade_ibfk_1` FOREIGN KEY (`projet_id`) REFERENCES `projets` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `projets_finissants`
--
ALTER TABLE `projets_finissants`
  ADD CONSTRAINT `projets_finissants_ibfk_1` FOREIGN KEY (`projet_id`) REFERENCES `projets` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `projets_jour_terre`
--
ALTER TABLE `projets_jour_terre`
  ADD CONSTRAINT `projets_jour_terre_ibfk_1` FOREIGN KEY (`projet_id`) REFERENCES `projets` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
