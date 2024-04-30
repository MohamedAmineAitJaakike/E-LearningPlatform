-- Création de la table admin
DROP TABLE IF EXISTS admin;
CREATE TABLE IF NOT EXISTS admin (
  id int NOT NULL AUTO_INCREMENT,
  nom varchar(255) NOT NULL,
  prenom varchar(255) NOT NULL,
  mail varchar(255) NOT NULL,
  mot_de_passe varchar(255) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insertion des données dans la table admin
INSERT INTO admin (id, nom, prenom, mail, mot_de_passe) VALUES
(1, 'Admin', 'Platform', 'md@gmail.com', '111');

-- Création de la table utilisateurs
DROP TABLE IF EXISTS utilisateurs;
CREATE TABLE IF NOT EXISTS utilisateurs (
  id int NOT NULL AUTO_INCREMENT,
  nom varchar(255) NOT NULL,
  prenom varchar(255) NOT NULL,
  mail varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  image varchar(255) DEFAULT NULL,
  role enum('etudiant','professeur','administrateur') NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insertion des données dans la table utilisateurs
INSERT INTO utilisateurs (id, nom, prenom, mail, password, image, role) VALUES
(1, 'Moussa Dembele', '', 'md@gmail.com', '1234', 'me.jpeg', 'etudiant'),
(2, 'Moussa Dembele', '', 'm@gmail.com', '0000', 'me.jpeg', 'professeur'),
(3, 'Moussa Dembele', '', 'm@gmail.com', '1234', 'me.jpeg', 'professeur');

-- Création de la table module
DROP TABLE IF EXISTS module;
CREATE TABLE IF NOT EXISTS module (
  id int NOT NULL AUTO_INCREMENT,
  IdParent int DEFAULT NULL,
  titre varchar(255) NOT NULL,
  presentation varchar(255) NOT NULL,
  mots_cles varchar(255) NOT NULL,
  Code_Cours varchar(255) NOT NULL,
  cible varchar(255) NOT NULL,
  prerequis varchar(255) NOT NULL,
  est_progressif tinyint(1) DEFAULT NULL,
  proprietaire int DEFAULT NULL,
  PRIMARY KEY (id),
  KEY proprietaire (proprietaire),
  CONSTRAINT FK_module_proprietaire FOREIGN KEY (proprietaire) REFERENCES utilisateurs (id)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insertion des données dans la table module
INSERT INTO module (id, IdParent, titre, presentation, mots_cles, Code_Cours, cible, prerequis, est_progressif, proprietaire) VALUES
(1, 1, 'THL', 'Cours THL', 'Automates', 'ENSATE', 'GI1', 'Rien', 1, 1);

-- Création de la table courssuivis
DROP TABLE IF EXISTS courssuivis;
CREATE TABLE IF NOT EXISTS courssuivis (
  id int NOT NULL AUTO_INCREMENT,
  idEtudiant int DEFAULT NULL,
  idCours int DEFAULT NULL,
  PRIMARY KEY (id),
  KEY idEtudiant (idEtudiant),
  KEY idCours (idCours),
  CONSTRAINT FK_courssuivis_idEtudiant FOREIGN KEY (idEtudiant) REFERENCES utilisateurs (id),
  CONSTRAINT FK_courssuivis_idCours FOREIGN KEY (idCours) REFERENCES module (IdParent)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insertion des données dans la table courssuivis
INSERT INTO courssuivis (id, idEtudiant, idCours) VALUES
(3, 1, 1);

-- Création de la table message
DROP TABLE IF EXISTS message;
CREATE TABLE IF NOT EXISTS message (
  id int NOT NULL AUTO_INCREMENT,
  idCours int NOT NULL,
  idExpediteur int NOT NULL,
  idRecepteur int NOT NULL,
  contenu text NOT NULL,
  date_envoi timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  est_annonce int DEFAULT NULL,
  PRIMARY KEY (id),
  KEY idCours (idCours),
  KEY idExpediteur (idExpediteur),
  KEY idRecepteur (idRecepteur),
  CONSTRAINT FK_message_idCours FOREIGN KEY (idCours) REFERENCES module (id),
  CONSTRAINT FK_message_idExpediteur FOREIGN KEY (idExpediteur) REFERENCES utilisateurs (id),
  CONSTRAINT FK_message_idRecepteur FOREIGN KEY (idRecepteur) REFERENCES utilisateurs (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Création de la table chapitre
DROP TABLE IF EXISTS chapitre;
CREATE TABLE IF NOT EXISTS chapitre (
  IdChap int NOT NULL AUTO_INCREMENT,
  IdModule int DEFAULT NULL,
  contenu varchar(255) NOT NULL,
  `accessible` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (IdChap),
  KEY IdModule (IdModule),
  CONSTRAINT FK_chapitre_IdModule FOREIGN KEY (IdModule) REFERENCES module (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

COMMIT;
