-- BD POUR PROJET PACKAGES 1-4
-- CRÉÉE LE 06/09/2017 PAR MARC-ANTOINE DUCHESNE

-- Création de la bd
-- DROP DATABASE IF EXISTS BDProjet_equipe2V2;
-- CREATE DATABASE BDProjet_equipe2V2;-

-- USE cegepjon_p2017_2_dev;
-- USE cegepjon_p2017_2_prod;
-- USE cegepjon_p2017_2_tests;

-- Table Reponsesss
DROP TABLE IF EXISTS tblReponse;
CREATE TABLE tblReponse(
	Id						INT				AUTO_INCREMENT,
	Texte 					VARCHAR(250) 	NOT NULL,
	PRIMARY KEY(Id)
);


DROP VIEW IF EXISTS vReponse;
CREATE VIEW vReponse AS SELECT Id,Texte,CONCAT(Id,Texte) AS tag FROM tblReponse;


-- Table ReponseQuestionGrille

DROP TABLE IF EXISTS tblReponseQuestionGrille;
CREATE TABLE tblReponseQuestionGrille(
	IdQuestionGrille		INT				NOT NULL,
	IdReponse				INT			 	NOT NULL,
	PRIMARY KEY(IdQuestionGrille,IdReponse)
);
DROP VIEW IF EXISTS vReponseQuestionGrille;
CREATE VIEW vReponseQuestionGrille AS SELECT IdQuestionGrille,IdReponse,CONCAT(IdQuestionGrille,IdReponse) AS tag FROM tblReponseQuestionGrille;

-- Table ReponseQuestionChoixReponse

DROP TABLE IF EXISTS tblReponseQuestionChoixReponse;
CREATE TABLE tblReponseQuestionChoixReponse(
	IdQuestionChoixReponse	INT				NOT NULL,
	IdReponse				INT			 	NOT NULL,
	PRIMARY KEY(IdQuestionChoixReponse,IdReponse)
);

DROP VIEW IF EXISTS vReponseQuestionChoixReponse;
CREATE VIEW vReponseQuestionChoixReponse AS SELECT
 IdQuestionChoixReponse,IdReponse,CONCAT(IdQuestionChoixReponse,idReponse) AS tag FROM  tblReponseQuestionChoixReponse;

-- Table QuestionChoixReponseEvaluation

DROP TABLE IF EXISTS tblQuestionChoixReponseEvaluation;
CREATE TABLE tblQuestionChoixReponseEvaluation(
	IdQuestionChoixReponse	INT				NOT NULL,
	IdEvaluation			INT			 	NOT NULL,
	PRIMARY KEY(IdQuestionChoixReponse,IdEvaluation)
);

DROP VIEW IF EXISTS vQuestionChoixReponseEvaluation;
CREATE VIEW vQuestionChoixReponseEvaluation AS SELECT 
IdQuestionChoixReponse,IdEvaluation,CONCAT(IdQuestionChoixReponse,IdEvaluation) AS tag FROM tblQuestionChoixReponseEvaluation;

-- Table tblQuestionGrilleEvaluation

DROP TABLE IF EXISTS tblQuestionGrilleEvaluation;
CREATE TABLE tblQuestionGrilleEvaluation(
	IdQuestionGrille		INT				NOT NULL,
	IdEvaluation			INT			 	NOT NULL,
	PRIMARY KEY(IdQuestionGrille,IdEvaluation)
);

DROP VIEW IF EXISTS vQuestionGrilleEvaluation;
CREATE VIEW vQuestionGrilleEvaluation AS SELECT 
IdQuestionGrille,IdEvaluation,CONCAT(IdQuestionGrille,IdEvaluation) AS tag FROM tblQuestionGrilleEvaluation;

-- Table QuestionGrille

DROP TABLE IF EXISTS tblQuestionGrille;
CREATE TABLE tblQuestionGrille(
	Id						INT				AUTO_INCREMENT,
	Texte 					VARCHAR(250) 	NOT NULL,
	PRIMARY KEY(Id),
	idCategorieQuestion		INT				NOT NULL
);

DROP VIEW IF EXISTS vQuestionGrille;
CREATE VIEW vQuestionGrille AS SELECT Id,Texte,CONCAT(Id,Texte,IdCategorieQuestion) 
AS tag,idCategorieQuestion FROM tblQuestionGrille;

-- Table QuestionChoixReponse

