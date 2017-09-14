-- BD POUR PROJET PACKAGES 1-4
-- CRÉÉE LE 06/09/2017 PAR MARC-ANTOINE DUCHESNE

-- Création de la bd
-- DROP DATABASE IF EXISTS BD_;
-- CREATE DATABASE BDProjet_equipe2V2;

-- USE BDProjet_equipe2V2;

USE cegepjon_p2017_2_tests;

-- Table Reponse

DROP TABLE IF EXISTS tblReponse;
CREATE TABLE tblReponse(
	Id						INT				AUTO_INCREMENT,
	Texte 					VARCHAR(250) 	NULL,
	tagEvaluation			VARCHAR(1000)	NULL,
	tag						VARCHAR(1000)	NULL,
	PRIMARY KEY(Id)
);

DROP VIEW IF EXISTS vReponse;
CREATE VIEW vReponse AS SELECT * FROM tblReponse;

-- Table ReponseQuestionGrille

DROP TABLE IF EXISTS tblReponseQuestionGrille;
CREATE TABLE tblReponseQuestionGrille(
	IdQuestionGrille		INT				NOT NULL,
	IdReponse				INT			 	NOT NULL,
	tag						VARCHAR(1000)	NULL,
	PRIMARY KEY(IdQuestionGrille,IdReponse)
);

DROP VIEW IF EXISTS vReponseQuestionGrille;
CREATE VIEW vReponseQuestionGrille AS SELECT * FROM tblReponseQuestionGrille;

-- Table ReponseQuestionChoixReponse

DROP TABLE IF EXISTS tblReponseQuestionChoixReponse;
CREATE TABLE tblReponseQuestionChoixReponse(
	IdQuestionChoixReponse	INT				NOT NULL,
	IdReponse				INT			 	NOT NULL,
	tag						VARCHAR(1000)	NULL,
	PRIMARY KEY(IdQuestionChoixReponse,IdReponse)
);

DROP VIEW IF EXISTS vReponseQuestionChoixReponse;
CREATE VIEW vReponseQuestionChoixReponse AS SELECT * FROM tblReponseQuestionChoixReponse;

-- Table QuestionChoixReponseEvaluation

DROP TABLE IF EXISTS tblQuestionChoixReponseEvaluation;
CREATE TABLE tblQuestionChoixReponseEvaluation(
	IdQuestionChoixReponse	INT				NOT NULL,
	IdEvaluation			INT			 	NOT NULL,
	tag						VARCHAR(1000)	NULL,
	PRIMARY KEY(IdQuestionChoixReponse,IdEvaluation)
);

DROP VIEW IF EXISTS vQuestionChoixReponseEvaluation;
CREATE VIEW vQuestionChoixReponseEvaluation AS SELECT * FROM tblQuestionChoixReponseEvaluation;

-- Table tblQuestionGrilleEvaluation

DROP TABLE IF EXISTS tblQuestionGrilleEvaluation;
CREATE TABLE tblQuestionGrilleEvaluation(
	IdQuestionGrille		INT				NOT NULL,
	IdEvaluation			INT			 	NOT NULL,
	tag						VARCHAR(1000)	NULL,
	PRIMARY KEY(IdQuestionGrille,IdEvaluation)
);

DROP VIEW IF EXISTS vQuestionGrilleEvaluation;
CREATE VIEW vQuestionGrilleEvaluation AS SELECT * FROM tblQuestionGrilleEvaluation;

-- Table QuestionGrille

DROP TABLE IF EXISTS tblQuestionGrille;
CREATE TABLE tblQuestionGrille(
	Id						INT				AUTO_INCREMENT,
	Texte 					VARCHAR(250) 	NULL,
	tagQuestionGrille		VARCHAR(1000)	NULL,
	PRIMARY KEY(Id)
);

DROP VIEW IF EXISTS vQuestionGrille;
CREATE VIEW vQuestionGrille AS SELECT * FROM tblQuestionGrille;

-- Table QuestionChoixReponse

