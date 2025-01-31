-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 31 jan. 2025 à 08:43
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
-- Base de données : `fil_rouge`
--

-- --------------------------------------------------------

--
-- Structure de la table `abonnement`
--

CREATE TABLE `abonnement` (
  `abn_id` int(11) NOT NULL,
  `abn_date` date NOT NULL,
  `abn_type` varchar(50) NOT NULL,
  `abn_status` tinyint(1) NOT NULL,
  `abn_dte_expiration` datetime NOT NULL,
  `abn_type_renouvellement` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `age`
--

CREATE TABLE `age` (
  `age_id` int(11) NOT NULL,
  `age_nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `age`
--

INSERT INTO `age` (`age_id`, `age_nom`) VALUES
(1, 'A partir de 5 ans'),
(2, 'A partir de 8 ans'),
(3, 'A partir de 10 ans'),
(4, 'A partir de 13 ans');

-- --------------------------------------------------------

--
-- Structure de la table `auteurs`
--

CREATE TABLE `auteurs` (
  `a_id` int(11) NOT NULL,
  `a_nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `auteurs`
--

INSERT INTO `auteurs` (`a_id`, `a_nom`) VALUES
(1, 'Antoine Bauza'),
(2, 'Bruno Faidutti'),
(3, 'Ludovic Maublanc'),
(4, 'Reiner Knizia'),
(5, 'Adam Kwapiński'),
(6, 'Christine Alcouffe'),
(7, 'Alexis Allard'),
(8, 'Benoit Turpin'),
(9, 'Fabien Gridel'),
(10, 'Jamey Stegmaier');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `ctg_id` int(11) NOT NULL,
  `ctg_nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`ctg_id`, `ctg_nom`) VALUES
(1, 'Jeu de plateau'),
(2, 'Jeu de dés'),
(3, 'Jeu de cartes'),
(4, 'Jeu de coopération'),
(5, 'Jeu de lettres'),
(6, 'Jeu d\'adresse'),
(7, 'Jeu de connaissances'),
(8, 'Jeu de logique'),
(9, 'Jeu d\'enquête');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `clt_id` int(11) NOT NULL,
  `clt_prenom` varchar(50) NOT NULL,
  `clt_nom` varchar(50) NOT NULL,
  `clt_adress` varchar(50) NOT NULL,
  `clt_cp` varchar(50) NOT NULL,
  `clt_ville` varchar(50) NOT NULL,
  `clt_numero_tel` varchar(15) NOT NULL,
  `u_id` int(11) NOT NULL,
  `abn_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `cmd_ref` varchar(20) NOT NULL,
  `cmd_date` datetime NOT NULL,
  `cmd_date_livraison_estime` date NOT NULL,
  `cmd_dte_livraison` date DEFAULT NULL,
  `cmd_dte_expedition` date DEFAULT NULL,
  `cmd_status` varchar(50) NOT NULL,
  `lvrs_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `clt_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `editeur`
--

CREATE TABLE `editeur` (
  `edit_id` int(11) NOT NULL,
  `edit_nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `editeur`
--

INSERT INTO `editeur` (`edit_id`, `edit_nom`) VALUES
(1, 'Gigamic'),
(2, 'USAopoly'),
(3, 'Mattel'),
(4, 'Goliath'),
(5, 'Bezier Games'),
(6, 'Matagot'),
(7, 'Lucky Duck Games');

-- --------------------------------------------------------

--
-- Structure de la table `jeu`
--

CREATE TABLE `jeu` (
  `jeu_id` int(11) NOT NULL,
  `jeu_nom` varchar(50) NOT NULL,
  `jeu_img` varchar(500) NOT NULL,
  `jeu_prix` decimal(15,2) NOT NULL,
  `jeu_EAN` varchar(50) NOT NULL,
  `jeu_dte_creation` int(4) NOT NULL,
  `jeu_nb_joueurs` varchar(50) NOT NULL,
  `jeu_description` varchar(2500) NOT NULL,
  `jeu_temps` varchar(50) NOT NULL,
  `jeu_qte_stc` int(11) NOT NULL,
  `jeu_note` decimal(2,1) DEFAULT NULL,
  `edit_id` int(11) NOT NULL,
  `pays_id` int(11) NOT NULL,
  `ctg_id` int(11) NOT NULL,
  `age_id` int(11) NOT NULL,
  `m_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `jeu`
--

INSERT INTO `jeu` (`jeu_id`, `jeu_nom`, `jeu_img`, `jeu_prix`, `jeu_EAN`, `jeu_dte_creation`, `jeu_nb_joueurs`, `jeu_description`, `jeu_temps`, `jeu_qte_stc`, `jeu_note`, `edit_id`, `pays_id`, `ctg_id`, `age_id`, `m_id`) VALUES
(1, 'La Guerre de l\'Anneau : Le Jeu de Cartes', 'https://les-meeples.fr/images/boardgames/main/la-guerre-de-lanneau-le-jeu-de-cartes-contre-lombre-extension_1719915103.jpg', 18.80, '2199000145717', 2004, '2 à 4 joueurs', 'Deux à quatre joueurs s’affrontent en deux équipes, les Peuples Libres contre l’Ombre. Les Peuples Libres tentent désespérément de mener à bien la destruction de l’Anneau. L’Ombre doit frapper rapidement et de manière décisive avant que les porteurs de l’Anneau ne réussissent leur quête\r\n\r\nChaque joueur possède des cartes représentant les forces et les faiblesses des factions impliquées dans la guerre. Pour gagner, il va falloir se focaliser sur votre objectif mais aussi surveiller les actions de vos adversaires. Pendant une manche, vous jouez des cartes représentant des personnages, armées, objets et événements de la Guerre de l’Anneau. À la fin de chaque manche, les combats sont résolus. Vous gagnez des points de victoire en remportant des combats. Plusieurs scénarios possibles, (de la Comté à la Montagne du Destin, un autre basé sur le premier livre, ou encore le duel, pour deux joueurs).', '1 à 2h', 12, NULL, 2, 2, 1, 2, 4),
(2, 'Les Loups-Garous de Thiercelieux', 'https://m.media-amazon.com/images/I/81ok3GQCS4L.jpg', 9.95, '3558380086000', 1986, '8 à 24 joueurs', 'De nouvelles options de jeu, plus de pouvoirs révélés pour les joueurs, une compatibilité parfaite avec l’extension Nouvelle Lune, plus de 120 combinaisons possibles entre personnages et métiers… on s’en lèche les babines !\r\nAttribuez des logements et un métier aux Villageois, regardez-les se disputer ces fonctions et s’éliminer les uns les autres pour les obtenir… Une profondeur de jeu inégalée et des centaines d’heures de jeu en perspective !\r\nCette extension nécessite le jeu de base pour être jouée.', '30 minutes à 1h', 7, NULL, 7, 1, 3, 3, 2),
(3, 'Uno', 'https://www.didacto.com/10860-large_default/uno.jpg', 13.95, '746775036744', 1971, '2 à 10 joueurs', 'Uno est sans aucun doute le jeu de cartes le plus célèbre du monde. \r\n\r\nCréé aux États-Unis en 1971 mais édité seulement en 1985, ce jeu de société s\'appuie sur les règles de base du 8 américains, agrémenté de quelques règles supplémentaires qui le rendent unique. Uno est un jeu de défausse et de réflexe qui repose sur la rapidité et la prise de décision. \r\n\r\nAvec des règles faciles à apprendre, vous serez rapidement gagné par la frénésie du jeu. Uno est un excellent jeu d\'ambiance pour 2 à 10 joueurs.', 'Moins de 30 minutes', 8, NULL, 4, 1, 3, 1, 1),
(4, 'Harry Potter - Hogwarts Battle', 'https://m.media-amazon.com/images/I/91ImqKtxF3L._AC_UF1000,1000_QL80_.jpg', 63.50, '700304047700', 2016, '2 à 4 joueurs', 'C\'est à quatre élèves d\'assurer la sécurité de l\'école en vainquant les méchants et en consolidant leurs défenses. Dans le jeu, les joueurs jouent le rôle d\'un étudiant de Poudlard : Harry, Ron, Hermione ou Neville, chacun avec son propre jeu de cartes qui est utilisé pour acquérir des ressources.\r\n\r\nEn gagnant de l\'influence, les joueurs ajoutent plus de cartes à leur jeu sous la forme de personnages iconiques (Hagrid, Severus Rogue, Sirius Black, Dumbledore...), de sorts et d\'objets magiques. D\'autres cartes leur permettent de recouvrer leurs points de santé ou de lutter contre Voldemort et ses alliés (Bellatrix Strange, Dolores Ombrage, Draco Malefoy et bien d\'autres encore), les empêchant ainsi de gagner du pouvoir. Les méchants contrecarrent les joueurs avec leurs attaques et l\'art de la magie noire. Ce n\'est qu\'en travaillant ensemble que les joueurs pourront vaincre tous les méchants et protéger le château des forces du mal.', '30 minutes à 1h', 10, NULL, 2, 2, 1, 4, 4),
(5, 'Champ D\'Honneur', 'https://m.media-amazon.com/images/I/71Y3mSegReL.jpg', 45.00, '3421272118717', 1987, '2 à 4 joueurs', 'Champ D\'Honneur est un wargame avec une mécanique de bag-building. \r\nAu début du jeu, recrutez vos armées en sélectionnant par un système de draft les unités que vous utilisez ensuite pour capturer les points clés sur le plateau. Pour réussir dans Champ D\'Honneur, vous devez gérer avec succès non seulement vos armées sur le champ de bataille, mais aussi celles qui attendent d\'être déployées.\r\nÀ chaque tour, vous tirez trois pièces de votre sac, puis vous les utilisez à tour de rôle pour effectuer des actions. Chaque pièce montre une unité militaire sur une face et peut être utilisée pour une ou plusieurs actions. ', '30 minutes à 1h', 2, NULL, 5, 3, 7, 4, 5),
(6, 'Dice Throne - Adventures - Occasion', 'https://www.okkazeo.com/images/jeux/38856.png', 67.43, '2199000145823', 2020, '1 à 4 joueurs', 'De l\’exploration, de l\’or, des trésors, des améliorations, des sbires, des combats de boss, et même une marchande nommée Rosella !\r\n\r\nOeuvrez ensemble pendant quelques nuits pour voyager des Sables Pourpres jusqu’à la salle du trône du Roi Fou. Vos héros gagneront des améliorations de deck permanentes à chaque session, mais ne soyez pas trop confiant… Le Roi n’a pas perdu une seule bataille en mille ans et il est impatient de relever un vrai défi !', '1 à 2h', 16, NULL, 7, 1, 7, 4, 3),
(7, 'Roll Player Adventures', 'https://m.media-amazon.com/images/I/71ZK0mtxc+L.jpg', 90.80, '2199000145984', 2023, '1 à 4 joueurs', 'Les personnages du joueur font face à des défis, explorent de nouvelles terres, se font des amis et des ennemis, résolvent des énigmes, combattent des monstres et prennent des décisions importantes qui façonneront l\'histoire au fur et à mesure qu\'ils progressent dans 11 aventures principales et une quête secondaire jouable.\r\nChoisissez l\'un des nombreux personnages, ou importez un personnage favori de Roll Player et emmenez-le dans un voyage héroïque. Si vous importez un personnage que vous avez créé dans Roll Player, toutes les extensions et toutes les cartes promotionnelles utilisées peuvent continuer à être utilisées dans les aventures de Roll Player.', '1 à 2h', 5, NULL, 3, 3, 6, 4, 6),
(8, 'The Great Wall', 'https://paradoxetemporel.fr/wp-content/uploads/2022/05/awrgw01fr_box3d_20220124.jpg', 63.92, '2199000145939', 2000, '1 à 4 joueurs', 'La Grande Muraille se dressait déjà pendant la dynastie Zhou, bien des années avant les troubles actuels. À l’époque, il s’agissait d’une simple série de murs et de forts qui protégeait le pays contre les invasions de tribus nomades. La muraille a survécu à de nombreuses guerres et batailles et été agrandie, reconstruite et réparée à maintes reprises… Bien plus tard, durant les Xe et XIe siècles, pour se défendre des invasions Jurchen Jin, la dynastie des Song du Nord a construit les sections de la Grande Muraille, localisées dans ce qui constitue aujourd’hui les provinces de Shanxi et de Hebei. Malgré le travail des Song, le mur n’a pas tenu, les forçant à se retirer au sud. Les formidables fortifications appartenaient maintenant à leurs ennemis.\r\nCent ans plus tard. Se servant de la Grande Muraille érigée par ses prédécesseurs, la dynastie Jin a tenté de repousser l’invasion de Mongols venus du nord. Mais la dynastie Song, à présent nommée Song du Sud, conserve ses rancunes envers les Jin. Les Song se sont alliés avec les Mongols pour écraser leur ancien ennemi. Ils n’ont cependant pas prévu la soif insatiable de leurs « alliés », et doivent maintenant faire face à leur tour à la horde mongole. C’est ici que commence notre histoire…', '2 à 3 heures', 8, NULL, 5, 1, 9, 3, 4),
(9, 'Lewis & Clark', 'https://cdn3.philibertnet.com/475376-thickbox_default/lewis-clark.jpg', 32.72, '2199000145885', 2013, '1 à 5 joueurs', 'Dans Lewis & Clark, chaque joueur conduit son propre \'Corps of Discovery\' à travers le continent. Son équipe sera complétée par les Indiens et les trappeurs rencontrés au long du voyage.Les joueurs conduisent une expédition à travers le continent Nord-Américain. Votre but ? Atteindre la côte Pacifique le premier en traversant les États-Unis. Lewis & Clark est donc un jeu de course. \r\n\r\nChaque joueur conduit sa propre expédition à travers les États-Unis. Chaque joueur a en main des cartes Personnage qui forment son expédition. Ces personnages permettent d’effectuer des actions telles que récolter des ressources, avancer sur le parcours ou demander de l’aide aux Indiens. Pour être déclenchée, l’action correspondant à une carte doit être associée à une Force fournie soit par une autre carte soit par des Indiens. À chaque tour de jeu, un joueur doit réaliser une action. Il peut aussi recruter un nouveau Personnage et améliorer sa main de cartes. Enfin, régulièrement, les joueurs pourront établir leur Camp afin de reprendre en main les cartes déjà jouées. Mais le chargement de ressources et le nombre d’Indiens accueillis peuvent éventuellement faire perdre l’avance durement gagnée. La gestion des ressources et des Indiens est donc cruciale dans le jeu. La partie s’arrête immédiatement dès qu’un joueur a amené son Camp sur ou au delà de Fort Clatsop.\r\n\r\nSeule la première place compte.', '1 à 2 heures', 11, NULL, 5, 3, 2, 4, 6),
(10, 'Dragomino', 'https://cdn.cultura.com/cdn-cgi/image/width=830/media/pim/68_366284_1_10_FR.PNG', 13.97, '2199000145182', 2010, '2 à 4 joueurs', 'Vous avez été nommé «dresseur de dragon» et vous avez la chance de partir à leur rencontre sur une île mystérieuse. Mais vous n’êtes pas le seul dresseur envoyé sur ces terres. Qui de vous découvrira le plus de bébés dragons ? \r\n\r\nDragomino est une version enfant de Kingdomino à jouer à partir de 5 ans, dans laquelle vous retrouverez les bonnes sensations de Kingdomino!\r\n\r\nPartez explorer l’île aux dragons et tentez de découvrir un maximum de bébés dragons dans les différents paysages que vous traversez !', 'Moins de 30 minutes', 12, NULL, 6, 3, 2, 1, 3),
(11, '12 Chip Trick', 'images/679c7a3424aa6_12-chip-trick.webp', 16.95, '2199000146325', 2002, '2 à 4 Joueurs', 'voyons voir\r\n', 'Moins de 30 minutes', 2, 6.8, 4, 2, 5, 3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `jeu_auteurs`
--

CREATE TABLE `jeu_auteurs` (
  `jeu_id` int(11) NOT NULL,
  `a_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `jeu_auteurs`
--

INSERT INTO `jeu_auteurs` (`jeu_id`, `a_id`) VALUES
(1, 2),
(2, 6),
(3, 1),
(4, 9),
(5, 10),
(6, 3),
(7, 4),
(8, 7),
(9, 5),
(10, 8),
(11, 8);

-- --------------------------------------------------------

--
-- Structure de la table `jeu_commande`
--

CREATE TABLE `jeu_commande` (
  `jeu_id` int(11) NOT NULL,
  `cmd_ref` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `jeu_langues`
--

CREATE TABLE `jeu_langues` (
  `jeu_id` int(11) NOT NULL,
  `l_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `jeu_langues`
--

INSERT INTO `jeu_langues` (`jeu_id`, `l_id`) VALUES
(1, 1),
(2, 1),
(3, 3),
(4, 2),
(5, 2),
(6, 2),
(7, 3),
(8, 2),
(9, 1),
(10, 3),
(11, 2);

-- --------------------------------------------------------

--
-- Structure de la table `jeu_theme`
--

CREATE TABLE `jeu_theme` (
  `jeu_id` int(11) NOT NULL,
  `tdj_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `jeu_theme`
--

INSERT INTO `jeu_theme` (`jeu_id`, `tdj_id`) VALUES
(1, 2),
(1, 12),
(2, 3),
(2, 7),
(3, 6),
(3, 10),
(4, 3),
(4, 8),
(4, 9),
(5, 5),
(5, 12),
(6, 3),
(6, 9),
(7, 3),
(7, 14),
(8, 2),
(8, 9),
(8, 12),
(9, 3),
(9, 7),
(9, 14),
(10, 6),
(10, 10),
(10, 15),
(11, 8);

-- --------------------------------------------------------

--
-- Structure de la table `langues`
--

CREATE TABLE `langues` (
  `l_id` int(11) NOT NULL,
  `l_nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `langues`
--

INSERT INTO `langues` (`l_id`, `l_nom`) VALUES
(1, 'Français'),
(2, 'Anglais'),
(3, 'Allemand');

-- --------------------------------------------------------

--
-- Structure de la table `livraison`
--

CREATE TABLE `livraison` (
  `lvrs_id` int(11) NOT NULL,
  `lvrs_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `livraison`
--

INSERT INTO `livraison` (`lvrs_id`, `lvrs_type`) VALUES
(1, 'Chonopost'),
(2, 'Colissimo'),
(3, 'La Poste');

-- --------------------------------------------------------

--
-- Structure de la table `mecanisme`
--

CREATE TABLE `mecanisme` (
  `m_id` int(11) NOT NULL,
  `m_nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `mecanisme`
--

INSERT INTO `mecanisme` (`m_id`, `m_nom`) VALUES
(1, 'Cartes'),
(2, 'Coopératifs'),
(3, 'Plis'),
(4, 'Affrontement'),
(5, 'Majorité'),
(6, 'Placement');

-- --------------------------------------------------------

--
-- Structure de la table `pays`
--

CREATE TABLE `pays` (
  `pays_id` int(11) NOT NULL,
  `pays_nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `pays`
--

INSERT INTO `pays` (`pays_id`, `pays_nom`) VALUES
(1, 'France'),
(2, 'Angleterre'),
(3, 'Allemagne');

-- --------------------------------------------------------

--
-- Structure de la table `theme_de_jeu`
--

CREATE TABLE `theme_de_jeu` (
  `tdj_id` int(11) NOT NULL,
  `tdj_nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `theme_de_jeu`
--

INSERT INTO `theme_de_jeu` (`tdj_id`, `tdj_nom`) VALUES
(1, 'Agents secrets'),
(2, 'Antiquité'),
(3, 'Aventure'),
(4, 'Chiffres et Lettres'),
(5, 'Connaissance'),
(6, 'Enfants'),
(7, 'Enquête'),
(8, 'Fantastique'),
(9, 'Histoire'),
(10, 'Humour'),
(11, 'Mathématiques'),
(12, 'Mythologie'),
(13, 'Sport'),
(14, 'Survie'),
(15, 'Vie Quotidienne');

-- --------------------------------------------------------

--
-- Structure de la table `type_payement`
--

CREATE TABLE `type_payement` (
  `p_id` int(11) NOT NULL,
  `p_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `type_payement`
--

INSERT INTO `type_payement` (`p_id`, `p_type`) VALUES
(1, 'Carte Bancaire'),
(2, 'Apple Pay'),
(3, 'PayPal'),
(4, 'Chèque');

-- --------------------------------------------------------

--
-- Structure de la table `type_utilisateur`
--

CREATE TABLE `type_utilisateur` (
  `tu_id` int(11) NOT NULL,
  `tu_libelle` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `type_utilisateur`
--

INSERT INTO `type_utilisateur` (`tu_id`, `tu_libelle`) VALUES
(1, 'Admin'),
(2, 'Utilisateurs'),
(3, 'Non enregistré'),
(4, 'Commercial');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `u_id` int(11) NOT NULL,
  `u_pseudo` varchar(50) NOT NULL,
  `u_email` varchar(50) NOT NULL,
  `u_mdp` varchar(50) NOT NULL,
  `tu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `abonnement`
--
ALTER TABLE `abonnement`
  ADD PRIMARY KEY (`abn_id`);

--
-- Index pour la table `age`
--
ALTER TABLE `age`
  ADD PRIMARY KEY (`age_id`);

--
-- Index pour la table `auteurs`
--
ALTER TABLE `auteurs`
  ADD PRIMARY KEY (`a_id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ctg_id`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`clt_id`),
  ADD UNIQUE KEY `u_id` (`u_id`),
  ADD KEY `abn_id` (`abn_id`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`cmd_ref`),
  ADD KEY `lvrs_id` (`lvrs_id`),
  ADD KEY `p_id` (`p_id`),
  ADD KEY `clt_id` (`clt_id`);

--
-- Index pour la table `editeur`
--
ALTER TABLE `editeur`
  ADD PRIMARY KEY (`edit_id`);

--
-- Index pour la table `jeu`
--
ALTER TABLE `jeu`
  ADD PRIMARY KEY (`jeu_id`),
  ADD KEY `edit_id` (`edit_id`),
  ADD KEY `pays_id` (`pays_id`),
  ADD KEY `ctg_id` (`ctg_id`),
  ADD KEY `age_id` (`age_id`),
  ADD KEY `m_id` (`m_id`);

--
-- Index pour la table `jeu_auteurs`
--
ALTER TABLE `jeu_auteurs`
  ADD PRIMARY KEY (`jeu_id`,`a_id`),
  ADD KEY `a_id` (`a_id`);

--
-- Index pour la table `jeu_commande`
--
ALTER TABLE `jeu_commande`
  ADD PRIMARY KEY (`jeu_id`,`cmd_ref`),
  ADD KEY `cmd_ref` (`cmd_ref`);

--
-- Index pour la table `jeu_langues`
--
ALTER TABLE `jeu_langues`
  ADD PRIMARY KEY (`jeu_id`,`l_id`),
  ADD KEY `l_id` (`l_id`);

--
-- Index pour la table `jeu_theme`
--
ALTER TABLE `jeu_theme`
  ADD PRIMARY KEY (`jeu_id`,`tdj_id`),
  ADD KEY `tdj_id` (`tdj_id`);

--
-- Index pour la table `langues`
--
ALTER TABLE `langues`
  ADD PRIMARY KEY (`l_id`);

--
-- Index pour la table `livraison`
--
ALTER TABLE `livraison`
  ADD PRIMARY KEY (`lvrs_id`);

--
-- Index pour la table `mecanisme`
--
ALTER TABLE `mecanisme`
  ADD PRIMARY KEY (`m_id`);

--
-- Index pour la table `pays`
--
ALTER TABLE `pays`
  ADD PRIMARY KEY (`pays_id`);

--
-- Index pour la table `theme_de_jeu`
--
ALTER TABLE `theme_de_jeu`
  ADD PRIMARY KEY (`tdj_id`);

--
-- Index pour la table `type_payement`
--
ALTER TABLE `type_payement`
  ADD PRIMARY KEY (`p_id`);

--
-- Index pour la table `type_utilisateur`
--
ALTER TABLE `type_utilisateur`
  ADD PRIMARY KEY (`tu_id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`u_id`),
  ADD KEY `tu_id` (`tu_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `abonnement`
--
ALTER TABLE `abonnement`
  MODIFY `abn_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `age`
--
ALTER TABLE `age`
  MODIFY `age_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `auteurs`
--
ALTER TABLE `auteurs`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `ctg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `clt_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `editeur`
--
ALTER TABLE `editeur`
  MODIFY `edit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `jeu`
--
ALTER TABLE `jeu`
  MODIFY `jeu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `langues`
--
ALTER TABLE `langues`
  MODIFY `l_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `livraison`
--
ALTER TABLE `livraison`
  MODIFY `lvrs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `mecanisme`
--
ALTER TABLE `mecanisme`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `pays`
--
ALTER TABLE `pays`
  MODIFY `pays_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `theme_de_jeu`
--
ALTER TABLE `theme_de_jeu`
  MODIFY `tdj_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `type_payement`
--
ALTER TABLE `type_payement`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `type_utilisateur`
--
ALTER TABLE `type_utilisateur`
  MODIFY `tu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `client_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `utilisateurs` (`u_id`),
  ADD CONSTRAINT `client_ibfk_2` FOREIGN KEY (`abn_id`) REFERENCES `abonnement` (`abn_id`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`lvrs_id`) REFERENCES `livraison` (`lvrs_id`),
  ADD CONSTRAINT `commande_ibfk_2` FOREIGN KEY (`p_id`) REFERENCES `type_payement` (`p_id`),
  ADD CONSTRAINT `commande_ibfk_3` FOREIGN KEY (`clt_id`) REFERENCES `client` (`clt_id`);

--
-- Contraintes pour la table `jeu`
--
ALTER TABLE `jeu`
  ADD CONSTRAINT `jeu_ibfk_1` FOREIGN KEY (`edit_id`) REFERENCES `editeur` (`edit_id`),
  ADD CONSTRAINT `jeu_ibfk_2` FOREIGN KEY (`pays_id`) REFERENCES `pays` (`pays_id`),
  ADD CONSTRAINT `jeu_ibfk_3` FOREIGN KEY (`ctg_id`) REFERENCES `categories` (`ctg_id`),
  ADD CONSTRAINT `jeu_ibfk_4` FOREIGN KEY (`age_id`) REFERENCES `age` (`age_id`),
  ADD CONSTRAINT `jeu_ibfk_5` FOREIGN KEY (`m_id`) REFERENCES `mecanisme` (`m_id`);

--
-- Contraintes pour la table `jeu_auteurs`
--
ALTER TABLE `jeu_auteurs`
  ADD CONSTRAINT `jeu_auteurs_ibfk_1` FOREIGN KEY (`jeu_id`) REFERENCES `jeu` (`jeu_id`),
  ADD CONSTRAINT `jeu_auteurs_ibfk_2` FOREIGN KEY (`a_id`) REFERENCES `auteurs` (`a_id`);

--
-- Contraintes pour la table `jeu_commande`
--
ALTER TABLE `jeu_commande`
  ADD CONSTRAINT `jeu_commande_ibfk_1` FOREIGN KEY (`jeu_id`) REFERENCES `jeu` (`jeu_id`),
  ADD CONSTRAINT `jeu_commande_ibfk_2` FOREIGN KEY (`cmd_ref`) REFERENCES `commande` (`cmd_ref`);

--
-- Contraintes pour la table `jeu_langues`
--
ALTER TABLE `jeu_langues`
  ADD CONSTRAINT `jeu_langues_ibfk_1` FOREIGN KEY (`jeu_id`) REFERENCES `jeu` (`jeu_id`),
  ADD CONSTRAINT `jeu_langues_ibfk_2` FOREIGN KEY (`l_id`) REFERENCES `langues` (`l_id`);

--
-- Contraintes pour la table `jeu_theme`
--
ALTER TABLE `jeu_theme`
  ADD CONSTRAINT `jeu_theme_ibfk_1` FOREIGN KEY (`jeu_id`) REFERENCES `jeu` (`jeu_id`),
  ADD CONSTRAINT `jeu_theme_ibfk_2` FOREIGN KEY (`tdj_id`) REFERENCES `theme_de_jeu` (`tdj_id`);

--
-- Contraintes pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD CONSTRAINT `utilisateurs_ibfk_1` FOREIGN KEY (`tu_id`) REFERENCES `type_utilisateur` (`tu_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