DROP TABLE IF EXISTS tblQuestionChoixReponse;
CREATE TABLE tblQuestionChoixReponse(
	Id						INT				AUTO_INCREMENT,
	Texte 					VARCHAR(250) 	NOT NULL,
	PRIMARY KEY(Id),
	idCategorieQuestion		INT			    NULL
);

DROP VIEW IF EXISTS vQuestionChoixReponse;
CREATE VIEW vQuestionChoixReponse AS SELECT Id,Texte,CONCAT(Id,Texte,idCategorieQuestion)
AS tag, idCategorieQuestion FROM tblQuestionChoixReponse;

-- Table Evaluation

DROP TABLE IF EXISTS tblEvaluation;
CREATE TABLE tblEvaluation(
	Id						INT				AUTO_INCREMENT,
	Titre 					VARCHAR(40) 	NOT NULL,
	DateLimite				DATE			NOT NULL,
	PRIMARY KEY(Id)
);

DROP VIEW IF EXISTS vEvaluation;
CREATE VIEW vEvaluation AS SELECT Id,Titre,DateLimite,CONCAT(Id,Titre,DateLimite) AS tag FROM tblEvaluation;

-- Table SuperviseurEvaluationStagiaireStage

DROP TABLE IF EXISTS tblSuperviseurEvaluationStagiaireStage;
CREATE TABLE tblSuperviseurEvaluationStagiaireStage(
	IdEvaluation			INT				NOT NULL,
	IdSuperviseur			INT				NOT NULL,
	IdStage					INT				NOT NULL,
	IdStagiaire				INT				NOT NULL,
	Statut					BIT				NOT	NULL,
	DateComplétée			DATE			NULL,
	PRIMARY KEY(IdEvaluation,IdSuperviseur,IdStage,IdStagiaire)
);

DROP VIEW IF EXISTS vSuperviseurEvaluationStagiaireStage;
CREATE VIEW vSuperviseurEvaluationStagiaireStage AS SELECT IdEvaluation,IdSuperviseur,IdStage,IdStagiaire,Statut,DateComplétée,
CONCAT(IdEvaluation,IdSuperviseur,IdStage,IdStagiaire,Statut,IFNULL(DateComplétée,'')) AS tag FROM tblSuperviseurEvaluationStagiaireStage;

-- Table stagiaire

DROP TABLE IF EXISTS tblStagiaire;
CREATE TABLE tblStagiaire(
	Id			 			INT				AUTO_INCREMENT,
	CourrielScolaire 		VARCHAR(320)	NOT NULL,
	Nom 					VARCHAR(50)		NOT NULL,
	Prenom 					VARCHAR(50)		NOT NULL,
	NumTelPersonnel 		CHAR(14)		NOT NULL,
	NumTelMaison 			CHAR(14)		NOT NULL,
	CourrielPersonnel 		VARCHAR(320)	NOT NULL,
	NumTelEntreprise 		CHAR(14)		NULL,
	Poste 					VARCHAR(7)		NULL,
	CourrielEntreprise	 	VARCHAR(320)	NULL,
	PRIMARY KEY(Id),
	IdStage					INT				NULL,
	CONSTRAINT Constraint_UNIQUE_Stagiaire UNIQUE (CourrielScolaire)
);

DROP VIEW IF EXISTS vStagiaire;
CREATE VIEW vStagiaire AS SELECT Id,CourrielScolaire,Nom,Prenom,NumTelPersonnel,NumTelMaison,CourrielPersonnel
,NumTelEntreprise,Poste,CourrielEntreprise,CONCAT(Id,CourrielScolaire,Nom,Prenom,NumTelPersonnel,NumTelMaison,CourrielPersonnel
,IFNULL(NumTelEntreprise,''),IFNULL(Poste,''),IFNULL(CourrielEntreprise,''),IFNULL(IdStage,'')) AS tag,IdStage FROM tblStagiaire;

-- Table JournalDeBord

DROP TABLE IF EXISTS tblJournalDeBord;
CREATE TABLE tblJournalDeBord(
	Id			 			INT				AUTO_INCREMENT,
	Dates			 		DATETIME			NOT NULL,
	Entree			 		VARCHAR(700)		NOT NULL,
	Documents	 			VARCHAR(255)		NULL,
	PRIMARY KEY(Id),
	IdStagiaire				INT					NOT NULL
);

DROP VIEW IF EXISTS vJournalDeBord;
CREATE VIEW vJournalDeBord AS SELECT Id,Dates,Entree,Documents,CONCAT(Id,Dates,Entree,IdStagiaire) AS tag,
 IdStagiaire FROM tblJournalDeBord;

-- Table Stage