DROP TABLE IF EXISTS tblQuestionChoixReponse;
CREATE TABLE tblQuestionChoixReponse(
	Id						INT				AUTO_INCREMENT,
	Texte 					VARCHAR(250) 	NULL,
	tagQuestionChoixReponse	VARCHAR(1000)	NULL,
	tag						VARCHAR(1000)	NULL,
	PRIMARY KEY(Id)
);

DROP VIEW IF EXISTS vQuestionChoixReponse;
CREATE VIEW vQuestionChoixReponse AS SELECT * FROM tblQuestionChoixReponse;

-- Table Evaluation

DROP TABLE IF EXISTS tblEvaluation;
CREATE TABLE tblEvaluation(
	Id						INT				AUTO_INCREMENT,
	Titre 					VARCHAR(40) 	NULL,
	tag						VARCHAR(1000)	NULL,
	PRIMARY KEY(Id)
);

DROP VIEW IF EXISTS vEvaluation;
CREATE VIEW vEvaluation AS SELECT * FROM tblEvaluation;

-- Table SuperviseurEvaluationStagiaireStage

DROP TABLE IF EXISTS tblSuperviseurEvaluationStagiaireStage;
CREATE TABLE tblSuperviseurEvaluationStagiaireStage(
	IdEvaluation			INT				NOT NULL,
	IdSuperviseur			INT				NOT NULL,
	IdStage					INT				NOT NULL,
	IdStagiaire				INT				NOT NULL,
	tag						VARCHAR(1000)	NULL,
	PRIMARY KEY(IdEvaluation,IdSuperviseur,IdStage,IdStagiaire)
);

DROP VIEW IF EXISTS vSuperviseurEvaluationStagiaireStage;
CREATE VIEW vSuperviseurEvaluationStagiaireStage AS SELECT * FROM tblSuperviseurEvaluationStagiaireStage;

-- Table stagiaire

DROP TABLE IF EXISTS tblStagiaire;
CREATE TABLE tblStagiaire(
	Id			 			INT				AUTO_INCREMENT,
	CourrielScolaire 		VARCHAR(320)	NOT NULL,
	Nom 					VARCHAR(50)		NOT NULL,
	Prenom 					VARCHAR(50)		NOT NULL,
	NumTelPersonnel 		CHAR(14)		NULL,
	NumTelMaison 			CHAR(14)		NULL,
	CourrielPersonnel 		VARCHAR(320)	NULL,
	NumTelEntreprise 		CHAR(14)		NULL,
	Poste 					VARCHAR(7)		NULL,
	CourrielEntreprise	 	VARCHAR(320)	NULL,
	tag						VARCHAR(1000)	NULL,
	PRIMARY KEY(Id),
	IdStage					INT,
	CONSTRAINT Constraint_UNIQUE_Stagiaire UNIQUE (CourrielScolaire)
);

DROP VIEW IF EXISTS vStagiaire;
CREATE VIEW vStagiaire AS SELECT * FROM tblStagiaire;

-- Table JournalDeBord

DROP TABLE IF EXISTS tblJournalDeBord;
CREATE TABLE tblJournalDeBord(
	Id			 			INT				AUTO_INCREMENT,
	Dates		 		DATE			NOT NULL,
	Nom 					VARCHAR(50)		NOT NULL,
	Prenom 					VARCHAR(50)		NOT NULL,
	Entree			 		VARCHAR(500)		NULL,
	Documents	 			VARCHAR(255)		NULL,
	PRIMARY KEY(Id),
	IdStagiaire				INT
);

DROP VIEW IF EXISTS vJournalDeBord;
CREATE VIEW vJournalDeBord AS SELECT * FROM tblJournalDeBord;

-- Table Stage

DROP TABLE IF EXISTS tblStage;
CREATE TABLE tblStage(
	Id			 			INT				AUTO_INCREMENT,
	PRIMARY KEY(Id),
	IdEntreprise			INT,
	IdResponsable			INT,
	IdSuperviseur			INT,
	IdStagiaire				INT,
	IdGestionnaire			INT,
	IdEnseignant			INT
);

DROP VIEW IF EXISTS vStage;
CREATE VIEW vStage AS SELECT * FROM tblStage;

