-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Dim 21 Mai 2023 à 19:54
-- Version du serveur :  5.6.20-log
-- Version de PHP :  5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `bdd_pokedex_finalisation_aau`
--
CREATE DATABASE IF NOT EXISTS `bdd_pokedex_finalisation_aau` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bdd_pokedex_finalisation_aau`;

-- --------------------------------------------------------

--
-- Structure de la table `tab_avoir`
--

CREATE TABLE IF NOT EXISTS `tab_avoir` (
  `CLE_talent` tinyint(4) DEFAULT NULL COMMENT 'Clé étrangère du talent',
  `CLE_pokedex` smallint(6) DEFAULT NULL COMMENT 'Clé étrangère du pokémon',
  `TAV_date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date de creation de l''enregistrement du talent',
  `TAV_derniere_modification` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date de modification de l''enregistrement du talent',
  `TAV_auteur_derniere_modification` varchar(32) NOT NULL COMMENT 'Auteur de la derniere modification de l''enregistrement du talent'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Table associative des talents';

-- --------------------------------------------------------

--
-- Structure de la table `tab_categorie`
--

CREATE TABLE IF NOT EXISTS `tab_categorie` (
`CLP_categorie` tinyint(4) NOT NULL COMMENT 'Cle primaire de la table categorie',
  `TCA_libelle` varchar(64) NOT NULL COMMENT 'Libelle de la categorie',
  `TCA_description` text NOT NULL COMMENT 'Description de la categorie',
  `TCA_date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date et heure de la creation de la categorie',
  `TCA_date_derniere_modification` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date de la derniere modification de la categorie',
  `TCA_auteur_derniere_modification` varchar(50) NOT NULL COMMENT 'Auteur de la derniere modification de la categorie'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='Tables des categories de Pokemon' AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Structure de la table `tab_decrire`
--

CREATE TABLE IF NOT EXISTS `tab_decrire` (
  `CLE_version` tinyint(4) NOT NULL COMMENT 'Clé étrangère de la version',
  `CLE_pokedex` smallint(6) DEFAULT NULL COMMENT 'Clé étrangère du pokémon',
  `TDE_description` text NOT NULL COMMENT 'description du pokémon',
  `TDE_date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date de creation de l''enregistrement de la description',
  `TDE_derniere_modification` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date de modification de l''enregistrement de la description',
  `TDE_auteur_derniere_modification` varchar(32) NOT NULL COMMENT 'Auteur de la derniere modification de l''enregistrement de la description'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Table associative de la description';

-- --------------------------------------------------------

--
-- Structure de la table `tab_disposer`
--

CREATE TABLE IF NOT EXISTS `tab_disposer` (
  `CLE_type` tinyint(4) DEFAULT NULL COMMENT 'Clé étrangère du type du pokémon',
  `CLE_pokedex` smallint(6) DEFAULT NULL COMMENT 'Clé étrangère du pokémon',
  `TDI_date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date de creation de l''enregistrement de l''association',
  `TDI_derniere_modification` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date de modification de l''enregistrement de l''association',
  `TDI_auteur_derniere_modification` varchar(32) NOT NULL COMMENT 'Auteur de la derniere modification de l''enregistrement de l''association'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='table associative des types des pokémons';

-- --------------------------------------------------------

--
-- Structure de la table `tab_evoluer`
--

CREATE TABLE IF NOT EXISTS `tab_evoluer` (
  `CLE_pokedex` smallint(6) DEFAULT NULL COMMENT 'Clé étrangère du pokémon',
  `CLE_evolution` smallint(6) DEFAULT NULL COMMENT 'Clé étrangère de l''évolution',
  `TEV_date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date de creation de l''enregistrement de l''évolution',
  `TEV_derniere_modification` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date de modification de l''enregistrement de l''évolution',
  `TEV_auteur_derniere_modification` varchar(32) NOT NULL COMMENT 'Auteur de la derniere modification de l''enregistrement de l''évolution'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Table sur les évolutions';

-- --------------------------------------------------------

--
-- Structure de la table `tab_genres`
--

CREATE TABLE IF NOT EXISTS `tab_genres` (
`CLP_genre` tinyint(4) NOT NULL COMMENT 'Table des sexes de Pokemon',
  `TGE_libelle` varchar(64) NOT NULL COMMENT 'Libelle du genre',
  `TGE_description` text NOT NULL COMMENT 'Description du genre',
  `TGE_date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date et heure de la creation du genre',
  `TGE_date_derniere_modification` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date de la derniere modification du genre',
  `TGE_auteur_derniere_modification` varchar(32) NOT NULL COMMENT 'Auteur de la derniere modification du genre'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='Tables des sexes de Pokemon' AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Structure de la table `tab_login`
--

CREATE TABLE IF NOT EXISTS `tab_login` (
  `LOG_identifiant` varchar(25) NOT NULL,
  `LOG_mdp` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `tab_login`
--

INSERT INTO `tab_login` (`LOG_identifiant`, `LOG_mdp`) VALUES
('admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918');

-- --------------------------------------------------------

--
-- Structure de la table `tab_pokedex`
--

CREATE TABLE IF NOT EXISTS `tab_pokedex` (
`CLP_pokedex` smallint(6) NOT NULL COMMENT 'Cle primaire de la table Pokedex',
  `POK_nom` varchar(128) NOT NULL COMMENT 'Nom du pokemon',
  `POK_numero` smallint(6) NOT NULL COMMENT 'Numero du Pokemon',
  `POK_taille` decimal(7,2) DEFAULT NULL COMMENT 'Taille du Pokemon',
  `POK_poids` decimal(7,2) DEFAULT NULL COMMENT 'Poids du pokemon',
  `CLE_genre` tinyint(4) DEFAULT NULL COMMENT 'Clé étrangère du genre du pokémon',
  `POK_point_vie` smallint(6) DEFAULT NULL COMMENT 'Point de vie du Pokemon',
  `POK_attaque` smallint(6) DEFAULT NULL COMMENT 'Point d''attaque du Pokemon',
  `POK_defense` smallint(6) DEFAULT NULL COMMENT 'Point de defense du Pokemon',
  `POK_attaque_speciale` smallint(6) DEFAULT NULL COMMENT 'Point d''attaque speciale du Pokemon',
  `POK_defense_speciale` smallint(6) DEFAULT NULL COMMENT 'Point de defense speciale du Pokemon',
  `POK_vitesse` smallint(6) DEFAULT NULL COMMENT 'points de vitesse du pokémon',
  `CLE_categorie` tinyint(4) DEFAULT NULL COMMENT 'categorie du Pokemon',
  `CLE_region` tinyint(4) DEFAULT NULL COMMENT 'Clé étrangère de la région',
  `POK_photo` varchar(256) DEFAULT NULL COMMENT 'Photo du Pokemon',
  `POK_date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date de creation de l''enregistrement du Pokemon',
  `POK_derniere_modification` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date de modification de l''enregistrement du Pokemon',
  `POK_auteur_derniere_modification` varchar(32) NOT NULL COMMENT 'Auteur de la derniere modification de l''enregistrement du Pokemon'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='Table regroupant l''ensemble des Pokemon' AUTO_INCREMENT=153 ;

-- --------------------------------------------------------

--
-- Structure de la table `tab_region`
--

CREATE TABLE IF NOT EXISTS `tab_region` (
`CLP_region` tinyint(4) NOT NULL COMMENT 'Cle primaire de la région',
  `TRE_libelle` varchar(32) NOT NULL COMMENT 'nom de la région',
  `TRE_description` text NOT NULL COMMENT 'description de la région',
  `TRE_date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date de creation de l''enregistrement de la région',
  `TRE_derniere_modification` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date de modification de l''enregistrement de la région',
  `TRE_auteur_derniere_modification` varchar(32) NOT NULL COMMENT 'Auteur de la derniere modification de l''enregistrement de la région'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='Table sur les régions des pokémons' AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Structure de la table `tab_subir`
--

CREATE TABLE IF NOT EXISTS `tab_subir` (
  `CLE_faiblesse` tinyint(4) DEFAULT NULL COMMENT 'Cle étrangère des faiblesses',
  `CLE_pokedex` smallint(6) DEFAULT NULL COMMENT 'Clé étrangère du pokémon',
  `TSU_taux_degats` tinyint(4) DEFAULT NULL COMMENT 'Taux de dégats reçus',
  `TSU_date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date de creation de l''enregistrement de l''association',
  `TSU_derniere_modification` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date de modification de l''enregistrement de l''association',
  `TSU_auteur_derniere_modification` varchar(32) NOT NULL COMMENT 'Auteur de la derniere modification de l''enregistrement de l''association'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='table associatif des faiblesses';

-- --------------------------------------------------------

--
-- Structure de la table `tab_talents`
--

CREATE TABLE IF NOT EXISTS `tab_talents` (
`CLP_talent` tinyint(4) NOT NULL COMMENT 'Cle primaire de la table talent',
  `TTA_libelle` varchar(64) NOT NULL COMMENT 'Libelle du talent',
  `TTA_description` text COMMENT 'Description',
  `TTA_date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date et heure de la creation du talent',
  `TTA_date_derniere_modification` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date de la derniere modification du talent',
  `TTA_auteur_derniere_modification` varchar(50) NOT NULL COMMENT 'Auteur de la derniere modification du talent'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='Tables des talents de Pokemon' AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Structure de la table `tab_types`
--

CREATE TABLE IF NOT EXISTS `tab_types` (
`CLP_types` tinyint(4) NOT NULL COMMENT 'Cle primaire de la table type',
  `TTY_libelle` varchar(64) NOT NULL COMMENT 'Libelle du type',
  `TTY_description` text NOT NULL COMMENT 'Description du type',
  `TTY_date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date et heure de la creation du type',
  `TTY_date_derniere_modification` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date de la derniere modification du type',
  `TTY_auteur_derniere_modification` varchar(50) NOT NULL COMMENT 'Auteur de la derniere modification du type'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='Tables des types possibles dans Pokémon' AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Structure de la table `tab_versions`
--

CREATE TABLE IF NOT EXISTS `tab_versions` (
`CLP_version` tinyint(4) NOT NULL COMMENT 'Cle primaire de la table version',
  `TVE_libelle` varchar(64) NOT NULL COMMENT 'Libelle de la version',
  `TVE_description` text NOT NULL COMMENT 'Description de la version',
  `TVE_date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date et heure de la creation de la version',
  `TVE_date_derniere_modification` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date de la derniere modification de la faiblesse',
  `TVE_auteur_derniere_modification` varchar(32) NOT NULL COMMENT 'Auteur de la derniere modification de la version'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='Tables des versions de Pokemon' AUTO_INCREMENT=7 ;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `tab_avoir`
--
ALTER TABLE `tab_avoir`
 ADD KEY `TAB_avoir_FK_tal` (`CLE_talent`), ADD KEY `TAB_avoir_FK_pok` (`CLE_pokedex`);

--
-- Index pour la table `tab_categorie`
--
ALTER TABLE `tab_categorie`
 ADD PRIMARY KEY (`CLP_categorie`), ADD UNIQUE KEY `TAT_libelle` (`TCA_libelle`);

--
-- Index pour la table `tab_decrire`
--
ALTER TABLE `tab_decrire`
 ADD KEY `TAB_decrire_FK_pok` (`CLE_pokedex`), ADD KEY `TAB_decrire_FK_ver` (`CLE_version`);

--
-- Index pour la table `tab_disposer`
--
ALTER TABLE `tab_disposer`
 ADD KEY `TAB_disposer_FK_pok` (`CLE_pokedex`), ADD KEY `TAB_disposer_FK_typ` (`CLE_type`);

--
-- Index pour la table `tab_evoluer`
--
ALTER TABLE `tab_evoluer`
 ADD KEY `TAB_evoluer_FK_pok` (`CLE_pokedex`), ADD KEY `TAB_evoluer_FK_evo` (`CLE_evolution`);

--
-- Index pour la table `tab_genres`
--
ALTER TABLE `tab_genres`
 ADD PRIMARY KEY (`CLP_genre`), ADD UNIQUE KEY `TGE_libelle` (`TGE_libelle`);

--
-- Index pour la table `tab_pokedex`
--
ALTER TABLE `tab_pokedex`
 ADD PRIMARY KEY (`CLP_pokedex`), ADD UNIQUE KEY `POK_nom` (`POK_nom`), ADD KEY `TAB_pokedex_FK_cat` (`CLE_categorie`), ADD KEY `TAB_pokedex_FK_reg` (`CLE_region`), ADD KEY `TAB_pokedex_FK_gen` (`CLE_genre`);

--
-- Index pour la table `tab_region`
--
ALTER TABLE `tab_region`
 ADD PRIMARY KEY (`CLP_region`), ADD UNIQUE KEY `TAB_region_UN` (`TRE_libelle`);

--
-- Index pour la table `tab_subir`
--
ALTER TABLE `tab_subir`
 ADD KEY `TAB_subir_FK_pok` (`CLE_pokedex`), ADD KEY `TAB_subir_FK_fai` (`CLE_faiblesse`);

--
-- Index pour la table `tab_talents`
--
ALTER TABLE `tab_talents`
 ADD PRIMARY KEY (`CLP_talent`), ADD UNIQUE KEY `TTA_libelle` (`TTA_libelle`);

--
-- Index pour la table `tab_types`
--
ALTER TABLE `tab_types`
 ADD PRIMARY KEY (`CLP_types`), ADD UNIQUE KEY `TTY_libelle` (`TTY_libelle`);

--
-- Index pour la table `tab_versions`
--
ALTER TABLE `tab_versions`
 ADD PRIMARY KEY (`CLP_version`), ADD UNIQUE KEY `TVE_libelle` (`TVE_libelle`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `tab_categorie`
--
ALTER TABLE `tab_categorie`
MODIFY `CLP_categorie` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'Cle primaire de la table categorie',AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `tab_genres`
--
ALTER TABLE `tab_genres`
MODIFY `CLP_genre` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'Table des sexes de Pokemon',AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `tab_pokedex`
--
ALTER TABLE `tab_pokedex`
MODIFY `CLP_pokedex` smallint(6) NOT NULL AUTO_INCREMENT COMMENT 'Cle primaire de la table Pokedex',AUTO_INCREMENT=153;
--
-- AUTO_INCREMENT pour la table `tab_region`
--
ALTER TABLE `tab_region`
MODIFY `CLP_region` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'Cle primaire de la région',AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `tab_talents`
--
ALTER TABLE `tab_talents`
MODIFY `CLP_talent` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'Cle primaire de la table talent',AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `tab_types`
--
ALTER TABLE `tab_types`
MODIFY `CLP_types` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'Cle primaire de la table type',AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `tab_versions`
--
ALTER TABLE `tab_versions`
MODIFY `CLP_version` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'Cle primaire de la table version',AUTO_INCREMENT=7;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `tab_avoir`
--
ALTER TABLE `tab_avoir`
ADD CONSTRAINT `TAB_avoir_FK_pok` FOREIGN KEY (`CLE_pokedex`) REFERENCES `tab_pokedex` (`CLP_pokedex`),
ADD CONSTRAINT `TAB_avoir_FK_tal` FOREIGN KEY (`CLE_talent`) REFERENCES `tab_talents` (`CLP_talent`);

--
-- Contraintes pour la table `tab_decrire`
--
ALTER TABLE `tab_decrire`
ADD CONSTRAINT `TAB_decrire_FK_pok` FOREIGN KEY (`CLE_pokedex`) REFERENCES `tab_pokedex` (`CLP_pokedex`),
ADD CONSTRAINT `TAB_decrire_FK_ver` FOREIGN KEY (`CLE_version`) REFERENCES `tab_versions` (`CLP_version`);

--
-- Contraintes pour la table `tab_disposer`
--
ALTER TABLE `tab_disposer`
ADD CONSTRAINT `TAB_disposer_FK_pok` FOREIGN KEY (`CLE_pokedex`) REFERENCES `tab_pokedex` (`CLP_pokedex`),
ADD CONSTRAINT `TAB_disposer_FK_typ` FOREIGN KEY (`CLE_type`) REFERENCES `tab_types` (`CLP_types`);

--
-- Contraintes pour la table `tab_evoluer`
--
ALTER TABLE `tab_evoluer`
ADD CONSTRAINT `TAB_evoluer_FK_evo` FOREIGN KEY (`CLE_evolution`) REFERENCES `tab_pokedex` (`CLP_pokedex`),
ADD CONSTRAINT `TAB_evoluer_FK_pok` FOREIGN KEY (`CLE_pokedex`) REFERENCES `tab_pokedex` (`CLP_pokedex`);

--
-- Contraintes pour la table `tab_pokedex`
--
ALTER TABLE `tab_pokedex`
ADD CONSTRAINT `TAB_pokedex_FK_cat` FOREIGN KEY (`CLE_categorie`) REFERENCES `tab_categorie` (`CLP_categorie`),
ADD CONSTRAINT `TAB_pokedex_FK_gen` FOREIGN KEY (`CLE_genre`) REFERENCES `tab_genres` (`CLP_genre`),
ADD CONSTRAINT `TAB_pokedex_FK_reg` FOREIGN KEY (`CLE_region`) REFERENCES `tab_region` (`CLP_region`);

--
-- Contraintes pour la table `tab_subir`
--
ALTER TABLE `tab_subir`
ADD CONSTRAINT `TAB_subir_FK_fai` FOREIGN KEY (`CLE_faiblesse`) REFERENCES `tab_types` (`CLP_types`),
ADD CONSTRAINT `TAB_subir_FK_pok` FOREIGN KEY (`CLE_pokedex`) REFERENCES `tab_pokedex` (`CLP_pokedex`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