DROP TABLE IF EXISTS tblStage;
CREATE TABLE tblStage(
	Id			 			INT				AUTO_INCREMENT,
	PRIMARY KEY(Id),
	IdEntreprise			INT					NOT NULL,
	IdResponsable			INT					NOT NULL,
	IdSuperviseur			INT					NOT NULL,
	IdStagiaire				INT					NOT NULL,
	IdGestionnaire			INT					NOT NULL,
	IdEnseignant			INT					NOT NULL
);

DROP VIEW IF EXISTS vStage;
CREATE VIEW vStage AS SELECT Id,CONCAT(Id,IdEntreprise,IdResponsable,IdSuperviseur,IdStagiaire,IdGestionnaire,IdEnseignant)
AS tag,IdEntreprise,IdResponsable,IdSuperviseur,IdStagiaire,IdGestionnaire,IdEnseignant FROM tblStage;

-- Table Gestionnaire

DROP TABLE IF EXISTS tblGestionnaire;
CREATE TABLE tblGestionnaire(
	Id			 			INT				AUTO_INCREMENT,
	PRIMARY KEY(Id),
	IdEmployeCegep			INT				NULL
);

DROP VIEW IF EXISTS vGestionnaire;
CREATE VIEW vGestionnaire AS SELECT Id,CONCAT(Id,IFNULL(IdEmployeCegep,'')) AS tag,IdEmployeCegep FROM tblGestionnaire;

-- Table Enseignant

DROP TABLE IF EXISTS tblEnseignant;
CREATE TABLE tblEnseignant(
	Id			 			INT				AUTO_INCREMENT,
	PRIMARY KEY(Id),
	IdEmployeCegep			INT				NOT NULL
);

DROP VIEW IF EXISTS vEnseignant;
CREATE VIEW vEnseignant AS SELECT Id,CONCAT(Id,IdemployeCegep) AS tag,IdEmployeCegep FROM tblEnseignant;

-- Table EmployeCegep

DROP TABLE IF EXISTS tblEmployeCegep;
CREATE TABLE tblEmployeCegep(
	Id						INT				AUTO_INCREMENT,
	CourrielCegep	 		VARCHAR(320)	NOT NULL,
	Nom 					VARCHAR(50)		NOT NULL,
	Prenom 					VARCHAR(50)		NOT NULL,
	CodePermanent			CHAR(7)			NOT NULL,
	NumTelCell		 		CHAR(14)		NOT NULL,
	CourrielPersonnel 		VARCHAR(320)	NOT NULL,
	PRIMARY KEY(Id),
	CONSTRAINT Constraint_UNIQUE_EmployeCegep UNIQUE (CourrielCegep)
);

DROP VIEW IF EXISTS vEmployeCegep;
CREATE VIEW vEmployeCegep AS SELECT Id,CourrielCegep,CodePermanent,Nom,NumTelCell,Prenom,
CourrielPersonnel,CONCAT(Id,CourrielCegep,CodePermanent,Nom,NumTelCell,Prenom,
CourrielPersonnel) AS tag FROM tblEmployeCegep;

--  Table Entreprise

DROP TABLE IF EXISTS tblEntreprise;
CREATE TABLE tblEntreprise(
	Id			 			INT				AUTO_INCREMENT,
	CourrielEntreprise		VARCHAR(320)	NOT NULL,
	Nom 					VARCHAR(100)	NOT NULL,
	NumTel			 		CHAR(14) 		NOT NULL,
	NumCivique 				CHAR(5)			NOT NULL,
	Rue				 		VARCHAR(100)	NOT NULL,
	Ville			 		VARCHAR(100)	NOT NULL,
	Province				VARCHAR(25)		NOT NULL,
	CodePostal			 	VARCHAR(7)		NOT NULL,
	Logo 					VARCHAR(255)	NULL,
	PRIMARY KEY(Id),
	CONSTRAINT Constraint_UNIQUE_Entreprise UNIQUE (CourrielEntreprise)
);
DROP VIEW IF EXISTS vEntreprise;
CREATE VIEW vEntreprise AS SELECT Id,CourrielEntreprise,Nom,NumTel,NumCivique,Rue,Ville,Province,CodePostal,Logo,
CONCAT(Id,CourrielEntreprise,Nom,NumTel,NumCivique,Rue,Ville,Province,CodePostal,IFNULL(Logo,'')) AS tag FROM tblEntreprise;

-- Table EmployeEntreprise