-- Table Gestionnaire

DROP TABLE IF EXISTS tblGestionnaire;
CREATE TABLE tblGestionnaire(
	Id			 			INT				AUTO_INCREMENT,
	PRIMARY KEY(Id),
	IdEmployeCegep			INT
);

DROP VIEW IF EXISTS vGestionnaire;
CREATE VIEW vGestionnaire AS SELECT * FROM tblGestionnaire;

-- Table Enseignant

DROP TABLE IF EXISTS tblEnseignant;
CREATE TABLE tblEnseignant(
	Id			 			INT				AUTO_INCREMENT,
	PRIMARY KEY(Id),
	IdEmployeCegep			INT
);

DROP VIEW IF EXISTS vEnseignant;
CREATE VIEW vEnseignant AS SELECT * FROM tblEnseignant;

-- Table EmployeCegep

DROP TABLE IF EXISTS tblEmployeCegep;
CREATE TABLE tblEmployeCegep(
	Id			 			INT				AUTO_INCREMENT,
	PRIMARY KEY(Id)
);

DROP VIEW IF EXISTS vEmployeCegep;
CREATE VIEW vEmployeCegep AS SELECT * FROM tblEmployeCegep;

--  Table Entreprise

DROP TABLE IF EXISTS tblEntreprise;
CREATE TABLE tblEntreprise(
	Id			 			INT				AUTO_INCREMENT,
	CourrielEntreprise		VARCHAR(320)	NOT NULL,
	Nom 					VARCHAR(100)	NOT NULL,
	Prenom 					VARCHAR(100)	NOT NULL,
	NumTel			 		CHAR(14) 		NOT NULL,
	NumCivique 				CHAR(5)			NOT NULL,
	Rue				 		VARCHAR(100)	NOT NULL,
	Ville			 		VARCHAR(100)	NOT NULL,
	Province				VARCHAR(25)		NOT NULL,
	CodePostal			 	VARCHAR(7)		NOT NULL,
	Logo 					VARCHAR(255)	NOT NULL,
	tagEntreprise			VARCHAR(1000)	NULL,
	PRIMARY KEY(Id),
	CONSTRAINT Constraint_UNIQUE_Entreprise UNIQUE (CourrielEntreprise)
);

DROP VIEW IF EXISTS vEntreprise;
CREATE VIEW vEntreprise AS SELECT * FROM tblEntreprise;

-- Table EmployeEntreprise

DROP TABLE IF EXISTS tblEmployeEntreprise;
CREATE TABLE tblEmployeEntreprise(
	Id						INT				AUTO_INCREMENT,
	CourrielEntreprise 		VARCHAR(320),
	Nom 					VARCHAR(50),
	Prenom 					VARCHAR(50),
	NumTelCell		 		CHAR(14),
	CourrielPersonnel 		VARCHAR(320),
	NumTelEntreprise 		CHAR(14),
	Poste 					VARCHAR(7),
	tagSuperviseur			VARCHAR(1000)	NULL,
	PRIMARY KEY(Id),
	IdEntreprise			INT,
	CONSTRAINT Constraint_UNIQUE_EmployeEntreprise UNIQUE (CourrielEntreprise)
);

DROP VIEW IF EXISTS vEmployeEntreprise;
CREATE VIEW vEmployeEntreprise AS SELECT * FROM tblEmployeEntreprise;

-- Table tblSuperviseur

DROP TABLE IF EXISTS tblSuperviseur;
CREATE TABLE tblSuperviseur(
	Id			 			INT				AUTO_INCREMENT,
	PRIMARY KEY(Id),
	IdEmployeEntreprise		INT
);

DROP VIEW IF EXISTS vSuperviseur;
CREATE VIEW vSuperviseur AS SELECT * FROM tblSuperviseur;

-- Table Responsable

DROP TABLE IF EXISTS tblResponsable;
CREATE TABLE tblResponsable(
	Id			 			INT				AUTO_INCREMENT,
	PRIMARY KEY(Id),
	IdEmployeEntreprise		INT
);

