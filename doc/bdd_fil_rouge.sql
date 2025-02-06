-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 06 fév. 2025 à 09:16
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
  `jeu_nom` varchar(100) NOT NULL,
  `jeu_img` varchar(500) NOT NULL,
  `jeu_prix` decimal(15,2) NOT NULL,
  `jeu_EAN` varchar(50) NOT NULL,
  `jeu_dte_creation` int(4) NOT NULL,
  `jeu_nb_joueurs` varchar(50) NOT NULL,
  `jeu_description` varchar(2500) DEFAULT NULL,
  `jeu_temps` varchar(50) NOT NULL,
  `jeu_qte_stc` int(11) NOT NULL,
  `jeu_note` decimal(2,1) DEFAULT NULL,
  `edit_id` int(11) NOT NULL,
  `pays_id` int(11) NOT NULL,
  `ctg_id` int(11) NOT NULL,
  `age_id` int(11) NOT NULL,
  `m_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `jeu_auteurs`
--

CREATE TABLE `jeu_auteurs` (
  `jeu_id` int(11) NOT NULL,
  `a_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Structure de la table `jeu_theme`
--

CREATE TABLE `jeu_theme` (
  `jeu_id` int(11) NOT NULL,
  `tdj_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(3, 'Allemagne'),
(4, 'Japon'),
(5, 'USA');

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
  `u_mdp` varchar(255) DEFAULT NULL,
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
  MODIFY `jeu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `pays_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