DROP TABLE IF EXISTS tblEmployeEntreprise;
CREATE TABLE tblEmployeEntreprise(
	Id						INT				AUTO_INCREMENT,
	CourrielEntreprise 		VARCHAR(320)	NOT NULL,
	Nom 					VARCHAR(50)		NOT NULL,
	Prenom 					VARCHAR(50)		NOt NULL,
	NumTelCell		 		CHAR(14)		NOT NULL,
	CourrielPersonnel 		VARCHAR(320)	NOT NULL,
	NumTelEntreprise 		CHAR(14)		NOT NULL,
	Poste 					VARCHAR(7)		NULL,
	PRIMARY KEY(Id),
	IdEntreprise			INT				NOT NULL,
	CONSTRAINT Constraint_UNIQUE_EmployeEntreprise UNIQUE (CourrielEntreprise)
);

DROP VIEW IF EXISTS vEmployeEntreprise;
CREATE VIEW vEmployeEntreprise AS SELECT Id,CourrielEntreprise,Nom,Prenom,NumTelCell,
CourrielPersonnel,NumTelEntreprise,Poste,CONCAT(Id,CourrielEntreprise,Nom,Prenom,NumTelCell,
CourrielPersonnel,NumTelEntreprise,IFNULL(Poste, ""),IdEntreprise) AS tag,IdEntreprise FROM tblEmployeEntreprise;

-- Table tblSuperviseur

DROP TABLE IF EXISTS tblSuperviseur;
CREATE TABLE tblSuperviseur(
	Id			 			INT				AUTO_INCREMENT,
	PRIMARY KEY(Id),
	IdEmployeEntreprise		INT				NOT NULL
);

DROP VIEW IF EXISTS vSuperviseur;
CREATE VIEW vSuperviseur AS SELECT Id,CONCAT(Id,IdEmployeEntreprise) AS tag,IdEmployeEntreprise FROM tblSuperviseur;

-- Table Responsable

DROP TABLE IF EXISTS tblResponsable;
CREATE TABLE tblResponsable(
	Id			 			INT				AUTO_INCREMENT,
	PRIMARY KEY(Id),
	IdEmployeEntreprise		INT				NOT NULL
);

DROP VIEW IF EXISTS vResponsable;
CREATE VIEW vResponsable AS SELECT Id,CONCAT(Id,IdEmployeEntreprise) AS tag,IdEmployeEntreprise FROM tblResponsable;

-- Table Categorie Question


DROP TABLE IF EXISTS tblCategorieQuestion;
CREATE TABLE tblCategorieQuestion 
(
	Id 						INT 			AUTO_INCREMENT,
	descriptionCategorie	 VARCHAR(500) 	NOT NULL,
	PRIMARY KEY(Id)
);

DROP VIEW IF EXISTS vCategorieQuestion;
CREATE VIEW vCategorieQuestion AS SELECT Id,descriptionCategorie,CONCAT(Id,descriptionCategorie) AS tag FROM tblCategorieQuestion;



-- VUE
DROP VIEW IF EXISTS vTableauBord;
CREATE VIEW vTableauBord AS 
SELECT  Stagiaire.Id, Stagiaire.Nom, Stagiaire.Prenom, Stagiaire.NumTelPersonnel, 
        Emp.Id AS 'Id Superviseur', Emp.Nom AS 'Nom Superviseur', Emp.Prenom AS 'Prenom Superviseur', Emp.NumTelCell AS 'Cell Superviseur', 
        EmpCeg.Id AS 'Id Enseignant', EmpCeg.Nom AS 'Nom Enseignant', EmpCeg.Prenom AS 'Prenom Enseignant', EmpCeg.NumTelCell AS 'Tel Enseignant' 
FROM vStagiaire AS Stagiaire
JOIN vStage AS Stage
ON Stage.IdStagiaire = Stagiaire.Id
JOIN vSuperviseur AS Sup
ON Sup.Id = Stage.IdSuperviseur
JOIN vEmployeEntreprise AS Emp
ON Emp.Id = Sup.IdEmployeEntreprise
JOIN vEnseignant AS Enseignant
ON Enseignant.Id = Stage.IdEnseignant
JOIN vEmployeCegep AS EmpCeg
ON EmpCeg.Id = Enseignant.IdEmployeCegep;


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

ALTER TABLE tblQuestionGrille
ADD FOREIGN KEY (IdCategorieQuestion)
REFERENCES
tblCategorieQuestion(Id);

ALTER TABLE tblQuestionChoixReponse
ADD FOREIGN KEY (IdCategorieQuestion)
REFERENCES
tblCategorieQuestion(Id);