DROP VIEW IF EXISTS vResponsable;
CREATE VIEW vResponsable AS SELECT * FROM tblResponsable;

-- Foreign key


ALTER TABLE tblReponseQuestionChoixReponse
ADD FOREIGN KEY (IdReponse)
REFERENCES
tblReponse(Id);


ALTER TABLE tblReponseQuestionChoixReponse
ADD FOREIGN KEY (IdQuestionChoixReponse)
REFERENCES
tblQuestionChoixReponse(Id);


ALTER TABLE tblQuestionChoixReponseEvaluation
ADD FOREIGN KEY (IdEvaluation)
REFERENCES
tblEvaluation(Id);


ALTER TABLE tblQuestionChoixReponseEvaluation
ADD FOREIGN KEY (IdQuestionChoixReponse)
REFERENCES
tblQuestionChoixReponse(Id);


ALTER TABLE tblQuestionGrilleEvaluation
ADD FOREIGN KEY (IdEvaluation)
REFERENCES
tblEvaluation(Id);


ALTER TABLE tblQuestionGrilleEvaluation
ADD FOREIGN KEY (IdQuestionGrille)
REFERENCES
tblQuestionGrille(Id);


ALTER TABLE tblReponseQuestionGrille
ADD FOREIGN KEY (IdReponse)
REFERENCES
tblReponse(Id);


ALTER TABLE tblReponseQuestionGrille
ADD FOREIGN KEY (IdQuestionGrille)
REFERENCES
tblQuestionGrille(Id);


ALTER TABLE tblSuperviseur
ADD FOREIGN KEY (IdEmployeEntreprise)
REFERENCES
tblEmployeEntreprise(Id);


ALTER TABLE tblEmployeEntreprise
ADD FOREIGN KEY (IdEntreprise)
REFERENCES
tblEntreprise(Id);


ALTER TABLE tblResponsable
ADD FOREIGN KEY (IdEmployeEntreprise)
REFERENCES
tblEmployeEntreprise(Id);


ALTER TABLE tblStage
ADD FOREIGN KEY (idEntreprise)
REFERENCES
tblEntreprise(Id);


ALTER TABLE tblStage
ADD FOREIGN KEY (IdResponsable)
REFERENCES
tblResponsable(Id);


ALTER TABLE tblStage
ADD FOREIGN KEY (IdSuperviseur)
REFERENCES
tblSuperviseur(Id);


ALTER TABLE tblStage
ADD FOREIGN KEY (IdStagiaire)
REFERENCES
tblStagiaire(Id);


ALTER TABLE tblStage
ADD FOREIGN KEY (IdGestionnaire)
REFERENCES
tblGestionnaire(Id);


ALTER TABLE tblStage
ADD FOREIGN KEY (IdEnseignant)
REFERENCES
tblEnseignant(Id);


ALTER TABLE tblGestionnaire
ADD FOREIGN KEY (IdEmployeCegep)
REFERENCES
tblEmployeCegep(Id);


ALTER TABLE tblEnseignant
ADD FOREIGN KEY (IdEmployeCegep)
REFERENCES
tblEmployeCegep(Id);


ALTER TABLE tblSuperviseurEvaluationStagiaireStage
ADD FOREIGN KEY (IdEvaluation)
REFERENCES
tblEvaluation(Id);


ALTER TABLE tblSuperviseurEvaluationStagiaireStage
ADD FOREIGN KEY (IdSuperviseur)
REFERENCES
tblSuperviseur(Id);


ALTER TABLE tblSuperviseurEvaluationStagiaireStage
ADD FOREIGN KEY (IdStage)
REFERENCES
tblStage(Id);


ALTER TABLE tblSuperviseurEvaluationStagiaireStage
ADD FOREIGN KEY (IdStagiaire)
REFERENCES
tblStagiaire(Id);


ALTER TABLE tblStagiaire
ADD FOREIGN KEY (IdStage)
REFERENCES
tblStage(Id);


ALTER TABLE tblJournalDeBord
ADD FOREIGN KEY (IdStagiaire)
REFERENCES
tblStagiaire(Id);